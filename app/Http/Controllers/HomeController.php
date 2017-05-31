<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityImage;
use App\HomeMail;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
//		$images = ActivityImage::get();
//
//		$files = File::files(public_path('uploads/activity'));
//		foreach ($files as $key => $file) {
//			$files[$key] = str_replace('/home/sanek/server/personalProjects/kipmuving/public/', '', $file);
//		}
		
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'home']);
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles' => [
				'css/jquery-ui.min.css',
				'css/product-tour.min.css',
                'css/home-style.min.css'
			],
			'scripts' => [
				'js/product.tour.min.js',
				'js/product-tour.min.js',
				'js/chosen.jquery.min.js',
			],
			'imageIndex' => $imageIndex,
			'activities' => $activity->getHomePageActivities(),
			'activitiesList' => $activity->getActivitiesList(),
			'count' => [
				'offers' => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		if (session('cities.current') == 'atacama')
			return view('site.home.atacama-index', $data);
		
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

	public function siteEntrance(){
        return view('site.home.site-entrance');
    }
}
