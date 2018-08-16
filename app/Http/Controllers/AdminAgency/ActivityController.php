<?php

namespace App\Http\Controllers\AdminAgency;
use App\Helpers\DatabaseConnection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\AdminAgencyModels\Activity;

class ActivityController extends Controller
{
    /**
     * Display activities (/)
     *
     * @return View
     */
    public function index()
    {
        $params = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'admin_agency',
            'username' => 'root',
            'password' => '123456'
        ];
        DatabaseConnection::setConnection($params);
        $activities = Activity::with(['hours','providers'])->get();

        $data = [
            'styles'         => config('resources.admin-agency.activities.styles'),
            'scripts'        => config('resources.admin-agency.activities.scripts'),
            'activities'     => $activities,
        ];
        return view('site.adminAgency.activities', $data);
    }
}
