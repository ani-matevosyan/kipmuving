<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
	public function confirmUser($confirmation_code)
	{
		$validation = Validator::make(['code' => $confirmation_code], ['code' => 'alpha_num|size:30']);
		if ((!$confirmation_code) || $validation->fails())
			abort(404);

		$user = User::where('confirmation_code', $confirmation_code)->first();
		if (!$user)
			abort(404);

		$user->confirmed = true;
		$user->confirmation_code = '';
		$user->save();

		return Redirect::to('/login')->with('success', 'user activated');
	}

	public function getConfirmEmail()
	{
		return view('auth.confirmation');
	}

	public function sendConfirmEmail(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|max:128',
		]);

		$user = User::where('email', $request['email'])
			->first();

		if (!$user)
			abort(404);

		if ($user['confirmed'])
			return Redirect::to('/login')->with('info', 'user is already activated');

		$user->confirmation_code = str_random(30);
		$user->save();

		Mail::send('emails.auth.confirm', ['user' => $user], function ($message) use ($user) {
			$message->to($user['email'], $user['first_name'])
				->subject('Verify your email address');
		});
		return Redirect::to('/login')->with('info', 'On your email was send email message');
	}
}
