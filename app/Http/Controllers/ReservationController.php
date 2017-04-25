<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Reservation;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Omnipay\Omnipay;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\View;

class ReservationController extends Controller
{
	private $price_per_person = 3.5;
	private $offers = [];
	private $total;
//	private $total_without_discount = 0;
	private $persons = 0;
//	private $to_pay;
	
	#Get offers data
	public function __construct(Offer $offer)
	{
		$data = null;
		
		if ($selected_offers = session('selectedOffers')) {
			$data = $this->getReservationData($selected_offers);
		} else return redirect()->action('ActivityController@index')->send();
		
		$this->offers = $data->offers;
		$this->total = $data->total;
//		$this->total_without_discount = $data->total_without_discount;
		$this->persons = $data->persons;

//		$this->to_pay = $data->total->to_pay;
		
		return 0;
	}
	
	#Get price in currencies from USD
	private static function getPriceInCurrency($price, $currency = 'USD')
	{
		$result = 0;
		
		switch ($currency) {
			case 'CLP':
				$result = $price * session('currency.values.USDCLP');
				break;
			case 'BRL':
				$result = $price * session('currency.values.USDBRL');
				break;
			case 'USD':
				$result = $price;
				break;
		}
		
		return round($result, 2);
	}
	
	#Create reservation and save to DB
	private function createReservation($offers, $user, $type, $uid, $status_code, $status = false)
	{
		foreach ($offers as $key => $offer) {
			$reservation = new Reservation();
			$reservation->type = $type;
			$reservation->status = $status;
			$reservation->status_code = $status_code;
			$reservation->lang_code = app()->getLocale();
			$reservation->user_id = $user->id;
			$reservation->offer_id = $offer->id;
			$reservation->persons = $offer->reservation['persons'];
			$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $offer->reservation['date'])->toDateString();
			$reservation->time_range = $offer->reservation['time']['start'].'-'.$offer->reservation['time']['end'];
			$reservation->payment_uid = $uid;
			$reservation->save();
		}
	}
	
	#Sending emails
	private static function sendMails($reservations, $user)
	{
		#Send email about reservation to user
		Mail::send('emails.reservar.user', ['user' => $user, 'reservation' => $reservations], function ($message) use ($user) {
			$message->from('info@kipmuving.com', 'Kipmuving team');
			$message->to($user->email, $user->first_name.' '.$user->last_name)->subject('Your Kipmuving.com reservations');
		});
		
		#Send email about reservation to admin
		Mail::send('emails.reservar.admin', ['user' => $user, 'reservation' => $reservations], function ($message) use ($user, $reservations) {
			$message->from('info@kipmuving.com', 'Kipmuving team');
			$message->to(config('app.admin_email'))->subject(count($reservations->offers).' Kipmuving.com reservations');
		});
		
		$agency_reservations = $reservations;
		$agency_reservations->offers = $reservations->offers->groupBy('agency.email');
		
		#Send emails about reservation to agencies
		foreach ($agency_reservations->offers as $agency_email => $item) {
			Mail::send('emails.reservar.agencia', [
				'reservations' => $item,
				'user'         => $user,
				'total'        => $item->sum('reservation.total')
			], function ($message) use ($agency_email) {
				$message->from('info@kipmuving.com', 'Kipmuving team');
//				$message->to($agency_email)->subject('Kipmuving.com reservation');
				//TODO change
				$message->to('sanek.solodovnikov.94@gmail.com')->subject('Kipmuving.com reservation');
			});
		}
	}
	
	private static function clearGarbageReservations()
	{
		$now = Carbon::now();
		
		$reservations = Reservation::where([
			['status', '=', false],
			['status_code', '=', 'none'],
			['updated_at', '<', $now->subDays(5)->toDateTimeString()]
		])
			->orWhere('status_code', '=', '')
			->get();
		
		foreach ($reservations as $reservation) {
			$reservation->delete();
		}

//		$reservations = Reservation::where([
//			['status', '=', false],
//			['status_code', '<>', 'none'],
//			['status_code', '<>', ''],
//			['updated_at', '<', $now->subDays(10)->toDateTimeString()]
//		])
//			->get();
	}
	
	#Collect reservation data from selected offers
	private static function getReservationData($selected_offers)
	{
		$data = collect();
//		$data->total = 0;
//		$data->total_in_currency = 0;
//		$data->total_without_discount = 0;
//		$data->total_without_discount_in_currency = 0;
		$data->persons = 0;
//		$data->to_pay = 0;
//		$data->to_pay_in_currency = 0;
		$data->total = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0]);
		$data->total->with_discount = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0]);
		$data->total->to_pay = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0]);
		
		$data->offers = collect();
		
		foreach ($selected_offers as $key => $selected_offer) {
			$data->offers->push(Offer::find($selected_offer['offer_id']));
			
			$reservation = [
				'date'    => $selected_offer['date'],
				'persons' => $selected_offer['persons'],
				'time'    => $selected_offer['time'],
				'total'   => $data->offers[$key]->price * $selected_offer['persons'] * (1 - config('kipmuving.discount'))
			];
			
			$data->offers[$key]['reservation'] = $reservation;
//			$data->total += $data->offers[$key]->real_price * (1 - config('kipmuving.discount')) * $selected_offer['persons'];
//			$data->total_in_currency += $data->offers[$key]->price * (1 - config('kipmuving.discount')) * $selected_offer['persons'];
//			$data->total_without_discount += $data->offers[$key]->real_price * $selected_offer['persons'];
//			$data->total_without_discount_in_currency += $data->offers[$key]->price * $selected_offer['persons'];
			$data->total['CLP'] += $data->offers[$key]->real_price * $selected_offer['persons'];
			$data->total['USD'] += round($data->total['CLP'] / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
			$data->total['BRL'] += round($data->total['USD'] * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['CLP'] = round($data->total['CLP'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['USD'] = round($data->total['USD'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['BRL'] = round($data->total['BRL'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->persons += $selected_offer['persons'];
		}
		
		//todo change
//		$data->to_pay = round(($data->total / session('currency.values.USDCLP')) * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
//		$data->to_pay_in_currency = round(($data->total_in_currency) * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
		$tmp = round($data->total->with_discount['CLP'] * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
		$data->total->to_pay['CLP'] = $tmp < 2000 ? 2000 : $tmp;
		$data->total->to_pay['USD'] = round($data->total->to_pay['CLP'] / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
		$data->total->to_pay['BRL'] = round($data->total->to_pay['USD'] * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);

//		$data->to_pay = 0.05;
//		$data->to_pay_in_currency = 0.05;
		
		return $data;
	}
	
	#Display reservations (/reserve)
	public function index()
	{
		if (!($user = Auth::user()))
			return redirect('/login');
		
		if (!($selected_offers = session('selectedOffers')))
			return redirect()->action('ActivityController@index');
		
		$reservations = $this->getReservationData($selected_offers);
		
		$data = [
			'user'        => $user,
			'reservation' => $reservations
		];
		
//		return view('site.reservar.su-reservar', $data);
//        return view('emails.reservar.agencia', ['reservations' => $reservations->offers, 'user' => $user, 'total' => '155000']);
//        return view('emails.reservar.admin', ['user' => $user, 'reservation' => $reservations]);
        return view('emails.reservar.user', ['user' => $user, 'reservation' => $reservations]);
	}
	
	#Cancel reservation
	public static function cancelReservation($id)
	{
		$reservation = Reservation::find($id);
		if ($reservation > Carbon::now()->toDateString()) {
			$reservation->status = false;
			$reservation->status_code = 'canceled';
			$reservation->save();
			
			//todo send emails
			
			return redirect()->back();
		}
		
		return abort(404);
	}
	#---------------------------------------------------------------------
	#
	#
	#
	#Payment PayPal
	public function paymentPaypal(Request $request)
	{
		$this->clearGarbageReservations();
		
		if (!($user = Auth::user()))
			return redirect('/login');
		
		if (!($selected_offers = session('selectedOffers')))
			return redirect()->action('ActivityController@index');
		
		$reservations = $this->getReservationData($selected_offers);
		
		$gateway = Omnipay::create('PayPal_Express');
		
		//TEST
//		$gateway->setUsername('contacto-facilitator_api1.kipmuving.com');
//		$gateway->setPassword('2JZSH53Q4JY79H3U');
//		$gateway->setSignature('A9frNSjdg56YUh3IOj8EoShIiMclAq9C.MaTyUJSoP-kp8lV4eYmPPhD');
//		$gateway->setTestMode(true);
		
		//LIVE
		$gateway->setUsername('contacto_api1.kipmuving.com');
		$gateway->setPassword('DGC72LTKNP4T3P69');
		$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AuhHvXFexATZ1S0YcGK5mBl9vDLM');
		$gateway->setTestMode(false);
		
		$gateway->setBrandName(config('app.name'));
		
		#PayPal (Express)
		if ($request->token) {
			$response = $gateway->completePurchase([
				'token'  => $request->token,
				'amount' => $reservations->total->to_pay['USD'],
			])->send();
		} else {
			$response = $gateway->purchase([
				'amount'      => $reservations->total->to_pay['USD'],
				'no_shipping' => 1,
				
				//TEST
//				'returnUrl' => 'http://kipmuving.lo/reserve/paypal',
//				'cancelUrl' => 'http://kipmuving.lo/reserve',
				
				//LIVE
				'returnUrl'   => 'http://kipmuving.com/reserve/paypal',
				'cancelUrl'   => 'http://kipmuving.com/reserve',
				
				'currency'    => 'USD',
				'description' => 'Kipmuving.com reservation',
			])->send();
		}
		
		if ($response->isSuccessful()) {
			$this->createReservation($reservations->offers, $user, 'paypal', $request->token, $response->getData()['ACK'], true);
			
			$this->sendMails($reservations, $user);
			
			session()->forget('selectedOffers');
			
			return redirect()->action('UserController@getUser');
			
		} elseif ($response->isRedirect())
			$response->redirect();
		else {
			$message = $response->getMessage();
			
			return redirect()->action('ReservationController@reserve')->with($message);
		}
		
		return null;
	}
	#---------------------------------------------------------------------
	#
	#
	#
	#Payment Pagseguro
	public function paymentPagseguro()
	{
		$this->clearGarbageReservations();
		
		if ($user = Auth::user()) {
			$data = [
				'items'    => [
					[
						'id'          => uniqid(),
						'description' => 'Kipmuving reservation',
						'quantity'    => 1,
						'amount'      => $this->total->to_pay['BRL']
					]
				],
				'currency' => 'BRL'
			];
			
			$checkout = PagSeguro::checkout()->createFromArray($data);
			$credentials = PagSeguro::credentials()->get();
			$information = $checkout->send($credentials);
			
			$this->createReservation($this->offers, $user, 'pagseguro', $data['items'][0]['id'], 'none', false);
			
			session()->forget('selectedOffers');
			
			return redirect()->to($information->getLink());
		}
		
		return redirect('/login');
	}
	
	public static function paymentPagseguroReturn($information)
	{
		$status = $information->getStatus()->getName();
		$item = $information->getItems()[0];
		
		$reservations = Reservation::where('payment_uid', '=', $item->getId())
			->orWhere('payment_uid', '=', $information->getCode())
			->where('type', '=', 'pagseguro')
			->get();
		
		$user_id = $reservations[0]->user_id;
		app()->setLocale($reservations[0]->lang_code);
		$selected_offers = [];
		
		foreach ($reservations as $reservation) {
			if ($reservation->status) { #reserved
				if (!($status == 'Paga')) {
					ReservationController::cancelReservation($reservation->id);
					$reservation->status = false;
					$reservation->payment_uid = $item->getId();
				}
			} else {
				if ($status == 'Paga') {
					$reservation->payment_uid = $information->getCode();
					$reservation->status = true;
					
					$time = explode('-', $reservation->time_range);
					$selected_offers[] = [
						'offer_id' => $reservation->offer_id,
						'date'     => Carbon::createFromFormat('Y-m-d', $reservation->reserve_date)->format('d/m/Y'),
						'persons'  => $reservation->persons,
						'time'     => [
							'start' => $time[0],
							'end'   => $time[1]
						]
					];
				} else {
					$reservation->payment_uid = $item->getId();
				}
			}
			$reservation->status_code = $status;
			$reservation->save();
		}
		
		if ($status == 'Paga') {
			$reservations = ReservationController::getReservationData($selected_offers);
			$user = User::find($user_id);
			
			ReservationController::sendMails($reservations, $user);
		}
	}
	
	public function paymentPagseguroRedirectGet(Request $request)
	{
//		dd('Pagseguro redirect information');
		//TODO информация что платеж принят на рассмотрение
//		Log::debug('redirect - get');
//		Log::info($request);
	}
	#---------------------------------------------------------------------
	#
	#
	#
	#Payment PayU
	public function paymentPayU()
	{
		$this->clearGarbageReservations();
		
		if ($user = Auth::user()) {
			//TEST
//			$api_key = '4Vj8eK4rloUd272L48hsrarnUA';
//			$merchant_id = '508029';
//			$account_id = '512326';
			//LIVE
			$api_key = '1wOnbtFLyv6N7v8QwWj5LVXNaw';
			$merchant_id = '630645';
			$account_id = '632993';
			$uid = uniqid();
			$signature = md5($api_key.'~'.$merchant_id.'~'.$uid.'~'.$this->total->to_pay['USD'].'~'.'USD');
//			$signature = md5($api_key.'~'.$merchant_id.'~'.$uid.'~3.5~'.'USD');
			
			$data = [
				'merchantId'    => $merchant_id,
				'ApiKey'        => $api_key,
				'accountId'     => $account_id,
				'description'   => 'Kipmuving.com reservation: '.$signature,
				'referenceCode' => $uid,
				'amount'        => $this->total->to_pay['USD'],
				'currency'      => 'USD',
				'signature'     => $signature,
				//TEST
//				'test'            => 1,
				//LIVE
				'test'          => 0,
//				'amount'        => 3.5,
				'buyerEmail'    => $user->email,
				'responseUrl'   => 'http://kipmuving.com/user',
				
				'confirmationUrl' => 'http://kipmuving.com/reserve/payu/notification',
				'continueUrl'     => 'http://kipmuving.com/reserve/payu/notification',
				'notifyUrl'       => 'http://kipmuving.com/reserve/payu/notification',
				'returnUrl'       => 'http://kipmuving.com/reserve/payu/notification',
			];
			
			$this->createReservation($this->offers, $user, 'payu', $signature, 'none', false);
			
			session()->forget('selectedOffers');
			
			return response()->json($data);
		}
		
		return redirect('/login');
	}
	
	public function paymentPayURedirect(Request $request)
	{
		Log::debug('redirect');
//		Log::debug('Redirect - ok');
//		dd($request->request);
		return redirect('/user');
	}
	
	public function paymentPayUNotifications(Request $request)
	{
		Log::debug('notification');
		Log::debug('request');
		Log::debug(print_r($request->request, 1));
		$status = $request['response_message_pol'];
		$signature = str_replace('Kipmuving.com reservation: ', '', $request['description']);
		
		$reservations = Reservation::where('payment_uid', '=', $signature)
			->where('type', '=', 'payu')
			->get();
		
		Log::debug('reservations');
		Log::debug(print_r($reservations, 1));
		Log::debug('status');
		Log::debug($status);
		Log::debug('signature');
		Log::debug($signature);
		
		$user_id = $reservations[0]->user_id;
		app()->setLocale($reservations[0]->lang_code);
		$selected_offers = [];
		
		foreach ($reservations as $reservation) {
			if ($reservation->status) { #reserved
				if ($status != 'APPROVED') {
					ReservationController::cancelReservation($reservation->id);
					$reservation->status = false;
//					$reservation->payment_uid = $item->getId();
				} else return;
			} else {
				if ($status == 'APPROVED') {
//					$reservation->payment_uid = $information->getCode();
					$reservation->status = true;
					
					$time = explode('-', $reservation->time_range);
					$selected_offers[] = [
						'offer_id' => $reservation->offer_id,
						'date'     => Carbon::createFromFormat('Y-m-d', $reservation->reserve_date)->format('d/m/Y'),
						'persons'  => $reservation->persons,
						'time'     => [
							'start' => $time[0],
							'end'   => $time[1]
						]
					];
				}
//				else {
//					$reservation->payment_uid = $item->getId();
//				}
			}
			$reservation->status_code = $status;
			$reservation->save();
		}
		Log::debug(print_r($selected_offers, 1));
		
		if ($status == 'APPROVED') {
			Log::debug('last if (send emails)');
			$reservations = ReservationController::getReservationData($selected_offers);
			$user = User::find($user_id);
			
			ReservationController::sendMails($reservations, $user);
		}
	}
	
	public function postPayU(Request $request)
	{
		Log::info('post');
		Log::info($request);
	}
	
	public function getPayU(Request $request)
	{
		Log::info('get');
		Log::info($request);
	}
	
}
