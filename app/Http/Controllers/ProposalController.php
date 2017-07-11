<?php

namespace App\Http\Controllers;

use App\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
	public function saveProposal()
	{
		
		$s_offers = session('selectedOffers');
		
		$uid = md5(uniqid());
		
		foreach ($s_offers as $s_offer) {
			$proposal = new Proposal();
			$proposal->uid = $uid;
			$proposal->offer_id = $s_offer['offer_id'];
			$proposal->persons = $s_offer['persons'];
			$proposal->reserve_date = Carbon::createFromFormat('d/m/Y', $s_offer['date'])->toDateString();
			$proposal->time_range = $s_offer['time']['start'] . '-' . $s_offer['time']['end'];
			$proposal->save();
		}
		
		return url('proposal/' . $uid);
	}
	
	public function addFromLink($uid)
	{
		
		$proposals = Proposal::where('uid', '=', $uid)->get();
		$result = session('selectedOffers');
		
		foreach ($proposals as $proposal) {
			
			$time = explode('-', $proposal->time_range);
			
			$result [] = [
				'offer_id' => $proposal->offer_id,
				'date'     => Carbon::createFromFormat('Y-m-d', $proposal->reserve_date)->format('d/m/Y'),
				'persons'  => $proposal->persons,
				'time'     => [
					'start' => $time[0],
					'end'   => $time[1]
				]
			];
		}
		
		session()->put('selectedOffers', $result);
		
		return redirect(action('HomeController@index'));
	}
}
