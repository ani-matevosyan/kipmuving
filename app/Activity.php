<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use KodiComponents\Support\Upload;

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
		'carry',
		'restrictions'
	];

	protected $table = 'activities';

//	protected $casts = [
//		'image' => 'image',
//		'image_thumb' => 'image',
//		'image_icon' => 'image'
//	];

	public function images()
	{
		return $this->hasMany('App\ActivityImage', 'activity_id', 'id');
	}

	public function getImagesAttribute()
	{
		$images = ActivityImage::where('activity_id', 2)->get();
		$imagesUrls = [];
		foreach ($images as $image) {
			$imagesUrls[] = $image['image_url'];
		}
		return $imagesUrls;
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

	public function getHomePageActivities()
	{
		$activities = Activity::limit(8)->get();
		foreach ($activities as $activity) {
			$offer = Offer::where('activity_id', $activity['id'])
				->orderby('price')
				->select('price')
				->first();
			$offer['price'] ? $activity['price'] = $offer['price'] : $activity['price'] = 0.00;
		}

		return $activities;
	}

	public function getActivitiesList()
	{
		$activitiesList = Activity::where('activity_translations.locale', app()->getLocale())
			->join('activity_translations', 'activity_translations.activity_id', 'activities.id')
			->select('activities.id as id' ,'activity_translations.name as name')
			->orderby('activity_translations.name')
			->get();

		return $activitiesList;
	}

	public function getActivity($id)
	{
		$activity = Activity::where('id', $id)->first();

		return $activity;
	}
}
