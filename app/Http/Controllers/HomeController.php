<?php

namespace App\Http\Controllers;

use App\Activity;
use App\HomeMail;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$imageIndex = rand(1, 3); //1-3
		$data = [
			'imageIndex' => $imageIndex,
			'activities' => $activity->getHomePageActivities(),
			'activitiesList' => $activity->getActivitiesList(),
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.home.index', $data);
	}

	public function sendMessage(Request $request){
		$this->validate($request, [
			'email' => 'email|required|max:128',
			'name' => 'alpha|required|max:128',
			'message' => 'required|min:5|max:1000',
			'g-recaptcha-response' => 'required|recaptcha'
		]);
		$data = [
			'name' => $request['name'],
			'email' => $request['email'],
			'message' => $request['message']
		];

		$homeMail = new HomeMail();
		$homeMail->name = $data['name'];
		$homeMail->email = $data['email'];
		$homeMail->message = $data['message'];
		$homeMail->user_ip = $request->ip();
		$homeMail->save();

		Mail::send('emails.homepage-form', ['data' => $data], function ($message) use ($data) {
			$message->from('info@kipmuving.com', 'Kipmuving team');
			$message->to(config('mail.admin_email'), $data['name'])->subject('Homepage form message');
		});
		return Redirect::to('/')->with('info', 'Your message is successfully send.');
	}
}
