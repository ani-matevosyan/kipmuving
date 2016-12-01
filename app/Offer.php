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
			$agency = AgencyTranslation::where('agencies.id', $offer['agency_id'])
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
			$offer['offerAgency'] = $agency;
		}

		return $offers;
	}

	public function getPriceOffers()
	{

	}
}
