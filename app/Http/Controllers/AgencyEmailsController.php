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
				$message = str_replace('{name}', $agency->name, $_message);
				
				Mail::send('emails.agency-emails', ['msg' => $message], function ($message) use ($agency) {
					$message->from('info@kipmuving.com', 'Kipmuving team');
					$message->to($agency->email)->subject('Kipmuving.com information');
				});
			}
		} else {
			return redirect()->back()->with('error', 'Select the agencies and enter the text of the message.');
		}
		
		return redirect()->back()->with('success', 'Message has been sent!');
	}
	
}
