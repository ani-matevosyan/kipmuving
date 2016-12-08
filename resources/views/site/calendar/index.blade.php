@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="#">HOME</a></li>
						<li>SU AGENDA</li>
					</ul>
					<div class="row">

						<header class="head">
							<h1>Su panorama en Pucón</h1>
							<p>
								<span>
									<strong class="sub-title">Aquí está su agenda.</strong> Este es el panorama que estás creando en sus vacaciones en Pucón. <Br/>
									Puede seguir incluyendo actividades o finalizar con la reserva. Para esto, precione en el botón <strong>RESERVAR</strong>.
								</span>
							</p>
							<br/>
							<a href="{{ action('ActivityController@index') }}"
								class="calendarbtnactividades">INCLUIR MÁS ACTIVIDADES</a>
							<Br/><Br/>
						</header>

						<div class="col-md-9 col-sm-12 col-xs-12">
							<div class="alert alert-danger alert-overlap ">Hay actividades en el mismo día, por favor, deje
								apenas una actividad por día antes de seguir con su reserva. Puedes mover la actividad de un día
								al otro, o simplesmente eliminarla.
							</div>
							<br>
							<div id='calendar' data-date="{{ $viewDate }}"></div>
							<br>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12">
							<section class="s_suprogram">
								<header>
									<h3>Su programa</h3>
									<p><span id="count_activities">{{ $count['offers'] }}</span> actividades</p>
								</header>
								<ul class="offers-list">
									<?php $total_cost = 0; ?>
									@foreach ($selectedOffers as $offer)
										<li>
											<a href="#">
												<h4>{{ $offer['name'] }}</h4>
												<span>{{$offer['price_offer'] * $offer['persons']}}</span>
											</a>
										</li>
										<?php
										$total_cost += $offer['price_offer'] * $offer['persons'];
										?>
									@endforeach
								</ul>
								<div class="total">
									<div class="totalprice">
										<p>{{ number_format($total_cost, 0, ".", ".") }}</p>
										<span>total em pesos</span>
									</div>
									<?php $total_discount = $total_cost * 0.9 ?>
									<div class="discount">
										<span>está economizando</span>
										<p>{{ number_format($total_discount, 0, ".", ".") }}</p>
									</div>
								</div>
								<a class="btn-reservar reserve">Reservar este panorama</a>
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
		</div>
	</main>

	<script>

       jQuery(document).ready(function () {


       });
	</script>
@stop
