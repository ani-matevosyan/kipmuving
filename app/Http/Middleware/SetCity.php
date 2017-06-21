<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Closure;

class setCity
{
	public function handle($request, Closure $next)
	{
		if (!session('cities')) {
			$cities = [
				'current' => 'pucon',
				'list' => ['pucon', 'atacama'],
				'entrance' => true
			];
			session()->put('cities', $cities);
		}
		
		return $next($request);
	}
}
