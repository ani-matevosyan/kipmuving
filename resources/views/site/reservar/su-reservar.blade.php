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
									<div class="print-header">
										<img src="{{ asset('images/printer.svg') }}" alt="Printer icon">
										<img src="{{ asset('images/cut.svg') }}" alt="Scissors icon">
										<span><strong>Imprima</strong> y <strong>Recorte</strong> cada <strong>vousher</strong> y lleve <strong>separadamente</strong> a cada agencia</span>
									</div>
									<ul class="accordion">
										<?php $first_offer = true ?>
										@foreach ($reservation->offers as $offer)
											<li class="accordion-li">
												<div class="print-li-header">
													<a href="/">
														<img src="{{ asset('images/kipmuving-atacama-logo.png') }}" alt="Kipmuving logo">
													</a>
												</div>
												<header>
													<div class="ico">
														<img src="/{{ $offer->activity->image_icon }}"
														     onerror="this.src='/images/image-none.jpg';"
														     alt="agency image">
													</div>
													<div class="text">
														<h2>
															<a
																	href="{{ action('ActivityController@getActivity', $offer->activity->id) }}">{{ $offer->activity->name }}</a>
														</h2>
														<strong
																class="sub-title">{{ $offer->agency->name }} <span>{{ $offer->agency->address }}</span></strong>
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
																<li class="money">
																	<img src="{{ asset('images/coin.svg') }}" alt="Coin icon" class="timing-icon">
																	<strong>Pagar en agencia</strong>
																	<strong
																			class="title">$ {{ number_format($offer->real_price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'], 0, '.', ' ') }} </strong>
																</li>
															</ul>
														</div>
													</div>
													<strong class="price">
														<sub>@if(session('currency.type') === 'BRL') R$ @else
																$ @endif</sub> {{ number_format($offer->reservation['persons'] * $offer->price * (1 - config('kipmuving.discount')), 0, '.', '.') }}
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
												<div class="print-li-footer">
													<a href="/">www.kipmuving.com</a>
												</div>
											</li>
											<?php $first_offer = false; ?>
										@endforeach
									</ul>
									@if (empty($message))
										<section class="s_moredetails">
											<p>{{ trans('main.to_confirm_your_activities') }}
												<strong>{{ trans('main.reserve_this_panorama') }}
													. </strong>{{ trans('main.confirm_with_payment_of_service') }}
												<strong>{{ config('kipmuving.service_fee') * 100 }}
													%</strong> {{ trans('main.you_will_receive_email_with_details') }}</p>
											<p class="carrio-heading">{{ trans('main.to_cancel_your_reservation') }}</p>
											<p>{{ trans('main.you_will_receive_info_about_agency') }}</p>
											<p class="carrio-heading">{{ trans('main.general_information') }}</p>
											<p>{{ trans('main.please_note_that_you_are_hiring') }}</p>
										</section>
									@endif

								</div>
								<div class="col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
									<section class="s_suprogram @if(session('currency.type') === 'BRL') brl-curr @endif">
										<header>
											<h3>{{ trans('main.program') }}</h3>
											<p><span
														id="count_activities">{{ count($reservation->offers) }}</span> {{ trans('main.activities') }}
											</p>
										</header>
										<ul class="offers-list">
											@foreach ($reservation->offers as $offer)
												<li>
													<a href="#"></a>
													<h4>{{ $offer->activity->name }}</h4>
													<span>{{number_format($offer->price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'], 0, '.', '.')}}</span>
												</li>
											@endforeach
										</ul>
										<div class="total">
											<div class="totalprice">
												<p>{{ number_format($reservation->total->with_discount[session('currency.type')], 0, ".", ".") }}</p>
												<span>{{ trans('main.total') }}</span>
											</div>
											<div class="discount">
												<span>{{ trans('main.you_save') }}</span>
												<p>{{ number_format($reservation->total[session('currency.type')] * config('kipmuving.discount'), 0, ".", ".") }}</p>
											</div>
										</div>
										<a href="#" class="btn-reservar reserve" data-toggle="modal"
										   data-target="#PaymentModal">{{ trans('main.reserve_this_panorama') }}</a>
									</section>
									<div class="su_program_note">
										* Ten en cuenta que el valor oficial es en pesos chilenos. La conversion en dolares o reales es un
										aproximado. El valor debera ser pago en pesos en la agencia.
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
												<p><span>{{ trans('main.support') }}</span> {{ trans('main.with_a_small_commission') }} <span>{{ config('kipmuving.service_fee') * 100 }}
														% </span> {{ trans('main.pay_for_website_maintenance') }}</p>
											</div>
											<div class="item broklink">
												<img src="images/broken-link-grey.svg" alt="broken-link">
												<p>{{ trans('main.we_make_your_union_with_agency') }}</p>
											</div>
										</div>
										<div class="payment">
											<img src="images/pagseguro_min_logo.png" alt="Pagseguro logo">
											<img src="images/payu_min_logo.png" alt="PayU logo">
											<img src="images/paypal.png" alt="PayPal logo">
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
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="info-item">
								<div class="row">
									<div class="col-xs-6">
										<h4>Reservando</h4>
									</div>
									<div class="col-xs-6">
										<strong>{{ count($reservation->offers) }} actividades</strong>
									</div>
								</div>
							</div>
							<div class="info-item">
								<div class="row">
									<div class="col-xs-6">
										<h4>Ahorrando</h4>
									</div>
									<div class="col-xs-6">
										<strong>$ {{ number_format($reservation->total['CLP'] * config('kipmuving.discount'), 0, ".", ".") }}</strong>
										<span>$ {{ number_format($reservation->total['USD'] * config('kipmuving.discount'), 0, ".", ".") }}
											/ R$ {{ number_format($reservation->total['BRL'] * config('kipmuving.discount'), 0, ".", ".") }}</span>
									</div>
								</div>
							</div>
							<div class="info-item">
								<div class="row">
									<div class="col-xs-6">
										<h4>Tarifa de servicio</h4>
									</div>
									<div class="col-xs-6">
										<strong>$ {{ number_format($reservation->total->to_pay['CLP'], 0, ".", ".") }}</strong>
										<span>$ {{ number_format($reservation->total->to_pay['USD'], 0, ".", ".") }}
											/ R$ {{ number_format($reservation->total->to_pay['BRL'], 0, ".", ".") }}</span>
										@if ($reservation->total->to_pay['CLP'] == 2000)
											<span>*pago minimo</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8 col-sm-6">
							<div class="payment-options">
								<div class="row">
									<h4>Confirmar con:</h4>
									<div class="col-md-4">
										<div class="payment-method">
											<a href="/reserve/pagseguro" class="pagseguro-btn">
												<img src="/images/pagseguro_logo_dark.png" alt="Pagseguro Logo">
											</a>
											<span>Pagos solamente con Real Brasilieno</span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="payment-method">
											<a href="/reserve/payu" class="payu-btn">
												<img src="/images/payu_logo.png" alt="PayU Logo">
											</a>
											<span>Tarjetas internacionales y america latina</span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="payment-method payment-method_last">
											<a href="/reserve/paypal" class="paypal-btn">
												<img src="/images/paypal_logo_transparent.png" alt="PayPal Logo">
											</a>
											<span>Para cuetnas Paypal y Tarjetas intarnacionales</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<form name="payuform" method="post" action="https://gateway.payulatam.com/ppp-web-gateway">
					{{--<form name="payuform" method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">--}}
					<input name="merchantId" type="hidden" value="">
					<input name="ApiKey" type="hidden" value="">
					<input name="accountId" type="hidden" value="">
					<input name="description" type="hidden" value="">
					<input name="referenceCode" type="hidden" value="">
					<input name="amount" type="hidden" value="">
					{{--<input name="tax" type="hidden"  value="">--}}
					{{--<input name="taxReturnBase" type="hidden"  value="">--}}
					<input name="currency" type="hidden" value="">
					<input name="signature" type="hidden" value="">
					{{--<input type="hidden" name="totalAmount" value="">--}}
					{{--<input type="hidden" name="OpenPayu-Signature" value="">--}}
					<input name="test" type="hidden" value="">
					<input name="buyerEmail" type="hidden" value="">
					<input name="responseUrl" type="hidden" value="">
					<input name="confirmationUrl" type="hidden" value="">
					<input name="continueUrl" type="hidden" value="">
					<input name="notifyUrl" type="hidden" value="">
					<input name="returnUrl" type="hidden" value="">
					{{--<input name="surl" type="hidden" value="">--}}
					{{--<input name="furl" type="hidden" value="">--}}
					{{--<input name="sUrl" type="hidden" value="">--}}
					{{--<input name="fUrl" type="hidden" value="">--}}
				</form>
			</div>
		</div>
	</div>
@stop
