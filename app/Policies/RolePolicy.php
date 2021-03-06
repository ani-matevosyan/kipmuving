<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

	public function display(User $user, Role $role)
	{
		if (Auth::check() && Auth::user()->can('roles-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('roles-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, Role $role)
	{
		if (Auth::check() && Auth::user()->can('roles-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, Role $role)
	{
		if (Auth::check() && Auth::user()->can('roles-control')) {
			return true;
		}
		return false;
	}
}
