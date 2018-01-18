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
      'scripts' => config('resources.routes.scripts.home'),
      'count'             => [
        'special_offers' => count($s_offers),
        'offers'         => count(session('basket.offers')) + count(session('basket.free'))
      ]
    ];

    return view('site.routes.home', $data);
  }

  public function suggestion(Offer $offer)
  {
    $s_offers = \session('basket.special');
    $data = [
      'styles' => config('resources.routes.styles'),
      'scripts' => config('resources.routes.scripts.single'),
      'count'             => [
        'special_offers' => count($s_offers),
        'offers'         => count(session('basket.offers')) + count(session('basket.free'))
      ]
    ];

    return view('site.routes.suggestion', $data);
  }

  public function activity(Offer $offer)
  {
    $s_offers = \session('basket.special');
    $data = [
      'styles' => config('resources.routes.styles'),
      'scripts' => config('resources.routes.scripts.single'),
      'count'             => [
        'special_offers' => count($s_offers),
        'offers'         => count(session('basket.offers')) + count(session('basket.free'))
      ]
    ];

    return view('site.routes.activity', $data);
  }

}
