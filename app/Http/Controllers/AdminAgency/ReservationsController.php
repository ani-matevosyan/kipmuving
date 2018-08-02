<?php

namespace App\Http\Controllers\AdminAgency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    //
    #Display reservations (/reserve)
    public function index(Offer $offer)
    {
        if (!($user = Auth::user()))
            return redirect('/login');

        $selected_offers = session('basket.offers');

//        if (count($selected_offers) + count(session('basket.special')) < 1)
//            return redirect()->action('ActivityController@index');

        $s_offers = \session('basket.special');
        $s_offers_max_persons = count($s_offers) > 0 ? max(array_column($s_offers, 'persons')) : 0;

        $reservations = $this->getReservationData($selected_offers);

        $data = [
//            'styles'         => config('resources.reservation.styles'),
//            'scripts'        => config('resources.reservation.scripts'),
            'user'           => $user,
            'reservation'    => $reservations,
            'count'             => [
                'special_offers' => count($s_offers),
                'offers'         => count(session('basket.offers')) + count(session('basket.free')),
                'persons'        => $offer->getSelectedOffersPersons() > $s_offers_max_persons ? $offer->getSelectedOffersPersons() : $s_offers_max_persons,
                'total'          => $offer->getSelectedOffersTotal(),
            ]
        ];

        return view('site.adminAgency.layouts.default', $data);
        return view('site.adminAgency.welcome', $data);
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
}
