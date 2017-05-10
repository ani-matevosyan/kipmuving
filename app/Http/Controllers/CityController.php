<?php

namespace App\Http\Controllers;

class CityController extends Controller
{
	public function setCity($city)
	{
		if (!in_array($city, session('cities.list')))
			abort(404);
		
		session(['cities' => [
			'current' => $city,
			'list'    => session('cities.list')
		]]);
		
		return back();
	}
}
