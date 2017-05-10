<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Closure;

class setCity
{
	public function handle($request, Closure $next)
	{
		if (!session('city'))
			session(['city' => 'pucon']);
		
		return $next($request);
	}
}
