<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Closure;

class setDate
{
	public function handle($request, Closure $next)
	{
		$tomorrow = Carbon::tomorrow()->toDateString();
		if (!Session::get('selectedDate'))
			Session::set('selectedDate', $tomorrow);
		return $next($request);
	}
}
