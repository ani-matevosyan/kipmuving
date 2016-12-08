<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
		\App\Role::class => \App\Policies\RolePolicy::class,
		\App\User::class => \App\Policies\UserPolicy::class,
		\App\Permission::class => \App\Policies\PermissionPolicy::class,
		\App\Activity::class => \App\Policies\ActivityPolicy::class,
		\App\Agency::class => \App\Policies\AgencyPolicy::class,
		\App\Offer::class => \App\Policies\OfferPolicy::class,
		\App\HomeMail::class => \App\Policies\MailPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		//
	}
}
