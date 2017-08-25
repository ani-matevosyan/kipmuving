<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagseguroController extends Controller
{
//	public function paymentPagseguro()
//	{
//		$this->clearGarbageReservations();
//
//		if ($user = Auth::user()) {
//			$data = [
//				'items'    => [
//					[
//						'id'          => uniqid(),
//						'description' => 'Kipmuving reservation',
//						'quantity'    => 1,
//						'amount'      => $this->total->to_pay['BRL'],
//					],
//				],
//				'currency' => 'BRL',
//			];
//
//			$checkout = PagSeguro::checkout()->createFromArray($data);
//			$credentials = PagSeguro::credentials()->get();
//			$information = $checkout->send($credentials);
//
//			$this->createReservation($this->offers, $user, 'pagseguro', $data['items'][0]['id'], 'none', false);
//
//			session()->forget('basket.offers');
//
//			return redirect()->to($information->getLink());
//		}
//
//		return redirect('/login');
//	}
//
//	public static function paymentPagseguroReturn($information)
//	{
//		$status = $information->getStatus()->getName();
//		$item = $information->getItems()[0];
//
//		$reservations = Reservation::where('payment_uid', '=', $item->getId())
//			->orWhere('payment_uid', '=', $information->getCode())
//			->where('type', '=', 'pagseguro')
//			->get();
//
//		$user_id = $reservations[0]->user_id;
//		app()->setLocale($reservations[0]->lang_code);
//		$selected_offers = [];
//
//		foreach ($reservations as $reservation) {
//			if ($reservation->status) { #reserved
//				if (!($status == 'Paga')) {
//					ReservationController::cancelReservation($reservation->id);
//					$reservation->status = false;
//					$reservation->payment_uid = $item->getId();
//				}
//			} else {
//				if ($status == 'Paga') {
//					$reservation->payment_uid = $information->getCode();
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
//				} else {
//					$reservation->payment_uid = $item->getId();
//				}
//			}
//			$reservation->status_code = $status;
//			$reservation->save();
//		}
//
//		if ($status == 'Paga') {
//			$reservations = ReservationController::getReservationData($selected_offers);
//			$user = User::find($user_id);
//
//			ReservationController::sendMails($reservations, $user);
//		}
//	}
//
//	public function paymentPagseguroRedirectGet(Request $request)
//	{
////		dd('Pagseguro redirect information');
//		//TODO информация что платеж принят на рассмотрение
////		Log::debug('redirect - get');
////		Log::info($request);
//	}
}
