<?php

namespace App\AdminAgencyModels;

use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    protected $connection = 'admin_agency';
    protected $table = 'provider_types';

    protected $fillable = [
        'name',
    ];


    public function providers()
    {
        return $this->hasMany('App\AdminAgencyModels\Provider', 'type', 'id');
    }
}
