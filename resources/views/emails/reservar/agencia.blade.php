<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Aventuras Chile</title>
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body style="font-family: 'PT Sans', sans-serif; font-size: 15px; font-weight: 400;  min-width: 320px !important; margin: 0; padding: 0; color: #000000;">
{{--<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">--}}
	{{--<tr>--}}
		{{--<td align="center" valign="top" id="bodyCell">--}}
			{{--<table style="margin:0 auto; width: auto !important; max-width:600px !important; background: #FFF;" cellpadding="0"--}}
			       {{--cellspacing="0" align="center">--}}
				{{--<tr>--}}
					{{--<td bgcolor="#133939"--}}
					    {{--style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">--}}
						{{--<span width="340" valign="top" height="82" style="display:block;" style="width:250px !important;--}}
						{{--height:auto !important; overflow:hidden;">--}}
							{{--<a target="_blank" href="/">--}}
								{{--<img src="{{ asset('/images/logo-new.svg') }}" alt="" align="left" vspace="0" hspace="0" style="width:180px !important;">--}}
							{{--</a>--}}
						{{--</span>--}}
					{{--</td>--}}
				{{--</tr>--}}
				{{--<tr>--}}
					{{--<td id="main" style=" padding-left:20px; padding-right:20px;">--}}
						{{--<table cellpadding="0" cellspacing="0" width="100%">--}}
							{{--<tr>--}}
								{{--<td style="font-size:14px; line-height:20px; color:#000000; padding-top:45px; padding-bottom:16px; border-bottom:1px solid #cccccc;">--}}
									{{--<strong>Hola {{ $reservations['0']->agency->name }}</strong><br>--}}
									{{--El pasajero <span style="color:#980e25">{{ $user->first_name.' '.$user->last_name }}</span> <span style="color:#980e25">{{ count($reservations) }}--}}
										{{--paseos</span>--}}
									{{--para <br>--}}
									{{--<span><br>--}}
										{{--Contact with client:<br>--}}
										{{--- Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a><br>--}}
										{{--- Phone: {{ $user->phone }}--}}
									{{--</span>--}}
								{{--</td>--}}
							{{--</tr>--}}
							{{--@foreach($reservations as $offer)--}}
								{{--<tr>--}}
									{{--<td--}}
											{{--style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px; border-bottom:1px solid #cccccc;">--}}
										{{--<table cellpadding="0" cellspacing="0" width="100%">--}}
											{{--<tr>--}}
												{{--<td style="padding-bottom:20px;" colspan="2">--}}
													{{--<table cellpadding="0" cellspacing="0" width="100%">--}}
														{{--<tr>--}}
															{{--<td width="51" height="39" valign="middle"--}}
															    {{--style="font-size:0; line-height:0; padding-right:20px;">--}}
																{{--<img src="{{ asset($offer->activity->image_icon) }}"--}}
																     {{--alt="activity image" align="left" vspace="0" hspace="0">--}}
															{{--</td>--}}
															{{--<td>--}}
																{{--<h2 style="margin-top:0; margin-bottom:0;"><span--}}
																			{{--style="font-size:22px; line-height:20px; color:#089f02;">{{ $offer->activity->name }}</span>--}}
																{{--</h2>--}}
																{{--<strong--}}
																		{{--style="font-size:16px; line-height:20px; font-weight:normal; display:block">{{ $offer->agency->name }} <span--}}
																			{{--style="font-size: 12px; display: inline-block; margin-left: 10px;">{{ $offer->agency->address }}</span></strong>--}}
															{{--</td>--}}
														{{--</tr>--}}
													{{--</table>--}}
												{{--</td>--}}
											{{--</tr>--}}
											{{--<tr>--}}
												{{--<td style="display: inline-block; padding-left: 70px; width:50%; padding-bottom:20px;" valign="top">--}}
													{{--<ul class="timing">--}}
														{{--<li class="time">--}}
															{{--<strong class="title">--}}
																{{--{{ trans('form.day') }}: {{ $offer->reservation['date'] }}--}}
															{{--</strong>--}}
															{{--<strong>--}}
																		{{--<span>{{ trans('main.duration') }}--}}
																			{{--:</span> {{ $offer->duration }}--}}
																{{--hrs--}}
															{{--</strong>--}}
															{{--<strong>--}}
																		{{--<span>{{ trans('main.schedule') }}--}}
																			{{--:</span> {{ \Carbon\Carbon::parse($offer->reservation['time']['start'])->format('H:i') }}--}}
																{{--a {{ \Carbon\Carbon::parse($offer->reservation['time']['end'])->format('H:i') }}--}}
															{{--</strong>--}}
														{{--</li>--}}
														{{--<li class="person">--}}
															{{--<strong>--}}
																{{--<span>{{ $offer->reservation['persons'] }}</span> {{ trans('main.persons') }}--}}
															{{--</strong>--}}
														{{--</li>--}}
														{{--<li class="money">--}}
															{{--<strong>Pagar en agencia</strong>--}}
															{{--<strong class="title">$ {{ number_format($offer->real_price * $offer->reservation['persons'], 0, '.', ' ') }}--}}
																{{--CLP</strong>--}}
														{{--</li>--}}
													{{--</ul>--}}
												{{--</td>--}}
											{{--</tr>--}}
										{{--</table>--}}
									{{--</td>--}}
								{{--</tr>--}}
							{{--@endforeach--}}
						{{--</table>--}}
					{{--</td>--}}
				{{--</tr>--}}
				{{--<tr>--}}
					{{--<td id="footer" class="footer">--}}
						{{--<p>--}}
							{{--{{ trans('emails.any_questions') }}--}}
							{{--<a href="mailto:contacto@aventuraschile.com">contacto@aventuraschile.com</a>--}}
						{{--</p>--}}
						{{--<p>{{ trans('emails.with_regards') }}</p>--}}
						{{--<p style="margin-bottom: 0">{{ trans('emails.aventuraschile_team') }}</p>--}}
						{{--<a href="#" style="color:#000000; text-decoration:none;">{{ url('/') }}</a>--}}
					{{--</td>--}}
				{{--</tr>--}}
			{{--</table>--}}
		{{--</td>--}}
	{{--</tr>--}}
{{--</table>--}}
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr style="padding: 10px 0 30px 0;">
		<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#f6f6f6" style="border-collapse: collapse;">
				<tbody>
				<tr>
					<td align="left" style="padding-top: 7px; padding-right: 10px; padding-bottom: 6px; padding-left: 38px; color: #FFCD06; font-size: 32px;">
						<div style="border-bottom: 1px solid #dddddd; padding-bottom: 5px; padding-top: 33px;">
							<a href="{{ asset('/') }}">
								<img src="{{ asset('/images/KeepMoving_logo_black.svg') }}" style="margin-left: -8px;" alt="Aventuras Chile" width="171">
							</a>
						</div>
					</td>
				</tr>
				<tr>
					<td style="padding: 20px 37px 50px 37px">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
							<tr>
								<td style="padding-bottom: 16px;">
									<p style="margin: 0 0 0 0">{{ trans('emails.hello') }} <strong>{{ $reservations['0']->agency->name }},</strong></p>
									<p style="margin: 0 0 0 0">{{ trans('main.congratulations') }}. {{ trans('emails.you_have') }} {{ count($reservations) }} @if(count($reservations) > 1) {{ trans('main.reserves') }} @else {{ trans('main.reserve_s') }} @endif{{ trans('main.for2') }}: </p>
								</td>
							</tr>
							<tr>
								<td>
									<p style="margin: 0 0 0 0">{{ trans('form.name') }}: <strong>{{ $user->first_name.' '.$user->last_name }}</strong></p>
									<p style="margin: 0 0 0 0">{{ trans('form.email') }}: <strong>{{ $user->email }}</strong></p>
									<p style="margin: 0 0 0 0">{{ trans('form.phone') }}: <strong>{{ $user->phone }}</strong></p>
								</td>
							</tr>
							<tr>
								<td style="padding-top: 45px; padding-bottom: 29px; border-bottom: 1px solid #d8d8d8;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tbody>
										<?php $totalprice = 0; ?>
										@foreach($reservations as $offer)
											<tr>
												<td style="padding-bottom: 58px;">
													<h2 style="font-weight: 700; font-size: 36px; margin: 0; margin-bottom: 5px; line-height: 1;">
														<a href="{{ asset('/activity').'/'.$offer->activity_id }}" style="color: #323e5b; text-decoration: none;">{{ $offer->activity->name }}</a>
													</h2>
													<p style="margin: 0 0 0 0; line-height: 1;">{{ trans('form.day_s') }} <strong style="font-size: 20px; color: #980e25;">{{ $offer->reservation['date'] }}</strong></p>
													<p style="margin: 0 0 0 0; line-height: 1;">total {{ trans('main.persons_s') }} <strong style="font-size: 20px; color: #980e25;">{{ $offer->reservation['persons'] }}</strong></p>
													<p style="margin: 0 0 0 0; line-height: 1;">total {{ trans('main.activity') }} <strong style="font-size: 20px; color: #980e25;">$ {{ number_format($offer->real_price * $offer->reservation['persons'], 0, '.', ' ') }}</strong></p>
													<?php $totalprice += $offer->real_price * $offer->reservation['persons'] ?>
												</td>
											</tr>
										@endforeach
										<tr>
											<td style="display: block; margin-top: -15px;">
												<p style="margin: 0 0 0 0; line-height: 1;">total {{ trans('emails.of_the') }} {{ trans('main.activities') }} <strong style="font-size: 20px; color: #980e25;">$ {{ number_format($totalprice, 0, '.', ' ') }}</strong></p>
											</td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tbody>
										<tr>
											<td style="padding-top: 22px;">
												{{ trans('emails.now_we_suggest') }}: <strong>{{ trans('emails.you_get_in_touch') }} {{ trans('emails.and_explain_your_terms') }}</strong>.
											</td>
										</tr>
										<tr>
											<td style="padding-top: 22px;">{{ trans('emails.any_questions') }} <a style="color: #191919; text-decoration: none;" href="mailto:contacto@aventuraschile.com">contacto@aventuraschile.com</a></td>
										</tr>
										<tr>
											<td style="padding-top: 22px;">
												<p style="margin: 0;">{{ trans('emails.with_regards') }}</p>
												<p style="margin: 0;">{{ trans('emails.aventuraschile_team') }}</p>
												<a style="text-decoration: none; color: #191919;" href="/">aventuraschile.com</a>
											</td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>
</body>
</html>
