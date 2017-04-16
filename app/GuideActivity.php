<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GuideActivity extends Model
{
	use Translatable;
	public $translationModel = 'App\GuideActivityTranslation';
	public $translatedAttributes = [
		'name',
		'short_description',
		'description',
		'bus_description'
	];
	protected $table = 'guide_activities';
	public $timestamps = false;
	
	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);
		
		return null;
	}
	
	public function getBusEstTimeAttribute()
	{
		$time = $this->attributes['bus_est_time'];
		
		return $time % 60 == 0 ? $time / 60 : (int)($time / 60).':'.($time % 60 < 10 ? '0'.$time % 60 : $time % 60);
	}
	
	public function getTimeRangesAttribute()
	{
		$time = $this->dataToArray($this->attributes['time_ranges']);
		$time[count($time) - 1] = str_replace(';', '', $time[count($time) - 1]);
		if ($time) {
			$result = [];
			foreach ($time as $key => $item) {
				$item = explode('-', $item);
				$result[$key]['start'] = $item[0];
				$result[$key]['end'] = $item[1];
			}
			
			return $result;
		}
		
		return null;
	}
	
	public function getRealTimeRangesAttribute() {
		return $this->attributes['time_ranges'];
	}
	
	public function setRealTimeRangesAttribute($time) {
		$this->attributes['time_ranges'] = $time;
	}
	
	public function getRealBusEstTimeAttribute() {
		return $this->attributes['bus_est_time'];
	}
	
	public function setRealBusEstTimeAttribute($time) {
		$this->attributes['bus_est_time'] = $time;
	}
	
	public function getTripadvisorCodeAttribute()
	{
		return str_replace('{language}', app()->getLocale(), $this->attributes['tripadvisor_code']);
	}
	
	public function getRealTripadvisorCodeAttribute()
	{
		return $this->attributes['tripadvisor_code'];
	}
	
	public function setRealTripadvisorCodeAttribute($code)
	{
		$this->attributes['tripadvisor_code'] = $code;
	}
}
