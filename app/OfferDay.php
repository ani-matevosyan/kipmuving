<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offer;

class OfferDay extends Model
{

    protected $table = 'offer_days';

    public function scopeWithOffer($query, $offerId)
    {
        return $query->where('offer_id', '=', $offerId);
    }


    public function offer() {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
}
