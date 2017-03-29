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
													href="#">{{ $user['username'] ? $user['username'] : $user['first_name'] }}</a>
												{{ trans('main.confirm_below_the_activities') }}</p>
										</header>
									@endif
									<ul class="accordion">
										@foreach ($reservations as $reservation)
											<li class="accordion-li">
												<header>
													<div class="ico">
														<img src="/{{ $reservation['activityData']['image_icon'] }}"
															  onerror="this.src='/images/image-none.jpg';"
															  alt="agency image">
													</div>
													<div class="text">
														<h2>
															<a href="{{ action('ActivityController@getActivity', $reservation['activityData']['id']) }}">{{ $reservation['activityData']['name'] }}</a>
														</h2>
														<strong
															class="sub-title">{{ $reservation['agencyData']['name'] }} <!--<span>O`Higgins Nº211-C </span>--></strong>
													</div>
												</header>
												<div class="activity_description">
													<div class="row">
														<div class="col-sm-7 col-xs-12">
															<div class="list-box">
																<strong class="title">{{ trans('main.you_must_take') }}</strong>
																<ul class="list">
																	@foreach ($reservation['offerData']['includes'] as $include)
																		<li>{{ $include }}</li>
																	@endforeach
																</ul>
															</div>
														</div>
														<div class="col-sm-5 col-xs-12">
															<ul class="timing">
																<li class="time">
																	<strong class="title">
																		{{ trans('form.day') }}: {{ $reservation['offerData']['date'] }}
																	</strong>
																	<strong>
																		<span>{{ trans('main.duration') }}
																			:</span> {{ $reservation['offerData']['hours'] }}
																		hrs
																	</strong>
																	<strong>
																		<span>{{ trans('main.schedule') }}
																			:</span> {{ \Carbon\Carbon::parse($reservation['offerData']['start_time'])->format('H:i') }}
																		a {{ \Carbon\Carbon::parse($reservation['offerData']['end_time'])->format('H:i') }}
																	</strong>
																</li>
																<li class="person">
																	<strong>
																		<span>{{ $reservation['offerData']['persons'] }}</span> {{ trans('main.persons') }}
																	</strong>
																</li>
															</ul>
														</div>
													</div>
													<strong class="price">
														<sub>$</sub> {{ number_format($reservation['offerData']['persons'] * $reservation['offerData']['price'], 0, '.', '.')* 0.9 }}
													</strong>
												</div>
												<div id="reservetour1">
													<div class="important">
														<p><strong class="title">{{ trans('main.important') }}:</strong> {{ $reservation['offerData']['important'] }}</p>
													</div>
													<div class="cancellation_rules">
														<p><span>Costos para cancelar: </span>{{ $reservation['offerData']['cancellation_rules'] }}</p>
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
											<p><span id="count_activities">{{ count($reservations) }}</span> {{ trans('main.activities') }}</p>
										</header>
										<ul class="offers-list">
											@foreach ($reservations as $reservation)
												<li>
													<a href="#"></a>
													<h4>{{ $reservation['activityData']['name'] }}</h4>
													<span>{{number_format($reservation['offerData']['price'] * (1 - config('kipmuving.discount')) * $reservation['offerData']['persons'], 0, '.', '.')}}</span>
												</li>
											@endforeach
										</ul>
										<div class="total">
											<div class="totalprice">
												<p>{{ number_format($total, 0, ".", ".") }}</p>
												<span>{{ trans('main.total') }}</span>
											</div>
											<?php $total_discount = $total_without_discount * config('kipmuving.discount') ?>
											<div class="discount">
												<span>{{ trans('main.you_save') }}</span>
												<p>{{ number_format($total_discount, 0, ".", ".") }}</p>
											</div>
										</div>
										<a href="/reserve/paypal" class="btn-reservar reserve">{{ trans('main.reserve_this_panorama') }}</a>
										{{--<a href="#" class="btn-reservar reserve" data-toggle="modal"--}}
											{{--data-target="#PaymentModal">{{ trans('main.reserve_this_panorama') }}</a>--}}
										<a href="/reserve/pagseguro">Pay with Pagseguro</a>
										<!--?php $uid = uniqid() ?-->
										<!--?php $signature = md5('4Vj8eK4rloUd272L48hsrarnUA~508029~'.$uid.'~'.'3'.'~'.'USD') ?-->
										{{--<form name="payuform" method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">--}}
											{{--<input name="merchantId" type="hidden"  value="508029">--}}
											{{--<input name="ApiKey" type="hidden"  value="1wOnbtFLyv6N7v8QwWj5LVXNaw">--}}
											{{--<input name="accountId" type="hidden" value="512326">--}}
											{{--<input name="description" type="hidden"  value="Test PAYU">--}}
											{{--<input name="referenceCode" type="hidden"  value="{{ $uid }}" >--}}
											{{--<input name="amount" type="hidden"  value="3">--}}
											{{--<input name="tax" type="hidden"  value="0">--}}
											{{--<input name="taxReturnBase" type="hidden"  value="0">--}}
											{{--<input name="currency" type="hidden"  value="USD">--}}
											{{--<input name="signature" type="hidden"  value="{{ $signature }}">--}}

											{{--<input type="hidden" name="totalAmount" value="15">--}}
											{{--<input type="hidden" name="OpenPayu-Signature" value="sender=508029;algorithm=md5;signature={{ $signature }}">--}}
											{{--<input name="test" type="hidden"  value="1">--}}
											{{--<input name="buyerEmail" type="hidden"  value="testt@test.com">--}}
											{{--<input name="responseUrl" type="hidden"  value="http://kipmuving.lo/user" >--}}
											{{--<input name="confirmationUrl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="continueUrl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="notifyUrl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="returnUrl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="surl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="furl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="sUrl" type="hidden" value="http://kipmuving.lo/user">--}}
											{{--<input name="fUrl" type="hidden" value="http://kipmuving.lo/user">--}}
										{{--</form>--}}
										{{--<script>--}}
											{{--$(document).ready(function () {--}}
												{{--$('.btn-reservar').click(function (event) {--}}
												  {{--event.preventDefault();--}}
												  {{--document.payuform.submit();--}}
												  {{--return false;--}}
												{{--});--}}
											{{--});--}}
										{{--</script>--}}
									</section>
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
											<span>{{ trans('main.you_can_use') }}:</span>
											<a href="#"><img src="images/stripe.png" alt="Stripe"></a>
											<a href="#"><img src="images/paypal.png" alt="PayPal"></a>
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
	{{--<div class="payment-modal modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
		{{--<div class="modal-dialog modal-sm" role="document">--}}
			{{--<div class="modal-content">--}}
				{{--<div class="modal-header">--}}
					{{--<h4 class="modal-title" id="myModalLabel">{{ trans('main.how_do_you_want_to_confirm_reservation') }}</h4>--}}
				{{--</div>--}}
				{{--<div class="modal-body">--}}
					{{--<div class="payment-way stripe-way">--}}
						{{--<img src="images/stripe.png" alt="Stripe">--}}
						{{--<button id="stripe-pay" class="btn-payment" type="button">{{ trans('main.confirm_card') }}</button>--}}
						{{--<script src="https://checkout.stripe.com/checkout.js"></script>--}}
						{{--<script>--}}
                      {{--var handler = StripeCheckout.configure({--}}
                          {{--key: "pk_test_Ozq7fWW5gnapw15qY6HmkQvs",--}}
                          {{--image: "/images/logo-tent.png",--}}
                          {{--name: "Kipmuving",--}}
                          {{--description: "Kipmuving Adventures",--}}
                          {{--allowRememberMe: false,--}}
                          {{--amount: {{$topay * 100}},--}}
                          {{--token: function (token) {--}}
                              {{--$.ajax({--}}
                                  {{--type: "POST",--}}
                                  {{--url: "/reserve",--}}
                                  {{--data: {--}}
                                      {{--'_token': $('meta[name="csrf-token"]').attr('content'),--}}
                                      {{--token: token--}}
                                  {{--},--}}
                                  {{--success: function (data) {--}}
									  {{--$("#payment_status").text(data);--}}
									  {{--$('#myModal').modal('show');--}}
                                  {{--},--}}
                                  {{--error: function (err) {--}}
									  {{--$(".error-payment").append(err);--}}
									  {{--$(".error-payment").slideDown();--}}
                                  {{--}--}}
                              {{--})--}}
                          {{--}--}}
                      {{--});--}}
                      {{--document.getElementById('stripe-pay').addEventListener('click', function (e) {--}}
                          {{--handler.open();--}}
                          {{--e.preventDefault();--}}
                      {{--});--}}
						{{--</script>--}}
					{{--</div>--}}
					{{--<div class="payment-way paypal-way">--}}
						{{--<img src="images/paypal.png" alt="PayPal">--}}
						{{--<div id="paypal-pay" class="btn-payment">{{ trans('main.confirm_paypal') }}</div>--}}
						{{--<form name='_xclick' action='{{	config('app.paypal_url') }}' method='post'>--}}
							{{--{{ csrf_field() }}--}}
							{{--<input type='hidden' name='cmd' value='_xclick'>--}}
							{{--<input type='hidden' name='business'--}}
									 {{--value='{{ config('app.paypal_merchant_email') }}'>--}}
							{{--<input type='hidden' name='currency_code' value='USD'>--}}
							{{--<input type='hidden' name='item_name' value='Kipmuving Activities Reservation'>--}}
							{{--<input type='hidden' name='custom' value='{{ count($offers) }}'>--}}
							{{--<input type='hidden' name='amount'--}}
									 {{--value='{{ $topay }}'>--}}
							{{--<input type='hidden' name='no_shipping' value='1'>--}}
							{{--<input type='hidden' name='rm' value='2'>--}}
							{{--<input type='hidden' name='return' value='{{ URL::to('/reserve') }}'>--}}
							{{--<input type='hidden' name='cancel_return' value='{{ URL::to('/reserve') }}'>--}}
							{{--<input type='hidden' name='notify_url' value='{{ URL::to('/paypal/notify') }}'>--}}
						{{--</form>--}}
						{{--<form name='_xclick' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>--}}
							{{--<input type='hidden' name='cmd' value='_xclick'>--}}
							{{--<input type='hidden' name='business' value='sanek.solodovnikov.94-facilitator@gmail.com'>--}}
							{{--<input type='hidden' name='currency_code' value='USD'>--}}
							{{--<input type='hidden' name='item_name' value='Kipmuving Activities Reservation'>--}}
							{{--<input type='hidden' name='custom' value='{{ count($offers) }}'>--}}
							{{--<input type='hidden' name='amount' value='{{ $topay }}'>--}}
							{{--<input type='hidden' name='no_shipping' value='1'>--}}
							{{--<input type='hidden' name='rm' value='2'>--}}
							{{--<input type='hidden' name='return' value='{{ URL::to('reserve') }}'>--}}
							{{--<input type='hidden' name='cancel_return' value='{{ URL::to('reserve') }}'>--}}
							{{--<input type='hidden' name='notify_url' value='{{ URL::to('reserve') }}'>--}}
						{{--</form>--}}
						{{--<form name='_xclick' action='{{ action('ReservationController@paymentPaypal') }}' method='get'>--}}
							{{--<input type='hidden' name='cmd' value='_xclick'>--}}
							{{--<input type='hidden' name='paymentType' value='paypal'>--}}
						{{--</form>--}}
						{{--<script src="https://www.paypalobjects.com/api/checkout.js"></script>--}}
						{{--<script>--}}
{{--//                      $(document).ready(function () {--}}
{{--//                          $('#paypal-pay').click(function (event) {--}}
{{--//                              event.preventDefault();--}}
{{--//                              document._xclick.submit();--}}
{{--//							  return false;--}}
{{--//                          });--}}
{{--//                      });--}}
{{--//							paypal.Button.render({--}}
{{--//--}}
{{--//								env: 'sandbox', // Specify 'sandbox' for the test environment--}}
{{--//--}}
{{--//                                locale: 'es_ES',--}}
{{--//--}}
{{--//                                style : {--}}
{{--//                                  shape: 'rect'--}}
{{--//                                },--}}
{{--//--}}
{{--//								payment: function(resolve, reject) {--}}
{{--//									// Set up the payment here, when the buyer clicks on the button--}}
{{--//								},--}}
{{--//--}}
{{--//								onAuthorize: function(data, actions) {--}}
{{--//									// Execute the payment here, when the buyer approves the transaction--}}
{{--//--}}
{{--//                                    if (error === '10486'){--}}
{{--//                                        actions.restart();--}}
{{--//                                    }--}}
{{--//								},--}}
{{--//--}}
{{--//                                onError: function(err){--}}
{{--//								    console.log('ERROR:');--}}
{{--//								    console.log(err);--}}
{{--//                                }--}}
{{--//--}}
{{--//							}, '#paypal-pay');--}}
						{{--</script>--}}
					{{--</div>--}}
					{{--<div class="error-payment"><span>Error: </span></div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}



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
