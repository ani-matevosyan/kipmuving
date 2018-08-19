<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $connection = 'admin_agency';
    protected $table = 'providers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'type',
        'address',
        'created_at',
        'updated_at'
    ];


    public function activities()
    {
        return $this->belongsToMany('App\AdminAgencyModels\Activity', 'activity_provider', 'provider_id');
    }

}
