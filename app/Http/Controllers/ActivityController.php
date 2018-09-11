<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityComment;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Classes\InstagramAPI;
use App\Classes\TripadvisorAPI;
use App\Classes\GoogleApi;

use odannyc\GoogleImageSearch\ImageSearch;

class ActivityController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'activities']);

		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$s_offers = \session('basket.special');
		$s_offers_max_persons = count($s_offers) > 0 ? max(array_column($s_offers, 'persons')) : 0;

		$imageIndex = rand(1, 3); //1-3
		$data = [
			'styles'            => config('resources.activities.list.styles'),
			'scripts'           => config('resources.activities.list.scripts'),
			'imageIndex'        => $imageIndex,
			'slider_activities' => Activity::where('region', '=', $region)
				->where('slider_activities_page', true)
//				->translatedIn(app()->getLocale())
				->limit(5)
				->inRandomOrder()
				->get(),
			'activities'        => $activity->getAllActivities(),
			'count'             => [
			  'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
				'persons'        => $offer->getSelectedOffersPersons() > $s_offers_max_persons ? $offer->getSelectedOffersPersons() : $s_offers_max_persons,
				'total'          => $offer->getSelectedOffersTotal(),
			],
		];
//        dd($data['slider_activities']);
		return view('site.activities.index', $data);
	}

	public function getSuProgram(Offer $offer)
	{
		$s_offers = \session('basket.special');
		$s_offers_max_persons = count($s_offers) > 0 ? max(array_column($s_offers, 'persons')) : 0;

		$data = [
			'offers'         => count($offer->getSelectedOffers()) + count(\session('basket.free')),
			'special_offers' => count($s_offers),
			'persons'        => $offer->getSelectedOffersPersons() > $s_offers_max_persons ? $offer->getSelectedOffersPersons() : $s_offers_max_persons,
			'total'          => $offer->getSelectedOffersTotal(),
		];

		return ['data' => $data];
	}

	public function getSelectedOffers(Offer $offer)
	{
		$data = $offer->getSelectedOffers();

		return ['data' => $data];
	}

	public function getActivity($id)
	{
        $_activity = new Activity();
        if (!($activity = $_activity->getActivity($id)))
            abort(404);

        $_offer = new Offer();


        $photos = [];
        $tag = '';
        $photos_google = [];
        $tripadvisorReviews = 0;
        $tripadvisorRating = '00';
        $google_rating = '00';


        if (!empty($activity->tripadvisor_link)) {
            $tripadvisor = new TripadvisorAPI();

            $data = ($tripadvisor->getContent($activity->tripadvisor_link));
            $tripadvisorReviews = $data['reviews'];
            $tripadvisorRating = $data['rating'];
        }

        if (!empty($activity->instagram_link)) {
            $instgram = new InstagramAPI();
            $url_parser = $activity->instagram_link; //ссылка для парсинга
            $photos = $instgram->getInstPhoto($url_parser);
            (empty($photos)) ? $photos = [] : $photos;
        }

        if (!empty($activity->google_place_id)) {
            $googleapi = new GoogleApi();
            $googleData = $googleapi->getInfoToPlaceId($activity->google_place_id);
            $googleRating = isset($googleData['rating'] )? $googleData['rating'] : '00';
            $googleReviews = isset($googleData['reviews'])? $googleData['reviews'] : 0;
        }

        if (!empty($activity->google_search_word)) {
            ImageSearch::config()->apiKey(env('GOOGLE_API_KEY'));
            ImageSearch::config()->cx(env('GOOGLE_API_CX'));
            ($temp = ImageSearch::search($activity->google_search_word)); // returns array of results
            foreach ($temp["items"] as $result) {
                $photos_google[] = $result["link"];
            }
            (empty($photos_google)) ? $photos_google = [] : $photos_google;
        }


//		$activity_comments = ActivityComment::where('activity_id', '=', $id)->get();
//
//		dd($activity_comments);

//		dd($activity->comments->where('answer', '<>', null)[0]->user);

		$data = [
			'styles'         => config('resources.activities.single.styles'),
			'scripts'        => config('resources.activities.single.scripts'),
			'activity'       => $activity,
			'activitiesList' => $_activity->getActivitiesList(),
			'offers'         => [
				'selected' => $_offer->getSelectedOffers(),
			],
			'count'          => [
            'special_offers' => count(session('basket.special')),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
				'persons'        => $_offer->getSelectedOffersPersons(),
				'total'          => $_offer->getSelectedOffersTotal(),
			],
			'title'          => empty($activity->name) ? null : $activity->name,
            //google, inatgram photos, reviews
            'photos' => $photos,
            'photos_google' => $photos_google,
            'googleRating' => $googleRating,
            'googleReviews' => $googleReviews,
            'hashtag' => $tag,
            'tripadvisorReviews' => $tripadvisorReviews,
            'tripadvisorRating' => $tripadvisorRating
		];

		return view('site.activities.activity-single', $data);
	}

	public function search(Request $request)
	{
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['activity_date'])->toDateString());

		return Redirect::to(action('ActivityController@getActivity', $request['activity_id']));
	}

	public function filters(Request $request)
	{
		$filters = json_decode($request->data);

		$activities = Activity::query();

		$activities = $activities->where('visibility', true);
		$activities = $activities->where('region', '=', session('cities.current'));

		if (count($filters->price) === 2 && is_integer($filters->price[0]) && is_integer($filters->price[1])) {
			$activities = $activities->whereRaw('(select min(offers.price) from offers where offers.activity_id = activities.id) between ' . $filters->price[0] . ' and ' . $filters->price[1]);
		}


		if (count($filters->style) > 0) {
			$activities = $activities->whereIn('styles', $filters->style);
		}

		if (count($filters->period) > 0) {

			if (in_array('Verano', $filters->period)) {
				$activities = $activities->where('available_high', true);
			}

			if (in_array('Invierno', $filters->period)) {
				$activities = $activities->where('available_low', true);
			}

			if (in_array('Actividad Diurna', $filters->period)) {
				$activities = $activities->where('available_day', true);
			}

			if (in_array('Actividad Noturna', $filters->period)) {
				$activities = $activities->where('available_night', true);
			}

		}

		$activities = $activities->get();

		$result = [];

		foreach ($activities as $activity) {

			$result[$activity->styles] [] = [
				'id'                => $activity->id,
				'name'              => $activity->name,
				'short_description' => $activity->short_description,
				'image_thumb'       => file_exists($activity->image_thumb) ? $activity->image_thumb : 'images/image-none.jpg',
				'availability'      => [
					'night'  => $activity->available_night,
					'day'    => $activity->available_day,
					'summer' => $activity->available_high,
					'winter' => $activity->available_low,
				],
				'offers_min_price'  => number_format($activity->offers->min('price'), 0, ".", "."),
			];

		}

		return response($result);
	}

	public function addComment(Request $request)
	{
		if (!empty($request['comment_id'])) {

			if ($activity_comment = ActivityComment::find($request['comment_id'])) {
				$activity_comment->answer = $request['message'];
				$activity_comment->save();
			} else abort(404);

		} else {
			$activity_comment = new ActivityComment();

			$activity_comment->activity_id = $request['activity_id'];
			$activity_comment->user_id = auth()->user()->id;
			$activity_comment->question = $request['message'];

			$activity_comment->save();
		}

		return redirect()->back();
	}
}
