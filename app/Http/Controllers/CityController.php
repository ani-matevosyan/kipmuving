<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
