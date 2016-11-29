<?php

namespace App\Policies;

use App\User;
use App\ActivityStyle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityStylePolicy
{
	use HandlesAuthorization;

	public function display(User $user, ActivityStyle $activityStyle)
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

	public function edit(User $user, ActivityStyle $activityStyle)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, ActivityStyle $activityStyle)
	{
		if (Auth::check() && Auth::user()->can('activities-control')) {
			return true;
		}
		return false;
	}
}
