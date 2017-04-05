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
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\View;

class ReservationController extends Controller
{
	private $price_per_person = 3.5;
	private $offers = [];
	private $total = 0;
	private $total_without_discount = 0;
	private $persons = 0;
	private $to_pay = 0;
	
	#Get offers data
	public function __construct(Offer $offer)
	{
		$data = null;
		
		if ($selected_offers = session('selectedOffers')) {
			$data = $this->getReservationData($selected_offers);
		} else return redirect()->action('ActivityController@index')->send();
		
		$this->offers = $data->offers;
		$this->total = $data->total;
		$this->total_without_discount = $data->total_without_discount;
		$this->persons = $data->persons;
		$this->to_pay = $data->to_pay;
		
		return 0;
	}
	
	#Get price in currencies from USD
	private function getPriceInCurrency($price, $currency = 'USD')
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
				'total'        => $item->sum('real_price')
			], function ($message) use ($agency_email) {
				$message->from('info@kipmuving.com', 'Kipmuving team');
//				$message->to($agency_email)->subject('Kipmuving.com reservation');
				//TODO change
				$message->to('sanek.solodovnikov.94@gmail.com')->subject('Kipmuving.com reservation');
			});
		}
	}
	
	#Collect reservation data from selected offers
	private static function getReservationData($selected_offers)
	{
		$data = collect();
		$data->total = 0;
		$data->total_in_currency = 0;
		$data->total_without_discount = 0;
		$data->total_without_discount_in_currency = 0;
		$data->persons = 0;
		$data->to_pay = 0;
		
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
			$data->total += $data->offers[$key]->real_price * (1 - config('kipmuving.discount')) * $selected_offer['persons'];
			$data->total_in_currency += $data->offers[$key]->price * (1 - config('kipmuving.discount')) * $selected_offer['persons'];
			$data->total_without_discount += $data->offers[$key]->real_price * $selected_offer['persons'];
			$data->total_without_discount_in_currency += $data->offers[$key]->price * $selected_offer['persons'];
			$data->persons += $selected_offer['persons'];
		}
		
		//todo change
//		$data->to_pay = round(($data->total / session('currency.values.USDCLP')) * config('kipmuving.service_fee'), 2);
		$data->to_pay = 0.05;
		
		return $data;
	}
	
	#Display reservations (/reserve)
	public function index()
	{
		$this->getPriceInCurrency($this->to_pay, 'BRL');
		
		if (!($user = Auth::user()))
			return redirect('/login');
		
		if (!($selected_offers = session('selectedOffers')))
			return redirect()->action('ActivityController@index');
		
		$reservations = $this->getReservationData($selected_offers);
		
		$data = [
			'user'        => $user,
			'reservation' => $reservations
		];
		
		return view('site.reservar.su-reservar', $data);
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
	
	#--------------------------------------------------------------------\Payment PayPal
	public function paymentPaypal(Request $request)
	{
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
				'amount' => $reservations->to_pay,
			])->send();
		} else {
			$response = $gateway->purchase([
				'amount'    => $reservations->to_pay,
				'no_shipping' => 1,
				
				//TEST
//				'returnUrl' => 'http://kipmuving.lo/reserve/paypal',
//				'cancelUrl' => 'http://kipmuving.lo/reserve',
				
				//LIVE
					'returnUrl' => 'http://kipmuving.com/reserve/paypal',
					'cancelUrl' => 'http://kipmuving.com/reserve',
				
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
	
	#--------------------------------------------------------------------\Payment Pagseguro
	public function paymentPagseguro()
	{
		if ($user = Auth::user()) {
			$data = [
				'items'    => [
					[
						'id'          => uniqid(),
						'description' => 'Kipmuving reservation',
						'quantity'    => 1,
						'amount'      => $this->getPriceInCurrency($this->to_pay, 'BRL')
					]
				],
				'currency' => 'BRL'
			];
			
			$checkout = PagSeguro::checkout()->createFromArray($data);
			$credentials = PagSeguro::credentials()->get();
			$information = $checkout->send($credentials);
			
			$this->createReservation($this->offers, $user, 'pagseguro', $data['items'][0]['id'], 'none', false);
			
			session()->forget('selectedOffers');
			
			return redirect()->to($information->getLink().'&shippingAddressRequired=false');
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
	
	#--------------------------------------------------------------------\Payment Stripe
	public function reserve(Request $request, Offer $offer)
	{
		if ($user = Auth::user()) {
			if ($request['token']) {
				$sessionOffers = session('selectedOffers');
				$offers = [];
				$offersTotalCost = 0;
				$offersTotalCostWithoutDiscount = 0;
				$persons = 0;
				
				foreach ($sessionOffers as $key => $sessionOffer) {
					$offers[] = $offer->getOffer($sessionOffer['offer_id']);
					$offersTotalCost += $offers[$key]['real_price'] * (1 - config('kipmuving.discount')) * $sessionOffer['persons'];
					$offersTotalCostWithoutDiscount += $offers[$key]['real_price'] * $sessionOffer['persons'];
					$persons += $sessionOffer['persons'];
				}
				
				$topay = round($this->getPriceInCurrency($offersTotalCost) * config('kipmuving.service_fee'), 2);
				
				#Stripe create charge
				$stripe = Stripe::make(config('services.stripe.secret'));
				$customer = $stripe->customers()->create(['email' => $request['token']['email']]);
				$card = $stripe->cards()->create($customer['id'], $request['token']['id']);
				$charge = $stripe->charges()->create([
					'customer' => $customer['id'],
					'currency' => 'USD',
					'amount'   => $topay,
				]);
				
				if ($charge['status'] == 'succeeded') {
					
					$batch = $this->GUID();
					
					#Add data about reservation to DB
					foreach ($offers as $key => $offer) {
						$reservation = new Reservation();
						$reservation->user_id = $user['id'];
						$reservation->offer_id = $sessionOffers[$key]['offer_id'];
						$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $sessionOffers[$key]['date'])->toDateString();
						$reservation->batch_id = $batch;
						$reservation->persons = $sessionOffers[$key]['persons'];
						$reservation->save();
					}
					
					$this->sendMails($offers, $user);
					
					session()->forget('selectedOffers');
					
					#TODO translate
					$message = 'Success :)';
					
					return $message;
				}
			}
			#Paypal payment
//			elseif ($request['payment_status']){
//				if ($request['payment_status'] === 'Completed')
//				dd($request['payment_status']);
//			}
		}
		#TODO translate
		$message = 'Failure :(';
		
		return $message;
	}
	
	#--------------------------------------------------------------------\Payment PayU
	public function paymentPayU(Request $request)
	{
		$payubiz = new PayUbiz([
			'merchantId' => 'gtKFFx',
			'secretKey'  => 'eCwWELxi',
			'testMode'   => true
		]);
		$params = [
			'txnid'       => uniqid(),
			'amount'      => 10.50,
			'productinfo' => 'A book',
			'firstname'   => 'Peter',
			'email'       => 'abc@example.com',
			'phone'       => '1234567890',
			'surl'        => 'http://kipmuving.lo/reserve/payu',
			'furl'        => 'http://kipmuving.lo/reserve/payu',
		];
		
		$payubiz->initializePurchase($params)->send();


//		$client = new Client();
//		$res = $client->post('https://sandbox.gateway.payulatam.com/ppp-web-gateway', [
//			'merchantId' => '630645',
//			'accountId' => '632993',
//			'description' => 'Test PAYU',
//			'referenceCode' => 'TESTTESTOS',
//			'amount' => '10',
//			'currency' => 'USD',
//			'signature' => 'a7661a80834abc20c1a5bbe5eb87b3e4',
//			'responseUrl' => '/user',
//			'confirmationUrl' => '/reserve'
//		]);
//
//		echo $res->getBody();
//		dd($res->getStatusCode(), 'ok');
//
//
//		$uniqueId = uniqid();
//		$secret = md5('4Vj8eK4rloUd272L48hsrarnUA~508029~'.$uniqueId.'~'.'10.00'.'~'.'USD');
//		dd($secret);


//		$gateway = Omnipay::create('PayUBiz');
//
//		$gateway->setKey('508029');
//		$gateway->setSalt($secret);
//		$gateway->setTestMode(true);
//
//		$params = [
//			'name' => 'sanek',
//			'email' => 'email@sanek.com',
//			'amount' => '10.00',
//			'product' => 'Product name',
//			'transactionId' => uniqid(),
//			'failureUrl' => url('api/v1/checkout/failed'),
//			'returnUrl' => url('api/v1/checkout/thank-you')
//		];
//
//		$gateway->purchase($params)->send()->redirect();
//
//		dd($gateway);


//
//		$gateway = Omnipay::create('PayU');
//
//		dd($gateway->getDefaultParameters(), $gateway);
//		$gateway->setTestMode(true);
//
//		$card = [
//			'billingLastName' => 'sanek',
//			'number' => '4000015372250142',
//			'expiryMonth' => '01',
//			'expiryYear' => '20',
//			'cvv' => '123'
//		];
//
//		$response = $gateway->purchase([
//			'amount' => '10.00',
//			'card' => $card,
//			'identityType' => 'NCZ'
//		]);
//		$response->setMerchantId('630645');
//		$response->setSecretKey($secret);
//		dd($secret);
//		$response->send();
//		if ($response->isSuccessful())
//			echo 'success';
//		elseif ($response->isRedirect())
//			$response->redirect();
//		else
//			echo 'fail<br>'.$response->getMessage();
//
//
//
//		dd($gateway, $response);
//
//		#PayPal (Express)
//		if ($request->token) {
//			$response = $gateway->completePurchase([
//				'token'  => $request->token,
//				'amount' => '10.00',
//			])->send();
//		} else {
//			$response = $gateway->purchase([
//				'amount'      => '10.00',
//				'returnUrl'   => 'http://kipmuving.lo/reserve/paypal',
//				'cancelUrl'   => 'http://kipmuving.lo/reserve',
//				'currency'    => 'USD',
//				'description' => 'Kipmuving.com reservation',
//			])->send();
//		}
//
//		dd($response);
//
//		if ($response->isSuccessful())
//			echo 'success';
//		elseif ($response->isRedirect())
//			$response->redirect();
//		else
//			echo 'fail<br>'.$response->getMessage();
//
//		dd('end', $gateway);
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
