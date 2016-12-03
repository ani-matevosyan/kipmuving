<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
	public function setDate(Request $request)
	{
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['date'])->toDateString());
	}

	public function reserve(Request $request)
	{
		$offers = session('selectedOffers');
		$offers[] = [
			'offer_id' => $request['offer_id'],
			'date' => $request['date'],
			'persons' => $request['persons']
		];

		session()->put('selectedOffers', $offers);
	}

	public function remove(Request $request)
	{
		$offers = session('selectedOffers');
		array_splice($offers, $request['oid'], 1);

		session()->put('selectedOffers', $offers);
	}

}
