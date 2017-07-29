<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

class GooglePlusController extends Controller
{
	public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}
	
	public function handleProviderCallback()
	{
		try {
			$user = Socialite::driver('google')->user();
		} catch (Exception $exception) {
			return redirect()->route('auth.google');
		}
		
		$auth_user = $this->findOrCreateUser($user);
		
		Auth::login($auth_user, true);
		
		return redirect()->route('home');
	}
	
	public function findOrCreateUser($googleUser)
	{
		
		dd($googleUser);
		if ($auth_user = User::where('gplus_id', '=', $googleUser->id)->first()) {
			return $auth_user;
		} elseif ($auth_user = User::where('email', '=', $googleUser->email)->first()) {
			
			$auth_user->facebook_id = $googleUser->id;
			$auth_user->save();
			
			return $auth_user;
		}
		
		$name = explode(' ', $googleUser->name);
		
		return User::create([
			'username'          => '',
			'first_name'        => isset($name[0]) ? $name[0] : ' ',
			'last_name'         => isset($name[1]) ? $name[1] : ' ',
			'gender'            => $googleUser['gender'] === 'male' ? 'm' : 'w',
			'email'             => $googleUser->email,
			'avatar'            => $googleUser->avatar,
			'confirmation_code' => ' ',
			'confirmed'         => 1,
			'password'          => ' ',
			'gplus_id'       => $googleUser->id
		]);
	}
}
