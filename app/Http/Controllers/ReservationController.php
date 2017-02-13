<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Srmklive\PayPal\Services\ExpressCheckout;

class ReservationController extends Controller
{
	private $pricePerPerson = 3.5;
	
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
	
	private function sendMails($offers, $sessionOffers, $user, $offersTotalCost)
	{
		$data = [];
		$agencyData = [];
		foreach ($offers as $key => $offer) {
			
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
				'offer_date'       => $sessionOffers[$key]['date'],
				'offer_start_time' => $sessionOffers[$key]['time']['start'],
				'offer_end_time'   => $sessionOffers[$key]['time']['end'],
				'offer_persons'    => $sessionOffers[$key]['persons'],
				'offer_price'      => $offer['real_price'] * (1 - config('kipmuving.discount'))
			];
			
			#Collect offers data
			$data['offers'][$key]['offer_id'] = $offer['offer_id'];
			$data['offers'][$key]['offer_start_time'] = $sessionOffers[$key]['time']['start'];
			$data['offers'][$key]['offer_end_time'] = $sessionOffers[$key]['time']['end'];
			$data['offers'][$key]['offer_hours'] = $offer['hours'];
			$data['offers'][$key]['offer_carry'] = $offer['offerCarry'];
			$data['offers'][$key]['offer_persons'] = $sessionOffers[$key]['persons'];
			$data['offers'][$key]['offer_price'] = $offer['real_price'] * (1 - config('kipmuving.discount'));
			$data['offers'][$key]['offer_date'] = $sessionOffers[$key]['date'];
			
		}
		#Collect other data
		$data['total_cost'] = $offersTotalCost;
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
				$message->to($agency_email)->subject('Kipmuving.com reservation');
			});
		}
	}
	
	public function index(Offer $offer, $message = null)
	{
		$selectedOffers = session('selectedOffers');
		
		if (Auth::guest() || !$selectedOffers)
			return view('site.reservar.reservar');
		
		$results = [];
		$total_cost = 0;
		$total_cost_CLP = 0;
		$total_cost_without_discount = 0;
//		$topay = 0;
		$persons = $offer->getSelectedOffersPersons();
		foreach ($selectedOffers as $key => $selectedOffer) {
			$offer = $offer->getOffer($selectedOffer['offer_id']);
			$total_cost += $offer['price'] * (1 - config('kipmuving.discount')) * $selectedOffer['persons'];
			$total_cost_without_discount += $offer['price'] * $selectedOffer['persons'];
			$total_cost_CLP += $offer['real_price'] * (1 - config('kipmuving.discount')) * $selectedOffer['persons'];
//			$topay += $selectedOffer['persons'] * $this->pricePerPerson;
			$results[] = [
				'offerData'    => [
					'id'                 => $offer['offer_id'],
					'date'               => $selectedOffer['date'],
					'start_time'         => $selectedOffer['time']['start'],
					'end_time'           => $selectedOffer['time']['end'],
					'persons'            => $selectedOffer['persons'],
					'hours'              => $offer['hours'],
					'price'              => $offer['price_offer'],
					'includes'           => $offer['offerIncludes'],
					'important'          => $offer['offerImportant'],
					'cancellation_rules' => $offer['offerCancellationRules']
				],
				'agencyData'   => [
					'id'          => $offer['agency_id'],
					'name'        => $offer['offerAgency']['name'],
					'description' => $offer['offerAgency']['description']
				],
				'activityData' => [
					'id'         => $offer['activity_id'],
					'name'       => $offer['offerActivity']['name'],
					'image_icon' => $offer['offerActivity']['image_icon']
				]
			];
		}
		$data = [
			'total_cost'                  => $total_cost,
			'total_cost_without_discount' => $total_cost_without_discount,
			'user'                        => Auth::user(),
			'offers'                      => $results,
			'persons'                     => $persons,
			'topay'                       => $this->getPriceInUSD($total_cost_CLP, 'CLP') * config('kipmuving.service_fee')
		];

//		dd($data['topay']);
		return view('site.reservar.su-reservar', $data);
	}
	
	#Stripe payment
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
					
					$this->sendMails($offers, $sessionOffers, $user, $offersTotalCost);
					
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
	
	public function cancelReservation($id)
	{
		$reservation = Reservation::find($id);
		if ($reservation > Carbon::now()->addDay()->toDateString()) {
			$reservation->delete();
			
			return redirect()->back();
		}
		
		return abort(404);
	}
	
	public function paymentPaypal(Request $request, Offer $offer)
	{
		if ($user = Auth::user()) {
			if (!$sessionOffers = session('selectedOffers'))
				return redirect()->action('ActivityController@index');
			$offers = [];
			$offersTotalCost = 0;
			$offersTotalCostWithoutDiscount = 0;
			$persons = 0;
			
			foreach ($sessionOffers as $key => $sessionOffer) {
				$offers[] = $offer->getOffer($sessionOffer['offer_id']);
//				$offersTotalCost += $offers[$key]['real_price'] * $sessionOffer['persons'];
				$offersTotalCost += $offers[$key]['real_price'] * (1 - config('kipmuving.discount')) * $sessionOffer['persons'];
				$offersTotalCostWithoutDiscount += $offers[$key]['real_price'] * $sessionOffer['persons'];
				$persons += $sessionOffer['persons'];
			}
			
			$topay = round($this->getPriceInUSD($offersTotalCost, 'CLP') * config('kipmuving.service_fee'), 2);
			
			$provider = new ExpressCheckout();
			
			$options = [
				'BRANDNAME' => config('app.name')
			];
			
			$data = [];
			$data['items'] = [
				[
					'name'  => 'Kipmuving.com - reservation',
//					'price' => $persons * $this->pricePerPerson,
					'price' => $topay,
					'qty'   => 1
				]
			];
			$data['invoice_id'] = time().str_random(5);
			$data['invoice_description'] = "Kipmuving.com - reservation";
			$data['return_url'] = action('ReservationController@paymentPaypal');
			$data['cancel_url'] = action('ReservationController@reserve');
			$data['total'] = $topay;
			
			if ($request['token']) {
				$response = $provider->doExpressCheckoutPayment($data, $request['token'], $request['PayerID']);
				#Completed payment
				if ($response['PAYMENTINFO_0_PAYMENTSTATUS'] == 'Completed') {
					$batch = $this->GUID();
					#Save reservations to DB
					foreach ($offers as $key => $offer) {
						$reservation = new Reservation();
						$reservation->user_id = $user['id'];
						$reservation->offer_id = $sessionOffers[$key]['offer_id'];
						$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $sessionOffers[$key]['date'])->toDateString();
						$reservation->batch_id = $batch;
						$reservation->persons = $sessionOffers[$key]['persons'];
						$reservation->save();
					}
					
					#Send emails
					$this->sendMails($offers, $sessionOffers, $user, $offersTotalCost);
					
					#Clear selected offers
					session()->forget('selectedOffers');
					
					return redirect()->action('UserController@getUser');
				} else {
					$message = 'Failure :(';
					
					return redirect()->action('ReservationController@reserve')->with($message);
				}
			}
			
			$response = $provider->addOptions($options);
			$response = $provider->setExpressCheckout($data);
			
			return redirect($response['paypal_link']);
		}
		
		return abort(403);
	}
}
