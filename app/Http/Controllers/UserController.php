<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

	public function getUser($id, User $user)
	{
		$currentUser = $user->getUser($id);
		if (!$currentUser)
			abort(404);

		$data = [
			'user' => $currentUser
		];

		return view('site.user.index', $data);
	}

	public function updateUser($id, Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255',
			'phone' => 'required|min:9|max:18',
			'day' => 'required|digits_between:1,2',
			'month' => 'required|digits_between:1,2',
			'year' => 'required|digits:4',
			'gender' => 'required|size:1',
			'image' => 'image',
		]);

		$day = ($request['day'] < 10) ? '0'.$request['day'] : $request['day'];
		$month = ($request['day'] < 10) ? '0'.$request['day'] : $request['day'];

		$user = User::find($id);
		$user->first_name = $request['first_name'];
		$user->last_name = $request['last_name'];
		$user->email = $request['email'];
		$user->phone = $request['phone'];
		$user->birthday = Carbon::parse($request['year'].'-'.$month.'-'.$day)->toDateString();
		$user->gender = $request['gender'];

		if (Input::hasFile('image')){
			$image = Input::file('image');
			$destination_path = public_path('uploads/users/');
			$file_path = 'uploads/users/'.str_random(5).time().str_random(5).'.'.$image->getClientOriginalExtension();
			$image->move($destination_path, $file_path);
			$user->avatar = $file_path;
		}

		$user->save();

		return Redirect::to(action('UserController@getUser', $id))->with('success', 'Your data is updated');
	}
}
