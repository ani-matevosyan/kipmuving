<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use KodiComponents\Support\Upload;

class Activity extends Model
{
	use Upload, Translatable {
		Translatable::getAttribute insteadof Upload;
		Upload::getAttribute as getUploadAttribute;
		Translatable::setAttribute insteadof Upload;
		Upload::setAttribute as setUploadAttribute;
	}

	public $translationModel = 'App\ActivityTranslation';
	public $translatedAttributes = ['name', 'subtitle', 'description', 'short_description'];

	protected $table = 'activities';

	protected $casts = [
		'image' => 'image',
		'image_thumb' => 'image',
		'image_icon' => 'image'
	];

	public function styles()
	{
		return $this->belongsToMany('App\ActivityStyle', 'activity_style', 'activity_id', 'style_id');
	}
}
