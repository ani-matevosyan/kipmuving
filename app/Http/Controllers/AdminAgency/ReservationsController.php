<?php

namespace App\Http\Controllers\AdminAgency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminAgency\View_Generator_Table;

class ReservationsController extends Controller
{
    /**
     * Display reservations (/)
     *
     * @param Offer $offer
     * @return View
     */
    public function index(Offer $offer)
    {
        $dateBeforeTwoWeeks = date('Y-m-d', strtotime('-2 weeks'));
        $prev_prev_monday = date('Y-m-d', strtotime('previous monday', strtotime('previous monday')));
//        $reservations = Reservation::where([['created_at', '>', $prev_prev_monday] ])->get();

        $period = $this->date_range('2018-07-23', date('Y-m-d', strtotime('tomorrow')));
        $periodWithKeys = array();
        foreach ($period as $key => $value) {
            $periodWithKeys[$value] = [];
        }

        $reservations = Reservation::with('offer')->where([['created_at', '>', '2018-07-23'] ])->get();

        $groupedArray = array();
        foreach($reservations as $key => $valuesAry)
        {
            $activity = $valuesAry->offer->activity->name;
            $groupedArray[$activity][\Carbon\Carbon::parse($valuesAry->created_at)->format('Y-m-d')][] = [
                'persons' => $valuesAry->persons,
                'date' => \Carbon\Carbon::parse($valuesAry->created_at)->format('Y-m-d'),
                'price' => $valuesAry->offer->price,
                'name' => $valuesAry->offer->activity->name,
                'time' => $valuesAry->offer->schedule['start'],
            ];
        }

        $finalArray = array();
        $c = 0;
        foreach ($groupedArray as $key => $value){
            foreach ($value as $k => $v){
                $finalArray[$c][$k] = $v;
                $finalArray[$c] = array_merge($periodWithKeys,$finalArray[$c]);
            }
            array_unshift($finalArray[$c], $key);
            $c++;
        }

        $thsArray = array_merge([''],$period);

        $reservationsTable = "";
        $table = new View_Generator_Table( $thsArray );
        foreach($finalArray as $row) {
            foreach ($row as $key => $item){
                if(is_array($item)){
                    if(count($item) == 0){
                        $cel = '';
                    }else {
                        if(count($item) == 1){
                            $cel = '<ul>'
                                  .'<li>'.$item[0]['persons'].'</li>'
                                .' <li>'.$item[0]['time'].'</li>'
                                .' <li>'.$item[0]['price'].'</li></ul>';
                        }else{
                             $cel = '';
                            foreach ($item  as $i){
                                $cel .= '<ul>'
                                        .'<li>'.$i['persons'].'</li>'
                                    .' <li>'. $i['time'].'</li>'
                                    .' <li>'. $i['price'].'</li></ul><hr>';
                            }
                        }
                    }
                }else {
                    $cel = $item;
                }
                $table->addCell($cel);
            }
        }
        $reservationsTable = $table->generate();


        $data = [
            'reservationsTable'        => $reservationsTable,
        ];
        return view('site.adminAgency.reservations', $data);
    }



    private function date_range($first, $last) {
        $period = new \DatePeriod(
            new \DateTime($first),
            new \DateInterval('P1D'),
            new \DateTime($last)
        );
        $dates = array();
        foreach ($period as $key => $value) {
            $dates[] = $value->format('Y-m-d');
        }
        return $dates;
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
