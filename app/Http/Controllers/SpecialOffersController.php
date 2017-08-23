<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialOffersController extends Controller
{
	public function addToBasket(Request $request)
	{
		$activity_id = 2;
		$date = '24/08/2017';
		$persons = 2;

		$basket = session('basket');
		$basket['special'] [] = [
			'activity_id' => $activity_id,
			'date'        => $date,
			'persons'     => $persons,
		];

		session()->put('basket', $basket);
	}

	public function removeFromBasket(Request $request)
	{
		$oid = 0;

		$basket = session('basket');

		array_splice($basket['special'], $oid, 1);

		session()->put('basket', $basket);
	}
}
