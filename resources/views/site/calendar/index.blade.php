@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li>{{ trans('main.your_agenda') }}</li>
					</ul>
					<div class="row">
						<header class="head">
							<h1>{{ trans('main.your_panorama_in_pucon') }}</h1>
							<p>
								<span>
									<strong
										class="sub-title">{{ trans('main.here_is_your_schedule') }}</strong> {{ trans('main.panorama_your_vacation') }}
									<Br/>
									{{ trans('main.you_can_include_activities') }} <strong>{{ trans('main.reserve') }}</strong>.
								</span>
							</p>
							<br/>
							<a href="{{ action('ActivityController@index') }}"
								class="btn btn-success btn-success-cal">{{ trans('main.include_more_activities') }}</a>
							<Br/><Br/>
						</header>

						<div class="col-md-9 col-sm-12 col-xs-12">
							<div class="alert alert-danger alert-overlap ">
								{{ trans('main.the_are_activities_of_the_same_day') }}
							</div>
							<br>
							<div id='calendar' data-date="{{ $viewDate }}" data-lang="{{ app()->getLocale() }}"></div>
							<br>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12">
							<section class="s_suprogram">
								<header>
									<h3>{{ trans('main.program') }}</h3>
									<p><span id="count_activities">{{ $count['offers'] }}</span> {{ trans('main.activities') }}
									</p>
								</header>
								<ul class="offers-list">
									<?php $total_cost = 0; ?>
									@foreach ($selectedOffers as $offer)
										<li>
											<a href="#"></a>
											<h4>{{ $offer['name'] }}</h4>
											{{ session('currency.type') }}<span>{{ number_format($offer['price'] * (1 - config('kipmuving.discount')) * $offer['persons'], 0, '.', '.') }}</span>
										</li>
										<?php $total_cost += $offer['price'] * $offer['persons']; ?>
									@endforeach
								</ul>
								<div class="total">
									<div class="totalprice">
										{{ session('currency.type') }}<p>{{ number_format($total_cost * (1 - config('kipmuving.discount')), 0, ".", ".") }}</p>
										<span>{{ trans('main.total') }}</span>
									</div>
									<?php $total_discount = $total_cost * config('kipmuving.discount') ?>
									<div class="discount">
										<span>{{ trans('main.you_save') }}</span>
										{{ session('currency.type') }} <p>{{ number_format($total_discount, 0, ".", ".") }}</p>
									</div>
								</div>
								<a class="btn-reservar reserve">{{ trans('main.reserve_this_panorama') }}</a>
							</section>
							<div class="su_program_note">
								* Ten en cuenta que el valor oficial es en pesos chilenos. La conversion en dolares o reales es un aproximado. El valor debera ser pago en pesos en la agencia.
							</div>
							<section class="s_howitworks_sidebar">
								<div class="section-container">
									<header>
										<h3>{{ trans('main.how_does_it_work') }} <span>KipMuving</span></h3>
									</header>
									<div class="item percent">
										<img src="images/10-grey.svg" alt="{{ config('kipmuving.discount') * 100 }}%">
										<p>{{ trans('main.agreement_with_local_agencies') }}</p>
									</div>
									<div class="item umbrella">
										<img src="images/umbrella-grey.svg" alt="umbrella">
										<p><span>{{ trans('main.support') }}</span> {{ trans('main.with_a_small_commission') }}
											<span>{{ config('kipmuving.service_fee') * 100 }}
												% </span> {{ trans('main.pay_for_website_maintenance') }}</p>
									</div>
									<div class="item broklink">
										<img src="images/broken-link-grey.svg" alt="broken-link">
										<p>{{ trans('main.we_make_your_union_with_agency') }}</p>
									</div>
								</div>
								<div class="payment">
									<a href="#">
										<img src="images/pagseguro_min_logo.png" alt="Pagseguro logo">
									</a>
									<a href="#">
										<img src="images/payu_min_logo.png" alt="PayU logo">
									</a>
									<a href="#">
										<img src="images/paypal.png" alt="PayPal logo">
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
