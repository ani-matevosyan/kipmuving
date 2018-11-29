<?php

namespace App;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\OfferDay;
use Illuminate\Support\Facades\Session;

class Offer extends Model
{
	use Translatable;
	public $translationModel = 'App\OfferTranslation';
	public $translatedAttributes = [
		'includes',
		'real_includes',
		'cancellation_rules',
		'important',
		'description',
	];
	protected $table = 'offers';

    public function days()
    {
        return $this->hasMany(OfferDay::class, 'offer_id', 'id');
    }

	public function activity()
	{
		return $this->hasOne('App\Activity', 'id', 'activity_id');
	}

	public function agency()
	{
		return $this->hasOne('App\Agency', 'id', 'agency_id');
	}

	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);

		return null;
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

	public function getAvailableTimeAttribute()
	{
		$time = $this->dataToArray($this->attributes['available_time']);
		$time[count($time) - 1] = str_replace(';', '', $time[count($time) - 1]);
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

	public function getRealAvailableTimeAttribute()
	{
		return $this->attributes['available_time'];
	}

	public function setRealAvailableTimeAttribute($available_time)
	{
		$this->attributes['available_time'] = $available_time;
	}

	public function getScheduleAttribute()
	{
		return [
			'start' => $this->available_time[0]['start'],
			'end'   => $this->available_time[count($this->available_time) - 1]['end'],
		];
	}

	public function getDurationAttribute()
	{
		if (count($this->available_time) > 0) {
			$start = $this->available_time[0]['start'];
			$end = $this->available_time[0]['end'];

			return $end - $start < 0 ? $end - $start + 24 : ($end - $start == 0 ? 24 : $end - $start);
		}

		return null;
	}

	private function checkOffersAvailability($offers)
	{
		return $offers->filter(function ($value, $key) {
			$startDate = Carbon::createFromFormat('d.m.Y', $value->available_start_date . '.' . Carbon::now()->year)->toDateString();
			$endDate = Carbon::createFromFormat('d.m.Y', $value->available_end_date . '.' . Carbon::now()->year)->toDateString();

			if ($endDate > $startDate)
				return session('selectedDate') >= $startDate
					&& session('selectedDate') <= $endDate;
//					&& $value->availability == true;
		});
	}

	public function getPriceAttribute()
	{
	    $today = date('Y-m-d');
        if(Session::has('selectedDate')) {
            $today = session('selectedDate');
        }
        return $this->getPrice($today);
	}

    public function getPrice($date)
    {
        $price = $this->attributes['price'];
        $modelDays = $this->days()->get();
        if($modelDays->isNotEmpty()){
            foreach ($modelDays as $key=>$item){
                if($date >= $item->available_start && $date <= $item->available_end){
                    if($item->price_offer){
                        $price = $item->price_offer;
                    }else{
                        $price = $item->price;
                    }
                }
            }
        }
        if (session('currency.type') == 'USD')
            $price = round($price / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
        elseif (session('currency.type') == 'BRL')
            $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
        elseif (session('currency.type') == 'ILS')
            $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDILS'), 2, PHP_ROUND_HALF_EVEN);

        return round($price, 2);
    }

    public function getOldPriceAttribute()
    {
        $today = date('Y-m-d');
        if(Session::has('selectedDate')) {
            $today = session('selectedDate');
        }
        return $this->getOldPrice($today);
    }

    public function getOldPrice($date)
    {
        $price = $this->attributes['price'];
        $modelDays = $this->days()->get();
        $countDaysContainingToday = 0;
        if($modelDays->isNotEmpty()){
            foreach ($modelDays as $key=>$item){
                if($date >= $item->available_start && $date <= $item->available_end ){
                    $countDaysContainingToday++;
                    if(!$item->price_offer){
                        $price = 0;
                    }else{
                        $price = $item->price;
                    }
                }
            }
            if($countDaysContainingToday == 0){
                return false;
            }
            if (session('currency.type') == 'USD')
                $price = round($price / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
            elseif (session('currency.type') == 'BRL')
                $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
            elseif (session('currency.type') == 'ILS')
                $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDILS'), 2, PHP_ROUND_HALF_EVEN);
            return round($price, 2);
        }else {
            return false;
        }
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
		elseif (session('currency.type') == 'ILS')
			$price = round($price / session('currency.values.USDCLP') * session('currency.values.USDILS'));

		return round($price, 2);
	}

	public function getRealPriceAttribute()
	{
		return $this->attributes['price'];
	}

    public function getCurrentPriceAttribute()
    {
        $price = $this->attributes['price'];
        $today = date('Y-m-d');
        if(Session::has('selectedDate')) {
            $today = session('selectedDate');
        }
        $modelDays = $this->days()->get();
        if($modelDays->isNotEmpty()){
            foreach ($modelDays as $key=>$item){
                if($today >= $item->available_start && $today <= $item->available_end){
                    if($item->price_offer){
                        $price = $item->price_offer;
                    }else{
                        $price = $item->price;
                    }
                }
            }
        }
        return $price;
    }

	public function getRealPriceOfferAttribute()
	{
		return $this->attributes['price_offer'];
	}

	public function setRealPriceAttribute($price)
	{
		$this->attributes['price'] = $price;
	}

	public function setRealPriceOfferAttribute($price_offer)
	{
		$this->attributes['price_offer'] = $price_offer;
	}

	public function getSelectedOffers()
	{
		$result = null;

		if (session()->has('basket.offers')) {
			$basket_offers = session('basket.offers');
			foreach ($basket_offers as $basket_offer) {
				$offer = Offer::find($basket_offer['offer_id']);

				$result [] = [
					'name'        => $offer->activity->name,
					'price_offer' => $offer->price_offer,
					'price'       => $offer->price,
					'offer_id'    => $basket_offer['offer_id'],
					'date'        => $basket_offer['date'],
					'persons'     => $basket_offer['persons'],
					'time'        => $basket_offer['time'],
				];
			}
		}

		return $result;
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

	public function getSelectedOffersTotal()
	{
		$total = 0;
		$selectedOffers = $this->getSelectedOffers();

		if ($selectedOffers)
			foreach ($selectedOffers as $offer) {
				$total += $offer['price'] * $offer['persons'];
			}

		return $total;
	}

	public function getAgencyOffers($agencyId)
	{
		$offers = Offer::where('agency_id', $agencyId)
			->join('offer_translations', 'offers.id', 'offer_translations.offer_id')
			->join('activities', 'activities.id', 'offers.activity_id')
			->join('activity_translations', 'activities.id', 'activity_translations.activity_id')
			->where('activity_translations.locale', app()->getLocale())
			->where('offer_translations.locale', app()->getLocale())
			->where('activities.visibility', true)
			->select(
				'activities.id as activity_id',
				'activities.image_icon as activity_icon',
				'activity_translations.name as activity_name',
				'offer_translations.includes as offer_includes',
				'offers.id',
				'offers.available_start',
				'offers.available_end',
				'offers.available_time',
				'offers.availability',
//				'offers.start_time',
//				'offers.end_time',
				'offers.price_offer',
				'offers.price'
			)
			->get();

		$offers = $this->checkOffersAvailability($offers);

		foreach ($offers as $offer) {
//			$offer['offer_includes'] = $this->getIncludes($offer['offer_includes']);
//			$offer['available_time'] = $this->getTime($offer['available_time']);
//			$offer['hours'] = $this->getDuration($offer['available_time']);
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
//				'offers.start_time',
				'offers.available_time',
//				'offers.end_time',
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
//		$offer['offerIncludes'] = $this->getIncludes($offer['offerIncludes']);
		$offer['offerCarry'] = $offer['offerActivity']['carry'];
//		$offer['available_time'] = $this->getTime($offer['available_time']);
//		$offer['hours'] = $this->getDuration($offer['available_time']);

		return $offer;
	}
}
