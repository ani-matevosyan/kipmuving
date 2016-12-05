<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class CalendarController extends Controller
{
	public function index(Offer $offer)
	{
		$data = [
			'selectedOffers' => $offer->getSelectedOffers(),
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.calendar.index', $data);
	}

	public function getAjaxData(Offer $offer)
    {
        $data = [
            'offers' => count($offer->getSelectedOffers()),
            'persons' => $offer->getSelectedOffersPersons()
        ];

        return array($data);
    }

}
