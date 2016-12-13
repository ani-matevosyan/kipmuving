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
		$time = 60; //Minutes to update currency
		$currency = $this->currency->where('code', 'USDCLP')->first();
		
		if (session('currency')) {
			if (Carbon::parse(session('currency.updated_at'))->addMinutes($time) < Carbon::now()) {
				#If data in DB need to update currency
				if (Carbon::now()->subMinutes($time) > Carbon::parse($currency['updated_at'])) {
					#Get currency
					#TODO change link
					$url = 'http://apilayer.net/api/live?access_key=390417d6045e37cadb7b22ad884ca4df&currencies=CLP&format=1';
					$json = json_decode(file_get_contents($url), true);
					
					#Update currency in DB
					$currency->value = $json['quotes']['USDCLP'];
					$currency->updated_at = Carbon::now()->toDateTimeString();
					$currency->save();
					
					#Collect updated data
					$data = [
						'value'      => $json['quotes']['USDCLP'],
						'updated_at' => Carbon::now()->toDateTimeString()
					];
				} else {
					#Collect old currency value and update time
					$data = [
						'value'      => $currency['value'],
						'updated_at' => Carbon::now()->toDateTimeString()
					];
				}
				session()->put('currency', $data);
			}
		} else {
			$data = [
				'value'      => $currency['value'],
				'updated_at' => Carbon::now()->toDateTimeString()
			];
			session()->put('currency', $data);
		}
		
		return $next($request);
	}
}
