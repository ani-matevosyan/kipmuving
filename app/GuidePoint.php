<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GuidePoint extends Model
{
	use Translatable;
	public $translationModel = 'App\GuidePointTranslation';
	public $translatedAttributes = [
		'description',
	];
	protected $table = 'guide_points';
	public $timestamps = false;
	
	public function getTripadvisorCodeAttribute()
	{
		return str_replace('{language}', app()->getLocale(), $this->attributes['tripadvisor_code']);
	}
}
