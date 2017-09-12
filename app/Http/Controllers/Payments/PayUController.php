<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayUController extends Controller
{
//	public function paymentPayU()
//	{
//		$this->clearGarbageReservations();
//
//		if ($user = Auth::user()) {
//			//TEST
////			$api_key = '4Vj8eK4rloUd272L48hsrarnUA';
////			$merchant_id = '508029';
////			$account_id = '512326';
//			//LIVE
//			$api_key = '1wOnbtFLyv6N7v8QwWj5LVXNaw';
//			$merchant_id = '630645';
//			$account_id = '632993';
//			$uid = uniqid();
//			$signature = md5($api_key . '~' . $merchant_id . '~' . $uid . '~' . $this->total->to_pay['USD'] . '~' . 'USD');
////			$signature = md5($api_key.'~'.$merchant_id.'~'.$uid.'~3.5~'.'USD');
//
//			$data = [
//				'merchantId'    => $merchant_id,
//				'ApiKey'        => $api_key,
//				'accountId'     => $account_id,
//				'description'   => 'Kipmuving.com reservation: ' . $signature,
//				'referenceCode' => $uid,
//				'amount'        => $this->total->to_pay['USD'],
//				'currency'      => 'USD',
//				'signature'     => $signature,
//				//TEST
////				'test'            => 1,
//				//LIVE
//				'test'          => 0,
////				'amount'        => 3.5,
//				'buyerEmail'    => $user->email,
//				'responseUrl'   => 'http://kipmuving.com/user',
//
//				'confirmationUrl' => 'http://kipmuving.com/reserve/payu/notification',
//				'continueUrl'     => 'http://kipmuving.com/reserve/payu/notification',
//				'notifyUrl'       => 'http://kipmuving.com/reserve/payu/notification',
//				'returnUrl'       => 'http://kipmuving.com/reserve/payu/notification',
//			];
//
//			$this->createReservation($this->offers, $user, 'payu', $signature, 'none', false);
//
//			session()->forget('basket.offers');
//
//			return response()->json($data);
//		}
//
//		return redirect('/login');
//	}
//
//	public function paymentPayURedirect(Request $request)
//	{
//		Log::debug('redirect');
////		Log::debug('Redirect - ok');
////		dd($request->request);
//		return redirect('/user');
//	}
//
//	public function paymentPayUNotifications(Request $request)
//	{
////		Log::debug('notification');
////		Log::debug('request');
////		Log::debug(print_r($request->request, 1));
//		$status = $request['response_message_pol'];
//		$signature = str_replace('Kipmuving.com reservation: ', '', $request['description']);
//
//		$reservations = Reservation::where('payment_uid', '=', $signature)
//			->where('type', '=', 'payu')
//			->get();
//
////		Log::debug('reservations');
////		Log::debug(print_r($reservations, 1));
////		Log::debug('status');
////		Log::debug($status);
////		Log::debug('signature');
////		Log::debug($signature);
//
//		$user_id = $reservations[0]->user_id;
//		app()->setLocale($reservations[0]->lang_code);
//		$selected_offers = [];
//
//		foreach ($reservations as $reservation) {
//			if ($reservation->status) { #reserved
//				if ($status != 'APPROVED') {
//					ReservationController::cancelReservation($reservation->id);
//					$reservation->status = false;
////					$reservation->payment_uid = $item->getId();
//				} else return;
//			} else {
//				if ($status == 'APPROVED') {
////					$reservation->payment_uid = $information->getCode();
//					$reservation->status = true;
//
//					$time = explode('-', $reservation->time_range);
//					$selected_offers[] = [
//						'offer_id' => $reservation->offer_id,
//						'date'     => Carbon::createFromFormat('Y-m-d', $reservation->reserve_date)->format('d/m/Y'),
//						'persons'  => $reservation->persons,
//						'time'     => [
//							'start' => $time[0],
//							'end'   => $time[1],
//						],
//					];
//				}
////				else {
////					$reservation->payment_uid = $item->getId();
////				}
//			}
//			$reservation->status_code = $status;
//			$reservation->save();
//		}
////		Log::debug(print_r($selected_offers, 1));
//
//		if ($status == 'APPROVED') {
////			Log::debug('last if (send emails)');
//			$reservations = ReservationController::getReservationData($selected_offers);
//			$user = User::find($user_id);
//
//			ReservationController::sendMails($reservations, $user);
//		}
//	}
//
//	public function postPayU(Request $request)
//	{
//		Log::info('post');
//		Log::info($request);
//	}
//
//	public function getPayU(Request $request)
//	{
//		Log::info('get');
//		Log::info($request);
//	}
}
