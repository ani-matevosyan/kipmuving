<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
	public function index(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles' => [
				'css/instafeed/instafeed.min.css'
			],
			'scripts' => [
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js', //currency/language pop-up
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.guia.caminhando', $data);
	}
	
	public function getBicicleta(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles' => [
				'css/instafeed/instafeed.min.css'
			],
			'scripts' => [
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js', //currency/language pop-up
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.guia.bicicleta', $data);
	}
	
	
	public function getDecarro(Offer $offer)
	{
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'styles' => [
				'css/jquery-ui.min.css',
				'css/instafeed/instafeed.min.css'
			],
			'scripts' => [
				'js/chosen.jquery.min.js',
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js', //currency/language pop-up
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			],
			'activities' => $this->getMapPoints()
		];
		
		return view('site.guia.decarro', $data);
	}

//	public function getMapPoints()
//	{
//		$JSON_points = json_decode(file_get_contents(asset('/js/features.json')), true);
//		foreach ($JSON_points['features'] as $key => $feature) {
//			if ($point = Mappoint::where('point_id', $feature['id'])->first()) {
//				$bus_time = $point['bus_est_time'] % 60 == 0
//					? $point['bus_est_time'] / 60
//					: (int)($point['bus_est_time'] / 60).':'.($point['bus_est_time'] % 60 < 10
//						? '0'.$point['bus_est_time'] % 60
//						: $point['bus_est_time'] % 60);
//
//				$JSON_points['features'][$key]['properties']['description'] = $point['description'];
//				$JSON_points['features'][$key]['properties']['tripadvisor_code'] = $point['tripadvisor_code'];
//				$JSON_points['features'][$key]['properties']['bus_description'] = $point['bus_description'];
//				$JSON_points['features'][$key]['properties']['bus_estimated_time'] = $bus_time;
//				$JSON_points['features'][$key]['properties']['bus_estimated_expenditure'] = $point['bus_est_expenditure'];
//				$JSON_points['features'][$key]['properties']['bus_estimated_service'] = $point['bus_est_service'];
//			}
//		}
////		dd($JSON_points['features'][0]['properties']['bus_estimated_time']);
//
//		return $JSON_points;
//	}
	
	public function getMapPoints()
	{
		$activities = GuideActivity::get();

//		dd($activities[0]->bus_est_time);
		
		return $activities;
//		dd($activities);


//		$JSON_points = json_decode(file_get_contents(asset('/js/features.json')), true);
//		foreach ($JSON_points['features'] as $key => $feature) {
//			if ($point = Mappoint::where('point_id', $feature['id'])->first()) {
//				$bus_time = $point['bus_est_time'] % 60 == 0
//					? $point['bus_est_time'] / 60
//					: (int)($point['bus_est_time'] / 60).':'.($point['bus_est_time'] % 60 < 10
//						? '0'.$point['bus_est_time'] % 60
//						: $point['bus_est_time'] % 60);
//
//				$JSON_points['features'][$key]['properties']['description'] = $point['description'];
//				$JSON_points['features'][$key]['properties']['tripadvisor_code'] = $point['tripadvisor_code'];
//				$JSON_points['features'][$key]['properties']['bus_description'] = $point['bus_description'];
//				$JSON_points['features'][$key]['properties']['bus_estimated_time'] = $bus_time;
//				$JSON_points['features'][$key]['properties']['bus_estimated_expenditure'] = $point['bus_est_expenditure'];
//				$JSON_points['features'][$key]['properties']['bus_estimated_service'] = $point['bus_est_service'];
//			}
//		}
//		dd($JSON_points);
//
//		return $JSON_points;
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
	
	public function getTourcultural(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'scripts' => [
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js', //currency/language pop-up
			],
			'imageIndex' => $imageIndex,
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.guia.tourcultural', $data);
	}
}
