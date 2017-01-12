<?php

namespace App\Http\Controllers;

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
			'selectedOffers' => $selectedOffers,
			'viewDate'       => Carbon::parse(session('selectedDate'))->format('Y-m-d'),
			'count'          => [
				'offers'  => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];
		
		return view('site.calendar.index', $data);
	}
	
	public function getData(Offer $offer)
	{
		$selectedOffers = session('selectedOffers');
		if (count($selectedOffers) <= 0)
			abort(404);
		$colors = ['#28975d', '#afa318', '#4a8b8d', '#ebb414'];
		$results = [];
		
		foreach ($selectedOffers as $key => $offer) {
			$currentOffer = Offer::where('offers.id', $offer['offer_id'])
				->join('activities', 'activities.id', 'offers.activity_id')
				->join('activity_translations', 'activities.id', 'activity_translations.activity_id')
				->join('agencies', 'agencies.id', 'offers.agency_id')
				->join('agency_translations', 'agencies.id', 'agency_translations.agency_id')
//				->where('activity_translations.locale', app()->getLocale())
				->select(
					'offers.start_time',
					'offers.end_time',
					'offers.break_start',
					'offers.break_close',
					'offers.price',
					'activities.id as activity_id',
					'agencies.id as agency_id',
					'activity_translations.name as activity_name',
					'agency_translations.name as agency_name'
				)
				->first();
			
			$selectedOffers[$key]['offer'] = $currentOffer;
			$start = Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'].' '.$selectedOffers[$key]['time']['start'])->toDateTimeString();
			$end = Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'].' '.$selectedOffers[$key]['time']['end'])->toDateTimeString();
			$results[] = [
				'id'               => $key,
				'className'        => 'cal-offer',
				'backgroundColor'  => $colors[$key % count($colors)],
				'borderColor'      => $colors[$key % count($colors)],
				// 'startEditable' => false,
				// 'endEditable' => false,
				'durationEditable' => false,
				'offer_id'         => $offer['offer_id'],
				'persons'          => $offer['persons'],
				'date'             => $offer['date'],
				'start'            => $start,
				'end'              => $end,
				'start_time'       => Carbon::parse($selectedOffers[$key]['time']['start'])->format('H:i'),
				'end_time'         => Carbon::parse($selectedOffers[$key]['time']['end'])->format('H:i'),
				'hours'            => $selectedOffers[$key]['time']['end'] - $selectedOffers[$key]['time']['start'],
				'break_start'      => $selectedOffers[$key]['offer']['break_start'],
				'break_close'      => $selectedOffers[$key]['offer']['break_close'],
				'price'            => $selectedOffers[$key]['offer']['price'] * $offer['persons'],
				'activity_id'      => $selectedOffers[$key]['offer']['activity_id'],
				'title'            => $selectedOffers[$key]['offer']['activity_name'],
				'agency_id'        => $selectedOffers[$key]['offer']['agency_id'],
				'agency_name'      => $selectedOffers[$key]['offer']['agency_name']
			];
		}
		
		return response()->json($results);
	}
	
	public function getProcess(Request $request)
	{
		$offers = session('selectedOffers');
		$action = $request['dir'];
		$oid = $request['oid'];
		
		if ($action == 'prev')
			$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->subDay()->format('d/m/Y');
		elseif ($action == 'next')
			$offers[$oid]['date'] = Carbon::createFromFormat('d/m/Y', $offers[$oid]['date'])->addDay()->format('d/m/Y');
		elseif ($action == 'del')
			array_splice($offers, $oid, 1);
		
		session()->put('selectedOffers', $offers);
		
		$data = [
			'selectedOffers' => $offers
		];
		
		return response()->json($data);
	}
	
}
