<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AgencyController extends Controller
{
	public function index(Offer $offer, Agency $agency)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'agencies']);
		
		$region = session('cities.current') ? session('cities.current') : 'pucon';
		
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'agencies'   => Agency::where('region', '=', $region)->get(),
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.agencies.index', $data);
	}
	
	public function getAgency($id)
	{
		$_agency = new Agency();
		$_offer = new Offer();
		
		$data = [
			'styles' => [
				'css/jquery-ui.min.css',
				'css/chosen/chosen.min.css',
				'css/instafeed/instafeed.min.css',
                'css/offer-items.min.css',
                'css/agency-style.min.css'
			],
			'scripts' => [
				'js/chosen.jquery.min.js',
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
				'http://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initAgencyMap'
			],
			'agency' => $_agency->getAgency($id),
//			'offers' => $_offer->getAgencyOffers($id)
		];

		return view('site.agencies.agency-single', $data);
	}
}
