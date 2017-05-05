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
			'scripts' => [
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js' //currency/language pop-up
			],
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
				'owl-carousel/owl.carousel.min.js', //currency/language pop-up
				'js/jquery.prettyPhoto.js' //instagram feed and currency/language pop-up
			],
			'agency' => $_agency->getAgency($id),
//			'offers' => $_offer->getAgencyOffers($id)
		];

		return view('site.agencies.agency-single', $data);
	}
}
