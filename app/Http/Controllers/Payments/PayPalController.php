<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PayPalController extends Controller
{
//	public function paymentPaypal(Request $request)
//	{
//		$this->clearGarbageReservations();
//
//		if (!($user = Auth::user()))
//			return redirect('/login');
//
//		if (!($selected_offers = session('basket.offers')))
//			return redirect()->action('ActivityController@index');
//
//		$reservations = $this->getReservationData($selected_offers);
//
//		$gateway = Omnipay::create('PayPal_Express');
//
//		//TEST
////		$gateway->setUsername('contacto-facilitator_api1.kipmuving.com');
////		$gateway->setPassword('2JZSH53Q4JY79H3U');
////		$gateway->setSignature('A9frNSjdg56YUh3IOj8EoShIiMclAq9C.MaTyUJSoP-kp8lV4eYmPPhD');
////		$gateway->setTestMode(true);
//
//		//LIVE
//		$gateway->setUsername('contacto_api1.kipmuving.com');
//		$gateway->setPassword('DGC72LTKNP4T3P69');
//		$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AuhHvXFexATZ1S0YcGK5mBl9vDLM');
//		$gateway->setTestMode(false);
//
//		$gateway->setBrandName(config('app.name'));
//
//		#PayPal (Express)
//		if ($request->token) {
//			$response = $gateway->completePurchase([
//				'token'  => $request->token,
//				'amount' => $reservations->total->to_pay['USD'],
//			])->send();
//		} else {
//			$response = $gateway->purchase([
//				'amount'      => $reservations->total->to_pay['USD'],
//				'no_shipping' => 1,
//
//				//TEST
////				'returnUrl' => 'http://kipmuving.lo/reserve/paypal',
////				'cancelUrl' => 'http://kipmuving.lo/reserve',
//
//				//LIVE
//				'returnUrl'   => 'http://kipmuving.com/reserve/paypal',
//				'cancelUrl'   => 'http://kipmuving.com/reserve',
//
//				'currency'    => 'USD',
//				'description' => 'Kipmuving.com reservation',
//			])->send();
//		}
//
//		if ($response->isSuccessful()) {
//			$this->createReservation($reservations->offers, $user, 'paypal', $request->token, $response->getData()['ACK'], true);
//
//			$this->sendMails($reservations, $user);
//
//			session()->forget('basket.offers');
//
//			return redirect()->action('UserController@getUser');
//
//		} elseif ($response->isRedirect())
//			$response->redirect();
//		else {
//			$message = $response->getMessage();
//
//			return redirect()->action('ReservationController@reserve')->with($message);
//		}
//
//		return null;
//	}
}
