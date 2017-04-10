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
											<!--p>Desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un
												libro de
												textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto
												de relleno
												en documentos electrónicos,.</p-->
										</header>
									@else
										<!--header class="head reserveMessageHeader" style="display:none;">
											<h1 class="reserveMessage"></h1>
											<p>Desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un
												libro de
												textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto
												de relleno
												en documentos electrónicos,.</p>
										</header-->
										<header class="head">
											<h1>{{ trans('main.these_are_your_activities') }}</h1>
											<p>{{ trans('please') }} <a
													href="#">{{ $user->username ? $user->username : $user->first_name }}</a>
												{{ trans('main.confirm_below_the_activities') }}</p>
										</header>
									@endif
									<ul class="accordion">
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
														<strong
															class="sub-title">{{ $offer->agency->name }} <!--<span>O`Higgins Nº211-C </span>--></strong>
													</div>
												</header>
												<div class="activity_description">
													<div class="row">
														<div class="col-sm-7 col-xs-12">
															<div class="list-box">
																<strong class="title">{{ trans('main.you_must_take') }}</strong>
																<ul class="list">
																	@foreach ($offer->includes as $include)
																		<li>{{ $include }}</li>
																	@endforeach
																</ul>
															</div>
														</div>
														<div class="col-sm-5 col-xs-12">
															<ul class="timing">
																<li class="time">
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
																	<strong>
																		<span>{{ $offer->reservation['persons'] }}</span> {{ trans('main.persons') }}
																	</strong>
																</li>
															</ul>
														</div>
													</div>
													<strong class="price">
														<sub>$</sub> {{ number_format($offer->reservation['persons'] * $offer->price, 0, '.', '.')* 0.9 }}
													</strong>
												</div>
												<div id="reservetour1">
													<div class="important">
														<p><strong class="title">{{ trans('main.important') }}:</strong> {{ $offer->important }}</p>
													</div>
													<div class="cancellation_rules">
														<p><span>Costos para cancelar: </span>{{ $offer->cancellation_rules }}</p>
													</div>
												</div>
											</li>
										@endforeach
									</ul>
									@if (empty($message))
										<section class="s_moredetails">
											<p>{{ trans('main.to_confirm_your_activities') }}
												<strong>{{ trans('main.reserve_this_panorama') }}. </strong>{{ trans('main.confirm_with_payment_of_service') }}
												<strong>{{ config('kipmuving.service_fee') * 100 }}%</strong> {{ trans('main.you_will_receive_email_with_details') }}</p>
											<p class="carrio-heading">{{ trans('main.to_cancel_your_reservation') }}</p>
											<p>{{ trans('main.you_will_receive_info_about_agency') }}</p>
											<p class="carrio-heading">{{ trans('main.general_information') }}</p>
											<p>{{ trans('main.please_note_that_you_are_hiring') }}</p>
										</section>
									@endif

								</div>
								<div class="col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
									<section class="s_suprogram">
										<header>
											<h3>{{ trans('main.program') }}</h3>
											<p><span id="count_activities">{{ count($reservation->offers) }}</span> {{ trans('main.activities') }}</p>
										</header>
										<ul class="offers-list">
											@foreach ($reservation->offers as $offer)
												<li>
													<a href="#"></a>
													<h4>{{ $offer->activity->name }}</h4>
													<span>{{number_format($offer->price * (1 - config('kipmuving.discount')) * $offer->reservation['persons'], 1, '.', '.')}}</span>
												</li>
											@endforeach
										</ul>
										<div class="total">
											<div class="totalprice">
												<p>{{ number_format($reservation->total_in_currency, 1, ".", ".") }}</p>
												<span>{{ trans('main.total') }}</span>
											</div>
											<div class="discount">
												<span>{{ trans('main.you_save') }}</span>
												<p>{{ number_format($reservation->total_without_discount_in_currency * config('kipmuving.discount'), 1, ".", ".") }}</p>
											</div>
										</div>
										<a href="#" class="btn-reservar reserve" data-toggle="modal" data-target="#PaymentModal">{{ trans('main.reserve_this_panorama') }}</a>
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
												<p><span>{{ trans('main.support') }}</span> {{ trans('main.with_a_small_commission') }} <span>{{ config('kipmuving.service_fee') * 100 }}% </span> {{ trans('main.pay_for_website_maintenance') }}</p>
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
				</section>
			</div>
		</div>
	</main>
	<div class="payment-modal modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title">Estas reservando <strong>{{ count($reservation->offers) }}</span> {{ trans('main.activities') }}</strong> y ahorrando <strong>$ {{ number_format($reservation->total_without_discount_in_currency * config('kipmuving.discount'), 1, ".", ".") }}.</strong> <br> Para completar, debera pagar <strong>$ 2.000.</strong> Elija su medio de pago:</p>
				</div>
				<div class="modal-body">
                    <div class="payment-options">
                        <a href="/reserve/pagseguro" class="pagseguro-btn"><img src="/images/pagseguro_logo_dark.png" alt="Pagseguro Logo"></a>
                        <a href="#" class="payu-btn"><img src="/images/payu_logo.png" alt="PayU Logo"></a>
                        <a href="/reserve/paypal" class="paypal-btn"><img src="/images/paypal_logo_transparent.png" alt="PayPal Logo"></a>
                    </div>
				</div>
                <?php $uid = uniqid() ?>
                <?php $signature = md5('4Vj8eK4rloUd272L48hsrarnUA~508029~'.$uid.'~'.'3'.'~'.'USD') ?>
                <form name="payuform" method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">
                    <input name="merchantId" type="hidden"  value="508029">
                    <input name="ApiKey" type="hidden"  value="1wOnbtFLyv6N7v8QwWj5LVXNaw">
                    <input name="accountId" type="hidden" value="512326">
                    <input name="description" type="hidden"  value="Test PAYU">
                    <input name="referenceCode" type="hidden"  value="{{ $uid }}" >
                    <input name="amount" type="hidden"  value="3">
                    <input name="tax" type="hidden"  value="0">
                    <input name="taxReturnBase" type="hidden"  value="0">
                    <input name="currency" type="hidden"  value="USD">
                    <input name="signature" type="hidden"  value="{{ $signature }}">

                    <input type="hidden" name="totalAmount" value="15">
                    <input type="hidden" name="OpenPayu-Signature" value="sender=508029;algorithm=md5;signature={{ $signature }}">
                    <input name="test" type="hidden"  value="1">
                    <input name="buyerEmail" type="hidden"  value="testt@test.com">
                    <input name="responseUrl" type="hidden"  value="http://kipmuving.lo/user" >
                    <input name="confirmationUrl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="continueUrl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="notifyUrl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="returnUrl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="surl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="furl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="sUrl" type="hidden" value="http://kipmuving.lo/user">
                    <input name="fUrl" type="hidden" value="http://kipmuving.lo/user">
                </form>
                <script>
                    $(document).ready(function () {
                        $('.payu-btn').click(function (event) {
                            event.preventDefault();
                            document.payuform.submit();
                            return false;
                        });
                    });
                </script>
			</div>
		</div>
	</div>



	{{--<div class="payment-modal modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
		{{--<div class="modal-dialog" role="document">--}}
			{{--<div class="modal-content">--}}
				{{--<div class="modal-header">--}}
					{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
						{{--<span aria-hidden="true">&times;</span>--}}
					{{--</button>--}}
					{{--<h4 class="modal-title" id="payment_status"></h4>--}}
				{{--</div>--}}
				{{--<div class="modal-body">--}}
					{{--<a href="{{ action('UserController@getUser') }}" class="btn btn-success btn-success-cal">To user page</a>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}

@stop
