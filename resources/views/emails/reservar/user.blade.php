<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
			xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<style>
		.you-must-take {
			padding: 0;
			list-style: none;
			margin: 10px 0 0 10px;
		}

		.you-must-take > li {
			margin: 0 0 6px;
			position: relative;
		}

		.you-must-take > li:before {
			content: "\2022";
			position: absolute;
			left: -10px;
			top: -1px;
			color: #089f02;
			font-size: 11px;
		}

		.timing {
			margin: 0;
			padding: 0;
			list-style: none;
			font-size: 14px;
			line-height: 18px;
			font-weight: 400;
		}

		.timing li {
			position: relative;
			border-top: 1px solid #d9d9d9;
			padding: 10px 0 10px 30px;
		}

		.timing li:after {
			width: 18px;
			content: '';
			height: 18px;
			position: absolute;
			left: 3px;
			right: auto;
			bottom: auto;
		}

		.timing li.time {
			border: 0;
			padding-top: 0;
		}

		.timing li.time:after {
			background: url(http://kipmuving.com/images/clock.svg) no-repeat;
			background-size: contain;
			background-position: center center;
			top: 2px;
		}

		.timing li.person:after {
			background: url(/images/happy.svg) no-repeat;
			background-size: contain;
			background-position: center center;
			top: 10px;
		}

		.timing li.money:after {
			background: url(/images/coin.svg) no-repeat;
			background-size: contain;
			background-position: center center;
			top: 18px;
		}

		.timing strong {
			display: block;
			font-weight: normal;
		}

		.timing strong.title {
			color: #963d4c;
			font-size: 16px;
			line-height: 20px;
			font-weight: 700;
		}

		.timing span {
			font-weight: bold;
		}

		.important {
			color: #fff;
			overflow: hidden;
			position: relative;
			background: #963d4c;
			font-size: 14px;
			line-height: 18px;
			font-weight: normal;
			padding: 8px 10px 10px 50px;
		}

		.important:after {
			width: 27px;
			content: '';
			height: 23px;
			position: absolute;
			left: 12px;
			top: 16px;
			right: auto;
			bottom: auto;
			background: url(/images/warning-white.svg) no-repeat;
			background-size: contain;
			background-position: center center;
		}

		.important .title {
			font-weight: 900;
			font-size: 16px;
			display: block;
			margin-bottom: 4px;
		}

		.footer {
			padding: 20px;
			vertical-align: top;
		}

		.footer p {
			margin: 15px 0;
		}
	</style>
</head>
<body
	style="margin:0; padding:0; font-size:14px; line-height:18px; font-family:'Lato', sans-serif; min-width:320px !important;"
	bgcolor="#FFFFFF" link="#535353">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
	<tr>
		<td align="center" valign="top" id="bodyCell">
			<table style="margin:0 auto; width: auto !important; max-width:600px !important; background: #f6f6f6;"
						 cellpadding="0"
						 cellspacing="0" align="center">
				<tr>
					<td bgcolor="#133939"
							style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height="82" style="display:block;" style="width:250px !important;
						height:auto !important; overflow:hidden;">
							<a target="_blank" href="http://www.kipmuving.com/">
								<img src="{{ asset('/images/logo-new.svg') }}" alt="" align="left" vspace="0" hspace="0"
										 style="width:207px !important;">
							</a>
						</span>
					</td>
				</tr>
				<tr>
					<td id="main" style=" padding-left:20px; padding-right:20px;">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td
									style="font-size:16px; line-height:20px; color:#000000; padding-top:55px; padding-bottom:16px; border-bottom:1px solid #cccccc;">
									<strong
										style="font-weight:bold;">{{ trans('emails.hello') }} {{ $user->first_name }} {{ $user->last_name }}</strong>,
									{{ trans('emails.many_thanks_for_booking') }}
									<p>{{ trans('emails.what_will_we_do_now') }}</p>
									<strong
										style="display:block; font-weight:bold; margin-top: 25px;">{{ trans('emails.activities_you_booked') }}
										:</strong>
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
													<strong
														style="display:block; font-weight:bold; padding-left:10px;">{{ trans('emails.you_must_take') }}
														:</strong>
													{{--<p>{{ $offer->carries }}</p>--}}
													@if ($offer->activity->carries)
														<ul class="you-must-take">
															@foreach($offer->activity->carries as $carry)
																<li>{{ $carry }}</li>
															@endforeach
														</ul>
													@endif
												</td>
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<ul class="timing">
														<li class="time">
															<strong class="title">
																{{ trans('form.day') }}: {{ $offer->reservation['date'] }}
															</strong>
															<strong>
																		<span>{{ trans('main.duration') }}
																			:</span> {{ $offer->duration }}
																hrs
															</strong>
															<strong>
																		<span>{{ trans('main.schedule') }}
																			:</span> {{ \Carbon\Carbon::parse($offer->reservation['time']['start'])->format('H:i') }}-{{ \Carbon\Carbon::parse($offer->reservation['time']['end'])->format('H:i') }}
															</strong>
														</li>
														<li class="person">
															<strong>
																<span>{{ $offer->reservation['persons'] }}</span> {{ trans('main.persons') }}
															</strong>
														</li>
														<li class="money">
															<strong>Pagar en agencia</strong>
															<strong class="title">$ {{ number_format($offer->real_price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'], 0, '.', ' ') }} CLP</strong>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="important">
														<strong class="title">{{ trans('emails.important') }}:</strong>
														{{ $offer->important }}
													</div>
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
					<td id="footer" class="footer">
						<p>{{ trans('emails.total_to_pay') }}
							<strong style="color:#980e25; font-weight:bold;">$ {{ number_format($reservation->total->with_discount['CLP'], 0, '.', ' ') }} CLP. </strong>{{ trans('emails.must_be_paid_at_agency') }}</p>
						<p>{{ trans('emails.each_agency_has_cancellation_policy') }}.</p>
						<p>
							{{ trans('emails.any_questions') }}
							<a href="mailto:contacto@kipmuving.com">contacto@kipmuving.com</a>
						</p>
						<p>{{ trans('emails.with_regards') }}</p>
						<p style="margin-bottom: 0">{{ trans('emails.kipmuving_team') }}</p>
						<a href="#" style="color:#000000; text-decoration:none;">{{ url('/') }}</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
