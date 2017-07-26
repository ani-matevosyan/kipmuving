<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityComment extends Model
{
	protected $table = 'activity_comments';
	
	public function user() {
		return $this->hasOne(User::class, 'id', 'user_id');
	}
}
