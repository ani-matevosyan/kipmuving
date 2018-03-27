<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Offer;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|confirmed|min:6',
      'phone' => 'required|min:9|max:18',
//			'day' => 'required|digits_between:1,2',
//			'month' => 'required|digits_between:1,2',
//			'year' => 'required|digits:4'
    ]);
  }

  public function showRegistrationForm(Offer $offer)
  {

    $s_offers = \session('basket.special');

    $data = [
      'styles' => config('resources.register.styles'),
      'scripts' => config('resources.register.scripts'),
      'count'             => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			]
    ];

    return view('auth.register', $data);
  }

  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

//		$this->guard()->login($user);

    return $this->registered($request, $user)
      ?: redirect($this->redirectPath());
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array $data
   * @return User
   */
  protected function create(array $data)
  {
//		$day = ($data['day'] < 10) ? '0'.$data['day'] : $data['day'];
//		$month = ($data['day'] < 10) ? '0'.$data['day'] : $data['day'];

    $confirmation_code = str_random(30);
    $user = User::create([
      'username' => '',
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'phone' => $data['phone'],
//			'birthday' => Carbon::parse($data['year'].'-'.$month.'-'.$day)->toDateString(),
      'confirmation_code' => $confirmation_code,
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
    ]);
    return $user;
  }

  protected function registered(Request $request, $user)
  {
    $user['_token'] = $request['_token'];
    Mail::send('emails.auth.confirm', ['user' => $user], function ($message) use ($user) {
      $message->from('contacto@aventuraschile.com', 'Kipmuving team');
      $message->to($user['email'], $user['name'])->subject('Confirm your email');
    });
    return Redirect::to('/login')->with('info', 'On your email was send email to confirm your account.');
  }
}
