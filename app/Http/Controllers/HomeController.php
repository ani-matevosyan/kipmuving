<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index(Activity $activity)
	{
		$data = [
			'activities' => $activity->getHomePageActivities(),
			'activitiesList' => $activity->getActivitiesList()
		];
		return view('site.home.index', $data);
	}
}
