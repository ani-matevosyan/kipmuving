<?php

namespace App\Policies;

use App\User;
use App\GuidePoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuidePointsPolicy
{
    use HandlesAuthorization;

	public function display(User $user, GuidePoint $guidePoint)
	{
		if (Auth::check() && Auth::user()->can('guide-points-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('guide-points-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, GuidePoint $guidePoint)
	{
		if (Auth::check() && Auth::user()->can('guide-points-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, GuidePoint $guidePoint)
	{
		if (Auth::check() && Auth::user()->can('guide-points-control')) {
			return true;
		}
		return false;
	}
}
