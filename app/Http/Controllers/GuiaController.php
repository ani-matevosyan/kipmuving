<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GuiaController extends Controller
{
	public function index(Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide']);
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles'     => [
			    'css/tripadvisor.min.css',
				'css/instafeed/instafeed.min.css',
                'css/guide-style.min.css'
			],
			'scripts'    => [
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total' => $offer->getSelectedOffersTotal()
			]
		];
		
		return view('site.guia.caminhando', $data);
	}
	
	public function getBicicleta(Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-bicycle']);
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles'     => [
                'css/tripadvisor.min.css',
				'css/instafeed/instafeed.min.css',
                'css/guide-style.min.css'
			],
			'scripts'    => [
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total' => $offer->getSelectedOffersTotal()
			]
		];
		
		return view('site.guia.bicicleta', $data);
	}
	
	
	public function getDecarro(Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-car']);
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles'     => [
                'css/tripadvisor.min.css',
				'css/jquery-ui.min.css',
				'css/instafeed/instafeed.min.css',
                'css/guide-style.min.css'
			],
			'scripts'    => [
				'js/chosen.jquery.min.js',
				'js/instafeed/instafeed.min.js',
				'js/ResizeSensor.min.js',
				'http://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps'
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total' => $offer->getSelectedOffersTotal()
			],
			'activities' => $this->getMapPoints()
		];
		
		return view('site.guia.decarro', $data);
	}
	
	public function getTourcultural(Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-cultural']);
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
		    'styles'     => [
                'css/tripadvisor.min.css',
                'css/guide-style.min.css'
            ],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total' => $offer->getSelectedOffersTotal()
			]
		];
		
		return view('site.guia.tourcultural', $data);
	}
	
	public function getMapPoints()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activities = GuideActivity::where('region', '=', $region)->get();
		
		return $activities;
	}
	
	public function addActivity(Request $request)
	{
		$activities = session('guideActivities');
		$activities[] = [
			'id'         => $request['id'],
			'date'       => $request['date'],
			'hours_from' => $request['hours_from'],
			'hours_to'   => $request['hours_to']
		];
		
		session()->put('guideActivities', $activities);
	}
}
