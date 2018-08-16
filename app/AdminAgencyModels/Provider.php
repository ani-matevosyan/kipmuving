<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $connection = 'admin_agency';
    protected $table = 'providers';


    public function activities()
    {
        return $this->belongsToMany('App\AdminAgencyModels\Activity', 'activity_provider', 'provider_id');
    }

}
