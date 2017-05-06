<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Offer;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
	public function index(Offer $offer, Agency $agency)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'agencies'   => Agency::get(),
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
				'css/instafeed/instafeed.min.css'
			],
			'scripts' => [
				'js/chosen.jquery.min.js',
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
			],
			'agency' => $_agency->getAgency($id),
//			'offers' => $_offer->getAgencyOffers($id)
		];

		return view('site.agencies.agency-single', $data);
	}
}
