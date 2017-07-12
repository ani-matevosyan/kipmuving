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
						<div class="col-xs-12">
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
						</div>

						<div class="col-md-9 col-sm-12 col-xs-12">
							{{--<div class="alert alert-danger alert-overlap ">--}}
								{{--{{ trans('main.the_are_activities_of_the_same_day') }}--}}
							{{--</div>--}}
							{{--<br>--}}
							<div id='calendar' class="calendar" data-date="{{ $viewDate }}" data-lang="{{ app()->getLocale() }}"></div>
							<br>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12">
							<aside class="sidebar">
								<section class="s_suprogram">
									<div class="suprogram-content @if(session('currency.type') === 'BRL') brl-curr @endif">
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
													<span>{{ number_format($offer['price'] * $offer['persons'], 0, '.', '.') }}</span>
												</li>
												<?php $total_cost += $offer['price'] * $offer['persons']; ?>
											@endforeach
										</ul>
										<div class="total">
											<div class="totalprice">
												<p>{{ number_format($total_cost, 0, ".", ".") }}</p>
												<span>{{ trans('main.total') }}</span>
											</div>
											<!--?php $total_discount = $total_cost * config('kipmuving.discount') ?-->
											{{--<div class="discount">--}}
												{{--<span>{{ trans('main.you_save') }}</span>--}}
												{{--<p>{{ number_format($total_discount, 0, ".", ".") }}</p>--}}
											{{--</div>--}}
										</div>
										<a class="btn-reservar reserve">{{ trans('main.reserve_this_panorama') }}</a>
									</div>
								</section>
								@ability('admin,developer', '')
									<div class="generate-link sidebar__block">
										<a class="btn btn-block"  href="{{ action('ProposalController@saveProposal') }}" >generate link</a>
										<input type="text" class="generate-link__generated-link" readonly value="asdasdsd">
									</div>
								@endability()
								<div class="su_program_note">
									* Ten en cuenta que el valor oficial es en pesos chilenos. La conversion en dolares o reales es un aproximado. El valor debera ser pago en pesos en la agencia.
								</div>
							</aside>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@stop
