<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
	protected $table = 'special_offers';

	public function offer() {
		return $this->hasOne(Offer::class, 'id', 'offer_id');
	}
}
