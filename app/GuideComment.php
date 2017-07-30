<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideComment extends Model
{
	protected $table = 'guide_comments';
	
	public function user() {
		return $this->hasOne(User::class, 'id', 'user_id');
	}
}
