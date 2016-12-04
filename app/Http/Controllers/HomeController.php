<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Offer;
use Illuminate\Http\Request;

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
}
