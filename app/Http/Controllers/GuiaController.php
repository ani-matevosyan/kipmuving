<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
	public function index(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.guia.caminhando', $data);
	}

	public function getBicicleta(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.guia.bicicleta', $data);
	}

	public function getDecarro(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.guia.decarro', $data);
	}

	public function getTourcultural(Offer $offer)
	{
		$imageIndex = rand(1, 4); //1-4
		$data = [
			'imageIndex' => $imageIndex,
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		return view('site.guia.tourcultural', $data);
	}
}
