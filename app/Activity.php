<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Activity extends Model
{
//	use Upload, Translatable {
//		Translatable::getAttribute insteadof Upload;
//		Upload::getAttribute as getUploadAttribute;
//		Translatable::setAttribute insteadof Upload;
//		Upload::setAttribute as setUploadAttribute;
//	}
	use Translatable;

	public $translationModel = 'App\ActivityTranslation';
	public $translatedAttributes = [
		'name',
		'subtitle',
		'description',
		'short_description',
		'carries',
		'real_carries',
		'restrictions',
		'real_restrictions'
	];

	protected $table = 'activities';

//	protected $casts = [
//		'image' => 'image',
//		'image_thumb' => 'image',
//		'image_icon' => 'image'
//	];


	public function offers()
	{
		return $this->hasMany('App\Offer', 'activity_id', 'id');
	}

	public function comments()
	{
		return $this->hasMany(ActivityComment::class, 'activity_id', 'id');
	}

	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);

		return null;
	}

	public function images()
	{
		return $this->hasMany('App\ActivityImage', 'activity_id', 'id');
	}

	public function getImagesAttribute()
	{
		$images = ActivityImage::where('activity_id', $this['id'])->get();
		$imagesUrls = [];
		foreach ($images as $image) {
			$imagesUrls[] = $image['image_url'];
		}

		return $imagesUrls;
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
//		$agency = Activity::find($this['id']);
//		$agency['tripadvisor_code'] = $code;
//		$agency->save();
		$this->attributes['tripadvisor_code'] = $code;
	}

	public function setImagesAttribute($images)
	{
		$images = array_unique($images);
		ActivityImage::where('activity_id', $this['id'])->delete();
		$activity = Activity::find($this['id']);
		foreach ($images as $image) {
			$activityImage = new ActivityImage();
			$activityImage->image_url = $image;
			$activityImage->activity_id = $this['id'];
			$activityImage->save();
			$activity->images()->save($activityImage);
		}
	}

//	public function getCarriesAttribute() {
//		return $this->attributes['carry'];
//	}

	public function getHomePageActivities()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activities = Activity::limit(8)
			->whereHas('offers', function ($query) {
				$query->where('price', '>', 0);
			})
			->where('activities.visibility', true)
			->where('region', '=', $region)
			->select('activities.*')
			->inRandomOrder()
			->get();

		return $activities;
	}

	public static function getActivitiesList()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activitiesList = Activity::where('visibility', true)
			->translatedIn(app()->getLocale())
			->where('region', '=', $region)
			->select('activities.id')
			->get();

		return $activitiesList->sortBy('name');
	}

	public function getActivity($id)
	{
		$activity = Activity::where('id', $id)
			->whereHas('offers', function ($query) {
				$query->where('price', '>', 0);
			})
			->where('visibility', true)
			->first();

		return $activity;
	}

	public function getAllActivities()
	{
		$region = session('cities.current') ? session('cities.current') : 'pucon';

		$activities = Activity::where('visibility', true)
			->where('region', '=', $region)
			->whereHas('offers', function ($query) {
				$query->where('price', '>', 0);
			})
			->inRandomOrder()
			->get();

		return $activities;
	}


    public function getParamTripadvisor(){
        preg_match( "|-d(\d+)|u", $this->tripadvisor_link, $object);
        if(isset($object[1])){
            return($object[1]);
        }else
            return '';
    }
}
