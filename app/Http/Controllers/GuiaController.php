<?php

namespace App\Http\Controllers;

use App\GuidePoint;
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

    public function getMapPoints(){
        $JSON_points = json_decode(file_get_contents(asset('/js/features.json')), true);
        foreach ($JSON_points['features'] as $key => $feature) {
            if ($point = GuidePoint::where('point_id', $feature['id'])->first()){
                $JSON_points['features'][$key]['properties']['description'] = $point['description'];
                $JSON_points['features'][$key]['properties']['tripadvisor_code'] = $point['tripadvisor_code'];
            }
        }
        return $JSON_points;
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
