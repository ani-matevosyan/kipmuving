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
        $providers = Provider::with(['providerType', 'activities'])->get();
        $providerTypes = ProviderType::all();
        $activities = Activity::all();
        $data = [
            'styles'         => config('resources.admin-agency.providers.styles'),
            'scripts'        => config('resources.admin-agency.providers.scripts'),
            'providers'      => $providers,
            'providerTypes'  => $providerTypes,
            'activities'     => $activities,
        ];
        return view('site.adminAgency.providers', $data);
    }

    protected function addProvider(Request $request){
        if($request->isMethod('post')) {
            parse_str($request->formData, $formData);
            $validator = Validator::make($formData, [
                'name' => 'required|max:255',
                'country' => 'max:255',
                'identity' => 'max:255',
                'address' => 'max:255',
                'email' => 'email|max:255|unique:admin_agency.providers',
                'phone' => 'max:255',
                'type' => 'numeric',
                'phone' => 'max:255',
                'comment' => 'max:1255',
                'activities.0' => 'required|numeric',
                'prices.0' => 'required|numeric',
                'prices.*' => 'numeric',
                'prices.*' => 'numeric',
            ]);
            if(!$validator->fails()){
                $provider = new Provider;
                $provider->name = $formData['name'];
                $provider->country = $formData['country'];
                $provider->identity = $formData['identity'];
                $provider->address = $formData['address'];
                $provider->email = $formData['email'];
                $provider->phone = $formData['phone'];
                $provider->type = $formData['type'];
                $provider->comment = $formData['comment'];
                $nameArr =  explode(" ",$formData['name']);
                $provider->first_name = $nameArr[0];
                $provider->last_name = isset($nameArr[1]) ? $nameArr[1]: '';
                $provider->save();

                $activities = $formData['activities'];
                $prices = $formData['prices'];

                $arrForAttach = array();
                foreach ($activities as $key =>$value){
                    foreach ($prices as $k=>$v){
                        if ($key==$k){
                            $arrForAttach[$value] = array('price'=>$v);
                        }
                    }
                }
                if(isset($activities)){
                    $provider->activities()->attach($arrForAttach);
                }
                echo json_encode(['success' => true]);
            }else{
                $errorMessages = $validator->errors();
                echo json_encode(['errorMessages' => $errorMessages]);
            }
            exit;
        }
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
