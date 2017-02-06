<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Mappoint extends Model
{
	use Translatable;
	public $translationModel = 'App\MappointTranslation';
	public $translatedAttributes = ['description', 'bus_description'];
	protected $table = 'mappoints';
	public $timestamps = false;
	
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
		$this->attributes['tripadvisor_code'] = $code;
	}
}
