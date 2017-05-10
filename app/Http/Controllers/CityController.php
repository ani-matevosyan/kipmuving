<?php

namespace App\Http\Controllers;

class CityController extends Controller
{
	public function setCity($city)
	{
		if (!in_array($city, ['pucon', 'atacama']))
			abort(404);
		
		session(['city' => $city]);
		
		return back();
	}
}
