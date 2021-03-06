<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityImage;
use App\Agency;
use App\HomeMail;
use App\Offer;
use App\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Suggestion;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
	public function index(Offer $offer)
	{

		if (session('cities.entrance') === false)
			return redirect()->route('entrance');

		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'home']);

		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$s_offers = \session('basket.special');
        $tGActivity = Activity::find(10);

		$data = [
			'styles'            => config('resources.home.styles'),
			'scripts'           => config('resources.home.scripts'),
			'imageIndex'        => rand(1, 3),
			'random_activities' => Activity::where('region', '=', $region)
				->where('visibility', true)
				->whereHas('offers', function ($query) {
					$query->where('price', '>', 0);
				})
				->translatedIn(app()->getLocale())
				->limit(8)
				->inRandomOrder()
				->get(),
			'slider_activities' => Activity::where('region', '=', $region)
				->where('visibility', true)
				->whereHas('offers', function ($query) {
					$query->where('price', '>', 0);
				})
				->where('slider', true)
				->translatedIn(app()->getLocale())
				->inRandomOrder()
				->get(),
			'activitiesList'    => Activity::getActivitiesList(),
			'count'             => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			],
            'suggestions'     => Suggestion::withActivities()->where('region', $region)->get(),
            'tGActivity'     => $tGActivity,
		];

		return view('site.home.index', $data);
	}

	public function getTranslations()
	{
		$activities = Activity::get();
		$offers = Offer::get();
		$agencies = Agency::get();

		echo '-----------------------------------';
		echo 'ACTIVITIES';
		echo '-----------------------------------';
		foreach ($activities as $key => $activity) {
			echo '<br><b>ID:</b> ' . $activity->id;
			echo '<br><br><b>Name: </b>' . $activity->name;
			echo '<br><br><b>Subtitle: </b>' . $activity->subtitle;
			echo '<br><br><b>Short description: </b>' . $activity->short_description;
			echo '<br><br><b>Carries: </b>';
			if (count($activity->carries) > 0) {
				foreach ($activity->carries as $item) {
					echo '<br>' . $item;
				}
			}

			echo '<br><br><b>Restrictions: </b>';
			if (count($activity->restrictions) > 0) {
				foreach ($activity->restrictions as $item) {
					echo '<br>' . $item;
				}
			}
			echo '<br><br><b>Description: </b>' . $activity->description;

			echo '<br>-----------------------------------';
		}

		echo '-----------------------------------';
		echo 'OFFERS';
		echo '-----------------------------------';
		foreach ($offers as $key => $offer) {
			echo '<br><b>ID:</b> ' . $offer->id;
			echo '<br><br><b>Includes: </b>';
			if (count($offer->includes) > 0) {
				foreach ($offer->includes as $item) {
					echo '<br>' . $item;
				}
			}
			echo '<br><br><b>Cancellation rules: </b>' . $offer->cancellation_rules;
			echo '<br><br><b>Important: </b>' . $offer->important;
			echo '<br><br><b>Description: </b>' . $offer->description;

			echo '<br>-----------------------------------';
		}

		echo '-----------------------------------';
		echo 'AGENCIES';
		echo '-----------------------------------';
		foreach ($agencies as $key => $agency) {
			echo '<br><b>ID:</b> ' . $agency->id;
			echo '<br><br><b>Name: </b>' . $agency->name;
			echo '<br><br><b>Description: </b>' . $agency->description;

			echo '<br>-----------------------------------';
		}

	}

	public function sendMessage(Request $request)
	{
        parse_str($request->formData, $formData);
        $validator = Validator::make($formData, [
            'email'                => 'email|required|max:128',
            'name'                 => 'regex:/^[\pL\s\-]+$/u|required|max:128',
            'message'              => 'required|min:5|max:1000',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
        if(!$validator->fails()){
            $data = [
                'name'    => $formData['name'],
                'email'   => $formData['email'],
                'message' => $formData['message'],
            ];

            $homeMail = new HomeMail();
            $homeMail->name = $data['name'];
            $homeMail->email = $data['email'];
            $homeMail->message = $data['message'];
            $homeMail->user_ip = $request->ip();
            $homeMail->save();

            Mail::send('emails.homepage-form', ['data' => $data], function ($message) use ($data) {
                $message->from('contacto@aventuraschile.com', 'Aventuras Chile team');
                $message->to('contacto@aventuraschile.com', $data['name'])->subject('Homepage form message');
            });
            echo json_encode(['success' => true]);
        }else{
            $errorMessages = $validator->errors();
            echo json_encode(['errorMessages' => $errorMessages]);
        }
        exit;
	}

	public function siteEntrance()
	{
		session(['cities.entrance' => true]);

		return view('site.home.site-entrance');
	}
}
