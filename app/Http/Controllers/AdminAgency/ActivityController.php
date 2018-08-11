<?php

namespace App\Http\Controllers\AdminAgency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display activities (/)
     *
     * @return View
     */
    public function index()
    {

        $data = [
            'styles'         => config('resources.admin-agency.activities.styles'),
            'scripts'        => config('resources.admin-agency.activities.scripts'),
        ];
        return view('site.adminAgency.activities', $data);
    }
}
