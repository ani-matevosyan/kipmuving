<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
	use Translatable;

	public $translationModel = 'App\SuggestionTranslation';
	public $translatedAttributes = [
		'name',
		'short_description',
		'description',
	];

	protected $table = 'suggestions';

	public function days()
	{
		return $this->hasMany(SuggestionDay::class, 'suggestion_id', 'id');
	}

	public function getMapPointsAttribute()
	{
		if ($this->attributes['id']) {
			$suggestion = Suggestion::find($this->attributes['id']);
			$map_points = "[";

			$i = 1;
			foreach ($suggestion->days as $day) {
				foreach ($day->activities as $item) {
					$map_points .= '["' . $item->activity->name . '", ' . $item->activity->latitude . ', ' . $item->activity->longitude . ', ' . $i++ . '],';
				}
			}

			$map_points .= ']';

			return $map_points;
		}

		return null;
	}
}
