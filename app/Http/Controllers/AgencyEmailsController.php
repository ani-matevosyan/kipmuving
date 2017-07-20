<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider;

class AgencyEmailsController extends Controller
{
	public function viewList()
	{
		$data = [
			'agencies' => Agency::get()
		];
		
		return view('site.admin.agency-emails', $data);
	}
	
	public function sendEmails(Request $request)
	{
		$_message = $request['message'];
		
		if ($request['agencies']) {
			
			foreach ($request['agencies'] as $agencyID) {
				$agency = Agency::find($agencyID);
				
				$activities = '<h3>Activities</h3>';
				
				foreach ($agency->offers as $offer) {
					$activities .= '<strong>Activity: </strong>'.$offer->activity->name.' ('.$offer->real_price.' CLP)<br>';
					$activities .= '<strong>Description: </strong>'.$offer->description.'<br>';
					
					if (isset($offer->includes) && count($offer->includes) > 0) {
						$activities .= '<strong>Includes: </strong><br>';
						foreach ($offer->includes as $include) {
							$activities .= $include.'<br>';
						}
					}
					
					if (isset($offer->available_time) && count($offer->available_time) > 0) {
						$activities .= '<strong>Time: </strong> ';
						foreach ($offer->available_time as $time) {
							$activities .= $time['start'].'-'.$time['end'].'; ';
						}
					}
					
					$activities .= '<br><br><br>';
				}
				
				$message = str_replace('{name}', $agency->contact, $_message);
				$message = str_replace('{activities}', $activities, $message);
				$message = nl2br($message);
				
//				Mail::send('emails.agency-emails', ['msg' => $message], function ($message) use ($agency) {
//					$message->from('info@kipmuving.com', 'Kipmuving team');
//					$message->to($agency->email)->subject('Kipmuving.com information');
//				});
				return view('emails.agency-emails', ['msg' => $message]);
			}
		} else {
			return redirect()->back()->with('error', 'Select the agencies and enter the text of the message.');
		}
		
		return redirect()->back()->with('success', 'Message has been sent!');
	}
	
}
