<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ActivityController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$imageIndex = rand(1, 3); //1-3
		$data = [
			'imageIndex' => $imageIndex,
			'activities' => $activity->getAllActivities(),
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.activities.index', $data);
	}
	
	public function getSuProgram(Offer $offer)
	{
		$data = [
			'offers'  => count($offer->getSelectedOffers()),
			'persons' => $offer->getSelectedOffersPersons()
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
		
//		dd($activity->offers[0]->duration);
		
		$data = [
			'activity'       => $activity,
			'activitiesList' => $_activity->getActivitiesList(),
			'offers'         => [
//				'recommend' => $offer->getRecommendOffers($id),
//				'price' => $offer->getPriceOffers($id),
//				'includes' => $offer->getIncludesOffers($id),
				'selected' => $_offer->getSelectedOffers()
			],
			'count'          => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $_offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.activities.activity-single', $data);
	}
	
	public function search(Request $request)
	{
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['activity_date'])->toDateString());
		
		return Redirect::to(action('ActivityController@getActivity', $request['activity_id']));
	}
}
