<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Offer;

class CalendarController extends Controller
{
	public function index(Offer $offer)
	{
		$selectedOffers = $offer->getSelectedOffers();
		if (count($selectedOffers) <= 0)
			return redirect()->to(action('ActivityController@index'));
		
		$data = [
			'styles'         => [
				'link' => 'plugins/fullcalendar/fullcalendar.css',
                'css/reservation-sidebar.min.css',
				[
					'media' => 'print',
					'link'  => 'plugins/fullcalendar/fullcalendar.print.css'
				]
			],
			'scripts' => [
				'plugins/fullcalendar/lib/moment.min.js',
				'plugins/fullcalendar/fullcalendar.min.js',
				'plugins/fullcalendar/es.js',
				'plugins/fullcalendar/pt.js',
			],
			'selectedOffers' => $selectedOffers,
			'viewDate'       => Carbon::parse(session('selectedDate'))->format('Y-m-d'),
			'count'          => [
				'offers'  => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.calendar.index', $data);
	}
	
	public function getData()
	{
		$selectedOffers = session('selectedOffers');
		$guideActivities = session('guideActivities');
		
		if (count($selectedOffers) <= 0)
			abort(404);
		$colors = ['#28975d', '#afa318', '#4a8b8d', '#ebb414'];
		$results = [];
		
		foreach ($selectedOffers as $key => $selectedOffer) {
			$offer = Offer::find($selectedOffer['offer_id']);
			
			$start = Carbon::createFromFormat('d/m/Y H:i:s', $selectedOffer['date'].' '.$selectedOffer['time']['start'])->toDateTimeString();
			$end = Carbon::createFromFormat('d/m/Y H:i:s', $selectedOffer['date'].' '.$selectedOffer['time']['end'])->toDateTimeString();
			
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
				'agency_name'      => $offer->agency->name
			];
		}
		
		$counter = count($results);
		
		if (count($guideActivities) > 0) {
			foreach ($guideActivities as $key => $guideActivity) {
				$activity = GuideActivity::find($guideActivity['id']);
				
				$start = Carbon::createFromFormat('d/m/Y H:i:s', $guideActivity['date'].' '.$guideActivity['hours_from'].':00')->toDateTimeString();
				$end = Carbon::createFromFormat('d/m/Y H:i:s', $guideActivity['date'].' '.$guideActivity['hours_to'].':00')->toDateTimeString();
				
				$results[] = [
					'id'                  => $counter++,
					'className'           => 'cal-offer guide-activity',
					'backgroundColor'     => '#FF8040',
					'borderColor'         => '#FF8040',
					'durationEditable'    => false,
					'guide_activity_id'   => $activity->id,
					'date'                => $guideActivity['date'],
					'start'               => $start,
					'end'                 => $end,
					'start_time'          => Carbon::parse($guideActivity['hours_from'])->format('H:i'),
					'end_time'            => Carbon::parse($guideActivity['hours_to'])->format('H:i'),
					'hours'               => $guideActivity['hours_to'] - $guideActivity['hours_from'],
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
		$offers = session('selectedOffers');
		$guide_activities = session('guideActivities');
		
		$action = $request['dir'];
		$oid = $request['oid'];
		
		if ($oid <= count($offers) - 1) {
			if ($action == 'prev')
				$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->subDay()->format('d/m/Y');
			elseif ($action == 'next')
				$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->addDay()->format('d/m/Y');
			session()->put('selectedOffers', $offers);
		} else {
			$oid = $oid - count($offers);
			if ($action == 'prev')
				$guide_activities[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $guide_activities[$oid]['date'])->subDay()->format('d/m/Y');
			elseif ($action == 'next')
				$guide_activities[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $guide_activities[$oid]['date'])->addDay()->format('d/m/Y');
			session()->put('guideActivities', $guide_activities);
		}
		
		$data = [
			'selectedOffers'  => $offers,
			'guideActivities' => $guide_activities
		];
		
		return response()->json($data);
	}
	
}
