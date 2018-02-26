<?php

namespace App\Http\Controllers;

use App\FreeActivity;
use App\Offer;
use App\Suggestion;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
	public function index()
	{
		$s_offers = \session('basket.special');
		$data = [
			'styles'          => config('resources.routes.styles'),
			'scripts'         => config('resources.routes.scripts.home'),
			'count'           => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			],
			'free_activities' => $this->getFreeActivities(),
			'suggestions'     => Suggestion::get(),
		];

		return view('site.routes.home', $data);
	}

	public function suggestion($id)
	{
		$s_offers = \session('basket.special');
		$data = [
			'styles'     => config('resources.routes.styles'),
			'scripts'    => config('resources.routes.scripts.single'),
			'count'      => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			],
			'suggestion' => Suggestion::find($id),
		];

		return view('site.routes.suggestion', $data);
	}

	public function filterSuggestions(Request $request)
	{
		$weather = $request['weather'] ?: null;
		$time = $request['time'] ?: null;
		$intensity = $request['intensity'] ?: null;
		$category = $request['category'] ?: null;

		$suggestions = Suggestion::query();

		if ($weather)
			$suggestions = $suggestions->where('weather', '=', $weather);

		if ($time)
			$suggestions = $suggestions->where('time_of_day', '=', $time);

		if ($intensity)
			$suggestions = $suggestions->where('intensity', '=', $intensity);

		if ($category)
			$suggestions = $suggestions->where('category', '=', $category);

		$suggestions = $suggestions->get();

		$data = [];
		foreach ($suggestions as $suggestion) {
			$data [] = [
				'image'             => $suggestion->image,
				'name'              => $suggestion->name,
				'short_description' => $suggestion->short_description,
				'category'          => $suggestion->category,
				'intensity'         => $suggestion->intensity,
			];
		}

		return $data;
	}

	public function activity($id)
	{
		$s_offers = \session('basket.special');
		$free_activity = FreeActivity::find($id);

		if (!$free_activity) abort(404);

		switch ($free_activity->page) {
			case 'walking' :
				$free_activity_category = 'Caminhando';
				break;
			case 'cultural' :
				$free_activity_category = 'Tour Cultural';
				break;
			case 'bus' :
				$free_activity_category = 'De Carro ou Ônibus';
				break;
			case 'bicycle' :
				$free_activity_category = 'Bicicleta';
				break;

			default:
				$free_activity_category = null;
		}

		$data = [
			'styles'                 => config('resources.routes.styles'),
			'scripts'                => config('resources.routes.scripts.single'),
			'count'                  => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			],
			'free_activity'          => $free_activity,
			'free_activity_category' => $free_activity_category,
		];

		return view('site.routes.activity', $data);
	}

	public function getFreeActivities()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activities = FreeActivity::where('region', '=', $region)->get();

		return $activities;
	}

}
