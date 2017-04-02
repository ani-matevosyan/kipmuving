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
	
	public function offers() {
		return $this->hasMany('App\Offer');
	}
	
	public function getTripadvisorCodeAttribute()
	{
		return str_replace('{language}', app()->getLocale(), $this->attributes['tripadvisor_code']);
	}
	public function getRealTripadvisorCodeAttribute()
	{
		return $this->attributes['tripadvisor_code'];
	}
	public function setRealTripadvisorCodeAttribute($code)
	{
//		$agency = Agency::find($this['id']);
//		$agency['tripadvisor_code'] = $code;
//		$agency->save();
		$this->attributes['tripadvisor_code'] = $code;
	}

	public function getAgencies()
	{
		$agencies = Agency::get();
		
		foreach ($agencies->sortBy('name') as $agency) {
			echo $agency->name.'<br>';
		}
		
		dd($agencies->sortBy('name'));
		
		$agencies = AgencyTranslation::join('agencies', 'agency_translations.agency_id', 'agencies.id')
			->where('agency_translations.locale', app()->getLocale())
			->select(
				'agencies.id',
				'agencies.image',
				'agency_translations.name',
				'agency_translations.description'
			)
			->orderBy('agency_translations.name')
			->get();

		return $agencies;
	}

	public function getAgency($id)
	{
		$agency = Agency::where('id', $id)->first();
		
//		dd($agency->offers[0]->activity->image_icon);

		return $agency;
	}
}
