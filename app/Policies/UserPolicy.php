<?php

namespace App\Policies;

//use Auth;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	public function display(User $user, User $item)
	{
		if (Auth::check() && Auth::user()->can('users-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('users-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, User $item)
	{
		if (Auth::check() && Auth::user()->can('users-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, User $item)
	{
		if (Auth::check() && Auth::user()->can('users-control')) {
			return true;
		}
		return false;
	}
}
