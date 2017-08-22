<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GooglePlusController extends Controller
{
	public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleProviderCallback()
	{
		try {
			$user = Socialite::driver('google')
				->stateless()
				->user();
		} catch (Exception $exception) {
			return redirect()->to('/login')->with('error', 'Sorry, we can\'t login you with Google+ :(');
		}

		$auth_user = $this->findOrCreateUser($user);

		Auth::login($auth_user, true);

		return redirect()->route('home');
	}

	public function findOrCreateUser($googleUser)
	{
		if ($auth_user = User::where('gplus_id', '=', $googleUser->id)->first()) {
			return $auth_user;
		} elseif ($auth_user = User::where('email', '=', $googleUser->email)->first()) {

			$auth_user->gplus_id = $googleUser->id;
			$auth_user->save();

			return $auth_user;
		}

		return User::create([
			'username'          => '',
			'first_name'        => $googleUser->user['name']['givenName'],
			'last_name'         => $googleUser->user['name']['familyName'],
			'gender'            => isset($googleUser->user['gender']) ? ($googleUser->user['gender'] === 'male' ? 'm' : 'w') : null,
			'email'             => $googleUser->email,
			'avatar'            => $googleUser->avatar,
			'confirmation_code' => ' ',
			'confirmed'         => 1,
			'password'          => ' ',
			'gplus_id'          => $googleUser->id,
		]);
	}
}
