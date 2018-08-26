<?php

namespace App\Http\Controllers\AdminAgency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminAgencyModels\Provider;

class ProviderController extends Controller
{
    /**
     * Display providers
     *
     * @return View
     */
    public function index()
    {
        $providers = Provider::with('providerType')->get();
//        foreach ($providers as $provider){
//            echo $provider->providerType->name;
//        }

        $data = [
            'styles'         => config('resources.admin-agency.providers.styles'),
            'scripts'        => config('resources.admin-agency.providers.scripts'),
            'providers'      => $providers,
        ];
        return view('site.adminAgency.providers', $data);
    }
}
