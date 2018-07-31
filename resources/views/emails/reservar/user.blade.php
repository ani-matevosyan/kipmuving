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
			background: url({{ asset('images/clock.svg') }}) no-repeat;
			background-size: contain;
			background-position: center center;
			top: 2px;
		}

		.timing li.person:after {
			background: url( {{ asset('images/happy.svg') }} ) no-repeat;
			background-size: contain;
			background-position: center center;
			top: 10px;
		}

		.timing li.money:after {
			background: url( {{ asset('images/coin.svg') }} ) no-repeat;
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
			background: url( {{ asset('images/warning-white.svg') }}) no-repeat;
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
			padding: 7px 30px 20px 30px;
			vertical-align: top;
		}

		.footer p {
			margin: 20px 0;
		}
		@media only screen and (max-width: 480px) {
			h2 {
				font-size: 25px !important;
				line-height: 125% !important;
			}
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
					<td bgcolor="#f6f6f6"
							style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height="82" style="display:block;" style="width:250px !important;
						height:auto !important; overflow:hidden;">
								<a target="_blank" href="{{ asset('/') }}">
								<img src="{{ asset('/images/siteImages/email-header-logo.png') }}" alt="" align="left" vspace="0" hspace="0"
										 style="width:180px !important;">
							</a>
						</span>
					</td>
				</tr>
				<tr>
					<td id="main" style=" padding-left:30px; padding-right:30px;">
						<table cellpadding="0" cellspacing="0" style="width: 100%; border-bottom: 1px solid #CCCCCC;">
							<tr>
								<td
									style="font-size:15px; line-height:20px; color:#000000; padding-top:29px; padding-bottom:16px; border-top: 1px solid #cccccc;">
									{{ trans('emails.hello') }} <strong style="font-weight:bold;">{{ $user->first_name }} {{ $user->last_name }}</strong>
									<div>
										<img width="15px" height="15px" src="{{ asset('/images/siteImages/clapping.png') }}" />
										<img width="15px" height="15px" src="{{ asset('/images/siteImages/clapping.png') }}" />
										{{ trans('main.congratulations') }}!! {{ trans('emails.it_has') }}
										<span style="color:#980e25; font-weight:bold;">{{ count($reservation->offers) }}</span>
										{{ trans('emails.reserved') }}.
									</div>
								</td>
							</tr>
							@foreach($reservation->offers as $offer)
								<tr>
									<td
										style="padding-top:20px; padding-bottom:20px;">
										<table cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td style="padding-bottom:8px;" colspan="2">
													<table cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<h2 style="margin-top:0; margin-bottom: 5px; font-size:31px; line-height:20px; color:#198ccd;">
																	{{ $offer->activity->name }}
																</h2>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr style="width:100%; font-size: 15px;">
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<div>
														<div>
															{{ trans('emails.day') }}
															<span style="color:#980e25; font-weight:bold;">
																{{ $offer->reservation['date'] }}
															</span>
														</div>
														<div>
															{{ trans('emails.total_persons') }}
															<span style="color:#980e25; font-weight:bold;">
																{{ $offer->reservation['persons'] }}
															</span>
														</div>
														<div>
															{{ trans('emails.total_activity') }}
															<span style="color:#980e25; font-weight:bold;">
																$ {{ number_format($offer->real_price * $offer->reservation['persons'], 0, '.', ' ') }} CLP
															</span>
														</div>
													</div>

												</td>
												<td style="width:50%; padding-bottom:20px;" valign="top" >
													<strong style="display:block; font-weight:bold; padding-left:20px;">
														{{ trans('emails.data_of_the_agency') }}:
													</strong>
													<div style=" padding-left:20px;">
														<div>
															{{ $offer->agency->name }}
														</div>
														<div>
															{{ $offer->agency->address }}
														</div>
														<div>
															{{ $offer->agency->whatsapp }}
														</div>
														<div>
															{{ $offer->agency->email }}
														</div>
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
					<td id="footer" class="footer" style="font-size: 15px">
						<p>{{ trans('emails.agencies_received_confirmation_email') }}</p>
						<p>
							{{ trans('emails.any_questions') }}
							<a href="mailto:contacto@aventuraschile.com">contacto@aventuraschile.com</a>
						</p>
						<div>{{ trans('emails.with_regards') }}</div>
						<p style="margin-bottom: 0; margin-top: 0">Aventuras Chile</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
