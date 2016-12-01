<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
	public function index()
	{
		return view('site.activities.index');
	}

	public function getActivity($id, Activity $activity)
	{
		$activity = $activity->getActivity($id);
		if (!$activity)
			abort(404);

		$data = [
			'activity' => $activity->getActivity($id)
		];

		return view('site.activities.activity-single', $data);
	}
}
