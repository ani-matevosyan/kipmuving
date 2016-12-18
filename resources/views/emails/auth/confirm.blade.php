<body style="margin:0; padding:0; font-size:14px; line-height:18px; font-family:'Trebuchet MS', Verdana, sans-serif;"
		bgcolor="#f6f6f6" link="#535353">
<style type="text/css">
	body {
		min-width: 320px !important;
	}

	.wrapper {
		margin: 0 auto;
		width: 600px !important;
	}

	@media (max-width: 639px) {
		.wrapper {
			width: auto !important;
			max-width: 600px !important;
		}

		.logo {
			width: 250px !important;
			height: auto !important;
			overflow: hidden;
		}

		.logo img {
			width: 250px !important;
		}

		.intro {
			font-size: 14px !important;
			line-height: 18px !important;
		}
	}
</style>

<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
	<tr>
		<td align="center" valign="top" id="bodyCell">
			<table class="wrapper" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td class="header" bgcolor="#133939"
						 style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height="82" style="display:block;" class="logo">
							<img src="{{ url('/images/logo.png') }}" alt="" align="left" vspace="0" hspace="0">
						</span>
					</td>
				</tr>
				<tr>
					<td id="main" style=" padding-left:20px; padding-right:20px;">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td class="intro"
									 style="font-size:16px; line-height:20px; color:#000000; padding-top:30px; padding-bottom:30px; border-bottom:1px solid #cccccc;">
									<h3 style="display:block; ">{{ trans('emails.hello') }}
										<strong>{{ $user['first_name'] }}</strong>, {{ trans('emails.thanks_for_joining') }}</h3>
									{{ trans('emails.confirm_mail_message') }}
									<br>
									<br>
									<strong style="display:block; font-weight:bold;">{{ trans('emails.please_activate_your_account_here') }}:</strong>
									{{ action('UserController@confirmUser', $user['confirmation_code']) }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td id="footer" valign="top"
						 style="padding-left:20px; padding-top:20px; padding-right:20px; padding-bottom:20px;">
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
