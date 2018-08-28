<?php

namespace App\Http\Controllers\AdminAgency;

use App\AdminAgencyModels\ProviderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminAgencyModels\Provider;
use Illuminate\Support\Facades\Validator;

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
        $providerTypes = ProviderType::all();
        $data = [
            'styles'         => config('resources.admin-agency.providers.styles'),
            'scripts'        => config('resources.admin-agency.providers.scripts'),
            'providers'      => $providers,
            'providerTypes'      => $providerTypes,
        ];
        return view('site.adminAgency.providers', $data);
    }


    protected function addProviderType(Request $request){
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'provider_type' => 'required|max:30',
            ]);
            if(!$validator->fails()){
                $providerType = new ProviderType;
                $providerType->name = $request->provider_type;
                $providerType->save();
                echo json_encode(['success' => true]);
            }else{
                $errorMessages = $validator->errors();
                echo json_encode(['errorMessages' => $errorMessages]);
            }
            exit;
        }
    }
}
