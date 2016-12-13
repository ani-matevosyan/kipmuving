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
	bgcolor="#f6f6f6" link="#535353">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
	<tr>
		<td align="center" valign="top" id="bodyCell">
			<table style="margin:0 auto; width: auto !important; max-width:600px !important;" cellpadding="0"
					 cellspacing="0" align="center">
				<tr>
					<td class="header" bgcolor="#133939"
						 style="padding-top:15px; padding-right:15px; padding-bottom:15px; padding-left:15px;">
						<span width="340" valign="top" height:"82" style="display:block;" style="width:250px !important;
						height:auto !important; overflow:hidden;"><img src="{{ url('/images/logo1.png') }}" alt=""
																					  align="left" vspace="0" hspace="0"
																					  class="width:250px !important;"></span>
					</td>
				</tr>
				<tr>
					<td id="main" style=" padding-left:20px; padding-right:20px;">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td class="intro"
									 style="font-size:16px; line-height:20px; color:#000000; padding-top:30px; padding-bottom:30px; border-bottom:1px solid #cccccc;">
									<strong
										style="font-weight:bold;">Hola {{ $data['user_first_name'] }} {{ $data['user_last_name'] }}</strong>,
									muchas gracias por reservar con Kipmuving. Sigue abajo la confirmación de su reserva.<br><br>
									<p>¿Qué haremos ahora? Vamos a confirmar todos los paseos con las agencias. Sabemos que
										algunas están sujetas a disponibilidad por la cantidad de personas y también del clima.
										Caso alguna actividad no suceda, volveremos a comunicar contigo para ofrecer otra opción.
										<br><br></p>
									<strong style="display:block; font-weight:bold;">Actividades que reservaste:</strong>
								</td>
							</tr>
							@foreach($data['offers'] as $offer)
								<tr>
									<td style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px; border-bottom:1px solid #cccccc;">
										<table cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td style="padding-bottom:20px;" colspan="2">
													<table cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td width="51" height="39" valign="middle"
																 style="font-size:0; line-height:0; padding-right:20px;">
																<img src="{{ url($offer['activity_icon']) }}"
																	  alt="activity image" align="left" vspace="0" hspace="0">
															</td>
															<td>
																<h2 style="margin-top:0; margin-bottom:0;"><span
																		style="font-size:31px; line-height:35px; color:#089f02;">{{ $offer['activity_name'] }}</span>
																</h2>
																<strong
																	style="font-size:22px; line-height:26px; font-weight:bold; display:block;">{{ $offer['agency_name'] }}</strong>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<strong style="display:block; font-weight:bold; padding-left:10px;">Debes
														llevar:</strong>
													<p>{{ $offer['offer_carry'] }}</p>
												</td>
												<td style="width:50%; padding-bottom:20px;" valign="top">
													<strong style="font-size:16px; line-height:20px; color:#963d4c; font-weight:bold; display:block; padding-left:25px; background:url(ico1.png) no-repeat;">Día: {{ $offer['offer_date'] }}</strong>
													<span style="display:block; margin-left:25px;"><strong>Duracion:</strong> {{ max(0, $offer['offer_end_time'] - $offer['offer_start_time']) }}
														hrs</span>
													<span
														style="display:block;
														border-bottom:1px solid #cccccc;
														padding-bottom:10px;
														margin-left:25px;"><strong>Horario:</strong> {{ date('H:i', strtotime($offer['offer_start_time'])) }} a {{ date('H:i', strtotime($offer['offer_end_time'])) }}
													</span>
													<span style="display:block; padding-left:25px; padding-top:10px; background:url(ico2.png) no-repeat; background-position:0 10px;"><strong>{{ $offer['offer_persons'] }}</strong> Persona</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" bgcolor="#913b49"
													 style="padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:40px; color:#ffffff; background:url(ico3.png) no-repeat; background-color:#913b49; background-position:10px 14px;">
													<strong
														style="display:block; font-size:16px; line-height:20px; font-weight:bold;">Importante:</strong>
													Deberá presentarte 1 dia antes en la dirección de la agencia<br>
													O’Higgins 221 para probar sapatos.
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
						Total a pagar en la agencia es de <span
							style="color:#980e25; font-weight:bold;">$ {{ $data['total_cost'] }} pesos.</span> Cada agencia
						tiene su política de cancelación, esté atento a ellas en el momento de su reserva. Pero normalmente
						puedes cancelar hasta 1 día antes de su actividad. En este caso, te devolveremos los 10% cancelado.
						<br>
						<br>
						Caso no apareazca en el día de su aventura, será cobrado un valor de <span
							style="color:#980e25; font-weight:bold;">10% como multa.</span>
						<br>
						<br>
						Cualquier duda por favor, escribíamos. Estaremos
						atentos a lo que necesites. Nuestro correo es
						<a href="mailto:contacto@kipmuving.com">contacto@kipmuving.com</a> y también por el teléfono
						+56 45 2444035. O por el whatsapp +56962266304
						<br>
						<br>
						Saludos.
						<br>
						<br>
						Equipo Kipmuving
						<br>
						<br>
						<br>
						<span style="display:block; text-align:center;"><a href="#" style="color:#000000; text-decoration:none;">www.kipmuving.com</a></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
