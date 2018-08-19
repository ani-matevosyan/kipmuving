<?php

namespace App\Http\Controllers\AdminAgency;
use App\AdminAgencyModels\Hour;
use App\AdminAgencyModels\Provider;
use App\Helpers\DatabaseConnection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\AdminAgencyModels\Activity;
use Illuminate\Support\Facades\Validator;

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
        $providers = Provider::all();

        $data = [
            'styles'         => config('resources.admin-agency.activities.styles'),
            'scripts'        => config('resources.admin-agency.activities.scripts'),
            'activities'     => $activities,
            'providers'      => $providers,
        ];
        return view('site.adminAgency.activities', $data);
    }


    protected function addActivity(Request $request)
    {
        if($request->isMethod('post')) {
            parse_str($request->formData, $formData);
            $messages = ['name.required' => ':attribute -@ anhrajest E, :) '];
            $validator = Validator::make($formData, [
                'name' => 'required|max:30',
                'price' => 'required|numeric',
                'min_persons' => 'required|numeric'
            ]);

            if(!$validator->fails()){
                $activity = new Activity;
                $activity->name = $formData['name'];
                $activity->price = $formData['price'];
                $activity->min_persons = $formData['min_persons'];
                $activity->save();

                $hoursArr = [];
                foreach ($formData['start_time'] as $key=>$item){
                    foreach ($formData['end_time'] as $k=>$i){
                        if($key == $k){
                            if($item != '' || $i != ''){
                                $hoursArr[] = new Hour([
                                    'start_time' => $item,
                                    'end_time'  => $i,
                                ]);
                            }
                        }
                    }
                }
                $activity->hours()->saveMany($hoursArr);
                if(isset($formData['providers'])){
                    $activity->providers()->attach($formData['providers']);
                }
                echo json_encode(['success' => true]);
            }else{
                $errorMessages = $validator->errors();
                echo json_encode(['errorMessages' => $errorMessages]);
            }
            exit;
        }
    }




}
