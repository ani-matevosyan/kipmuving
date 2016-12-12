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

	public function index(Offer $offer)
	{
		if (Auth::guest())
			return redirect()->to(action('HomeController@index'));

		$selectedOffers = session('selectedOffers');
		$results = [];
		$total_cost = 0;
		$persons = $offer->getSelectedOffersPersons();
		foreach ($selectedOffers as $key => $selectedOffer) {
			$offer = $offer->getOffer($selectedOffer['offer_id']);
			$total_cost += $offer['price_offer'] * $selectedOffer['persons'];
			$results[] = [
				'offerData' => [
					'id' => $offer['offer_id'],
					'date' => $selectedOffer['date'],
					'start_time' => $offer['start_time'],
					'end_time' => $offer['end_time'],
					'persons' => $selectedOffer['persons'],
					'price' => $offer['price_offer'],
					'includes' => $offer['offerIncludes'],
					'important' => $offer['offerImportant']
				],
				'agencyData' => [
					'id' => $offer['agency_id'],
					'name' => $offer['offerAgency']['name']
				],
				'activityData' => [
					'id' => $offer['activity_id'],
					'name' => $offer['offerActivity']['name'],
					'image_icon' => $offer['offerActivity']['image_icon']
				]
			];

		}
		$data = [
			'total_cost' => $total_cost,
			'user' => Auth::user(),
			'offers' => $results,
			'persons' => $persons
		];
		return view('site.reservar.su-reservar', $data);
	}

	public function reserve(Request $request, Offer $offer)
	{
		if ($user = Auth::user()) {
			if ($request['payment']) {
				$sessionOffers = session('selectedOffers');
				$offers = [];
				$offersTotalCost = 0;
				foreach ($sessionOffers as $key => $sessionOffer) {
					$offers[] = $offer->getOffer($sessionOffer['offer_id']);
					$offersTotalCost += $offers[$key]['price'] * $sessionOffer['persons'];
				}
				$batch = $this->GUID();
				foreach ($offers as $key => $offer) {
					$reservation = new Reservation();
					$reservation->user_id = $user['id'];
					$reservation->offer_id = $sessionOffers[$key]['offer_id'];
					$reservation->reserve_date = Carbon::parse($sessionOffers[$key]['date'])->toDateString();
					$reservation->batch_id = $batch;
					$reservation->persons = $sessionOffers[$key]['persons'];
					$reservation->save();
				}
//				dd($offers);
				foreach ($offers as $key => $offer) {
//					dd($offer);
					$activity = Activity::find($offer['activity_id']);
					$userData['activities'][$key]['id'] = $activity['id'];
					$userData['activities'][$key]['name'] = $activity['name'];
					$userData['activities'][$key]['icon'] = $activity['image_icon'];

					$agency = Agency::find($offer['agency_id']);
					$userData['agencies'][$key]['id'] = $agency['id'];
					$userData['agencies'][$key]['name'] = $agency['name'];

					$userData['offers'][$key]['id'] = $offer['offer_id'];
					$userData['offers'][$key]['start_time'] = $offer['start_time'];
					$userData['offers'][$key]['end_time'] = $offer['end_time'];
					//TODO!
					$userData['offers'][$key]['carry'] = $offer['offerCarry'];
					//TODO?
					$userData['offers'][$key]['persons'] = $sessionOffers[$key]['persons'];
					$userData['offers'][$key]['date'] = $sessionOffers[$key]['date'];
				}

				$userData['total_cost'] = $offersTotalCost;
				$userData['user']['first_name'] = $user['first_name'];
				$userData['user']['last_name'] = $user['last_name'];

				Mail::send('emails.reservar.user', ['userData' => $userData], function ($message) use ($user) {
					$message->from('info@kipmuving.com', 'Kipmuving team');
					$message->to($user['email'], $user['first_name'].' '.$user['last_name'])->subject('Your Kipmuving.com reservations');
				});

				dd('ok');
			}
		}
	}
}
