<?php

namespace App\Http\Controllers;

use App\SpecialOffer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

	public function removeFromBasketPost(Request $request)
	{
		$basket = session('basket');

		array_splice($basket['special'], $request['oid'], 1);

		session()->put('basket', $basket);
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

		$data = [
			'user_name'        => $s_offer->user->first_name . ' ' . $s_offer->user->last_name,
			'activity_name'    => $s_offer->offer->activity->name,
			'agency_name'      => $s_offer->offer->agency->name,
			'date'             => Carbon::createFromFormat('Y-m-d', $s_offer->offer_date)->format('d/m/Y'),
			'persons'          => $s_offer->persons,
			'price'            => $s_offer->offer->real_price,
			'total_price'      => $s_offer->offer->real_price * $s_offer->persons,
			'new_total_price'  => $request['price'],
			'offer_valid_date' => Carbon::createFromFormat('Y-m-d H:i:s', $s_offer->updated_at)->addDays(3)->format('d/m/Y'),
		];

		if (!$s_offer->active) {
			$s_offer->active = true;
			$s_offer->price = $request['price'];

			$s_offer->save();
		} else return redirect()->back()->with('message', 'Sorry, you have already sent this offer to the user.');

		//TODO change email
		Mail::send('emails.special-offers.special-offers-to-user', ['data' => $data], function ($message) use ($data){
			$message->from('contacto@keepmoving.co', 'Kipmuving team');
			$message->to(config('app.admin_email'))->subject('You received a special offer: '.$data['activity_name']);
		});

		return redirect()->back()->with('message', 'Great, we send email to user. Many thanks!');
	}

	public function getJsonInfo(Request $request)
	{
		$s_offer = SpecialOffer::find($request['id']);
		$result = null;

		if ($s_offer) {
			$result = [
				'agency'   => [
					'id'      => $s_offer->offer->agency->id,
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
					'new_price'  => $s_offer->price,
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
				'price'       => $s_offer->price,
				'timeranges'  => $s_offer->offer->available_time,
			];
		}

		return response()->json($result);
	}
}
