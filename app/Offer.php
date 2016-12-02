<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	use Translatable;
	public $translationModel = 'App\OfferTranslation';
	public $translatedAttributes = [
		'includes',
		'cancellation_rules',
		'restrictions',
		'important',
		'carry',
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
	private function includesToArray($includes){
		return explode('; ',$includes);
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

	public function getRecommendOffers($activityId)
	{
		$offers = Offer::join('agencies', 'offers.agency_id', 'agencies.id')
			->where('offers.activity_id', $activityId)
			->where('offers.availability', true)
			->orderBy('agencies.recommendation', 'DESC')
			->select('offers.*')
			->get();

		foreach ($offers as $offer) {
			$offer['hours'] = $offer['end_time'] - $offer['start_time'];
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
			$offer['includes'] = $this->includesToArray($offer['includes']);
		}
		return $offers;
	}

	public function getPriceOffers($activityId)
	{
		$offers = Offer::where('activity_id', $activityId)
			->where('availability', true)
			->orderBy('price_offer', 'ASC')
			->get();

		foreach ($offers as $offer) {
			$offer['hours'] = $offer['end_time'] - $offer['start_time'];
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
		}

		return $offers;
	}

	public function getIncludesOffers($activityId)
	{
		$offers = Offer::where('activity_id', $activityId)
			->where('availability', true)
			->orderBy('includes_count', 'DESC')
			->get();

		foreach ($offers as $offer) {
			$offer['hours'] = $offer['end_time'] - $offer['start_time'];
			$offer['offerAgency'] = $this->getAgency($offer['agency_id']);
		}

		return $offers;
	}
}
