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

	public function getJsonInfo(Request $request)
	{
		$s_offer = SpecialOffer::find($request['id']);
		$result = null;

		if ($s_offer) {
			$result = [
				'agency'   => [
					'logo'    => $s_offer->offer->agency->image_icon,
					'name'    => $s_offer->offer->agency->name,
					'address' => $s_offer->offer->agency->address,
				],
				'offer'    => [
					's_offer_id' => $s_offer->id,
					'includes'   => $s_offer->offer->includes,
					'duration'   => $s_offer->offer->duration,
					'schedule'   => $s_offer->offer->schedule['start'] . '-' . $s_offer->offer->schedule['end'],
					'old_price'  => $s_offer->offer->real_price * $s_offer->persons,
					'new_price'  => $s_offer->price * $s_offer->persons,
				],
				'activity' => [
					'description' => $s_offer->offer->activity->description,
				],
			];
		}

		return response()->json($result);
	}

	public function getConfirmOfferJsonData(Request $request)
	{
		$s_offer = SpecialOffer::find($request['id']);
		$result = null;

		if ($s_offer) {
			$result = [
				'agency_name' => $s_offer->offer->agency->name,
				'price'       => $s_offer->price * $s_offer->persons,
				'timeranges'  => $s_offer->offer->available_time
			];
		}

		return response()->json($result);
	}
}
