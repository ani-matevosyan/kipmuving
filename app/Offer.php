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
}
