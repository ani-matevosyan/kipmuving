<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use App\Http\Traits\NewUpload;
use KodiComponents\Support\Upload;

class Activity extends Model
{
//	use Upload;
//	use NewUpload;
//	use Translatable;
	use Upload, Translatable {
		Translatable::getAttribute insteadof Upload;
		Upload::getAttribute as getUploadAttribute;
		Translatable::setAttribute insteadof Upload;
		Upload::setAttribute as setUploadAttribute;
//		Translatable::setAttribute insteadof Upload;
//		Upload::getAttribute as test;
//		Upload::setAttribute as testt;
	}
//	dd();

	public $translationModel = 'App\ActivityTranslation';
	public $translatedAttributes = ['name', 'subtitle', 'description', 'short_description'];

	protected $table = 'activities';

	protected $casts = [
		'image' => 'image',
		'image_thumb' => 'image',
		'image_icon' => 'image'
	];
}
