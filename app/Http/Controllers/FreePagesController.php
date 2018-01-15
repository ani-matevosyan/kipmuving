<?php

namespace App\Http\Controllers;

use App\FreeActivity;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class FreePagesController extends Controller
{
	public function index(Offer $offer)
	{

    $s_offers = \session('basket.special');

		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide']);

		$data = [
			'styles'  => config('resources.free.walking.styles'),
			'scripts' => config('resources.free.walking.scripts'),
			'count'   => [
        'special_offers' => count($s_offers),
				'offers'  => count(session('basket.offers')) + count(session('basket.free')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total'   => $offer->getSelectedOffersTotal(),
			],
		];

		return view('site.free.caminhando', $data);
	}

	public function getBicicleta(Offer $offer)
	{

    $s_offers = \session('basket.special');

		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-bicycle']);

		$data = [
		  'count'      => [
        'special_offers' => count($s_offers),
        'offers'  => count(session('basket.offers')) + count(session('basket.free')),
      ],
			'styles'     => config('resources.free.bicycle.styles'),
			'scripts'    => config('resources.free.bicycle.scripts'),
			'activities' => $this->getMapPoints(),
		];

		return view('site.free.bicicleta', $data);
	}

	public function getDecarro(Offer $offer)
	{

    $s_offers = \session('basket.special');

		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-car']);

		$data = [
      'count'      => [
        'special_offers' => count($s_offers),
        'offers'  => count(session('basket.offers')) + count(session('basket.free')),
      ],
			'styles'     => config('resources.free.bus.styles'),
			'scripts'    => config('resources.free.bus.scripts'),
			'activities' => $this->getMapPoints(),
		];

		return view('site.free.decarro', $data);
	}

	public function getTourcultural(Offer $offer)
	{

    $s_offers = \session('basket.special');

		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-car']);

		$data = [
      'count'      => [
        'special_offers' => count($s_offers),
        'offers'  => count(session('basket.offers')) + count(session('basket.free')),
      ],
			'styles'     => config('resources.free.cultural.styles'),
			'scripts'    => config('resources.free.cultural.scripts'),
			'activities' => $this->getMapPoints(),
		];

		return view('site.free.tourcultural', $data);
	}

	public function getMapPoints()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activities = FreeActivity::where('region', '=', $region)->get();

		return $activities;
	}

	public function addActivity(Request $request)
	{
		$basket = session('basket');
		$basket['free'] [] = [
			'id'         => $request['id'],
			'date'       => $request['date'],
			'hours_from' => $request['hours_from'],
			'hours_to'   => $request['hours_to'],
		];

		session()->put('basket', $basket);
	}
}
