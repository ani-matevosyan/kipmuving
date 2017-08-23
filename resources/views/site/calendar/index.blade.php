@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
				<li>{{ trans('main.your_agenda') }}</li>
			</ul>
			<header class="calendar-page-header">
				<h1 class="calendar-page-header__title">{{ trans('main.your_panorama_in_pucon') }}</h1>
				<p class="calendar-page-header__description">{{ trans('main.here_is_your_schedule') }}{{ trans('main.reserve') }}.</p>
				<a href="{{ action('ActivityController@index') }}" class="calendar-page-header__include-activities-button">{{ trans('main.include_more_activities') }}</a>
				@ability('admin,developer', '')
					<a href="{{ action('CalendarController@generateICS') }}" class="btn export-button calendar-page-header__export-button">{{ trans('main.export_calendar')}}</a>
				@endability()
			</header>
			<div class="row">
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
						<section class="s-program">
							<div class="s-program__content @if(session('currency.type') === 'BRL') s-program__content_brl-curr @endif">
								<div class="s-program__basket">
									<header class="s-program__header">
										<h3 class="s-program__title">{{ trans('main.instant_booking') }}</h3>
										<p class="s-program__offers-count">
											<span id="count-activities">{{ $count['offers'] }}</span> @if($count['offers'] > 1) {{ trans('main.activities') }} @else  {{ trans('main.activity') }} @endif
										</p>
									</header>
									<ul class="basket-list" id="instant-booking-list">
										<?php $total_cost = 0; ?>
										@foreach ($selectedOffers as $offer)
											<li class="basket-list__item">
												<a class="basket-list__delete-button" href="#"></a>
												<h4 class="basket-list__name">{{ $offer['name'] }}</h4>
												<span class="basket-list__price">{{ number_format($offer['price'] * $offer['persons'], 0, '.', '.') }}</span>
											</li>
											<?php $total_cost += $offer['price'] * $offer['persons']; ?>
										@endforeach
									</ul>
									<div class="s-program__total">
										<p class="s-program__price">{{ number_format($total_cost, 0, ".", ".") }}</p>
										<span class="s-program__total-text">{{ trans('main.total') }}</span>
									</div>
								</div>
								<div class="s-program__basket">
									<header class="s-program__header s-program__header_subscription">
										<h3 class="s-program__title s-program__title_subscription">{{ trans('main.receive_offers') }}</h3>
										<p class="s-program__offers-count">
											<span id="count-activities">{{ $count['offers'] }}</span> @if($count['offers'] > 1) {{ trans('main.activities') }} @else  {{ trans('main.activity') }} @endif
										</p>
									</header>
									<ul class="basket-list basket-list_subscription">
										@foreach ($selectedOffers as $offer)
											<li class="basket-list__item basket-list__item_subscription">
												<a class="basket-list__delete-button" href="#"></a>
												<h4 class="basket-list__name">{{ $offer['name'] }}</h4>
											</li>
										@endforeach
									</ul>
								</div>
								<a class="btn-reservar s-program__reserve-button">{{ trans('main.reserve_this_panorama') }}</a>
							</div>
						</section>
						@ability('admin,developer', '')
							<div class="generate-link sidebar__block">
								<a class="btn btn-block" id="generate-link"  href="{{ action('ProposalController@saveProposal') }}" >{{ trans('main.generate_link') }}</a>
								<input type="text" class="generate-link__generated-link" readonly value="asdasdsd">
							</div>
						@endability()
						<div class="note">
							* {{ trans('main.keep_in_mind') }}
						</div>
					</aside>
				</div>
			</div>
		</div>
	</main>
@stop
