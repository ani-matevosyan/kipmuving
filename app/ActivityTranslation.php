<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTranslation extends Model
{
	protected $table = 'activity_translations';
	public $timestamps = false;
	
	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);
		
		return null;
	}
	
	public function getCarriesAttribute()
	{
		if ($this->dataToArray($this->attributes['carry'])[0] != '-')
			return $this->dataToArray($this->attributes['carry']);
		
		return null;
	}
	
	public function getRealCarriesAttribute()
	{
		return $this->attributes['carry'];
	}
	
	public function setRealCarriesAttribute($carries)
	{
		$this->attributes['carry'] = $carries;
	}
	
	public function getRestrictionsAttribute()
	{
		if ($this->dataToArray($this->attributes['restrictions'])[0] != '-')
			return $this->dataToArray($this->attributes['restrictions']);
		
		return null;
	}
	
	public function getRealRestrictionsAttribute()
	{
		return $this->attributes['restrictions'];
	}
	
	public function setRealRestrictionsAttribute($restrictions)
	{
		$this->attributes['restrictions'] = $restrictions;
	}
}
