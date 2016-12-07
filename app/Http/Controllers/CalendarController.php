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
		$data = [
			'selectedOffers' => $offer->getSelectedOffers(),
			'viewDate' => Carbon::parse(session('selectedDate'))->format('d/m/Y'),
			'count' => [
				'offers' => count($offer->getSelectedOffers()),
				'persons' => $offer->getSelectedOffersPersons()
			]
		];

		return view('site.calendar.index', $data);
	}

	public function getAjaxData(Offer $offer)
	{
		$data = [
			'offers' => count($offer->getSelectedOffers()),
			'persons' => $offer->getSelectedOffersPersons()
		];

		return array($data);
	}

	public function getData(Offer $offer)
	{
		$selectedOffers = session('selectedOffers');
		$colors = ['#28975d', '#afa318', '#4a8b8d', '#ebb414'];
		$results = [];

		foreach ($selectedOffers as $key => $offer) {
			$currentOffer = Offer::where('offers.id', $offer['offer_id'])
				->join('activities', 'activities.id', 'offers.activity_id')
				->join('activity_translations', 'activities.id', 'activity_translations.activity_id')
				->join('agencies', 'agencies.id', 'offers.agency_id')
				->join('agency_translations', 'agencies.id', 'agency_translations.agency_id')
				->where('activity_translations.locale', app()->getLocale())
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
			$start = Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'].' '.$selectedOffers[$key]['offer']['start_time'])->toDateTimeString();
			$end = Carbon::createFromFormat('d/m/Y H:i:s', $offer['date'].' '.$selectedOffers[$key]['offer']['end_time'])->toDateTimeString();
			$results[] = [
				'id' => $key,
				'class_name' => 'cal-offer',
				'backgroundColor' => $colors[$key % count($colors)],
				'borderColor' => $colors[$key % count($colors)],
				// 'startEditable' => false,
				// 'endEditable' => false,
				'durationEditable' => false,
				'offer' => [
					'offer_id' => $offer['offer_id'],
					'persons' => $offer['persons'],
					'date' => $offer['date'],
					'start' => $start,
					'end' => $end,
					'start_time' => Carbon::parse($selectedOffers[$key]['offer']['start_time'])->format('H:i'),
					'end_time' => Carbon::parse($selectedOffers[$key]['offer']['end_time'])->format('H:i'),
					'hours' => $selectedOffers[$key]['offer']['end_time'] - $selectedOffers[$key]['offer']['start_time'],
					'break_start' => $selectedOffers[$key]['offer']['break_start'],
					'break_close' => $selectedOffers[$key]['offer']['break_close'],
					'price' => $selectedOffers[$key]['offer']['price'] * $offer['persons']
				],
				'activity' => [
					'activity_id' => $selectedOffers[$key]['offer']['activity_id'],
					'activity_name' => $selectedOffers[$key]['offer']['activity_name'],
				],
				'agency' => [
					'agency_id' => $selectedOffers[$key]['offer']['agency_id'],
					'agency_name' => $selectedOffers[$key]['offer']['agency_name'],
				],
			];
		}
		$data = [
			'currentDate' => Carbon::now()->format('d/m/Y'),
			'offers' => $results
		];
		return Response::json($data);
	}

}