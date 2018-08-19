<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $connection = 'admin_agency';
    protected $table = 'activity_hours';
    protected $fillable = [
        'start_time',
        'end_time',
        'activity_id',
        'created_at',
        'updated_at'
    ];


    public function activity(){
        return $this->belongsTo('App\AdminAgencyModels\Activity');
    }
}
