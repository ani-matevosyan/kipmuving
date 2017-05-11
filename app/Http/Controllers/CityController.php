<?php

namespace App\Http\Controllers;

class CityController extends Controller
{
	public function setCity($city, $route = null)
	{
		if (!in_array($city, session('cities.list')))
			abort(404);
		
		session(['cities' => [
			'current' => $city,
			'list'    => session('cities.list')
		]]);
		
//		dd($route);
		
		return $route ? redirect()->route($route) : redirect()->back();
	}
}
