<?php

namespace App\Http\Controllers;

use App\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOffersController extends Controller
{
	public function addToBasket(Request $request)
	{
		$basket = session('basket');

		$basket['special'] [] = [
			'activity_id' => $request['activity_id'],
			'date'        => $request['date'],
			'persons'     => $request['persons'],
		];

		session()->put('basket', $basket);
	}

	public function removeFromBasket($oid)
	{
		//TODO change to POST

		$basket = session('basket');

		array_splice($basket['special'], $oid, 1);

		session()->put('basket', $basket);

		return redirect()->back();
	}

	public function sendOfferPage($uid)
	{
		$data = [
			'styles'  => config('resources.sendOffer.styles'),
			'scripts' => config('resources.sendOffer.scripts'),
			'offer'   => SpecialOffer::where([
				['uid', '=', $uid],
				['active', false],
			])->first(),
		];

		return view('site.home.send-offer-page', $data);
	}

	public function sendOffer(Request $request)
	{
		$this->validate($request, [
			'price' => 'required|numeric',
		]);

		$s_offer = SpecialOffer::where('uid', '=', $request['s_offer_uid'])->first();

		if (!$s_offer->active) {
			$s_offer->active = true;
			$s_offer->price = $request['price'];

			$s_offer->save();
		} else return redirect()->back()->with('message', 'Sorry, you have already sent this offer to the user.');

		//TODO send email to user

		return redirect()->back()->with('message', 'Great, we send email to user. Many thanks!');
	}
}
