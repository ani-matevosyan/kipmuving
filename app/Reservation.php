<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $table = 'reservations';
	
	public function user()
	{
		return $this->hasOne('App\User', 'id', 'user_id');
	}
	
	public function offer()
	{
		return $this->hasOne('App\Offer', 'id', 'offer_id');
	}
	
	public function getTimeAttribute()
	{
		if ($this->attributes['time_range']) {
			$time = explode('-', $this->attributes['time_range']);
			
			if (is_array($time))
				return [
					'start' => $time[0],
					'end'   => $time[1]
				];
		}
		
		return null;
	}

	public function getSumAttribute()
	{
		return $this->offer['real_price'] * $this->attributes['persons'];
	}
	
	public function getNameAttribute()
	{
//		dd($this->user);
		return $this->user->first_name.' '.$this->user->last_name;
	}
}
