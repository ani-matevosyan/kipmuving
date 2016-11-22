<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
}
