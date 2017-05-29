<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
	private function getTime($timeString)
	{
		if (!$timeString)
			return null;
		
		$tmp = explode('-', $timeString);
		
		$result = [
			'start' => $tmp[0].':00',
			'end'   => $tmp[1].':00'
		];
		
		return $result;
	}
	
	public function setDate(Request $request)
	{
		Session::set('selectedDate', Carbon::createFromFormat('d/m/Y', $request['date'])->toDateString());
	}
	
	public function reserve(Request $request)
	{
		$offers = session('selectedOffers');
		$offers[] = [
			'offer_id' => $request['offer_id'],
			'date'     => $request['date'],
			'persons'  => $request['persons'],
			'time'     => $this->getTime($request['timeRange'])
		];
		
		session()->put('selectedOffers', $offers);
	}
	
	public function remove(Request $request)
	{
		$offers = session('selectedOffers');
		$guide_activities = session('guideActivities');
		$oid = $request['oid'];
		
		if ($oid < count($offers)) {
			array_splice($offers, $oid, 1);
			session()->put('selectedOffers', $offers);
		} else {
			$oid = $oid - count($offers);
			array_splice($guide_activities, $oid, 1);
			session()->put('guideActivities', $guide_activities);
		}
	}
	
}
