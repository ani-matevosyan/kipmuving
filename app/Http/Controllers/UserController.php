<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Agency;
use App\Offer;
use App\Reservation;
use App\SpecialOffer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

	public function getUser()
	{
		if (!$user = Auth::user())
			return redirect()->to('/login');

		$data = [
			'styles'  => config('resources.user.styles'),
			'scripts' => config('resources.user.scripts'),
			'user'    => $user,
		];

		return view('site.user.index', $data);
	}

	public function getUserReservations()
	{
		if (!$user = Auth::user())
			return redirect()->to('/login');

		$data = [
			'styles'  => config('resources.user.styles'),
			'scripts' => config('resources.user.scripts'),
			'user'    => $user,
		];

		return view('site.user.reservations', $data);
	}

	public function updateUser($id, Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name'  => 'required|max:255',
			'email'      => 'required|email|max:255',
			'phone'      => 'required|min:9|max:18',
			'password'   => 'min:6|confirmed',
		]);


		$user = User::find($id);
		$user->first_name = $request['first_name'];
		$user->last_name = $request['last_name'];
		$user->email = $request['email'];
		$user->phone = $request['phone'];
		$user->password = bcrypt($request['password']);

		$user->save();

		return Redirect::to(action('UserController@getUser', $id))->with('success', 'Your data is updated');
	}

	public function updateUsersAvatar($id, Request $request)
	{
		$this->validate($request, [
			'image' => 'image',
		]);

		$user = User::find($id);

		if (Input::hasFile('image')) {
			if ($user['avatar'])
				File::delete(public_path($user['avatar']));
			$image = Input::file('image');
			$destination_path = public_path('uploads/users/');
			$file_path = asset('uploads/users/' . str_random(5) . time() . str_random(5) . '.' . $image->getClientOriginalExtension());
			$image->move($destination_path, $file_path);
			$user->avatar = $file_path;
		}

		$user->save();
	}

	public function getAvatar()
	{

		if (!$user = Auth::user())
			abort(404);


		$avatarPath = $user['avatar'];

		return $avatarPath;

	}
}
