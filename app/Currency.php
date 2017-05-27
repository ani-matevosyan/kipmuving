<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $table = 'currencies';
	
	public function getCodes()
	{
		$codes = Currency::select('code')->get();
		$codes = $codes->toArray();
		$codesArray = [];
		foreach ($codes as $code) {
			$codesArray[] = array_shift($code);
		}
		return $codesArray;
	}
}
