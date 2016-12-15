<?php

namespace App\Policies;

use App\Reservation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReservationPolicy
{
	use HandlesAuthorization;
	
	
	public function display(User $user, Reservation $reservation)
	{
		if (Auth::check() && Auth::user()->can('reservations-control')) {
			return true;
		}
		return false;
	}
	
	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('reservations-control')) {
			return true;
		}
		return false;
	}
	
	public function edit(User $user, Reservation $reservation)
	{
		if (Auth::check() && Auth::user()->can('reservations-control')) {
			return true;
		}
		return false;
	}
	
	public function delete(User $user, Reservation $reservation)
	{
		if (Auth::check() && Auth::user()->can('reservations-control')) {
			return true;
		}
		return false;
	}
}
