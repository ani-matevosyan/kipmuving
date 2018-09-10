<?php

namespace App\Classes;

class GoogleApi{

    public function getInfoToPlaceId($string)
    {
        if(!$response = $this->getApi($string)){
            return false;
        }

        if(isset($response['result']['rating'])){
            return $this->stringFormatter($response['result']['rating']);
        }else {
            return [];
        }
    }

    public function  stringFormatter($sting){

        return  $float = (float) filter_var($sting, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 20 ;
    }

    public static function isOk($string){
        if(!self::getApi($string)){
            return false;
        }

        return true;
    }

    public static function getApi($string){

        $details_url  = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$string&fields=name,rating,review,formatted_phone_number&key=". env('GOOGLE_API_KEY');

        $ch = curl_init();
//        dd($ch);
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ($response['status'] != 'OK') {
            return false;
        }
        return $response;
    }

}
