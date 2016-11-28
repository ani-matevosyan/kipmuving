<?php

namespace App\Policies;

use App\User;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

	public function display(User $user, Activity $activity)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, Activity $activity)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, Activity $activity)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}
}
