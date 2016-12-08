<?php

namespace App\Policies;

use App\Offer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
	use HandlesAuthorization;

	public function display(User $user, Offer $offer)
	{
		if (Auth::check() && Auth::user()->can('offers-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('offers-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, Offer $offer)
	{
		if (Auth::check() && Auth::user()->can('offers-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, Offer $offer)
	{
		if (Auth::check() && Auth::user()->can('offers-control')) {
			return true;
		}
		return false;
	}
}
