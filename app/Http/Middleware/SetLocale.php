<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Locale;
use Closure;

class SetLocale
{
	public function __construct(Locale $locale)
	{
		$this->locale = $locale;
	}

	public function handle($request, Closure $next)
	{
		$currentLocale = Session::get('currentLocale');
		$localeCodes = $this->locale->getCodes();

		if (in_array($currentLocale, $localeCodes))
			$locale = $currentLocale;
		else
			$locale = Config::get('app.locale');

		app()->setLocale($locale);
		Session::put('currentLocale', $locale);

		return $next($request);
	}
}
