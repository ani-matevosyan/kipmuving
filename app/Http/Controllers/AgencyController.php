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
			'agencies' => $agency->getAgencies(),
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.agencies.index', $data);
	}

	public function getAgency($id, Agency $agency, Offer $offer)
	{
		$data = [
			'agency' => $agency->getAgency($id),
			'offers' => $offer->getAgencyOffers($id),
			'countOffers' => count($offer->getAgencyOffers($id))
		];
//		dd($data);
		return view('site.agencies.agency-single', $data);
	}
}
