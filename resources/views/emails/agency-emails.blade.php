<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <title>ACP Agencia</title>
    <style>
        .timing{
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 14px;
            line-height: 18px;
            font-weight: 400;
        }
        .timing li{
            position: relative;
            border-top: 1px solid #d9d9d9;
            padding: 10px 0 10px 30px;
        }
        .timing li:after{
            width: 18px;
            content: '';
            height: 18px;
            position: absolute;
            left: 3px;
            right: auto;
            bottom: auto;
        }
        .timing li.time{
            border: 0;
            padding-top: 0;
        }
        .timing li.time:after{
            background: url(http://kipmuving.com/images/clock.svg) no-repeat;
            background-size: contain;
            background-position: center center;
            top: 2px;
        }
        .timing li.person:after{
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
        .timing strong{
            display: block;
            font-weight: normal;
        }
        .timing strong.title{
            color: #963d4c;
            font-size: 16px;
            line-height: 20px;
            font-weight: 700;
        }
        .timing span{
            font-weight: bold;
        }
        .footer{
            padding: 20px;
            vertical-align: top;
        }
        .footer p{
            margin: 15px 0;
        }
    </style>
</head>
<body style="margin:0; padding:0; font-size:14px; line-height:18px; font-family:'Lato', sans-serif; min-width:320px !important;"
      bgcolor="#FFFFFF" link="#535353">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top" id="bodyCell">
            <table style="margin:0 auto; width: auto !important; max-width:600px !important; background: #FFF;" cellpadding="0"
                   cellspacing="0" align="center">
                <tr>
                    <td bgcolor="#133939"
                        style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height="82" style="display:block;" style="width:250px !important;
						height:auto !important; overflow:hidden;">
							<a target="_blank" href="/">
								<img src="{{ asset('/images/logo-new.svg') }}" alt="" align="left" vspace="0" hspace="0" style="width:180px !important;">
							</a>
						</span>
                    </td>
                </tr>
                <tr>
                    <td id="main" style=" padding-left:20px; padding-right:20px;">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="font-size:14px; line-height:20px; color:#000000; padding-top:45px; padding-bottom:16px; border-bottom:1px solid #cccccc;">
                                    <span>{!! $msg !!}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td id="footer" class="footer">
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
