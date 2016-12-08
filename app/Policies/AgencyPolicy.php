<?php

namespace App\Policies;

use App\Agency;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
{
	use HandlesAuthorization;

	public function display(User $user, Agency $agency)
	{
		if (Auth::check() && Auth::user()->can('agencies-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('agencies-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, Agency $agency)
	{
		if (Auth::check() && Auth::user()->can('agencies-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, Agency $agency)
	{
		if (Auth::check() && Auth::user()->can('agencies-control')) {
			return true;
		}
		return false;
	}
}
