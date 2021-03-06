<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
	protected $widgets = [
		\App\Widgets\LanguageSelect::class
	];

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer('site.layouts.default-new', 'App\Http\Composers\MainComposer');
		$widgetsRegistry = $this->app[\SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface::class];

		foreach ($this->widgets as $widget) {
			$widgetsRegistry->registerWidget($widget);
		}
//        DB::listen(function ($query){
//            dump($query->sql);
//            dump($query->bindings);
//        });
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
