@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('CalendarController@index') }}">{{ trans('main.your_agenda') }}</a></li>
						<li>{{ trans('main.reservation') }}</li>
					</ul>
					<section class="s_reservar">
						<div class="your-reservation">
							<div class="row">
								<div class="col-md-8 col-sm-12 col-xs-12">
									@if (! empty($message))
										<header class="head">
											<h1>{{ $message }}</h1>
										</header>
									@else
										<header class="head">
											<h1>{{ trans('main.these_are_your_activities') }}</h1>
											<p>{{ trans('please') }} <a
														href="#">{{ $user->username ? $user->username : $user->first_name }}</a>
												{{ trans('main.confirm_below_the_activities') }}</p>
										</header>
									@endif
									<ul class="accordion">
										<?php $first_offer = true ?>
										@foreach ($reservation->offers as $offer)
											<li class="accordion-li">
												<header>
													<div class="ico">
														<img src="/{{ $offer->activity->image_icon }}"
														     onerror="this.src='/images/image-none.jpg';"
														     alt="agency image">
													</div>
													<div class="text">
														<h2>
															<a href="{{ action('ActivityController@getActivity', $offer->activity->id) }}">{{ $offer->activity->name }}</a>
														</h2>
														<strong class="sub-title">{{ $offer->agency->name }} <span>{{ $offer->agency->address }}</span></strong>
													</div>
												</header>
												<div class="activity_description">
													<div class="row">
														<div class="col-sm-6 col-xs-12">
															<div class="list-box">
																<strong class="title">{{ trans('main.you_must_take') }}</strong>
																<ul class="list">
																	@foreach ($offer->includes as $include)
																		<li>{{ $include }}</li>
																	@endforeach
																</ul>
															</div>
														</div>
														<div class="col-sm-6 col-xs-12">
															<ul class="timing">
																<li class="time">
																	<img src="{{ asset('images/clock.svg') }}" alt="Time icon" class="timing-icon">
																	<strong class="title">
																		{{ trans('form.day') }}: {{ $offer->reservation['date'] }}
																	</strong>
																	<strong>
																		<span>{{ trans('main.duration') }}
																			:</span> {{ $offer->duration }}
																		hrs
																	</strong>
																	<strong>
																		<span>{{ trans('main.schedule') }}
																			:</span> {{ \Carbon\Carbon::parse($offer->reservation['time']['start'])->format('H:i') }}
																		a {{ \Carbon\Carbon::parse($offer->reservation['time']['end'])->format('H:i') }}
																	</strong>
																</li>
																<li class="person">
																	<img src="{{ asset('images/happy.svg') }}" alt="Person icon" class="timing-icon">
																	<strong>
																		<span>{{ $offer->reservation['persons'] }}</span> {{ trans('main.persons') }}
																	</strong>
																</li>
															</ul>
														</div>
													</div>
													<strong class="price">
														<sub>@if(session('currency.type') === 'BRL') R$ @else
																$ @endif</sub> {{ number_format($offer->reservation['persons'] * $offer->price, 0, '.', '.') }}
														{{--$ {{ number_format($offer->real_price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'], 0, '.', ' ') }}--}}
													</strong>
												</div>
												<div @if($first_offer) id="reservetour1" @endif class="reservation-info-block">
													<div class="important">
														<p><strong class="title">{{ trans('main.important') }}:</strong> {{ $offer->important }}</p>
													</div>
													<div class="cancellation_rules">
														<p><span>Costos para cancelar: </span>{{ $offer->cancellation_rules }}</p>
													</div>
												</div>
											</li>
											<?php $first_offer = false; ?>
										@endforeach
									</ul>
										{{--TODO Here special offers--}}
										{{--TODO You can use $special_offers in foreach. And $item has fields: 'activity_name', 'count_agencies', 'date', 'persons'--}}
										{{--TODO End Here special offers--}}
									@if (empty($message))
										<section class="s_moredetails">
											<p>{{ trans('main.to_confirm_your_activities') }}
												<strong>{{ trans('main.confirm') }}</strong>.
												{{ trans('main.you_got_mail') }}
											</p>
											<p class="carrio-heading">{{ trans('main.to_cancel_your_reservation') }}</p>
											<p>{{ trans('main.you_will_receive_info_about_agency') }}</p>
											<p class="carrio-heading">{{ trans('main.general_information') }}</p>
											<p>{{ trans('main.please_note_that_you_are_hiring') }}</p>
										</section>
									@endif

								</div>
								<div class="col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
									<aside class="sidebar">
										<section class="s-program">
											<div class="s-program__content @if(session('currency.type') === 'BRL') s-program__content_brl-curr @endif">
												<div class="s-program__basket">
													<header class="s-program__header">
														<h3 class="s-program__title">{{ trans('main.instant_booking') }}</h3>
														@if(count($reservation->offers) > 0)
															<p class="s-program__offers-count">
																<span id="count-activities">{{ count($reservation->offers) }}</span> @if(count($reservation->offers) > 1) {{ trans('main.activities') }} @else  {{ trans('main.activity') }} @endif
															</p>
														@endif
													</header>
													@if(count($reservation->offers) > 0)
														<ul class="basket-list">
															@foreach ($reservation->offers as $offer)
																<li class="basket-list__item">
																	<a class="basket-list__delete-button" href="#"></a>
																	<h4 class="basket-list__name">{{ $offer->activity->name }}</h4>
																	<span class="basket-list__price">{{number_format($offer->price * $offer->reservation['persons'], 0, '.', '.')}}</span>
																</li>
															@endforeach
														</ul>
														<div class="s-program__total">
															<p class="s-program__price">{{ number_format($reservation->total[session('currency.type')], 0, ".", ".") }}</p>
															<span class="s-program__total-text">{{ trans('main.total') }}</span>
														</div>
													@endif
												</div>
												@if(isset($special_offers) && count($special_offers) > 0)
													<div class="s-program__basket">
														<header class="s-program__header s-program__header_subscription">
															<h3 class="s-program__title s-program__title_subscription">{{ trans('main.receive_offers') }}</h3>
															<p class="s-program__offers-count">
																<span id="count-activities">{{ count($special_offers) }}</span> @if(count($special_offers) > 1) {{ trans('main.activities') }} @else  {{ trans('main.activity') }} @endif
															</p>
														</header>
														<ul class="basket-list basket-list_subscription">
															@foreach ($special_offers as $offer)
																<li class="basket-list__item basket-list__item_subscription">
																	{{--TODO delete special offers--}}
																	<a class="basket-list__delete-button" href="#"></a>
																	<h4 class="basket-list__name">{{ $offer['activity_name'] }}</h4>
																</li>
															@endforeach
														</ul>
													</div>
												@endif
												<a href="{{ action('ReservationController@reserve') }}" class="btn-reservar s-program__reserve-button">{{ trans('main.confirm') }}</a>
											</div>
										</section>
										<div class="note">
											* Ten en cuenta q ue el valor oficial es en pesos chilenos. La conversion en dolares o reales es un
											aproximado. El valor debera ser pago en pesos en la agencia.
										</div>
									</aside>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>

@stop
