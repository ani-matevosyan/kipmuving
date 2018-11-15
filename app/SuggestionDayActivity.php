<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\SuggestionDay;

class SuggestionDayActivity extends Model
{
	protected $table = 'suggestion_day_activity';
	public $timestamps = false;

	public function scopeWithSuggestionDay($query, $suggestionDayId)
	{
		return $query->where('suggestion_day_id', '=', $suggestionDayId);
	}

	public function getActivityAttribute()
	{
		if ($this->attributes['id']) {
			$activity = null;

			if ($this->attributes['activity_type'] === 'free') {
				$activity = FreeActivity::find($this->attributes['activity_id']);
			} elseif ($this->attributes['activity_type'] === 'paid') {
				$activity = Activity::find($this->attributes['activity_id']);
			}

			return $activity;
		}

		return null;
	}

    public function suggestionDay() {
        return $this->belongsTo(SuggestionDay::class, 'suggestion_day_id', 'id');
    }
}
