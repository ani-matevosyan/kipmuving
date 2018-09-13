<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12-09-2018
 * Time: 10:06
 */

namespace App\Classes;


class Tripadvisor
{

    private $config = [
        'root'       => 'data',
        'cache_time' => (60*24),
        'key'        => 'df87a091ea2941e6a7f6c850c574659d',
        'v'          => '2.0',
        'url'        => 'http://api.tripadvisor.com/api/partner/',
        'comment'    => true
    ];

    public  $cache = '';

    public function getCurl($url){

            $ch = curl_init ();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = (curl_exec($ch));
            curl_close($ch);
           $cache = json_decode($data,true);

        return $this->cache = $cache;

    }

    /*
        query some keywords
          q			 => some string text about of searc
          distance	 => 0.1

    */

    public function getQuery($template,$value,$query='',$type=''){
        if ($query!='') $query = '&'.http_build_query($query);
        $this->config['type']     = ($type=='')?'':$type;
        $this->config['template'] = $template;
        $this->config['value']    = $value;
        if ($template=='location_mapper' and $this->config['type']=='') $this->config['type']='hotels';
        foreach($this->config as $key => $val){
            $arrKeys[] = '{'.$key.'}';
            $arrVals[] = $val;
        }

        $pattern=[
            'location_mapper' => '{url}{v}/{template}/{value}?key={key}-mapper&category={type}'.$query,
            'default'         => '{url}{v}/{template}/{value}/{type}?key={key}'.$query];

        $this->getCurl(str_replace($arrKeys,$arrVals,((isset($pattern[$template]))?$pattern[$template]:$pattern['default'])));

            return $this->cache;

    }



    public function getHotels($values,$q) {
        $data = $this->getQuery('location_mapper',$values,['q'=>$q,'lang'=>'en']);
        if (!isset($data[0]['location_id'])) return false;
        $this->config['comment'] = false;
        return $this->getQuery('location',$data[0]['location_id'],['lang'=>'en']);

    }

}