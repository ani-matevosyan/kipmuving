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
		$data->to_pay_in_currency = 0;
		
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
		$data->to_pay = round(($data->total / session('currency.values.USDCLP')) * config('kipmuving.service_fee'), 2);
		$data->to_pay_in_currency = round(($data->total_in_currency) * config('kipmuving.service_fee'), 2);
		
//		$data->to_pay = 0.05;
//		$data->to_pay_in_currency = 0.05;
		
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
				'amount'      => $reservations->to_pay,
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
	
	#--------------------------------------------------------------------\Payment PayU
	public function paymentPayURedirect(Request $request)
	{
//		Log::debug('Redirect - ok');
		dd($request->request);
	}
	
	public function paymentPayUNotifications(Request $request)
	{
		$data = [
			'response_code_pol'       => $request['response_code_pol'],
			'phone'                   => $request['phone'],
			'additional_value'        => $request['additional_value'],
			'test'                    => $request['test'],
			'transaction_date'        => $request['transaction_date'],
			'cc_number'               => $request['cc_number'],
			'cc_holder'               => $request['cc_holder'],
			'error_code_bank'         => $request['error_code_bank'],
			'billing_country'         => $request['billing_country'],
			'bank_referenced_name'    => $request['bank_referenced_name'],
			'description'             => $request['description'],
			'administrative_fee_tax'  => $request['administrative_fee_tax'],
			'value'                   => $request['value'],
			'administrative_fee'      => $request['administrative_fee'],
			'payment_method_type'     => $request['payment_method_type'],
			'office_phone'            => $request['office_phone'],
			'email_buyer'             => $request['email_buyer'],
			'response_message_pol'    => $request['response_message_pol'],
			'error_message_bank'      => $request['error_message_bank'],
			'shipping_city'           => $request['shipping_city'],
			'transaction_id'          => $request['transaction_id'],
			'sign'                    => $request['sign'],
			'tax'                     => $request['tax'],
			'transaction_bank_id'     => $request['transaction_bank_id'],
			'payment_method'          => $request['payment_method'],
			'billing_address'         => $request['billing_address'],
			'payment_method_name'     => $request['payment_method_name'],
			'pse_bank'                => $request['pse_bank'],
			'state_pol'               => $request['state_pol'],
			'date'                    => $request['date'],
			'nickname_buyer'          => $request['nickname_buyer'],
			'reference_pol'           => $request['reference_pol'],
			'currency'                => $request['currency'],
			'risk'                    => $request['risk'],
			'shipping_address'        => $request['shipping_address'],
			'bank_id'                 => $request['bank_id'],
			'payment_request_state'   => $request['payment_request_state'],
			'customer_number'         => $request['customer_number'],
			'administrative_fee_base' => $request['administrative_fee_base'],
			'attempts'                => $request['attempts'],
			'merchant_id'             => $request['merchant_id'],
			'exchange_rate'           => $request['exchange_rate'],
			'shipping_country'        => $request['shipping_country'],
			'installments_number'     => $request['installments_number'],
			'franchise'               => $request['franchise'],
			'payment_method_id'       => $request['payment_method_id'],
			'extra1'                  => $request['extra1'],
			'extra2'                  => $request['extra2'],
			'antifraudMerchantId'     => $request['antifraudMerchantId'],
			'extra3'                  => $request['extra3'],
			'commision_pol_currency'  => $request['commision_pol_currency'],
			'nickname_seller'         => $request['nickname_seller'],
			'ip'                      => $request['ip'],
			'commision_pol'           => $request['commision_pol'],
			'airline_code'            => $request['airline_code'],
			'billing_city'            => $request['billing_city'],
			'pse_reference1'          => $request['pse_reference1'],
			'cus'                     => $request['cus'],
			'reference_sale'          => $request['reference_sale'],
			'authorization_code'      => $request['authorization_code'],
			'pse_reference3'          => $request['pse_reference3'],
			'pse_reference2'          => $request['pse_reference2'],
		];
		Log::debug('Notification - data');
		Log::debug(print_r($data, 1));
	}
	
	
	public function paymentPayU()
	{
		$api_key = '4Vj8eK4rloUd272L48hsrarnUA';
		$merchant_id = '508029';
		$account_id = '512326';
		$uid = uniqid();
		$signature = md5($api_key.'~'.$merchant_id.'~'.$uid.'~'.$this->to_pay.'~'.'USD');
		
		$data = [
			'merchantId'      => $merchant_id,
			'ApiKey'          => $api_key,
			'accountId'       => $account_id,
			'description'     => 'Kipmuving.com reservation',
			'referenceCode'   => $uid,
			'amount'          => $this->to_pay,
			'tax'             => 0,
			'taxReturnBase'   => 0,
			'currency'        => 'USD',
			'signature'       => $signature,
			'totalAmount'     => $this->to_pay,
			'test'            => 1,
			'buyerEmail'      => 'testt@test.com',
			'responseUrl'     => 'http://kipmuving.com/reserve/payu/redirect',
			'confirmationUrl' => 'http://kipmuving.com/reserve/payu/notification',
			'continueUrl'     => 'http://kipmuving.com/reserve/payu/notification',
			'notifyUrl'       => 'http://kipmuving.com/reserve/payu/notification',
			'returnUrl'       => 'http://kipmuving.com/reserve/payu/notification',
			'surl'            => 'http://kipmuving.com/reserve/payu/notification',
			'furl'            => 'http://kipmuving.com/reserve/payu/notification',
			'sUrl'            => 'http://kipmuving.com/reserve/payu/notification',
			'fUrl'            => 'http://kipmuving.com/reserve/payu/notification',
		];
		
//		TODO save to DB

//		dd($data);
		
		return response()->json($data);
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
