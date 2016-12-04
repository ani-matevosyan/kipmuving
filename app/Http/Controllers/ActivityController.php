<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Offer;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$data = [
			'activities' => $activity->getAllActivities(),
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.activities.index', $data);
	}

	public function getSuProgram(Offer $offer){
        $data = [
            'offers' => count($offer->getSelectedOffers()),
            'persons' => $offer->getSelectedOffersPersons()
        ];
        return array('data' => $data);
    }

    public function getSelectedOffers(Offer $offer){
        $data = $offer->getSelectedOffers();
        return array('data' => $data);
    }

	public function getActivity($id, Activity $activity, Offer $offer)
	{
		$activity = $activity->getActivity($id);
		if (!$activity)
			abort(404);

		$data = [
			'activity' => $activity->getActivity($id),
			'activitiesList' => $activity->getActivitiesList(),
			'offers' => [
				'recommend' => $offer->getRecommendOffers($id),
				'price' => $offer->getPriceOffers($id),
				'includes' => $offer->getIncludesOffers($id),
				'selected' => $offer->getSelectedOffers()
			],
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];

		return view('site.activities.activity-single', $data);
	}

	public function search(Request $request)
	{
//		TODO
		dd($request['offer_id']);
	}
}
