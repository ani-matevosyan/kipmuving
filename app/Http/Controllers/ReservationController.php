<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
	public function index(Offer $offer)
	{
		if (Auth::guest())
			return redirect()->to(action('HomeController@index'));

		$selectedOffers = session('selectedOffers');
		$results = [];
		$total_cost = 0;
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
			'offers' => $results
		];
		return view('site.reservar.su-reservar', $data);
	}

	public function reserve(Request $request)
	{
		dd($request);
	}
}
