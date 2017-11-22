<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Offer;
use App\Reservation;
use App\SpecialOffer;
use App\User;
use Carbon\Carbon;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

//use GuzzleHttp\Client;
//use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Redirect;
//use laravel\pagseguro\Platform\Laravel5\PagSeguro;
//use Illuminate\Http\Request;
//use Cartalyst\Stripe\Laravel\Facades\Stripe;
//use Omnipay\Omnipay;
//use Psr\Http\Message\RequestInterface;
//use Psr\Http\Message\ResponseInterface;
//use Psr\Http\Message\UriInterface;
//use Srmklive\PayPal\Services\ExpressCheckout;
//use Illuminate\Support\Facades\View;

class ReservationController extends Controller
{
	private $offers = [];
	private $total;
	private $persons = 0;

	#Display reservations (/reserve)
	public function index(Offer $offer)
	{
		if (!($user = Auth::user()))
			return redirect('/login');

		$selected_offers = session('basket.offers');

		if (count($selected_offers) + count(session('basket.special')) < 1)
			return redirect()->action('ActivityController@index');

		$s_offers = \session('basket.special');
		$s_offers_max_persons = count($s_offers) > 0 ? max(array_column($s_offers, 'persons')) : 0;

		$reservations = $this->getReservationData($selected_offers);

		$data = [
			'styles'         => config('resources.reservation.styles'),
			'scripts'        => config('resources.reservation.scripts'),
			'user'           => $user,
			'reservation'    => $reservations,
			'special_offers' => $this->getSpecialOffersData(),
			'count'             => [
				'special_offers' => count($s_offers),
				  'offers'         => count(session('basket.offers')) + count(session('basket.free')),
				  'persons'        => $offer->getSelectedOffersPersons() > $s_offers_max_persons ? $offer->getSelectedOffersPersons() : $s_offers_max_persons,
				  'total'          => $offer->getSelectedOffersTotal(),
			]
		];

		return view('site.reservar.su-reservar', $data);
	}

	public function reserve()
	{
		if (!($user = Auth::user()))
			return redirect('/login');

		$selected_offers = session('basket.offers');
		$special_offers = session('basket.special');

		if (count($selected_offers) + count($special_offers) < 1)
			return redirect()->action('ActivityController@index');

		if (count($selected_offers) > 0) {
			$reservations = $this->getReservationData($selected_offers);

			$this->createReservation($reservations->offers, $user, 'kipmuving', uniqid(), 'Success', true);

			$this->sendMails($reservations, $user);

			session()->forget('basket.offers');
		}

		if (count($special_offers) > 0) {
			$this->subscribeSpecialOffers();
		}

		return redirect()->action('UserController@getUserReservations');
	}

	public function reserveSpecialOffer(Request $request)
	{
		if(!$user = auth()->user())
			return redirect()->to('/login');

		$s_offer = SpecialOffer::find($request['id']);
		$timerange = explode('-', $request['timerange']);

		$selected_offer [] = [
			'offer_id' => $s_offer->offer->id,
			'date'     => Carbon::createFromFormat('Y-m-d', $s_offer->offer_date)->format('d/m/Y'),
			'persons'  => $s_offer->persons,
			'time'     => [
				'start' => $timerange[0],
				'end'   => $timerange[1],
			],
		];

		$reservation = $this->getReservationData($selected_offer, $s_offer->price);

		#Email to user
		Mail::send('emails.reservations.confirm-to-user', ['user' => $user, 'reservation' => $reservation], function ($message) use ($user) {
			$message->from('contacto@keepmoving.co', 'Keepmoving team');
			$message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Your Keepmoving.co reservation');
		});

		#Email to agency
		Mail::send('emails.reservations.confirm-to-agency', ['user' => $user, 'reservation' => $reservation], function ($message) use ($user, $s_offer) {
			$message->from('contacto@keepmoving.co', 'Keepmoving team');
			$message->to($s_offer->offer->agency->email)->subject('Keepmoving.co reservation');
		});

		$s_offer->active = false;
		$s_offer->save();

		$this->createReservation($reservation->offers, $user, 'kipmuving', uniqid(), 'Success', true, $s_offer->price);

		return response()->json(['success' => true]);
	}

	public function getPrintData(Request $request)
	{
		$reservation_ids = $request['ids'];
		$data = [];

		foreach ($reservation_ids as $reservation_id) {
			$reservation = Reservation::find($reservation_id);

			if ($reservation) {
				$data [] = [
					'activity_icon'         => file_exists(public_path($reservation->offer->activity->image_icon)) ? $reservation->offer->activity->image_icon : null,
					'activity_name'         => $reservation->offer->activity['name'],
					'activity_duration'     => $reservation->offer->duration,
					'activity_schedule'     => $reservation->offer->schedule,
					'agency_name'           => $reservation->offer->agency['name'],
					'agency_address'        => $reservation->offer->agency['address'],
					'offer_price'           => round($reservation->offer->price, 2, PHP_ROUND_HALF_EVEN),
					'offer_includes'        => $reservation->offer->includes,
					'reservation_date'      => Carbon::createFromFormat('Y-m-d', $reservation->reserve_date)->format('d/m/Y'),
					'reservation_persons'   => $reservation->persons,
					'reservation_total'     => round($reservation->offer->price, 2, PHP_ROUND_HALF_EVEN) * $reservation->persons,
					'reservation_new_total' => $reservation->offer_price ? $reservation->offer_price : 0,
					'special_offer'         => $reservation->is_special_offer ? true : false,
				];
			}
		}

		return $data;
	}

	#Cancel reservation
	public static function cancelReservation($id)
	{
		if ($reservation = Reservation::find($id)) {
			if ($user = User::find($reservation->user_id)) {
				if ($current_user = Auth::user()) {
					if ($current_user->id == $user->id) {
						$time = explode('-', $reservation->time_range);
						$selected_offers[] = [
							'offer_id' => $reservation->offer_id,
							'date'     => Carbon::createFromFormat('Y-m-d', $reservation->reserve_date)->format('d/m/Y'),
							'persons'  => $reservation->persons,
							'time'     => [
								'start' => $time[0],
								'end'   => $time[1],
							],
						];

						$reservation_data = self::getReservationData($selected_offers);

						if ($reservation > Carbon::now()->toDateString()) {
							$reservation->status = false;
							$reservation->status_code = 'canceled by user';
							$reservation->save();

							Mail::send('emails.reservar.cancelation.user', ['user' => $user, 'reservation' => $reservation_data], function ($message) use ($user) {
								$message->from('contacto@keepmoving.co', 'Keepmoving team');
								$message->to($user->email, $user->first_name.' '.$user->last_name)->subject('You canceled reservation on Keepmoving.co');
							});

							Mail::send('emails.reservar.cancelation.agencia', ['reservations' => $reservation_data->offers, 'user' => $user], function ($message) use ($reservation_data) {
								$message->from('contacto@keepmoving.co', 'Keepmoving team');
								$message->to($reservation_data->offers[0]->agency->email)->subject('Keepmoving.co canceled reservation');
							});

							return redirect()->back();
						}
					} else abort(503);
				} else abort(503);
			}
		}

		return abort(404);
	}

	#Create reservation and save to DB
	private function createReservation($offers, $user, $type, $uid, $status_code, $status = false, $new_price = null)
	{
		foreach ($offers as $key => $offer) {
			$reservation = new Reservation();
			$reservation->type = $type;
			$reservation->status = $status;
			$reservation->status_code = $status_code;
			$reservation->lang_code = app()->getLocale();
			$reservation->user_id = $user->id;
			$reservation->offer_id = $offer->id;
			$reservation->persons = $offer->reservation['persons'];
			$reservation->reserve_date = Carbon::createFromFormat('d/m/Y', $offer->reservation['date'])->toDateString();
			$reservation->time_range = $offer->reservation['time']['start'] . '-' . $offer->reservation['time']['end'];
			$reservation->payment_uid = $uid;

			#Special offer reservation
			if ($new_price) {
				$reservation->is_special_offer = true;
				$reservation->offer_price = $new_price;
			}

			$reservation->save();
		}
	}

	#Subscribe on special offers
	private function subscribeSpecialOffers()
	{

		$offers = session('basket.special');

		foreach ($offers as $offer) {
			$activity = Activity::find($offer['activity_id']);
			$subscription_uid = uniqid() . uniqid();

			foreach ($activity->offers as $a_offer) {
				if ($a_offer->agency['email']) {
					$uid = uniqid() . uniqid();

					$data = [
						'agency_name'   => $a_offer->agency['name'],
						'activity_name' => $activity->name,
						'date'          => $offer['date'],
						'persons'       => $offer['persons'],
						'offer_price'   => $a_offer['real_price'],
						'total_price'   => $a_offer['real_price'] * $offer['persons'],
						'uid'           => $uid,
					];

					$s_offer = new SpecialOffer();

					$s_offer->user_id = auth()->user()['id'];
					$s_offer->offer_id = $a_offer->id;
					$s_offer->offer_date = Carbon::createFromFormat('d/m/Y', $offer['date'])->toDateString();
					$s_offer->persons = $offer['persons'];
					$s_offer->subscription_uid = $subscription_uid;
					$s_offer->uid = $uid;

					$s_offer->save();

					Mail::send('emails.special-offers.special-offers-to-agency', ['data' => $data], function ($message) use ($data, $a_offer){
						$message->from('contacto@keepmoving.co', 'Kipmuving team');
						$message->to($a_offer->agency['email'])->subject('You received a special offer: '.$data['activity_name']);
					});
				}
			}
		}

		session()->forget('basket.special');
	}

	#Sending emails
	private static function sendMails($reservations, $user)
	{
		#Send email about reservation to user
		Mail::send('emails.reservar.user', ['user' => $user, 'reservation' => $reservations], function ($message) use ($user) {
			$message->from('contacto@keepmoving.co', 'Kipmuving team');
			$message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Your Keepmoving.co reservations');
		});

		#Send email about reservation to admin
		Mail::send('emails.reservar.admin', ['user' => $user, 'reservation' => $reservations], function ($message) use ($user, $reservations) {
			$message->from('contacto@keepmoving.co', 'Keepmoving team');
			$message->to(config('app.admin_email'))->subject(count($reservations->offers).' Keepmoving.co reservations');
		});

		$agency_reservations = $reservations;
		$agency_reservations->offers = $reservations->offers->groupBy('agency.email');

		#Send emails about reservation to agencies
		foreach ($agency_reservations->offers as $agency_email => $item) {
			Mail::send('emails.reservar.agencia', [
				'reservations' => $item,
				'user'         => $user,
				'total'        => $item->sum('reservation.total')
			], function ($message) use ($agency_email) {
				$message->from('contacto@keepmoving.co', 'Keepmoving team');
				$message->to($agency_email)->subject('Keepmoving.co reservation');
			});
		}
	}

	#Collect reservation data from selected offers
	private static function getReservationData($selected_offers, $new_price = null)
	{
		$data = collect();

		$data->persons = 0;
		$data->total = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0, 'ILS' => 0]);
		$data->total->with_discount = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0, 'ILS' => 0]);
		$data->total->to_pay = collect(['CLP' => 0, 'USD' => 0, 'BRL' => 0, 'ILS' => 0]);

		$data->offers = collect();

		if (count($selected_offers) > 0) {
			foreach ($selected_offers as $key => $selected_offer) {
				$data->offers->push(Offer::find($selected_offer['offer_id']));

				$reservation = [
					'date'    => $selected_offer['date'],
					'persons' => $selected_offer['persons'],
					'time'    => $selected_offer['time'],
					'total'   => $data->offers[$key]->price * $selected_offer['persons'] * (1 - config('kipmuving.discount')),
				];

				$data->offers[$key]['reservation'] = $reservation;
				$data->offers[$key]['is_special_offer'] = $new_price ? true : false;
				$new_price ? $data->total['CLP'] = $new_price : $data->total['CLP'] += $data->offers[$key]->real_price * $data->offers[$key]->reservation['persons'];
				$data->persons += $selected_offer['persons'];
			}

			$data->total['USD'] = round($data->total['CLP'] / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
			$data->total['BRL'] = round($data->total['USD'] * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
			$data->total['ILS'] = round($data->total['USD'] * session('currency.values.USDILS'), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['CLP'] = round($data->total['CLP'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['USD'] = round($data->total['USD'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['BRL'] = round($data->total['BRL'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);
			$data->total->with_discount['ILS'] = round($data->total['ILS'] * (1 - config('kipmuving.discount')), 2, PHP_ROUND_HALF_EVEN);

			//todo change
//		$data->to_pay = round(($data->total / session('currency.values.USDCLP')) * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
//		$data->to_pay_in_currency = round(($data->total_in_currency) * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
			$tmp = round($data->total->with_discount['CLP'] * config('kipmuving.service_fee'), 2, PHP_ROUND_HALF_EVEN);
			$data->total->to_pay['CLP'] = $tmp < 2000 ? 2000 : $tmp;
			$data->total->to_pay['USD'] = round($data->total->to_pay['CLP'] / session('currency.values.USDCLP'), 2, PHP_ROUND_HALF_EVEN);
			$data->total->to_pay['BRL'] = round($data->total->to_pay['USD'] * session('currency.values.USDBRL'), 2, PHP_ROUND_HALF_EVEN);
			$data->total->to_pay['ILS'] = round($data->total->to_pay['USD'] * session('currency.values.USDILS'), 2, PHP_ROUND_HALF_EVEN);
		}

		return $data;
	}

	#Collect special offers data
	private function getSpecialOffersData()
	{
		$s_offers = session('basket.special');

		if (count($s_offers) > 0) {
			$result = [];

			foreach ($s_offers as $offer) {
				$activity = Activity::find($offer['activity_id']);

				$result [] = [
					'activity_id'    => $activity->id,
					'activity_name'  => $activity->name,
					'count_agencies' => $activity->offers->count(),
					'date'           => $offer['date'],
					'persons'        => $offer['persons'],
				];
			}

			return $result;
		}

		return null;
	}

	#TEST
	public function testEmails($type)
	{
		$selected_offers = session('basket.offers');
		if ($selected_offers) {
			$reservations = self::getReservationData($selected_offers);
			$user = Auth::user();
//			dd($reservations->offers);
			switch ($type) {
				case 'user':
					return view('emails.reservar.user', ['user' => $user, 'reservation' => $reservations]);
					break;
				case 'admin':
					return view('emails.reservar.admin', ['user' => $user, 'reservation' => $reservations]);
					break;
				case 'agency':
					return view('emails.reservar.agencia', ['reservations' => $reservations->offers, 'user' => $user, 'total' => '155000']);
					break;
				case 'user-cancel':
					return view('emails.reservar.cancelation.user', ['user' => $user, 'reservation' => $reservations]);
					break;
				case 'agency-cancel':
					return view('emails.reservar.cancelation.agencia', ['user' => $user, 'reservations' => $reservations->offers]);
					break;
				default:
					echo 'You need use link, for example: /reserve/testemails/TYPE, where TYPE: user | admin | agency | user-cancel | agency-cancel<br>';
					echo 'For example: http://kipmuving.com/reserve/testemails/user';
			}
		} else return '<br>You need select offers';
	}



	#Not used now
//	private static function clearGarbageReservations()
//	{
//		$now = Carbon::now();
//
//		$reservations = Reservation::where([
//			['status', '=', false],
//			['status_code', '=', 'none'],
//			['updated_at', '<', $now->subDays(5)->toDateTimeString()],
//		])
//			->orWhere('status_code', '=', '')
//			->get();
//
//		foreach ($reservations as $reservation) {
//			$reservation->delete();
//		}
//
////		$reservations = Reservation::where([
////			['status', '=', false],
////			['status_code', '<>', 'none'],
////			['status_code', '<>', ''],
////			['updated_at', '<', $now->subDays(10)->toDateTimeString()]
////		])
////			->get();
//	}
}
