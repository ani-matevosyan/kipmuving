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
                                <p style="margin: 0 0 0 0">{{ trans('emails.hello') }} <strong>User name,</strong></p>
                                <p style="margin: 0 0 0 0">{{ trans('emails.thank_you_very_much') }} <strong><a href="/" style="color: #191919; text-decoration: none;">KeepMoving</a></strong> {{ trans('emails.below_you_have') }}</p>
                                <p style="margin: 20px 0 0 0">{{ trans('emails.what_do_you_have_to_do') }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td style="border-bottom: 1px solid #e0e0e0; padding-top: 18px; padding-bottom: 20px;">
                                            <h2 style="font-weight: 700; font-size: 26px; margin: 0 0 3px 0;"><a href="#" style="color: #323e5b; text-decoration: none;">Activity name</a></h2>
                                            <p style="margin: 0 0 0 0"><strong>{{ trans('emails.date') }}</strong>: 18/12/2017</p>
                                            <p style="margin: 0 0 0 0"><strong>{{ trans('main.persons') }}</strong>: 3</p>
                                            <p style="margin: 0 0 0 0"><strong>{{ trans('main.duration') }}</strong>: 4hrs , 12:00 at 16:00</p>
                                            <p style="margin: 20px 0 0 0;"><strong>{{ trans('main.agency') }}</strong>: <strong><a href="#" style="color: #3097d2; text-decoration: none;">Agency name</a></strong></p>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td>O`Higgins Nº211-C</td>
                                                        <td style="border-left: 1px solid #191919; padding-left: 13px;">
                                                            <a href="#" style="color: #191919; text-decoration: none;">contacrto@aguiventura.com</a>
                                                        </td>
                                                        <td style="border-left: 1px solid #191919; padding-left: 13px;">
                                                            +56962266304
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p style="margin: 20px 0 0 10px;"><strong>{{ trans('emails.what_includes') }}</strong></p>
                                            <ul style="margin: 0 0 0 0; padding: 0 0 0 0; list-style: none;">
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Transporte ida/vuelta</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Entrada al Parque Nacional</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">1 guía profesional para 6 personas</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Seguro</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Guía Certificado</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Chaqueta de Ipora</li>
                                                <li style="background-image: url({{ asset('/images/bullet-icon.png') }}); background-position: 0 9px; background-size: 3px; background-repeat: no-repeat; position: relative; padding: 0 0 0 10px;">Pantalón de Cordura</li>
                                            </ul>
                                            <p style="margin: 20px 0 0 0; font-size: 17px;"><strong>{{ trans('emails.offer_price') }}</strong>: <strong style="color: #3097d2;">$120.000</strong></p>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 29px;">
                                                <tbody>
                                                <tr>
                                                    <td style="color: #fff; background-color: #963d4c; background-image: url({{ asset('/images/warning-white.svg') }}); background-position: 12px 16px; background-repeat: no-repeat; background-size: 19px 17px; padding: 7px 0 18px 50px;">
                                                        <strong>{{ trans('emails.important') }}:</strong>
                                                        <p style="font-size: 14px; margin: 0 0 0 0;">Deberás presentarte 1 día antes en la dirección de la agencia para pagar sus actividades y probar equipos si es necesario.</p>
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
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td style="padding-top: 17px;">{{ trans('emails.any_questions') }} <a style="color: #191919; text-decoration: none;" href="mailto:contacto@keepmoving.co">contacto@keepmoving.co</a></td>
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
