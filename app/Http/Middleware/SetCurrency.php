<?php

namespace App\Http\Middleware;

use App\Currency;
use Carbon\Carbon;
use Closure;

class setCurrency
{
	public function __construct(Currency $currency)
	{
		$this->currency = $currency;
	}
	
	public function handle($request, Closure $next)
	{
//		$currency = $this->currency->where('code', 'USDCLP')->first();
//		dd(Carbon::now()->subMinutes(1)->toDateTimeString(), Carbon::now()->subMinutes(1)->toDateTimeString() > Carbon::parse($currency['updated_at'])->toDateTimeString(), Carbon::parse($currency['updated_at'])->toDateTimeString());
//		if (Carbon::now()->subMinutes(1)->toDateTimeString() > Carbon::parse($currency['updated_at'])->toDateTimeString()) {
//			$url = 'http://apilayer.net/api/live?access_key=390417d6045e37cadb7b22ad884ca4df&currencies=CLP&format=1';
//			$json = json_decode(file_get_contents($url), true);
//			$currency->value = $json['quotes']['USDCLP'];
//			$currency->save();
//		} else
//			dd('<');
//
//		dd(Carbon::now()->subMinutes(1)->toDateTimeString(), Carbon::parse($currency['updated_at'])->toDateTimeString());
		
		return $next($request);
	}
}
