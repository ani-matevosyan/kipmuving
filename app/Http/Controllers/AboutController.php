<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function index(Offer $offer)
  {
    $s_offers = \session('basket.special');
    $data = [
      'styles' => config('resources.about.styles'),
      'count'             => [
				'special_offers' => count($s_offers),
				  'offers'         => count(session('basket.offers')) + count(session('basket.free'))
			]
    ];

    return view('site.about.index', $data);
  }

}
