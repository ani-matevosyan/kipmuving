<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityComment;
use App\Locale;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Classes\InstagramAPI;
use App\Classes\TripadvisorAPI;
use App\Classes\Tripadvisor;
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
        $googleRating = '00';
        $googleReviews = 0;



        if (!empty($activity->tripadvisor_link)) {
            $data = json_decode($activity->tripadvisor_widget_data );
//            with API
//            $tripadvisorReviews = isset($data->num_reviews) ? $data->num_reviews: 0 ;
//            $tripadvisorRating =  isset($data->rating)? (float)$data->rating * 20: 0 ;

            $tripadvisorReviews = isset($data->reviews) ? $data->reviews: 0 ;
            $tripadvisorRating =  isset($data->rating)? (float)$data->rating * 2: 0 ;
        }

        if (!empty($activity->instagram_link)) {
            $photos = json_decode($activity->instagram_data);
            (empty($photos)) ? $photos = [] : $photos;
        }

        if (!empty($activity->google_place_id)) {
            $googleData = json_decode($activity->google_widget_data);
            $googleRating = isset($googleData->rating )? $googleData->rating : '00';
            $googleReviews = isset($googleData->reviews)? $googleData->reviews : 0;
        }

        if (!empty($activity->google_search_word)) {
          $photos_google = json_decode($activity->google_search_data);
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


    public function updateActivitiesWidgetsPhotosData(Request $request)
    {
        $activities = Activity::all();
        foreach ($activities as $activity){
            $photos_google = [];

            if (!empty($activity->tripadvisor_link)) {
                // without the Api
                $tripadvisor = new TripadvisorAPI();
                $data = ($tripadvisor->getContent($activity->tripadvisor_link));
                // with API
                // $ta = new Tripadvisor();
                // $data = $ta->getQuery('location',$activity->getParamTripadvisor(),'','');
                $activity->tripadvisor_widget_data = json_encode( $data, JSON_UNESCAPED_UNICODE );;
            }

            if (!empty($activity->instagram_link)) {
                $instgram = new InstagramAPI();
                $url_parser = $activity->instagram_link; //ссылка для парсинга
                $photos = $instgram->getInstPhoto($url_parser);
                (empty($photos)) ? $photos = [] : $photos;
                $activity->instagram_data = json_encode( $photos, JSON_UNESCAPED_UNICODE );;;
            }

            if (!empty($activity->google_place_id)) {
                $googleapi = new GoogleApi();
                $googleData = $googleapi->getInfoToPlaceId($activity->google_place_id);
                $activity->google_widget_data = json_encode( $googleData, JSON_UNESCAPED_UNICODE );;
            }

            if (!empty($activity->google_search_word)) {
                ImageSearch::config()->apiKey(env('GOOGLE_API_KEY'));
                ImageSearch::config()->cx(env('GOOGLE_API_CX'));
                ($temp = ImageSearch::search($activity->google_search_word)); // returns array of results
                if(isset($temp["items"])){
                    foreach ($temp["items"] as $key=>$result) {
                        $photos_google[$key]['link'] = $result['link'];
                        $photos_google[$key]['thumbnailLink'] = $result['image']['thumbnailLink'];
                    }
                    $activity->google_search_data = json_encode( $photos_google, JSON_UNESCAPED_UNICODE );;
                }else{
                    $activity->google_search_data = "{}";
                }

                (empty($photos_google)) ? $photos_google = [] : $photos_google;
            }
            $activity->save();
        }
        echo 'The updates finished successfully!';
    }


    public function updateActivityWidgetsPhotosData(Request $request)
    {
        $activity = Activity::find($request->id);
        $tripadvisor_link = $request->tripadvisor_link;
        $instagram_link = $request->instagram_link;
        $google_place_id = $request->google_place_id;
        $google_search_word = $request->google_search_word;

        $photos_google = [];
        if ($tripadvisor_link) {
            $tripadvisor = new TripadvisorAPI();
            $data = ($tripadvisor->getContent($activity->tripadvisor_link));
//            with API
//            $ta = new Tripadvisor();
//            $data = $ta->getQuery('location',$this->getParamTripadvisor($tripadvisor_link),'','');
            $activity->tripadvisor_widget_data = json_encode( $data, JSON_UNESCAPED_UNICODE );;
        }

        if ($instagram_link) {
            $instgram = new InstagramAPI();
            $url_parser = $instagram_link; //ссылка для парсинга
            $photos = $instgram->getInstPhoto($url_parser);
            (empty($photos)) ? $photos = [] : $photos;
            $activity->instagram_data = json_encode( $photos, JSON_UNESCAPED_UNICODE );;;
        }

        if ($google_place_id) {
            $googleapi = new GoogleApi();
            $googleData = $googleapi->getInfoToPlaceId($google_place_id);
            $activity->google_widget_data = json_encode( $googleData, JSON_UNESCAPED_UNICODE );;
        }

        if ($google_search_word) {
            ImageSearch::config()->apiKey(env('GOOGLE_API_KEY'));
            ImageSearch::config()->cx(env('GOOGLE_API_CX'));
            ($temp = ImageSearch::search($google_search_word)); // returns array of results
            if(isset($temp["items"])){
                foreach ($temp["items"] as $key=>$result) {
                    $photos_google[$key]['link'] = $result['link'];
                    $photos_google[$key]['thumbnailLink'] = $result['image']['thumbnailLink'];
                }
                $activity->google_search_data = json_encode( $photos_google, JSON_UNESCAPED_UNICODE );;
            }else{
                $activity->google_search_data = "{}";
            }
            (empty($photos_google)) ? $photos_google = [] : $photos_google;
        }
        $activity->save();
        echo 'The updates finished successfully!';
    }



    public function getParamTripadvisor($tripadvisor_link){
        preg_match( "|-d(\d+)|u", $tripadvisor_link, $object);
        if(isset($object[1])){
            return($object[1]);
        }else
            return '';
    }


}
