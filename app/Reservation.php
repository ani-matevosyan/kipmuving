<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $table = 'reservations';
	
	public function getUserAttribute()
	{
		$user = User::find($this['user_id'])
			->first();
		
		return $user['first_name'].' '.$user['last_name'];
	}
	
	public function getActivityAttribute()
	{
		$offer = Offer::find($this['offer_id']);
		$activity = Activity::find($offer['activity_id']);
		
		return $activity['name'];
	}
	
	public function getAgencyAttribute()
	{
		$offer = Offer::find($this['offer_id']);
		$agency = Agency::find($offer['agency_id']);
		
		return $agency['name'];
	}
	
	public function getSumAttribute()
	{
		$offer = Offer::find($this['offer_id']);
		
		return $offer['real_price_offer'] * $this['persons'];
	}
	
	public function getPriceAttribute()
	{
		$offer = Offer::find($this['offer_id']);
		
		return $offer['real_price_offer'];
	}
}
