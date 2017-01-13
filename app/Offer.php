<?php

namespace App;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	use Translatable;
	public $translationModel = 'App\OfferTranslation';
	public $translatedAttributes = [
		'includes',
		'cancellation_rules',
		'important',
		'description'
	];
	protected $table = 'offers';
	
	private function getAgency($agencyId)
	{
		$agency = AgencyTranslation::where('agencies.id', $agencyId)
			->join('agencies', 'agency_translations.agency_id', 'agencies.id')
			->where('agency_translations.locale', app()->getLocale())
			->select(
				'agencies.id',
				'agencies.address',
				'agencies.email',
				'agencies.latitude',
				'agencies.longitude',
				'agencies.image',
				'agencies.image_icon',
				'agency_translations.name',
				'agency_translations.description'
			)
			->first();
		
		return $agency;
	}
	
	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);
		
		return null;
	}
	
	private function getIncludes($includes)
	{
		if (!$includes)
			return null;
		
		$result = $this->dataToArray($includes);
		$result = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
			return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
		}, $result);
		$result[count($result) - 1] = str_replace(';', '', $result[count($result) - 1]);
		
		return $result;
	}
	
	private function getTime($time)
	{
		$time = $this->dataToArray($time);
		
		if ($time) {
			$result = [];
			foreach ($time as $key => $item) {
				$item = explode('-', $item);
				$result[$key]['start'] = $item[0];
				$result[$key]['end'] = $item[1];
			}
			
			return $result;
		}
		
		return null;
	}
	
	private function getDuration($timeArray)
	{
		if (!$timeArray)
			return null;
		
		$start = $timeArray[0]['start'];
		$end = $timeArray[0]['end'];
		
		return $end - $start < 0 ? $end - $start + 24 : ($end - $start == 0 ? 24 : $end - $start);
	}
	
	private function checkOffersAvailability($offers)
	{
		return $offers->filter(function ($value, $key) {
			$startDate = Carbon::createFromFormat('d.m.Y', $value->available_start_date.'.'.Carbon::now()->year)->toDateString();
			$endDate = Carbon::createFromFormat('d.m.Y', $value->available_end_date.'.'.Carbon::now()->year)->toDateString();
			
			if ($endDate > $startDate)
				return session('selectedDate') >= $startDate
					&& session('selectedDate') <= $endDate;
//					&& $value->availability == true;
		});
	}
	
	public function getPriceAttribute()
	{
		$price = $this->attributes['price'];
		
		if (session('currency.type') == 'USD')
			$price = round($price / session('currency.values.USDCLP'));
		elseif (session('currency.type') == 'BRL')
			$price = round($price / session('currency.values.USDCLP') * session('currency.values.USDBRL'));
		
		return $price;
	}
	
	public function getAvailableStartDateAttribute()
	{
		$start = Carbon::parse($this->attributes['available_start'])->format('d.m');
		
		return $start;
	}
	
	public function getAvailableEndDateAttribute()
	{
		$end = Carbon::parse($this->attributes['available_end'])->format('d.m');
		
		return $end;
	}
	
	public function getPriceOfferAttribute()
	{
		$price = $this->attributes['price_offer'];
		
		if (session('currency.type') == 'USD')
			$price = round($price / session('currency.values.USDCLP'));
		elseif (session('currency.type') == 'BRL')
			$price = round($price / session('currency.values.USDCLP') * session('currency.values.USDBRL'));
		
		return $price;
	}
	
	public function getActivityAttribute()
	{
		$activity = Activity::where('id', $this['activity_id'])
			->first();
		
		return $activity['name'];
	}
	
	public function getAgencyAttribute()
	{
		$agency = Agency::where('id', $this['agency_id'])
			->first();
		
		return $agency['name'];
	}
	
	public function getRealPriceAttribute()
	{
		return $this->attributes['price'];
	}
	
	public function getRealPriceOfferAttribute()
	{
		return $this->attributes['price_offer'];
	}
	
	public function setRealPriceAttribute($price)
	{
		$offer = Offer::find($this['id']);
		$offer['price'] = $price;
		$offer->save();
	}
	
	public function setRealPriceOfferAttribute($price_offer)
	{
		$offer = Offer::find($this['id']);
		$offer['price_offer'] = $price_offer;
		$offer->save();
	}
	
	public function getRecommendOffers($activityId)
	{
		$offers = Offer::join('agencies', 'offers.agency_id', 'agencies.id')
			->where('offers.activity_id', $activityId)
			->where('offers.availability', true)
			->orderBy('agencies.recommendation', 'DESC')
			->select('offers.*')
			->get();
		
		$offers = $this->checkOffersAvailability($offers);
		
		foreach ($offers as $offer) {
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
			$offer['includes'] = $this->getIncludes($offer['includes']);
			$offer['available_time'] = $this->getTime($offer['available_time']);
			$offer['hours'] = $this->getDuration($offer['available_time']);
		}
		
		return $offers;
	}
	
	public function getPriceOffers($activityId)
	{
		$offers = Offer::where('activity_id', $activityId)
			->where('availability', true)
			->orderBy('price_offer', 'ASC')
			->get();
		
		$offers = $this->checkOffersAvailability($offers);
		
		foreach ($offers as $offer) {
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
			$offer['includes'] = $this->getIncludes($offer['includes']);
			$offer['available_time'] = $this->getTime($offer['available_time']);
			$offer['hours'] = $this->getDuration($offer['available_time']);
		}
		
		return $offers;
	}
	
	public function getIncludesOffers($activityId)
	{
		$offers = Offer::where('activity_id', $activityId)
			->where('availability', true)
			->get();
		
		$offers = $this->checkOffersAvailability($offers);
		
		foreach ($offers as $offer) {
			$offer['includes_count'] = count($this->getIncludes($offer['includes']));
		}
		
		$offers = array_reverse(array_sort($offers, function ($value) {
			return $value['includes_count'];
		}));
		
		foreach ($offers as $offer) {
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
			$offer['includes'] = $this->getIncludes($offer['includes']);
			$offer['available_time'] = $this->getTime($offer['available_time']);
			$offer['hours'] = $this->getDuration($offer['available_time']);
		}
		
		return $offers;
	}
	
	public function getSelectedOffers()
	{
		if (session()->has('selectedOffers')) {
			$sessionOffers = session('selectedOffers');
			$offers = [];
			foreach ($sessionOffers as $sessionOffer) {
				$offers[] = Offer::where('offers.id', $sessionOffer['offer_id'])
					->join('activities', 'activities.id', 'offers.activity_id')
					->join('activity_translations', 'activities.id', 'activity_translations.activity_id')
					->where('activity_translations.locale', app()->getLocale())
					->select('offers.price_offer', 'activity_translations.name')
					->first();
			}
			if (count($offers) > 0)
				foreach ($offers as $key => $offer) {
					$sessionOffers[$key]['name'] = $offer['name'];
					$sessionOffers[$key]['price_offer'] = $offer['price_offer'];
				}
			else
				$sessionOffers = null;
		} else {
			session()->forget('selectedOffers');
			$sessionOffers = null;
		}
		
		return $sessionOffers;
	}
	
	public function getSelectedOffersPersons()
	{
		$countPersons = 0;
		$selectedOffers = $this->getSelectedOffers();
		if ($selectedOffers)
			foreach ($selectedOffers as $offer) {
				if ($countPersons < $offer['persons'])
					$countPersons = $offer['persons'];
			}
		
		return $countPersons;
	}
	
	public function getAgencyOffers($agencyId)
	{
		$offers = Offer::where('agency_id', $agencyId)
			->join('offer_translations', 'offers.id', 'offer_translations.offer_id')
			->join('activities', 'activities.id', 'offers.activity_id')
			->join('activity_translations', 'activities.id', 'activity_translations.activity_id')
			->where('activity_translations.locale', app()->getLocale())
			->where('offer_translations.locale', app()->getLocale())
			->select(
				'activities.id as activity_id',
				'activity_translations.name as activity_name',
				'offer_translations.includes as offer_includes',
				'offers.id',
				'offers.available_start',
				'offers.available_end',
				'offers.available_time',
				'offers.availability',
				'offers.start_time',
				'offers.end_time',
				'offers.price_offer'
			)
			->get();
		
		$offers = $this->checkOffersAvailability($offers);
		
		foreach ($offers as $offer) {
			$offer['offer_includes'] = $this->getIncludes($offer['offer_includes']);
			$offer['available_time'] = $this->getTime($offer['available_time']);
			$offer['hours'] = $this->getDuration($offer['available_time']);
		}
		
		return $offers;
	}
	
	public function getOffer($offerId)
	{
		$offer = Offer::where('offers.id', $offerId)
			->join('offer_translations', 'offer_translations.offer_id', 'offers.id')
			->where('offer_translations.locale', app()->getLocale())
			->select(
				'offers.id as offer_id',
				'offers.agency_id',
				'offers.activity_id',
				'offers.start_time',
				'offers.end_time',
				'offers.price_offer',
				'offers.price',
				'offer_translations.includes as offerIncludes',
				'offer_translations.important as offerImportant',
				'offer_translations.cancellation_rules as offerCancellationRules'
			)
			->first();
		$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
		$offer['offerActivity'] = Activity::where('activities.id', $offer['activity_id'])
			->first();
		$offer['offerIncludes'] = $this->getIncludes($offer['offerIncludes']);
		$offer['offerCarry'] = $offer['offerActivity']['carry'];
		
		return $offer;
	}
}
