<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class FreePagesController extends Controller
{
  public function index(Offer $offer)
  {
    $prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

    if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
      return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide']);

    $data = [
      'styles' => config('resources.free.walking.styles'),
      'scripts' => config('resources.free.walking.scripts'),
      'count' => [
        'offers' => count(session('selectedOffers')) + count(session('guideActivities')),
        'persons' => $offer->getSelectedOffersPersons(),
        'total' => $offer->getSelectedOffersTotal()
      ]
    ];

    return view('site.free.caminhando', $data);
  }

  public function getBicicleta(Offer $offer)
  {
    $prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

    if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
      return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-bicycle']);


    $data = [
      'styles' => config('resources.free.bicycle.styles'),
      'scripts' => config('resources.free.bicycle.scripts'),
      'activities' => $this->getMapPoints()
    ];

    return view('site.free.bicicleta', $data);
  }


  public function getDecarro(Offer $offer)
  {
    $prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

    if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
      return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-car']);


    $data = [
      'styles' => config('resources.free.bus.styles'),
      'scripts' => config('resources.free.bus.scripts'),
      'activities' => $this->getMapPoints()
    ];

    return view('site.free.decarro', $data);
  }

  public function getTourcultural(Offer $offer)
  {
    $prefix = str_replace('/', '', Route::current()->getAction()['prefix']);

    if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
      return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'guide-car']);


    $data = [
      'styles' => config('resources.free.cultural.styles'),
      'scripts' => config('resources.free.cultural.scripts'),
      'activities' => $this->getMapPoints()
    ];

    return view('site.free.tourcultural', $data);
  }

  public function getMapPoints()
  {
    $region = session('cities.current') ? session('cities.current') : 'pucon';

    $activities = GuideActivity::where('region', '=', $region)->get();

    return $activities;
  }

  public function addActivity(Request $request)
  {
    $activities = session('guideActivities');
    $activities[] = [
      'id' => $request['id'],
      'date' => $request['date'],
      'hours_from' => $request['hours_from'],
      'hours_to' => $request['hours_to']
    ];

    session()->put('guideActivities', $activities);
  }
}
