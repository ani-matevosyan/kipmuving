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
				'persons' => $offer->getSelectedOffersPersons(),
				'total' => $offer->getSelectedOffersTotal()
			]
		];
		
		return view('site.agencies.index', $data);
	}
	
	public function getAgency($id)
	{
		$_agency = new Agency();
		$_offer = new Offer();
		
		$data = [
			'styles' => config('resources.agencies.single.styles'),
			'scripts' => config('resources.agencies.single.scripts'),
			'agency' => $_agency->getAgency($id),
//			'offers' => $_offer->getAgencyOffers($id)
		];

		return view('site.agencies.agency-single', $data);
	}
}
