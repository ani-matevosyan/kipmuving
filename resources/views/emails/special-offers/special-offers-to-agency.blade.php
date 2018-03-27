<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Aventuras Chile</title>
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
					<a href="{{ asset('/') }}">
						<img src="{{ asset('/images/KeepMoving_logo.svg') }}" style="display: block;" alt="Aventuras Chile" width="171">
					</a>
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="padding: 12px 37px 50px 37px">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr>
							<td style="border-bottom: 1px solid #e0e0e0; padding-bottom: 16px;">
								<p style="margin: 0 0 0 0">{{ trans('emails.hello') }} <strong>{{ $data['agency_name'] }},</strong></p>
								<p style="margin: 0 0 0 0">{{ trans('emails.you_received_special_offer') }}:</p>
							</td>
						</tr>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<td style="border-bottom: 1px solid #e0e0e0; padding-top: 18px; padding-bottom: 20px;">
											<h2 style="font-weight: 700; font-size: 26px; color: #323e5b; margin: 0 0 3px 0;">{{ $data['activity_name'] }}</h2>
											<p style="margin: 0 0 0 0"><strong>{{ trans('emails.date') }}</strong>: {{ $data['date'] }}</p>
											<p style="margin: 0 0 0 0"><strong>{{ trans('main.persons') }}</strong>: {{ $data['persons'] }}</p>
											<p style="margin: 0 0 0 0"><strong>{{ trans('emails.your_price') }}</strong>: $ {{ number_format($data['offer_price'], 0, '.', '.') }}</p>
											<p style="margin: 0 0 0 0"><strong>{{ trans('main.total') }}</strong>: $ {{ number_format($data['total_price'], 0, '.', '.') }}</p>
											<a href="{{ action('SpecialOffersController@sendOfferPage', ['uid' => $data['uid']]) }}" style="font-size: 14px; color: #ffffff; text-transform: uppercase; font-weight: 700; background: #198ccd; border-radius: 4px; display: inline-block; text-decoration: none; padding: 5px 14px 5px 14px; margin-top: 31px;">{{ trans('main.send_special_offer') }}</a>
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
										<td style="padding-top: 17px;">{{ trans('emails.any_questions') }} <a style="color: #191919; text-decoration: none;" href="mailto:contacto@aventuraschile.com">contacto@aventuraschile.com</a></td>
									</tr>
									<tr>
										<td style="padding-top: 17px;">{{ trans('emails.with_regards') }}</td>
									</tr>
									<tr>
										<td style="padding-top: 17px;">
											<strong style="display: block">{{ trans('emails.aventuraschile_team') }}</strong>
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
	</tr>
	</tbody>
</table>
</body>
</html>
