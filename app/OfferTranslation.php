<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferTranslation extends Model
{
	protected $table = 'offer_translations';
	public $timestamps = false;
	
	private function dataToArray($data)
	{
		if ($data)
			return explode(";\r\n", $data);
		
		return null;
	}
	
	public function getRealIncludesAttribute() {
		return $this->attributes['includes'];
	}
	
	public function setRealIncludesAttribute($includes) {
		$this->attributes['includes'] = $includes;
	}
	
	public function getIncludesAttribute() {
		$result = $this->dataToArray($this->attributes['includes']);
		$result = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
			return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
		}, $result);
		$result[count($result) - 1] = str_replace(';', '', $result[count($result) - 1]);

		return $result;
	}
}
