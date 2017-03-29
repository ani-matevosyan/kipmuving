<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Reservation;
use App\ReservationNew;
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
	
	#Generate unique id
	private function GUID()
	{
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(16384, 20479),
			mt_rand(32768, 49151),
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(0, 65535));
	}
	
	#Get price in USD from different currencies
	private function getPriceInUSD($price, $currency)
	{
		$result = 0;
		switch ($currency) {
			case 'BRL':
				$result = $price / session('currency.values.USDBRL');
				break;
			case 'CLP':
				$result = $price / session('currency.values.USDCLP');
				break;
			case 'USD':
				$result = $price;
				break;
		}
		
		return round($result, 2);
	}
	
	#Get price in BRL from price in USD
	private function getPriceInBRL()
	{
		return round($this->to_pay * session('currency.values.USDBRL'), 2);
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
			$reservation->offer_id = $offer['offer_id'];
			$reservation->persons = $offer['reservation']['persons'];
			$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $offer['reservation']['date'])->toDateString();
			$reservation->time_range = $offer['reservation']['time']['start'].'-'.$offer['reservation']['time']['end'];
			$reservation->payment_uid = $uid;
			$reservation->save();
		}
	}
	
	#Sending emails
	private static function sendMails($reservations, $user)
	{
		$data = [];
		$agencyData = [];
		foreach ($reservations->offers as $key => $offer) {
			
			#Collect activities data
			$data['offers'][$key]['activity_id'] = $offer['offerActivity']['id'];
			$data['offers'][$key]['activity_name'] = $offer['offerActivity']['name'];
			$data['offers'][$key]['activity_icon'] = $offer['offerActivity']['image_icon'];
			
			#Collect agencies data
			$data['offers'][$key]['agency_id'] = $offer['offerAgency']['id'];
			$data['offers'][$key]['agency_name'] = $offer['offerAgency']['name'];
			$data['offers'][$key]['agency_email'] = $offer['offerAgency']['email'];
			
			$agencyData[$offer['offerAgency']['email']][] = [
				'activity_name'    => $offer['offerActivity']['name'],
				'offer_date'       => $offer['reservation']['date'],
				'offer_start_time' => $offer['reservation']['time']['start'],
				'offer_end_time'   => $offer['reservation']['time']['end'],
				'offer_persons'    => $offer['reservation']['persons'],
				'offer_price'      => $offer['real_price'] * (1 - config('kipmuving.discount'))
			];
			
			#Collect offers data
			$data['offers'][$key]['offer_id'] = $offer['offer_id'];
			$data['offers'][$key]['offer_start_time'] = $offer['reservation']['time']['start'];
			$data['offers'][$key]['offer_end_time'] = $offer['reservation']['time']['end'];
			$data['offers'][$key]['offer_hours'] = $offer['hours'];
			$data['offers'][$key]['offer_carry'] = $offer['offerCarry'];
			$data['offers'][$key]['offer_persons'] = $offer['reservation']['persons'];
			$data['offers'][$key]['offer_price'] = $offer['real_price'] * (1 - config('kipmuving.discount'));
			$data['offers'][$key]['offer_date'] = $offer['reservation']['date'];
			
		}
		#Collect other data
		$data['total_cost'] = $reservations->total;
		$data['user_first_name'] = $user['first_name'];
		$data['user_last_name'] = $user['last_name'];
		$data['user_email'] = $user['email'];
		
		#Send email about reservation to user
		Mail::send('emails.reservar.user', ['data' => $data], function ($message) use ($user) {
			$message->from('info@kipmuving.com', 'Kipmuving team');
			$message->to($user['email'], $user['first_name'].' '.$user['last_name'])->subject('Your Kipmuving.com reservations');
		});
		
		#Send email about reservation to admin
		Mail::send('emails.reservar.admin', ['data' => $data], function ($message) use ($user, $data) {
			$message->from('info@kipmuving.com', 'Kipmuving team');
			$message->to(config('app.admin_email'))->subject(count($data['offers']).' Kipmuving.com reservations');
		});
		
		#Send emails about reservation to agencies
		foreach ($agencyData as $agency_email => $item) {
			Mail::send('emails.reservar.agencia', [
				'data' => [
					'offers'          => $item,
					'user_first_name' => $data['user_first_name'],
					'user_last_name'  => $data['user_last_name'],
					'user_email'      => $data['user_email'],
				]
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
		$offer = new Offer();
		
		$data = collect();
		$data->total = 0;
		$data->total_without_discount = 0;
		$data->persons = 0;
		$data->to_pay = 0;
		
		$data->offers = [];
		
		foreach ($selected_offers as $key => $selected_offer) {
			$data->offers[$key] = $offer->getOffer($selected_offer['offer_id']);
			
			$reservation = [
				'date'    => $selected_offer['date'],
				'persons' => $selected_offer['persons'],
				'time'    => $selected_offer['time'],
				'total'   => $data->offers[$key]->price * $selected_offer['persons'] * (1 - config('kipmuving.discount'))
			];
			
			$data->offers[$key]['reservation'] = $reservation;
			$data->total += $data->offers[$key]['real_price'] * (1 - config('kipmuving.discount')) * $selected_offer['persons'];
			$data->total_without_discount += $data->offers[$key]['real_price'] * $selected_offer['persons'];
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
		if (!($user = Auth::user()))
			return redirect('/login');
		
		if (!($selected_offers = session('selectedOffers')))
			return redirect()->action('ActivityController@index');

//		dd($selected_offers);
		
		$reservations = $this->getReservationData($selected_offers);

//		$this->sendMails($reservations, $user);
		
		$data = [
			'user'                   => $user,
			'persons'                => $reservations->persons,
			'total'                  => 0,
			'total_without_discount' => 0,
			'to_pay'                 => $reservations->to_pay
		];
		
		$results = [];
		
		foreach ($reservations->offers as $offer) {
			$data['total'] += $offer->price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'];
			$data['total_without_discount'] += $offer->price * $offer->reservation['persons'];
			
			$results[] = [
				'offerData'    => [
					'id'                 => $offer->offer_id,
					'date'               => $offer->reservation['date'],
					'start_time'         => $offer->reservation['time']['start'],
					'end_time'           => $offer->reservation['time']['end'],
					'persons'            => $offer->reservation['persons'],
					'hours'              => $offer->hours,
					'price'              => $offer->price_offer,
					'includes'           => $offer->offerIncludes,
					'important'          => $offer->offerImportant,
					'cancellation_rules' => $offer->offerCancellationRules
				],
				'agencyData'   => [
					'id'          => $offer->offerAgency->id,
					'name'        => $offer->offerAgency->name,
					'description' => $offer->offerAgency->description
				],
				'activityData' => [
					'id'         => $offer->offerActivity->id,
					'name'       => $offer->offerActivity->name,
					'image_icon' => $offer->offerActivity->image_icon
				]
			];
		}
		
		$data['reservations'] = $results;
		
		return view('site.reservar.su-reservar', $data);
	}
	
	#Cancel reservation
	public static function cancelReservation($id)
	{
		$reservation = Reservation::find($id);
		if ($reservation > Carbon::now()->toDateString()) {
			$reservation->delete();
			
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
		$gateway->setUsername('contacto-facilitator_api1.kipmuving.com');
		$gateway->setPassword('2JZSH53Q4JY79H3U');
		$gateway->setSignature('A9frNSjdg56YUh3IOj8EoShIiMclAq9C.MaTyUJSoP-kp8lV4eYmPPhD');
		$gateway->setTestMode(true);
		
		//LIVE
//			$gateway->setUsername('contacto_api1.kipmuving.com');
//			$gateway->setPassword('DGC72LTKNP4T3P69');
//			$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AuhHvXFexATZ1S0YcGK5mBl9vDLM');
//			$gateway->setTestMode(false);
		
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
				
				//TEST
				'returnUrl' => 'http://kipmuving.lo/reserve/paypal',
				'cancelUrl' => 'http://kipmuving.lo/reserve',
				
				//LIVE
//					'returnUrl' => 'http://kipmuving.com/reserve/paypal',
//					'cancelUrl' => 'http://kipmuving.com/reserve',
				
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
		
		
		#Old PayPal

//		if ($user = Auth::user()) {
//			if (!$sessionOffers = session('selectedOffers'))
//				return redirect()->action('ActivityController@index');
//			$offers = [];
//			$offersTotalCost = 0;
//			$offersTotalCostWithoutDiscount = 0;
//			$persons = 0;
//
//			foreach ($sessionOffers as $key => $sessionOffer) {
//				$offers[] = $offer->getOffer($sessionOffer['offer_id']);
////				$offersTotalCost += $offers[$key]['real_price'] * $sessionOffer['persons'];
//				$offersTotalCost += $offers[$key]['real_price'] * (1 - config('kipmuving.discount')) * $sessionOffer['persons'];
//				$offersTotalCostWithoutDiscount += $offers[$key]['real_price'] * $sessionOffer['persons'];
//				$persons += $sessionOffer['persons'];
//			}
//
//			$topay = round($this->getPriceInUSD($offersTotalCost, 'CLP') * config('kipmuving.service_fee'), 2);
//
//			$provider = new ExpressCheckout();
//
//			$options = [
//				'BRANDNAME' => config('app.name')
//			];
//
//			$data = [];
//			$data['items'] = [
//				[
//					'name'  => 'Kipmuving.com - reservation',
////					'price' => $persons * $this->pricePerPerson,
//					'price' => $topay,
//					'qty'   => 1
//				]
//			];
//			$data['invoice_id'] = time().str_random(5);
//			$data['invoice_description'] = "Kipmuving.com - reservation";
//			$data['return_url'] = action('ReservationController@paymentPaypal');
//			$data['cancel_url'] = action('ReservationController@reserve');
//			$data['total'] = $topay;
//
//			if ($request['token']) {
//				$response = $provider->doExpressCheckoutPayment($data, $request['token'], $request['PayerID']);
//				#Completed payment
//				if ($response['PAYMENTINFO_0_PAYMENTSTATUS'] == 'Completed') {
//					$batch = $this->GUID();
//					#Save reservations to DB
//					foreach ($offers as $key => $offer) {
//						$reservation = new Reservation();
//						$reservation->user_id = $user['id'];
//						$reservation->offer_id = $sessionOffers[$key]['offer_id'];
//						$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $sessionOffers[$key]['date'])->toDateString();
//						$reservation->batch_id = $batch;
//						$reservation->persons = $sessionOffers[$key]['persons'];
//						$reservation->save();
//					}
//
//					#Send emails
//					$this->sendMails($offers, $user);
//
//					#Clear selected offers
//					session()->forget('selectedOffers');
//
//					return redirect()->action('UserController@getUser');
//				} else {
//					$message = 'Failure :(';
//
//					return redirect()->action('ReservationController@reserve')->with($message);
//				}
//			}
//
//			$response = $provider->addOptions($options);
//			$response = $provider->setExpressCheckout($data);
//
//			return redirect($response['paypal_link']);
//		}
//
//		return abort(403);
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
						'amount'      => $this->getPriceInBRL()
					]
				],
				'currency' => 'BRL'
			];
			
			$checkout = PagSeguro::checkout()->createFromArray($data);
			$credentials = PagSeguro::credentials()->get();
			$information = $checkout->send($credentials);
			
			$this->createReservation($this->offers, $user, 'pagseguro', $data['items'][0]['id'], 'none', false);
			
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
				$reservation->status = false;
				$reservation->payment_uid = $item->getId();
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
		dd('REDIRECT PAGSEGURO', $request);
		//TODO информация что платеж принят на рассмотрение
		Log::debug('redirect - get');
		Log::info($request);
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
				
				$topay = round($this->getPriceInUSD($offersTotalCost, 'CLP') * config('kipmuving.service_fee'), 2);
				
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
