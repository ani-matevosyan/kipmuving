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

class ActivityController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'activities']);

		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$imageIndex = rand(1, 3); //1-3
		$data = [
			'styles'            => config('resources.activities.list.styles'),
			'scripts'           => config('resources.activities.list.scripts'),
			'imageIndex'        => $imageIndex,
			'slider_activities' => Activity::where('region', '=', $region)
				->where('slider_activities_page', true)
//				->translatedIn(app()->getLocale())
				->limit(4)
				->inRandomOrder()
				->get(),
			'activities'        => $activity->getAllActivities(),
			'count'             => [
				'offers'  => count(session('basket.offers')) + count(session('basket.free')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total'   => $offer->getSelectedOffersTotal(),
			],
		];

		return view('site.activities.index', $data);
	}

	public function getSuProgram(Offer $offer)
	{
		$data = [
			'offers'  => count($offer->getSelectedOffers()),
			'special_offers' => count(session('basket.special')),
			'persons' => $offer->getSelectedOffersPersons(),
			'total'   => $offer->getSelectedOffersTotal(),
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
				'offers'  => count(session('basket.offers')) + count(session('basket.free')),
				'persons' => $_offer->getSelectedOffersPersons(),
				'total'   => $_offer->getSelectedOffersTotal(),
			],
			'title'          => empty($activity->name) ? null : $activity->name,
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
