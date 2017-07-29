<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

class FacebookController extends Controller
{
	public function redirectToProvider()
	{
		return Socialite::driver('facebook')->redirect();
	}
	
	public function handleProviderCallback()
	{
		try {
			$user = Socialite::driver('facebook')->user();
		} catch (Exception $exception) {
			return redirect()->route('auth.facebook');
		}
		
		$auth_user = $this->findOrCreateUser($user);
		
		Auth::login($auth_user, true);
		
		return redirect()->route('home');
	}
	
	public function findOrCreateUser($facebookUser)
	{
		if ($auth_user = User::where('facebook_id', '=', $facebookUser->id)->first()) {
			return $auth_user;
		} elseif ($auth_user = User::where('email', '=', $facebookUser->email)->first()) {
			
			$auth_user->facebook_id = $facebookUser->id;
			$auth_user->save();
			
			return $auth_user;
		}
		
		$name = explode(' ', $facebookUser->name);
		
		return User::create([
			'username'          => '',
			'first_name'        => isset($name[0]) ? $name[0] : ' ',
			'last_name'         => isset($name[1]) ? $name[1] : ' ',
			'gender'            => $facebookUser['gender'] === 'male' ? 'm' : 'w',
			'email'             => $facebookUser->email,
			'avatar'            => $facebookUser->avatar,
			'confirmation_code' => ' ',
			'confirmed'         => 1,
			'password'          => ' ',
			'facebook_id'       => $facebookUser->id
		]);
	}
}
