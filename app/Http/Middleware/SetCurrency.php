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
		$currencies = $this->currency->orderBy('updated_at', 'DESC')->get();
		if (session('currency')) {
			if (Carbon::parse(session('currency.updated_at'))->addMinutes($time) < Carbon::now()) {
				#If data in DB need to update currency
				if (Carbon::now()->subMinutes($time) > Carbon::parse($currencies[0]['updated_at'])) {
					#Get currency
					#TODO change link
					$url = 'http://apilayer.net/api/live?access_key=390417d6045e37cadb7b22ad884ca4df&currencies=CLP,BRL,ILS&format=1';
					$json = json_decode(file_get_contents($url), true);
					#Update currencies in DB
					foreach ($currencies as $currency) {
						$currency->value = $json['quotes'][$currency['code']];
						$currency->updated_at = Carbon::now()->toDateTimeString();
						$currency->save();
						
						#Collect currencies
						$values[$currency['code']] = $json['quotes'][$currency['code']];
					}
					
					#Collect updated data
					$data = [
						'type'       => session('currency.type'),
						'values'     => $values,
						'updated_at' => Carbon::now()->toDateTimeString()
					];
				} else {
					#Collect old currency value and update time
					foreach ($currencies as $currency) {
						$values[$currency['code']] = $currency['value'];
					}
					$data = [
						'type'       => session('currency.type'),
						'values'     => $values,
						'updated_at' => Carbon::now()->toDateTimeString()
					];
				}
				session()->put('currency', $data);
			}
		} else {
			#Default currency
			$location = \SypexGeo::get(request()->ip());
			if ($location['country']['iso'] == 'ES' || $location['country']['iso'] == 'CL')
				$currencyType = 'CLP';
			elseif ($location['country']['iso'] == 'PT' || $location['country']['iso'] == 'BR')
				$currencyType = 'BRL';
			else
				$currencyType = 'USD';
			
			foreach ($currencies as $currency) {
				$values[$currency['code']] = $currency['value'];
			}
			
			$data = [
				'type'       => $currencyType,
				'values'      => $values,
				'updated_at' => Carbon::now()->toDateTimeString()
			];
			session()->put('currency', $data);
		}
		
		if (!session()->has('currencies')) {
			$data = ['USD', 'CLP', 'BRL', 'ILS'];
			session()->put('currencies', $data);
		}
		
		return $next($request);
	}
}
