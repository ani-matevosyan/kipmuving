<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Agency;
use App\Offer;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class ReservationController extends Controller
{
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
	
	public function index(Offer $offer, $message = null)
	{
		$selectedOffers = session('selectedOffers');
		
		if (Auth::guest() || !$selectedOffers)
			return view('site.reservar.reservar');
		
		$results = [];
		$total_cost = 0;
		$topay = 0;
		$persons = $offer->getSelectedOffersPersons();
		foreach ($selectedOffers as $key => $selectedOffer) {
			$offer = $offer->getOffer($selectedOffer['offer_id']);
			$total_cost += $offer['price_offer'] * $selectedOffer['persons'];
			$topay += $selectedOffer['persons'] * 5;
			$results[] = [
				'offerData'    => [
					'id'         => $offer['offer_id'],
					'date'       => $selectedOffer['date'],
					'start_time' => $offer['start_time'],
					'end_time'   => $offer['end_time'],
					'persons'    => $selectedOffer['persons'],
					'price'      => $offer['price_offer'],
					'includes'   => $offer['offerIncludes'],
					'important'  => $offer['offerImportant']
				],
				'agencyData'   => [
					'id'   => $offer['agency_id'],
					'name' => $offer['offerAgency']['name']
				],
				'activityData' => [
					'id'         => $offer['activity_id'],
					'name'       => $offer['offerActivity']['name'],
					'image_icon' => $offer['offerActivity']['image_icon']
				]
			];
			
		}
		$data = [
			'total_cost' => $total_cost,
			'user'       => Auth::user(),
			'offers'     => $results,
			'persons'    => $persons,
			'topay'      => $topay
		];
		
		return view('site.reservar.su-reservar', $data);
	}
	
	public function reserve(Request $request, Offer $offer)
	{
		if ($user = Auth::user()) {
			if ($request['token']) {
				$sessionOffers = session('selectedOffers');
				$offers = [];
				$offersTotalCost = 0;
				$persons = 0;
				
				foreach ($sessionOffers as $key => $sessionOffer) {
					$offers[] = $offer->getOffer($sessionOffer['offer_id']);
					$offersTotalCost += $offers[$key]['real_price'] * $sessionOffer['persons'];
					$persons += $sessionOffer['persons'];
				}
				
				#Stripe create charge
				$stripe = Stripe::make(config('services.stripe.secret'));
				$customer = $stripe->customers()->create(['email' => $request['token']['email']]);
				$card = $stripe->cards()->create($customer['id'], $request['token']['id']);
				$charge = $stripe->charges()->create([
					'customer' => $customer['id'],
					'currency' => 'USD',
					'amount'   => $persons * 5,
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
							'activity_name' => $offer['offerActivity']['name'],
							'offer_date'    => $sessionOffers[$key]['date'],
							'offer_persons' => $sessionOffers[$key]['persons'],
							'offer_price'   => $offer['real_price']
						];
						
						#Collect offers data
						$data['offers'][$key]['offer_id'] = $offer['offer_id'];
						$data['offers'][$key]['offer_start_time'] = $offer['start_time'];
						$data['offers'][$key]['offer_end_time'] = $offer['end_time'];
						$data['offers'][$key]['offer_carry'] = $offer['offerCarry'];
						$data['offers'][$key]['offer_persons'] = $sessionOffers[$key]['persons'];
						$data['offers'][$key]['offer_price'] = $offer['real_price'];
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
						], function ($message) use ($user) {
							$message->from('info@kipmuving.com', 'Kipmuving team');
							#TODO change agency email
							$message->to($user['email'])->subject('Kipmuving.com reservation');
						});
					}
					
					session()->forget('selectedOffers');
					
					$message = 'Success :)';
					
					return $message;
				}
			}
		}
		
		$message = 'Failure :(';
		
		return $message;
	}
}
