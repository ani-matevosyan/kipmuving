<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index(Activity $activity)
	{
		$data = [
			'activities' => $activities = $activity->getHomePageActivities()
		];
		return view('site.home.index', $data);
	}
}
