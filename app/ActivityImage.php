<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
	protected $table = 'activity_images';
	public $timestamps = false;

	public function activities()
	{
    	return $this->belongsTo(Activity::class);
	}
}
