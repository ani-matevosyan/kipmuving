<?php

namespace App\Http\Controllers;

use App\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
	public function setCurrency($code)
	{
		$validation = Validator::make(['code' => $code], ['code' => 'alpha|size:3']);
		if ($validation->fails())
			abort(404);
		
		$currencies = Currency::select('code', 'value', 'updated_at')
			->get();
		$data = [];
		if (in_array($code, ['USD', 'CLP', 'BRL'])) {
			
			foreach ($currencies as $currency) {
				$values[$currency['code']] = $currency['value'];
			}
			
			$data = [
				'type'  => $code,
				'value' => $values,
				'updated_at' => Carbon::now()->toDateTimeString()
			];
		} else
			abort(404);
		
		session()->put('currency', $data);
		
		return back();
	}
}
