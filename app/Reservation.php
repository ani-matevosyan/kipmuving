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
		return $this->price * $this->attributes['persons'];
	}
	
	public function getNameAttribute()
	{
		return $this->user->first_name.' '.$this->user->last_name;
	}

    public function getPriceAttribute()
    {
        $price = $this->attributes['price'];
        if (session('currency.type') == 'USD')
            $price = round($price / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
        elseif (session('currency.type') == 'BRL')
            $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
        elseif (session('currency.type') == 'ILS')
            $price = round($price / session('currency.values.USDCLP') * session('currency.values.USDILS'), 2, PHP_ROUND_HALF_EVEN);

        return round($price, 2);
    }
}
