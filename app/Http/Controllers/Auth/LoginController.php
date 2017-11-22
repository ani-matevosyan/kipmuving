<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
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
    $this->middleware('guest', ['except' => 'logout']);
  }

  public function showLoginForm(Offer $offer)
  {

    $s_offers = \session('basket.special');

    $data = [
      'styles' => config('resources.login.styles'),
      'scripts' => config('resources.login.scripts'),
      'count'             => [
				'special_offers' => count($s_offers),
				'offers'         => count(session('basket.offers')) + count(session('basket.free')),
			]
    ];

    if (!session()->has('url.intended')) {
      session(['url.intended' => url()->previous()]);
    }

    return view('auth.login', $data);
  }
}
