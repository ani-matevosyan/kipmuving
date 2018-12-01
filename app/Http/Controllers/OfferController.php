<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\OfferDay;
use App\Offer;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
	private function getTime($timeString)
	{
		if (!$timeString)
			return null;

        $timeString = str_replace(' ', '', $timeString);
		$tmp = explode('-', $timeString);

		$result = [
			'start' => $tmp[0] . ':00',
			'end'   => $tmp[1] . ':00',
		];

		return $result;
	}

	public function setDate(Request $request)
	{
	    $activityId = $request->activityId;
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['date'])->toDateString());
        $offers = Offer::with('days')
            ->where('activity_id','=', $activityId)
            ->whereHas('agency')
            ->get();
        if($offers->isNotEmpty()){
            foreach ($offers as $key=>$item){
                $offers[$key]->old_price = $item->old_price;
                $offers[$key]->the_price = $item->price;
            }
        }
	    echo json_encode(['offers' => $offers]);
	}

	public function reserve(Request $request)
	{
		$basket = \session('basket');
		$basket['offers'] [] = [
			'offer_id' => $request['offer_id'],
			'date'     => $request['date'],
			'persons'  => $request['persons'],
			'time'     => $this->getTime($request['timeRange']),
		];

		session()->put('basket', $basket);
	}

	public function remove(Request $request)
	{
		$offers = session('basket.offers');
		$freeActivities = session('basket.free');
		$oid = $request['oid'];

		if ($oid < count($offers)) {
			array_splice($offers, $oid, 1);
			session()->put('basket.offers', $offers);
		} else {
			$oid = $oid - count($offers);
			array_splice($freeActivities, $oid, 1);
			session()->put('basket.free', $freeActivities);
		}
	}

	public function removeFromBasket($oid)
	{
		//TODO change to POST

		$basket = session('basket');

		array_splice($basket['offers'], $oid, 1);

		session()->put('basket', $basket);

		return redirect()->back();
	}

    public function addDays(Request $request)
    {
        parse_str($request->formData, $formData);
        $validator = Validator::make($formData, [
            'available_start.*' => 'max:255',
            'available_end.*' => 'max:255',
            'price.*' => 'numeric',
            'price_offer.*' => 'numeric',
        ]);
        if(!$validator->fails() && isset($formData['available_start'])){
            $start_dates = $formData['available_start'];
            $end_dates = $formData['available_end'];
            $prices = $formData['price'];
            $price_offers = $formData['price_offer'];

            $offerDayArr = [];
            foreach ($start_dates as $key=>$value){
                if($value && $end_dates[$key] && $prices[$key]){
                    $offerDayArr[] = [
                        'offer_id' => $request->offer_id,
                        'available_start'=> date('Y-m-d', strtotime(str_replace('/', '-', $value))),
                        'available_end'=> date('Y-m-d', strtotime(str_replace('/', '-', $end_dates[$key]))),
                        'price'=> $prices[$key],
                        'price_offer'=> ($price_offers[$key]? $price_offers[$key] : null),
                    ];
                }
            }
            OfferDay::insert($offerDayArr);

        }else{
            $errorMessages = $validator->errors();
            echo json_encode(['errorMessages' => $errorMessages]);
        }
    }


    public function editDays(Request $request)
    {
        parse_str($request->formData, $formData);
        $validator = Validator::make($formData, [
            'available_start.*' => 'max:255',
            'available_end.*' => 'max:255',
            'price.*' => 'numeric',
            'price_offer.*' => 'numeric',
        ]);
        if(!$validator->fails()){
            OfferDay::where('offer_id', $request->offer_id)->delete();
            if(isset($formData['available_start'])){
                $start_dates = $formData['available_start'];
                $end_dates = $formData['available_end'];
                $prices = $formData['price'];
                $price_offers = $formData['price_offer'];

                $offerDayArr = [];
                foreach ($start_dates as $key=>$value){
                    if($value && $end_dates[$key] && $prices[$key]){
                        $offerDayArr[] = [
                            'offer_id' => $request->offer_id,
                            'available_start'=> date('Y-m-d', strtotime(str_replace('/', '-', $value))),
                            'available_end'=> date('Y-m-d', strtotime(str_replace('/', '-', $end_dates[$key]))),
                            'price'=> $prices[$key],
                            'price_offer'=> ($price_offers[$key]? $price_offers[$key] : null),
                        ];
                    }
                }
                OfferDay::insert($offerDayArr);
            }

        }else{
            $errorMessages = $validator->errors();
            echo json_encode(['errorMessages' => $errorMessages]);
        }
    }


    public function getPriceByDateAndPersons(Request $request){
        $offer_id = $request->offer_id;
        $persons = $request->persons ? $request->persons : 1;
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $offer = Offer::with('days')->find( $offer_id);
        $oldPrice = $offer->getOldPrice($date);
        $price = $offer->getPrice($date);
        $priceWithPersons = $persons * $price;
        $oldPriceWithPersons = $persons * $oldPrice;
        echo json_encode([
            'price' => $price,
            'oldPrice' => $oldPrice,
            'priceWithPersons' => $priceWithPersons,
            'oldPriceWithPersons' => $oldPriceWithPersons,
        ]);
    }

}
