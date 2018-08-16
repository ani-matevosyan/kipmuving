<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Activity extends Model
{

    protected $connection = 'admin_agency';
    protected $table = 'activities';


    public function hours()
    {
        return $this->hasMany('App\AdminAgencyModels\Hour', 'activity_id', 'id');
    }

    public function providers()
    {
        return $this->belongsToMany('App\AdminAgencyModels\Provider', 'activity_provider', 'activity_id');
    }



}
