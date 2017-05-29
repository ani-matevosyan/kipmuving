<?php

namespace App\Policies;

use App\User;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
	use HandlesAuthorization;

	public function display(User $user, Permission $permission)
	{
		if (Auth::check() && Auth::user()->can('permissions-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('permissions-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, Permission $permission)
	{
		if (Auth::check() && Auth::user()->can('permissions-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, Permission $permission)
	{
		if (Auth::check() && Auth::user()->can('permissions-control')) {
			return true;
		}
		return false;
	}
}
