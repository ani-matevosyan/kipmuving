<?php

namespace App\Http\Controllers\AdminAgency;
use App\AdminAgencyModels\Hour;
use App\AdminAgencyModels\Provider;
use App\AdminAgencyModels\ProviderType;
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
//        DatabaseConnection::setConnection($params);
        $activities = Activity::with(['hours','providers'])->get();
        $providers = Provider::all();
        $providerTypes = ProviderType::all();

        $data = [
            'styles'         => config('resources.admin-agency.activities.styles'),
            'scripts'        => config('resources.admin-agency.activities.scripts'),
            'activities'     => $activities,
            'providers'      => $providers,
            'providerTypes'      => $providerTypes,
        ];
        return view('site.adminAgency.activities.activities', $data);
    }


    protected function addActivity(Request $request)
    {
        if($request->isMethod('post')) {
            parse_str($request->formData, $formData);
            $validator = Validator::make($formData, [
                'name' => 'required|max:30',
                'price' => 'required|numeric',
                'min_persons' => 'required|numeric',
                'start_time.0' => 'required|date_format:H:i',
                'end_time.0' => 'required|date_format:H:i',
                'start_time.*' => 'date_format:H:i',
                'end_time.*' => 'date_format:H:i',
            ]);
            if(!$validator->fails()){
                $activity = new Activity;
                $activity->name = ucwords(strtolower($formData['name']));
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

    protected function getActivity(Request $request)
    {
        if($request->isMethod('post')) {
            $activityId = $request->activity_id;
            $activity = Activity::with(['hours','providers'])->find($activityId);
            $providers = Provider::all();
            $data = [
                'activity'      => $activity,
                'providers'      => $providers,
            ];
            echo view('site.adminAgency.activities.editModal', $data);
        }
    }


    protected function editActivity(Request $request)
    {
        if($request->isMethod('post')) {
            $activity_id = $request->activity_id;
            parse_str($request->formData, $formData);
            $validator = Validator::make($formData, [
                'name' => 'required|max:30',
                'price' => 'required|numeric',
                'min_persons' => 'required|numeric',
                'start_time.0' => 'required|date_format:H:i',
                'end_time.0' => 'required|date_format:H:i',
                'start_time.*' => 'date_format:H:i',
                'end_time.*' => 'date_format:H:i',
            ]);
            if(!$validator->fails()){
                $activity = Activity::find($activity_id);
                $activity->name = ucwords(strtolower($formData['name']));
                $activity->price = $formData['price'];
                $activity->min_persons = $formData['min_persons'];
                $activity->save();

                $hoursArr = [];
                $hArr = [];
                foreach ($formData['start_time'] as $key=>$item){
                    foreach ($formData['end_time'] as $k=>$i){
                        if($key == $k){
                            if($item != '' || $i != ''){
                                $hoursArr[] = new Hour([
                                    'start_time' => $item,
                                    'end_time'  => $i,
                                ]);
                                $hArr[] =[
                                    'start_time' => $item,
                                    'end_time'  => $i,
                                ];
                            }
                        }
                    }
                }

                if(count($hoursArr) >= count($activity->hours)){
                    $c = 0;
                    foreach ($activity->hours as $hour){
                        $activity->hours()->where('id', $hour->id)->update($hArr[$c]);
                        $c++;
                    }
                    array_splice($hoursArr,0, count($activity->hours));
                    $activity->hours()->saveMany($hoursArr);
                }else {
                    $countDeleted = count($activity->hours) - count($hoursArr);
                     $c = 0;
                    foreach ($activity->hours->slice(0, -$countDeleted) as $hour){
                        $activity->hours()->where('id', $hour->id)->update($hArr[$c]);
                        $c++;
                    }
                    foreach ($activity->hours->take(-$countDeleted) as $hour){
                        $activity->hours()->where('id', $hour->id)->delete();
                    }
                }

                if(isset($formData['providers'])){
                    $activity->providers()->sync($formData['providers']);
                }
                echo json_encode(['success' => true]);
            }else{
                $errorMessages = $validator->errors();
                echo json_encode(['errorMessages' => $errorMessages]);
            }
            exit;
        }
    }


    protected function deleteActivity(Request $request)
    {
        if($request->isMethod('post')) {
            $activity_id = $request->activity_id;
            $activity = Activity::find($activity_id);
            $activity->delete();
            echo json_encode(['success' => true]);
            exit;
        }
    }





}
