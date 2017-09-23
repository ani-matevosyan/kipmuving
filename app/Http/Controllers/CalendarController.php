<?php

namespace App\Http\Controllers;

use App\FreeActivity;
use App\SpecialOffer;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Offer;
use App\Services\ICS;

class CalendarController extends Controller
{
	public function index()
	{
		$_offer = new Offer();
		$selectedOffers = $_offer->getSelectedOffers();
		$freeActivities = session('basket.free');

		if (count($selectedOffers) + count($freeActivities) <= 0)
			return redirect()->to(action('ActivityController@index'));

		$data = [
			'styles'         => config('resources.calendar.styles'),
			'scripts'        => config('resources.calendar.scripts'),
			'selectedOffers' => $selectedOffers,
			'special_offers' => SpecialOffer::getSpecialOffers(),
			'viewDate'       => Carbon::parse(session('selectedDate'))->format('Y-m-d'),
			'count'          => [
				'offers'  => count($_offer->getSelectedOffers()),
				'persons' => $_offer->getSelectedOffersPersons(),
			],
		];

		return view('site.calendar.index', $data);
	}

	public function getData()
	{
		$selectedOffers = session('basket.offers');
		$freeActivities = session('basket.free');

		if (count($selectedOffers) + count($freeActivities) <= 0 ) abort(404);

		$colors = ['#28975d', '#afa318', '#4a8b8d', '#ebb414'];
		$results = [];

		foreach ($selectedOffers as $key => $selectedOffer) {
			$offer = Offer::find($selectedOffer['offer_id']);

			$start = Carbon::createFromFormat('d/m/Y H:i:s', $selectedOffer['date'] . ' ' . $selectedOffer['time']['start'])->toDateTimeString();
			$end = Carbon::createFromFormat('d/m/Y H:i:s', $selectedOffer['date'] . ' ' . $selectedOffer['time']['end'])->toDateTimeString();

			$results[] = [
				'id'               => $key,
				'className'        => 'cal-offer',
				'backgroundColor'  => $colors[$key % count($colors)],
				'borderColor'      => $colors[$key % count($colors)],
				'durationEditable' => false,
				'offer_id'         => $offer->id,
				'persons'          => $selectedOffer['persons'],
				'date'             => $selectedOffer['date'],
				'start'            => $start,
				'end'              => $end,
				'start_time'       => Carbon::parse($selectedOffer['time']['start'])->format('H:i'),
				'end_time'         => Carbon::parse($selectedOffer['time']['end'])->format('H:i'),
				'hours'            => $selectedOffer['time']['end'] - $selectedOffer['time']['start'],
				'break_start'      => $offer->break_start,
				'break_close'      => $offer->break_close,
				'price'            => $offer->price * $selectedOffer['persons'],
				'activity_id'      => $offer->activity->id,
				'title'            => $offer->activity->name,
				'agency_id'        => $offer->agency->id,
				'agency_name'      => $offer->agency->name,
			];
		}

		$counter = count($results);

		if (count($freeActivities) > 0) {
			foreach ($freeActivities as $key => $freeActivity) {
				$activity = FreeActivity::find($freeActivity['id']);

				$start = Carbon::createFromFormat('d/m/Y H:i:s', $freeActivity['date'] . ' ' . $freeActivity['hours_from'] . ':00')->toDateTimeString();
				$end = Carbon::createFromFormat('d/m/Y H:i:s', $freeActivity['date'] . ' ' . $freeActivity['hours_to'] . ':00')->toDateTimeString();

				$results[] = [
					'id'                  => $counter++,
					'className'           => 'cal-offer guide-activity',
					'backgroundColor'     => '#FF8040',
					'borderColor'         => '#FF8040',
					'durationEditable'    => false,
					'guide_activity_id'   => $activity->id,
					'date'                => $freeActivity['date'],
					'start'               => $start,
					'end'                 => $end,
					'start_time'          => Carbon::parse($freeActivity['hours_from'])->format('H:i'),
					'end_time'            => Carbon::parse($freeActivity['hours_to'])->format('H:i'),
					'hours'               => $freeActivity['hours_to'] - $freeActivity['hours_from'],
					'bus_est_expenditure' => $activity->bus_est_expenditure,
					'bus_est_service'     => $activity->bus_est_service,
					'title'               => $activity->name,
				];
			}
		}

		return response()->json($results);
	}

	public function getProcess(Request $request)
	{
		$offers = session('basket.offers');
		$freeActivities = session('basket.free');

		$action = $request['dir'];
		$oid = $request['oid'];

		if ($oid <= count($offers) - 1) {
			if ($action == 'prev')
				$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->subDay()->format('d/m/Y');
			elseif ($action == 'next')
				$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->addDay()->format('d/m/Y');
			session()->put('basket.offers', $offers);
		} else {
			$oid = $oid - count($offers);
			if ($action == 'prev')
				$freeActivities[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $freeActivities[$oid]['date'])->subDay()->format('d/m/Y');
			elseif ($action == 'next')
				$freeActivities[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $freeActivities[$oid]['date'])->addDay()->format('d/m/Y');
			session()->put('basket.free', $freeActivities);
		}

		$data = [
			'selectedOffers' => $offers,
			'freeActivities' => $freeActivities,
		];

		return response()->json($data);
	}

	public function generateICS()
	{
		$offers = session('basket.offers');
		$free_activities = session('basket.free');

		if (count($offers) + count($free_activities) < 1)
			return redirect()->route('activities');

		$calendar = new ICS('Kipmuving events - ' . Carbon::now()->toDateString());

		if (count($offers) > 0) {
			foreach ($offers as $offer) {
				$_offer = Offer::find($offer['offer_id']);

				$calendar->add(
					Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'] . ' ' . $offer['time']['start']),
					Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'] . ' ' . $offer['time']['end']),
					isset($_offer->activity->name) ? $_offer->activity->name : 'Activity without name',
					isset($_offer->description) ? $_offer->description : 'Activity without description',
					$_offer->activity->latitude . ", " . $_offer->activity->longitude
				);
			}
		}

		if (count($free_activities) > 0) {
			foreach ($free_activities as $free_activity) {
				$activity = FreeActivity::find($free_activity['id']);

				$calendar->add(
					Carbon::createFromFormat('d/m/Y H:i', $free_activity['date'] . ' ' . $free_activity['hours_from']),
					Carbon::createFromFormat('d/m/Y H:i', $free_activity['date'] . ' ' . $free_activity['hours_to']),
					$activity->name ? $activity->name : 'Activity without name',
					$activity->short_description ? $activity->short_description : 'Activity without description',
					$activity->latitude . ", " . $activity->longitude
				);
			}
		}

		$calendar->show();
	}

}
