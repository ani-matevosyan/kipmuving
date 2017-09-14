<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>KeepMoving</title>
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body style="font-family: 'PT Sans', sans-serif; font-size: 16px; font-weight: 400;  min-width: 320px !important; margin: 0; padding: 0; color: #191919;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr style="padding: 10px 0 30px 0;">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
			<tbody>
			<tr>
				<td align="left" bgcolor="#383838" style="padding: 7px 10px 6px 38px; color: #FFCD06; font-size: 32px;">
					<a href="/">
						<img src="{{ asset('/images/KeepMoving_logo.svg') }}" style="display: block;" alt="KeepMoving" width="171">
					</a>
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="padding: 12px 37px 50px 37px">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr>
							<td style="border-bottom: 1px solid #e0e0e0; padding-bottom: 16px;">
								<p style="margin: 0 0 0 0">{{ trans('emails.hello') }} <strong>{{ $reservation->offers[0]->agency->name }},</strong></p>
								<p style="margin: 0 0 0 0">{{ trans('emails.congratulations') }}:</p>
							</td>
						</tr>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									@foreach($reservation->offers as $offer)
										<tr>
											<td style="border-bottom: 1px solid #e0e0e0; padding-top: 18px; padding-bottom: 20px;">
												<h2 style="font-weight: 700; font-size: 26px; margin: 0 0 3px 0;">
													<a href="{{ action('ActivityController@getActivity', ['id' => $offer->activity->id]) }}" style="color: #323e5b; text-decoration: none;">{{ $offer->activity->name }}</a>
												</h2>
												<p style="margin: 0 0 0 0">
													<strong>{{ trans('emails.date') }}</strong>: {{ $offer->reservation['date'] }}
												</p>
												<p style="margin: 0 0 0 0">
													<strong>{{ trans('main.persons') }}</strong>: {{ $offer->reservation['persons'] }}
												</p>
												<p style="margin: 20px 0 0 0;">
													<strong>{{ trans('emails.guests_information') }}</strong>
												</p>
												<p style="margin: 0 0 0 0">
													<strong>{{ trans('form.name') }}</strong>: {{ $user->first_name . ' ' . $user->last_name }}
												</p>
												<p style="margin: 0 0 0 0">
													<strong>{{ trans('form.email') }}</strong>:
													<a href="mailto:{{ $user->email }}" style="color: #191919; text-decoration: none;">{{ $user->email }}</a>
												</p>
												<p style="margin: 0 0 0 0">
													<strong>{{ trans('emails.phone_number') }}</strong>: {{ $user->phone }}
												</p>
												<p style="margin: 20px 0 0 0; font-size: 17px;">
													<strong>{{ trans('emails.offer_price') }}</strong>: <strong style="color: #3097d2;">$ {{ number_format($reservation->total['CLP'], 0, '.', '.') }}</strong>
												</p>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<td style="padding-top: 17px;">{{ trans('emails.now_you_can_talk') }}</td>
									</tr>
									<tr>
										<td style="padding-top: 17px;">{{ trans('emails.any_questions') }} <a style="color: #191919; text-decoration: none;" href="mailto:contacto@keepmoving.co">contacto@keepmoving.co</a>
										</td>
									</tr>
									<tr>
										<td style="padding-top: 17px;">{{ trans('emails.with_regards') }}</td>
									</tr>
									<tr>
										<td style="padding-top: 17px;">
											<strong style="display: block">{{ trans('emails.kipmuving_team') }}</strong>
											<a style="text-decoration: none; color: #191919;" href="/">keepmoving.co</a>
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
	</tr>
	</tbody>
</table>
</body>
</html>
