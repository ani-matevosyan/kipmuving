<?php

namespace App\Policies;

use App\HomeMail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailPolicy
{
	use HandlesAuthorization;

	public function display(User $user, HomeMail $homeMail)
	{
		if (Auth::check() && Auth::user()->can('mails-control')) {
			return true;
		}
		return false;
	}

	public function create(User $user)
	{
		if (Auth::check() && Auth::user()->can('mails-control')) {
			return true;
		}
		return false;
	}

	public function edit(User $user, HomeMail $homeMail)
	{
		if (Auth::check() && Auth::user()->can('mails-control')) {
			return true;
		}
		return false;
	}

	public function delete(User $user, HomeMail $homeMail)
	{
		if (Auth::check() && Auth::user()->can('mails-control')) {
			return true;
		}
		return false;
	}
}
