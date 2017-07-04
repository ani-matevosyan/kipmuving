<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ActivityController extends Controller
{
	public function index(Activity $activity, Offer $offer)
	{
		$prefix = str_replace('/', '', Route::current()->getAction()['prefix']);
		
		if (in_array($prefix, session('cities.list')) && $prefix != session('cities.current'))
			return redirect()->action('CityController@setCity', ['prefix' => $prefix, 'route' => 'activities']);
		
		$imageIndex = rand(1, 3); //1-3
		$data = [
			'styles'     => [
				'owl-carousel/owl.carousel.css',
				'owl-carousel/owl.theme.css',
				'css/product-tour.min.css',
				'css/activities-style.min.css'
			],
			'scripts'    => [
				'js/product.tour.min.js',
				'js/product-tour.min.js',
//                'libs/jcf/js/jcf.js',
//                'libs/jcf/js/jcf.checkbox.js',
//                'libs/jcf/js/jcf.range.js',
				'js/chosen.jquery.min.js',
				'owl-carousel/owl.carousel.min.js',
//                'js/activities-scripts.min.js'
			],
			'imageIndex' => $imageIndex,
			'activities' => $activity->getAllActivities(),
			'count'      => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $offer->getSelectedOffersPersons(),
				'total'   => $offer->getSelectedOffersTotal()
			]
		];
		
		return view('site.activities.index', $data);
	}
	
	public function getSuProgram(Offer $offer)
	{
		$data = [
			'offers'  => count($offer->getSelectedOffers()),
			'persons' => $offer->getSelectedOffersPersons(),
			'total'   => $offer->getSelectedOffersTotal()
		];
		
		return ['data' => $data];
	}
	
	public function getSelectedOffers(Offer $offer)
	{
		$data = $offer->getSelectedOffers();
		
		return ['data' => $data];
	}
	
	public function getActivity($id)
	{
		$_activity = new Activity();
		if (!($activity = $_activity->getActivity($id)))
			abort(404);
		
		$_offer = new Offer();

//		dd($activity->offers[0]->duration);
		
		$data = [
			'styles'         => [
				'css/product-tour.min.css',
				'css/jquery-ui.min.css',
				'css/chosen/chosen.min.css',
                'css/jcf.custom.css',
				'css/prettyPhoto.min.css',
				'css/instafeed/instafeed.min.css',
				'css/offer-items.min.css',
				'css/activity-style.min.css'
			],
			'scripts'        => [
				'js/product.tour.min.js',
				'js/product-tour.min.js',
				'js/moment.js',
                'libs/jcf/js/jcf.js',
                'libs/jcf/js/jcf.select.js',
				'js/chosen.jquery.min.js',
				'js/instafeed/instafeed.min.js',
				'js/instafeed/instafeed-settings.min.js',
				'js/jquery.prettyPhoto.js', //Gallery and currency/language pop-up
				'http://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap'
			],
			'activity'       => $activity,
			'activitiesList' => $_activity->getActivitiesList(),
			'offers'         => [
//				'recommend' => $offer->getRecommendOffers($id),
//				'price' => $offer->getPriceOffers($id),
//				'includes' => $offer->getIncludesOffers($id),
				'selected' => $_offer->getSelectedOffers()
			],
			'count'          => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $_offer->getSelectedOffersPersons(),
				'total' => $_offer->getSelectedOffersTotal()
			],
			'title'          => empty($activity->name) ? null : $activity->name
		];
		
		return view('site.activities.activity-single', $data);
	}
	
	public function search(Request $request)
	{
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['activity_date'])->toDateString());
		
		return Redirect::to(action('ActivityController@getActivity', $request['activity_id']));
	}
}
