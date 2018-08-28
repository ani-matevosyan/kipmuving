<?php

namespace App\Http\Controllers\AdminAgency;

use App\AdminAgencyModels\ProviderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminAgencyModels\Provider;
use Illuminate\Support\Facades\Validator;
use App\AdminAgencyModels\Activity;

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
        $activities = Activity::all();
        $data = [
            'styles'         => config('resources.admin-agency.providers.styles'),
            'scripts'        => config('resources.admin-agency.providers.scripts'),
            'providers'      => $providers,
            'providerTypes'      => $providerTypes,
            'activities' => $activities,
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

    protected function deleteProviderType(Request $request){
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'provider_type_id' => 'required|numeric',
            ]);
            if(!$validator->fails()){
                $providerType = ProviderType::withCount('providers')->find($request->provider_type_id);
                if($providerType->providers_count == 0){
                    $providerType->delete();
                    echo json_encode(['success' => true]);
                }else{
//                    $errorMessages = array('You cannot delete provider types that have providers !!');
                    $errorMessages = array('¡No puedes eliminar los tipos de proveedores que tienen proveedores!');
                     echo json_encode(['errorMessages' => $errorMessages]);
                }
            }else{
                $errorMessages = $validator->errors();
                echo json_encode(['errorMessages' => $errorMessages]);
            }
            exit;
        }
    }
}
