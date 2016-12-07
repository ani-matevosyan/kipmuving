@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="#">HOME</a></li>
						<li><a href="#">SU AGENDA</a></li>
						<li>RESERVA</li>
					</ul>
					<div class="your-reservation">

						@if (! empty($message))
							<header class="head">
								<h1>{{ $message }}</h1>
								<p>Desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de
									textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno
									en documentos electrónicos,.</p>
							</header>
						@else
							<header class="head">
								<h1>Último paso para confirmar</h1>
								<strong class="sub-title">
									<span>Muchas gracias <a
											href="#">{{ $user['username'] ? $user['username'] : $user['first_name'] }}</a> por su reserva.</span>
								</strong>Siga abajo sus actividades. Ahora sólo queda un paso para confirmar su reserva. Revise
								sus actividades y garantiza su cupo.</span>
							</header>
						@endif

						<div class="row">
							<div class="col-md-9 col-sm-12 col-xs-12">
								<ul class="accordion">
									{{--{{ dd($offers[0]) }}--}}
									@foreach ($offers as $offer)
										<li>
											<header>
												<div class="ico">
													<img src="/{{ $offer['activityData']['image_icon'] }}"
														  onerror="this.src='/images/image-none.jpg';"
														  alt="agency image">
												</div>
												<div class="text">
													<h2>
														<a href="#">{{ $offer['activityData']['name'] }}</a>
													</h2>
													<strong
														class="sub-title">{{ $offer['agencyData']['name'] }} <!--<span>O`Higgins Nº211-C </span>--></strong>
												</div>
											</header>
											<div class="row">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<div class="list-box">
														<strong class="title">Qué incluye</strong>
														<p>
														<ul class="list">
															@foreach ($offer['offerData']['includes'] as $include)
																<li>{{ $include }}</li>
															@endforeach
														</ul>
														</p>
														<!-- <ul class="list">
															<li>Ropa abrigada</li>
															<li>Lentes de sol + crema solar</li>
															<li>Comida y bebida</li>
															<li>Efectivo (para la tellesila y las propinas de los guias)</li>
														</ul> -->
													</div>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<ul class="timing">
														<li class="time">
															<strong class="title">
																Día: {{ $offer['offerData']['date'] }}
															</strong>
															<strong>
																<span>Duracion:</span> {{ $offer['offerData']['end_time'] - $offer['offerData']['start_time'] }}
																hrs
															</strong>
															<strong>
																<span>Horario:</span> {{ \Carbon\Carbon::parse($offer['offerData']['start_time'])->format('H:i') }}
																a {{ \Carbon\Carbon::parse($offer['offerData']['end_time'])->format('H:i') }}
															</strong>
														</li>
														<li class="person">
															<strong>
																<span>{{ $offer['offerData']['persons'] }}</span> persona
															</strong>
														</li>
													</ul>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<strong class="price">
														<sub>$</sub> {{ number_format($offer['offerData']['persons'] * $offer['offerData']['price'], 0, '.', '.') }}
													</strong>
												</div>
											</div>
											<div class="important">
												<strong class="title">Importante:</strong>
												<p>{{ $offer['offerData']['important'] }}</p>
											</div>
										</li>
									@endforeach
								</ul>
								@if (empty($message))
									<div class="box">
										<p>Para garantizar su reserva, haremos el cobro de apenas <strong>10% del total de su
												panorama </strong>en su tarjeta de crédito.
											¿Porque hacemos esto? <strong>Para garantizar que reamente quieres hacer esta
												actividad</strong>, así las agencias pueden se
											programar y reservar su cupo. Muchas trabajan con pocas personas, así que es importante
											confirmar su presencia.
											La diferencia será paga en la agencia en el día de su actividad.
										</p>
										<p>
											El valor que cargaremos en su tarjeta de crédito es de
											<strong>$ {{ number_format($total_cost/10, 0, '.', '.') }} pesos
												(U$ {{ number_format($total_cost/6900) }} dólares)</strong> referente a todas sus
											actividades.
											Y tienes a pagar en a agencia, la diferencia de
											<strong>$ {{ number_format($total_cost*9/10,  0, '.', '.') }} pesos</strong>.
										</p>
										<div class="row carrito-bar">
											<div class="col-xs-4 item item1">
												<div class="wrapper">
													<div class="title">Garantía de su reserva</div>
													<div class="details">$ {{ number_format($total_cost/10,  0, '.', '.') }}</div>
												</div>
											</div>
											<div class="col-xs-3 item item2">
												<div class="wrapper">
													<div class="title">Pagar diferencia Agencias</div>
													<div class="details">$ {{ number_format($total_cost*9/10,  0, '.', '.') }}</div>
												</div>
											</div>
											<div class="col-xs-5 item item3">
												<div class="wrapper">
													<div class="title">Donaremos para la organización</div>
													<div class="details">Parques para Chile
														$ {{ number_format($total_cost/1000,  0, '.', '.') }}</div>
												</div>
											</div>
										</div>
										<p class="carrio-heading">Para cancelar su reserva</p>
										<p>
											Usted puede cancelar su panorama de forma gratuita hasta <strong>3 días</strong> antes
											de su actividad. Antes de esa fecha, los depósitos prévios de garantía son
											reembolsables.
										</p>
										<p class="carrio-heading">La actividad no ocurrió por el clima o cantidad de personas</p>
										<p>
											Avisaremos con antecipación para que pueda programarse y también le iremos proponer
											otra actividad que pueda
											ser hecha. El valor pago de la garantía de esta actividad, será devuelta a su tarjeta
											de crédito.
										</p>
										<p class="carrio-heading">Información general</p>
										<p>
											Tenga en cuenta que está contratando <strong>las agencias </strong>. KipMuving.com
											facilita su contrato con el
											proveedor de actividades en Pucón a través del uso de su sistema de reserva. Imprima
											una copia de este formulario
											de reserva y de los Términos y condiciones y guárdelos como referencia.
										</p>
									</div>
									<div class="row">
										<div class="col-xs-6">
											<img src="/images/stripe.jpg"/>
											<button id="stripe-pay" class="btn btn-pay stripe">CONFIRMAR TARJETA</button>
											<script src="https://checkout.stripe.com/checkout.js"></script>
											<script>
                                     var handler = StripeCheckout.configure({
                                         key: "{{ config('app.stripe_publishable_key') }}",
                                         image: "/images/logo-pucon.png",
                                         name: "Kipmuving",
                                         description: "Kipmuving Adventures",
                                         allowRememberMe: false,
                                         amount: "{{ number_format($total_cost / 69, 0, '.', '') }}",
                                         token: function (token) {
                                             var stripeToken = token.id;
                                             var url = window.location.href = "/reserve";
                                             var form = $('<form action="' + url + '" method="post">' +
                                                 '<input type="text" name="stripeToken" value="' + stripeToken + '" />' +
                                                 '</form>');
                                             $('body').append(form);
                                             form.submit();
                                         }
                                     });
                                     document.getElementById('stripe-pay').addEventListener('click', function (e) {
                                         handler.open();
                                         e.preventDefault();
                                     });
											</script>
										</div>
										<div class="col-xs-6">
											<img src="/images/paypal.jpg"/>
											<button type="button" class="btn btn-pay paypal">CONFIRMAR PAYPAL</button>
											<form name='_xclick' action='{{	config('app.paypal_url') }}' method='post'>
												<input type='hidden' name='cmd' value='_xclick'>
												<input type='hidden' name='business'
														 value='{{ config('app.paypal_merchant_email') }}'>
												<input type='hidden' name='currency_code' value='USD'>
												<input type='hidden' name='item_name' value='Kipmuving Activities Reservation'>
												<input type='hidden' name='custom' value='{{ count($offers) }}'>
												<input type='hidden' name='amount'
														 value='{{ number_format($total_cost / 6900, 1) }}'>
												<input type='hidden' name='no_shipping' value='1'>
												<input type='hidden' name='rm' value='2'>
												<input type='hidden' name='return' value='{{ URL::to('/reserve') }}'>
												<input type='hidden' name='cancel_return' value='{{ URL::to('/reserve') }}'>
												<input type='hidden' name='notify_url' value='{{ URL::to('/paypal/notify') }}'>
											</form>
											<script>
                                     $(document).ready(function () {
                                         $('.btn-pay.paypal').click(function (event) {
                                             event.preventDefault();
                                             document._xclick.submit();
                                             return false;
                                         });
                                     });
											</script>
										</div>
									</div>
								@endif


								{{--@if (empty($message))--}}

								{{--@endif--}}

							</div>
							<div class="col-md-3 col-sm-12 col-xs-12">
								<section class="program-schedule">
									<h2>su programa</h2>
									<strong class="sub-title"><span>{{ count($offers) }}</span> actividades</strong>
									<ul class="offers-list">
										<?php $oid = 0; ?>
										@foreach ($offers as $offer)
											<li>
												<a href="#"	data-oid={{ $oid }}>
													{{ $offer['offerData']['date'] }} - {{ $offer['activityData']['name'] }}
												</a>
											</li>
										<!-- <span>$ {{ number_format($offer['offerData']['price'] * $offer['offerData']['persons'], 0, '.', '.') }}</span> -->
											<?php
											$oid = $oid + 1;
											?>
										@endforeach
									</ul>
									<footer class="footer">
										<!-- <a href="javascript:void(0)" class="btn-reservar btn btn-primary">Carrito</a> -->
										<strong class="total-price">$ {{ number_format($total_cost, 0, '.', '.') }}</strong>
									</footer>
								</section>
								<section class="important-block" style="padding-bottom: 0px;">
									<div class="box alert">
										<h2>Importante</h2>
										<strong class="sub-title">Como funciona su reserva</strong>
										<p>Nosotros tenemos el objetivo de presentar las mejores opciones de paseos en Pucón para
											que puedas elegir teniendo el completo panorama y empezar a planificar su viaje y
											aprovechar todo del destino.</p>
										<p>Mostramos las mejores ofertas de todas agencias con sus atractivos. Cuando hace la
											reserva, hacemos la confirmación con la agencia. Recuerda que el destino donde el clima
											influye en la actividad. Que haremos:</p>
									</div>
								</section>
								<div class="img-chart">
									<img src="/images/boxhowork.svg"
										  alt="image description"
										  width="250"
										  height="30"
										  onerror="this.onerror=null; this.src='images/img-chart.jpg'">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@stop
