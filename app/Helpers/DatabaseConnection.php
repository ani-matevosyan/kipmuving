<?php

namespace App\Helpers;
use Config;
use DB;

class DatabaseConnection
{
    public static function setConnection($params)
    {
        config(['database.connections.admin_agency' => [
            'driver' => $params['driver'],
            'host' => $params['host'],
            'database'  => $params['database'],
            'username' => $params['username'],
            'password' => $params['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]]);
    }
}