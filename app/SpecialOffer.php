<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
	protected $table = 'special_offers';

	public function offer() {
		return $this->hasOne(Offer::class, 'id', 'offer_id');
	}

	public static function getSpecialOffers() {

		$offers = session('basket.special');
		$data = [];

		foreach ($offers as $offer) {
			$data []= [
				'activity' => Activity::find($offer['activity_id']),
				'date' => $offer['date'],
				'persons' => $offer['persons']
			];
		}

		return $data;
	}
}
