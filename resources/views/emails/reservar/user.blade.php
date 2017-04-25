<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
		xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body
	style="margin:0; padding:0; font-size:14px; line-height:18px; font-family:'Trebuchet MS', Verdana, sans-serif; min-width:320px !important;"
	bgcolor="#FFFFFF" link="#535353">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
	<tr>
		<td align="center" valign="top" id="bodyCell">
			<table style="margin:0 auto; width: auto !important; max-width:600px !important;" cellpadding="0"
					 cellspacing="0" align="center">
				<tr>
					<td bgcolor="#133939"
						 style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height="82" style="display:block;" style="width:250px !important;
						height:auto !important; overflow:hidden;">
						<img src="{{ asset('/images/logo-new.svg') }}" alt="" align="left" vspace="0" hspace="0"
							  style="width:250px !important;">
						</span>
					</td>
				</tr>
				<tr>
					<td id="main" style=" padding-left:20px; padding-right:20px;">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td style="font-size:16px; line-height:20px; color:#000000; padding-top:30px; padding-bottom:30px; border-bottom:1px solid #cccccc;">
									<strong
										style="font-weight:bold;">{{ trans('emails.hello') }} {{ $user->first_name }} {{ $user->last_name }}</strong>,
									{{ trans('emails.many_thanks_for_booking') }}<br><br>
									<p>{{ trans('emails.what_will_we_do_now') }}
										<br><br></p>
									<strong style="display:block; font-weight:bold;">{{ trans('emails.activities_you_booked') }}:</strong>
								</td>
							</tr>
							@foreach($reservation->offers as $offer)
								<tr>
									<td
										style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px; border-bottom:1px solid #cccccc;">
										<table cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td style="padding-bottom:20px;" colspan="2">
													<table cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td width="51" height="39" valign="middle"
																 style="font-size:0; line-height:0; padding-right:20px;">
																<img src="{{ url($offer->activity->image_icon) }}"
																	  alt="activity image" align="left" vspace="0" hspace="0">
															</td>
															<td>
																<h2 style="margin-top:0; margin-bottom:0;"><span
																		style="font-size:31px; line-height:35px; color:#089f02;">{{ $offer->activity->name }}</span>
																</h2>
																<strong
																	style="font-size:22px; line-height:26px; font-weight:bold; display:block;">{{ $offer->agency->name }}</strong>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<strong style="display:block; font-weight:bold; padding-left:10px;">{{ trans('emails.you_must_take') }}:</strong>
													<p>{{ $offer->carries }}</p>
												</td>
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<strong
														style="font-size:16px; line-height:20px; color:#963d4c; font-weight:bold; display:block; padding-left:25px; background:url(ico1.png) no-repeat;">{{ trans('emails.day') }}: {{ $offer->reservation['date'] }}</strong>
													<span
														style="display:block; margin-left:25px;"><strong>{{ trans('emails.duration') }}:</strong> {{ $offer->duration }}
														hrs</span>
													<span
														style="display:block;
														border-bottom:1px solid #cccccc;
														padding-bottom:10px;
														margin-left:25px;"><strong>{{ trans('emails.schedule') }}:</strong> {{ date('H:i', strtotime($offer->reservation['time']['start'])) }}
														{{ trans('emails.to') }} {{ date('H:i', strtotime($offer->reservation['time']['end'])) }}
													</span>
													<span
														style="display:block; padding-left:25px; padding-top:10px; background:url(ico2.png) no-repeat; background-position:0 10px;"><strong>{{ $offer->reservation['persons'] }}</strong> {{ trans('emails.persons') }}</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" bgcolor="#913b49"
													 style="padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:40px; color:#ffffff; background:url(ico3.png) no-repeat; background-color:#913b49; background-position:10px 14px;">
													<strong
														style="display:block; font-size:16px; line-height:20px; font-weight:bold;">{{ trans('emails.important') }}:</strong>
													{{ trans('emails.you_must_present') }}<br>
													O’Higgins 221 {{ trans('emails.to_try_shoes') }}.
												</td>
											</tr>
										</table>
									</td>
								</tr>
							@endforeach
						</table>
					</td>
				</tr>
				<tr>
					<td id="footer" valign="top"
						 style="padding-left:20px; padding-top:20px; padding-right:20px; padding-bottom:20px;">
						{{ trans('emails.total_to_pay') }} <span
							style="color:#980e25; font-weight:bold;">$ {{ $reservation->total->with_discount['CLP'] }} CLP
							.</span> {{ trans('emails.each_agency_has_cancellation_policy') }}
						<br>
						<br>
						{{ trans('emails.if_you_do_not_appear_on_the_day') }} <span
							style="color:#980e25; font-weight:bold;">{{ trans('emails.as_a_fine') }}</span>
						<br>
						<br>
						{{ trans('emails.any_questions') }}
						<a href="mailto:contacto@kipmuving.com">contacto@kipmuving.com</a> {{ trans('emails.and_also_by_phone') }}
						+56 45 2444035. {{ trans('emails.or_whatsapp') }} +56962266304
						<br>
						<br>
						{{ trans('emails.with_regards') }}
						<br>
						<br>
						{{ trans('emails.kipmuving_team') }}
						<br>
						<br>
						<br>
						<span style="display:block; text-align:center;">
							<a href="#" style="color:#000000; text-decoration:none;">{{ url('/') }}</a>
						</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
