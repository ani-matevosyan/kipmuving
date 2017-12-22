<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
  public function index(Offer $offer)
  {
    $s_offers = \session('basket.special');
    $data = [
      'styles' => config('resources.routes.styles'),
      'count'             => [
        'special_offers' => count($s_offers),
        'offers'         => count(session('basket.offers')) + count(session('basket.free'))
      ]
    ];

    return view('site.routes.home', $data);
  }

}
