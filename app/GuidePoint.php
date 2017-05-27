<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GuidePoint extends Model
{
	use Translatable;
	public $translationModel = 'App\GuidePointTranslation';
	public $translatedAttributes = ['description', 'bus_description'];
	protected $table = 'guide_points';
	protected $fillable = [
		
	];
	public $timestamps = false;
	
//	public function setTripadvisorCodeAttribute($code)
//	{
//		dd($code);
//	}
//	public function getTripadvisorCodeAttribute()
//	{
//		return str_replace('{language}', app()->getLocale(), $this->attributes['tripadvisor_code']);
//	}
//
//	public function getRealTripadvisorCodeAttribute()
//	{
//		return $this->attributes['tripadvisor_code'];
//	}
//
//	public function setRealTripadvisorCodeAttribute($code)
//	{
//		$this->attributes['tripadvisor_code'] = $code;
//	}
}
