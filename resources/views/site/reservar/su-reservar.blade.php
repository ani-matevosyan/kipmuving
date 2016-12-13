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
                    <section class="s_reservar">
					<div class="your-reservation">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12">
						@if (! empty($message))
							<header class="head">
								<h1>{{ $message }}</h1>
								<p>Desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de
									textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno
									en documentos electrónicos,.</p>
							</header>
						@else
							<header class="head">
								<h1>Estas son sus actividades</h1>
                                <p>Por favor <a href="#">{{ $user['username'] ? $user['username'] : $user['first_name'] }}</a> confirme abajo las actividades que hará en Pucón los días seleccionados</p>
							</header>
						@endif
								<ul class="accordion">
									@foreach ($offers as $offer)
										<li class="accordion-li">
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
													<strong	class="sub-title">{{ $offer['agencyData']['name'] }} <!--<span>O`Higgins Nº211-C </span>--></strong>
												</div>
											</header>
                                            <div class="activity_description">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <div class="list-box">
                                                            <strong class="title">Debes llevar</strong>
                                                            <ul class="list">
                                                                @foreach ($offer['offerData']['includes'] as $include)
                                                                    <li>{{ $include }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
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
                                                </div>
                                                <strong class="price">
                                                    <sub>$</sub> {{ number_format($offer['offerData']['persons'] * $offer['offerData']['price'], 0, '.', '.') }}
                                                </strong>
                                            </div>
											<div class="important">
												<strong class="title">Importante:</strong>
												<p>{{ $offer['offerData']['important'] }}</p>
											</div>
										</li>
									@endforeach
								</ul>
								@if (empty($message))
                                    <section class="s_moredetails">
                                        <header>
                                            <h3><i class="fa fa-plus-circle" aria-hidden="true"></i> Más detalles</h3>
                                        </header>
                                        <p>Para confirmar suas atividades, pressione o botõe <strong>RESERVAR ESTE PANORAMA.</strong>Faça a confirmação com o pagamento da taxa de serviço de apenas <strong>U$ 5 dólares.</strong> Em seguida te chegará um email com os detalhes da reserva.</p>
                                        <p class="carrio-heading">Para cancelar su reserva</p>
                                        <p>Chegará ao seu email os dados da agencia e deverá entrar em contato com ela para cancelar qualquer reserva,
                                            também adiantar datas ou ter mais informações.</p>
                                        <p class="carrio-heading">Información general</p>
                                        <p>Tenga en cuenta que está contratando las agencias no a KipMuving.com. KipMuving.com facilita su contrato con el proveedor de actividades en Pucón a través del uso de su sistema de reserva. Imprima una copia de este formulario de reserva y de los Términos y condiciones y guárdelos como referencia.</p>
                                    </section>
								@endif

							</div>
							<div class="col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
								<section class="s_suprogram">
									<header>
										<h3>Su programa</h3>
										<p><span id="count_activities">{{ count($offers) }}</span> actividades</p>
									</header>
									<ul class="offers-list">
										@foreach ($offers as $offer)
											<li>
												<a href="#">
													<h4>{{ $offer['activityData']['name'] }}</h4>
													<span>{{number_format($offer['offerData']['price'] * $offer['offerData']['persons'], 0, '.', '.')}}</span>
                                                </a>
											</li>
										@endforeach
									</ul>
									<div class="total">
										<div class="totalprice">
											<p>{{ number_format($total_cost, 0, ".", ".") }}</p>
											<span>total em pesos</span>
										</div>
										<?php $total_discount = $total_cost * 0.1 ?>
										<div class="discount">
											<span>está economizando</span>
											<p>{{ number_format($total_discount, 0, ".", ".") }}</p>
										</div>
									</div>
									<a href="#" class="btn-reservar reserve" data-toggle="modal" data-target="#PaymentModal">Reservar este panorama</a>
									<div class="note">
										* valor aproximado
									</div>
								</section>
								<section class="s_howitworks_sidebar">
									<div class="section-container">
										<header>
											<h3>Como funciona <span>KipMuving</span></h3>
										</header>
										<div class="item percent">
											<img src="images/10-grey.svg" alt="10%">
											<p>Acordo realizado com as agencias locais</p>
										</div>
										<div class="item umbrella">
											<img src="images/umbrella-grey.svg" alt="umbrella">
											<p><span>Apoianos</span> com um pequena comissão de <span>U$ 5 </span> pagar a manutenção do site, etc.</p>
										</div>
										<div class="item broklink">
											<img src="images/broken-link-grey.svg" alt="broken-link">
											<p>Fazemos a união sua com a agencia. Você paga seus passeios diretamente com eles.</p>
										</div>
									</div>
									<div class="payment">
										<span>Pode usar:</span>
										<a href="#">
											<img src="images/stripe.png" alt="Stripe">
										</a>
										<a href="#">
											<img src="images/paypal.png" alt="PayPal">
										</a>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
                </section>
			</div>
		</div>
	</main>
    <div class="payment-modal modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Como quer confirmar su reserva?</h4>
                </div>
                <div class="modal-body">
                    <div class="payment-way stripe-way">
                        <img src="images/stripe.png" alt="Stripe">
                        <button id="stripe-pay" type="button">CONFIRMAR TARJETA</button>
                        <script src="https://checkout.stripe.com/checkout.js"></script>
                        <script>
                            var handler = StripeCheckout.configure({
                                key: "pk_test_Ozq7fWW5gnapw15qY6HmkQvs",
                                image: "/images/logo-tent.png",
                                name: "Kipmuving",
                                description: "Kipmuving Adventures",
                                allowRememberMe: false,
                                amount: "{{(((count($offers))*$persons)*5)*100}}",
                                token: function (token) {
                                    $.ajax({
                                        type: "POST",
                                        url: "/reserve",
                                        data: {
                                            '_token': $('meta[name="csrf-token"]').attr('content'),
                                            token: token
                                        },
                                        success: function(){
                                            alert("Your payment has been accepted");
                                        },
                                        error: function(err){
                                            console.log(err);
                                        }
                                    })
                                }
                            });
                            document.getElementById('stripe-pay').addEventListener('click', function (e) {
                                handler.open();
                                e.preventDefault();
                            });
                        </script>
                    </div>
                    <div class="payment-way paypal-way">
                        <img src="images/paypal.png" alt="PayPal">
                        <button id="paypal-pay" type="button">CONFIRMAR PAYPAL</button>
                        <form name='_xclick' action='{{	config('app.paypal_url') }}' method='post'>
                            <input type='hidden' name='cmd' value='_xclick'>
                            <input type='hidden' name='business'
                                   value='{{ config('app.paypal_merchant_email') }}'>
                            <input type='hidden' name='currency_code' value='USD'>
                            <input type='hidden' name='item_name' value='Kipmuving Activities Reservation'>
                            <input type='hidden' name='custom' value='{{ count($offers) }}'>
                            <input type='hidden' name='amount'
                                   value='{{(((count($offers))*$persons)*5)*100}}'>
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
            </div>
        </div>
    </div>
@stop
