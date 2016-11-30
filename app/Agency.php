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
}
