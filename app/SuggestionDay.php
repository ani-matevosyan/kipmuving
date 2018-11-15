<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Suggestion;

class SuggestionDay extends Model
{
	use Translatable;

	public $translationModel = 'App\SuggestionDayTranslation';
	public $translatedAttributes = [
		'name',
		'description',
	];

	protected $table = 'suggestion_days';

	public function scopeWithSuggestion($query, $suggestionId)
	{
		return $query->where('suggestion_id', '=', $suggestionId);
	}

	public function activities() {
		return $this->hasMany(SuggestionDayActivity::class, 'suggestion_day_id', 'id');
	}

    public function suggestion() {
        return $this->belongsTo(Suggestion::class, 'suggestion_id', 'id');
    }
}
