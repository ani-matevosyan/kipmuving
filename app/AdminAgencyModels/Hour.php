<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $connection = 'admin_agency';
    protected $table = 'activity_hours';


    public function activity(){
        return $this->belongsTo('App\AdminAgencyModels\Activity');
    }
}
