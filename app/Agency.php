<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
	use Translatable;
	public $translationModel = 'App\AgencyTranslation';
	public $translatedAttributes = ['name', 'description'];
	protected $table = 'agencies';

	public function getAgencies()
	{
		$agencies = AgencyTranslation::join('agencies', 'agency_translations.agency_id', 'agencies.id')
			->where('agency_translations.locale', app()->getLocale())
			->select(
				'agencies.id',
				'agencies.image',
				'agency_translations.name',
				'agency_translations.description'
			)
			->get();

		return $agencies;
	}

	public function getAgency($id)
	{
		$agency = Agency::where('id', $id)->first();

		return $agency;
	}
}
