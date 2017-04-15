<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GuideActivity extends Model
{
	use Translatable;
	public $translationModel = 'App\GuideActivityTranslation';
	public $translatedAttributes = [
		'name',
		'short_description',
		'description',
		'bus_description'
	];
	protected $table = 'guide_activities';
	public $timestamps = false;
}
