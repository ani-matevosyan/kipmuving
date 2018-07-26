@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container-fluid">
			<header class="calendar-page-header">
				<h1 class="calendar-page-header__title">{{ trans('main.your_panorama_in_pucon') }}</h1>
				<p class="calendar-page-header__description">{{ trans('main.here_is_your_schedule') }}{{ trans('main.reserve') }}.</p>
				<a href="{{ action('ActivityController@index') }}" class="calendar-page-header__include-activities-button">{{ trans('main.include_more_activities') }}</a>
				@ability('admin,developer', '')
				<a href="{{ action('CalendarController@generateICS') }}" class="btn export-button calendar-page-header__export-button">{{ trans('main.export_calendar')}}</a>
				@endability()
			</header>
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					{{--<div class="alert alert-danger alert-overlap ">--}}
					{{--{{ trans('main.the_are_activities_of_the_same_day') }}--}}
					{{--</div>--}}
					{{--<br>--}}
					<div id='calendar' class="calendar" data-date="{{ $viewDate }}" data-lang="{{ app()->getLocale() }}"></div>
					<br>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<aside class="sidebar">

						<section class="s-program">
							<div class="s-program__content @if(session('currency.type') === 'BRL') s-program__content_brl-curr @endif">

								<div class="activity-basket">
									<header>{{ trans('emails.hello') }}<strong>{{ auth()->user() ? (auth()->user()->username ? ' '.auth()->user()->username : ' '.auth()->user()->first_name) : '' }}</strong>, {{ trans('main.here_is_the_view') }}:</header>
									<dl>
										<dt>{{ trans('main.confirmed') }}:</dt>
										<dd>
											<ul class="activity-basket__confirms-list">
												@if(isset($selectedOffers) && count($selectedOffers) > 0)
                                                    <?php $total_cost = 0; ?>
													@foreach ($selectedOffers as $key => $offer)
														<li fake_id="{{  $key }}" class="basket_lis">
															<button data-offer-id="{{ $key }}"></button>
															{{ \Carbon\Carbon::createFromFormat('d/m/Y', $offer['date'])->format('d/m') }}  {{ $offer['name'] }}
														</li>
														<?php $total_cost += $offer['price'] * $offer['persons']; ?>
													@endforeach
												@endif
											</ul>
										</dd>
									</dl>
									<dl>
										<dt>{{ trans('main.persons') }}:</dt>
										<dd><span id="program_persons">{{ $count['persons'] }}</span></dd>
									</dl>
									<dl>
										<dt>{{ trans('main.total_of') }}:</dt>
										<dd>
											@if(session('currency.type') === 'BRL')
												R$
											@else
												$
											@endif
											<span id="program_total">{{ number_format($total_cost, 0, ".", ".") }}</span>
										</dd>
									</dl>
									<footer>
										<div class="row">
											<a href="{{ action('ReservationController@index') }}" class="activity-basket__to-reserve"><span class="glyphicon glyphicon-check"></span> {{ trans('main.reserve') }}</a>
										</div>
									</footer>
								</div>

							</div>
						</section>
						@ability('admin,developer', '')
						<div class="generate-link sidebar__block">
							<a class="btn btn-block" id="generate-link" href="{{ action('ProposalController@saveProposal') }}">{{ trans('main.generate_link') }}</a>
							<input type="text" class="generate-link__generated-link" readonly value="asdasdsd">
						</div>
						@endability()
					</aside>
				</div>
			</div>
		</div>
	</main>
@stop
