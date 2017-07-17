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
				'libs/product-tour/product-tour.min.css',
				'css/activities-style.min.css'
			],
			'scripts'    => [
				'js/product.tour.min.js',
				'libs/product-tour/product-tour.min.js',
				'js/chosen.jquery.min.js',
				'owl-carousel/owl.carousel.min.js',
				'libs/jquery-ui/slider/jquery-ui.min.js',
				'js/activities-scripts.min.js'
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
		
		$data = [
			'styles'         => [
				'libs/product-tour/product-tour.min.css',
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
				'libs/product-tour/product-tour.min.js',
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
				'selected' => $_offer->getSelectedOffers()
			],
			'count'          => [
				'offers'  => count(session('selectedOffers')) + count(session('guideActivities')),
				'persons' => $_offer->getSelectedOffersPersons(),
				'total'   => $_offer->getSelectedOffersTotal()
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
	
	public function filters(Request $request)
	{
		$filters = json_decode($request->data);
		
		$activities = Activity::query();
		
		$activities = $activities->where('visibility', true);
		$activities = $activities->where('region', '=', session('cities.current'));
		
		if (count($filters->price) === 2 && is_integer($filters->price[0]) && is_integer($filters->price[1])) {
			$activities = $activities->whereRaw('(select min(offers.price) from offers where offers.activity_id = activities.id) between ' . $filters->price[0] . ' and ' . $filters->price[1]);
		}
		
		
		if (count($filters->style) > 0) {
			$activities = $activities->whereIn('styles', $filters->style);
		}
		
		if (count($filters->period) > 0) {
			
			if (in_array('Verano', $filters->period)) {
				$activities = $activities->where('available_high', true);
			}
			
			if (in_array('Invierno', $filters->period)) {
				$activities = $activities->where('available_low', true);
			}
			
			if (in_array('Actividad Diurna', $filters->period)) {
				$activities = $activities->where('available_day', true);
			}
			
			if (in_array('Actividad Noturna', $filters->period)) {
				$activities = $activities->where('available_night', true);
			}
			
		}
		
		$activities = $activities->get();
		
		$result = [];
		
		foreach ($activities as $activity) {

			$result[$activity->styles] [] = [
				'id'                => $activity->id,
				'name'              => $activity->name,
				'short_description' => $activity->short_description,
				'image_thumb'       => file_exists($activity->image_thumb) ? $activity->image_thumb : 'images/image-none.jpg',
				'availability'      => [
					'night'  => $activity->available_night,
					'day'    => $activity->available_day,
					'summer' => $activity->available_high,
					'winter' => $activity->available_low,
				],
				'offers_min_price'  => number_format($activity->offers->min('price'), 0, ".", ".")
			];
			
		}
		
		return response($result);
	}
}
