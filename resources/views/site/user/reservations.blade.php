@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main" class="user-reservations-page">
		<div class="container">
			<header class="user-page-header user-reservations-page__header">
				<h1 class="user-page-header__title">{{ trans('main.my_adventures') }}</h1>
				<p class="user-page-header__description">{{ trans('main.here_you_will_find_adventures') }}</p>
			</header>
			<section class="s-offers">
				<header class="s-offers__header s-offers__header_special">
					<h2 class="s-offers__title s-offers__title_special">{{ trans('main.received_offers') }}</h2>
				</header>
				<ul class="your-offers">
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph">{{ trans('main.these_offers_valid') }}: <strong>16/12/2017</strong></p>
						</div>
						<ul class="special-offers your-offers__special-offers">
							<li class="special-offers__item">
								<h4 class="special-offers__agency">Aguaventura</h4>
								<div class="special-offers__right-part">
									<span class="price special-offers__price">$ 120.000</span>
									<button class="special-offers__button" data-toggle="modal" data-target="#accept-offer-modal">{{ trans('button-links.accept') }}</button>
									<button class="special-offers__info-button"></button>
								</div>
							</li>
							<li class="special-offers__item">
								<h4 class="special-offers__agency">Aguaventura</h4>
								<div class="special-offers__right-part">
									<span class="price special-offers__price">$ 120.000</span>
									<button class="special-offers__button" data-toggle="modal" data-target="#accept-offer-modal">{{ trans('button-links.accept') }}</button>
									<button class="special-offers__info-button"></button>
								</div>
							</li>
							<li class="special-offers__item">
								<h4 class="special-offers__agency">Patagonia Experience</h4>
								<div class="special-offers__right-part">
									<span class="price special-offers__price">$ 120.000</span>
									<button class="special-offers__button" data-toggle="modal" data-target="#accept-offer-modal">{{ trans('button-links.accept') }}</button>
									<button class="special-offers__info-button"></button>
								</div>
							</li>
						</ul>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
				</ul>
			</section>
			<section class="s-offers">
				<header class="s-offers__header">
					<h2 class="s-offers__title">{{ trans('main.immediate_and_confirmed') }}</h2>
					<button class="s-offers__print-button">{{ trans('main.select_to_print') }}</button>
				</header>
				<ul class="your-offers">
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
					<li class="your-offers__item">
						<h3 class="your-offers__name"><a class="your-offers__name-link" href="#">VOLCÁN VILLARRICA</a></h3>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: Pucon Aventura</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: Address 7878</p>
						</div>
						<div class="your-offers__info-block">
							<p class="your-offers__paragraph"><strong>{{ trans('form.day') }}</strong>: 15 de Febrero</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.duration') }}</strong>: 4 hrs</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.schedule') }}</strong>: 12:00 a 18:00</p>
							<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: 1</p>
						</div>
						<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price">$ 120.000</span></p>
						<div class="your-offers__cancel">
							<a href="#" class="your-offers__cancel-button">{{ trans('main.cancel_activity') }}</a>
						</div>
					</li>
				</ul>
			</section>



			<div class="profile-block">
				<div class="my_profile">
					@if(isset($user->reservations))
						<div class="my-adventures">
							<header class="my-adventures__header">
								<h2 class="my-adventures__title">{{ trans('main.my_adventures') }}</h2>
								<p class="my-adventures__subtitle">{{ trans('main.here_you_will_find_adventures') }}</p>
								@ability('admin,developer', '')
								<a href="{{ action('CalendarController@generateICS') }}" class="btn export-button my-adventures__export-button">{{ trans('main.export_calendar')}}</a>
								@endability()
							</header>
							<ul class="item-list">
								@foreach ($user->reservations->where('status', true) as $reservation)
									@if(isset($reservation->offer))
										<li>
											<label class="check_activity">
												<input type="checkbox" name="to_print" value="{{$reservation['id']}}">
												<i class="glyphicon glyphicon-ok"></i>
											</label>
											<div class="order-item">
												<header>
													@if(isset($reservation->offer->activity['image_icon']))
														<div class="ico">
															<img alt="image description"
																	 src="{{ asset($reservation->offer->activity['image_icon']) }}"
																	 onerror="this.src='{{ asset('/images/image-none.jpg') }}';">
														</div>
													@endif
													<div class="text">
														@if (isset($reservation->offer->activity['id']) && isset($reservation->offer->activity['name']))
															<h2>
																<a href="{{ action('ActivityController@getActivity', $reservation->offer->activity['id']) }}" data-toggle="modal"
																	 data-target="#myModal">{{ $reservation->offer->activity['name'] }}</a>
															</h2>
														@endif

														@if(isset($reservation->offer->agency->name) && isset($reservation->offer->agency->address))
															<strong class="sub-title">
																{{ $reservation->offer->agency->name }} <span
																		class="agency-address">{{ $reservation->offer->agency->address }}</span>
															</strong>
														@endif
													</div>
												</header>
												<div class="cols-row">
													<div class="col">
														<div class="list-box">
															<strong class="title">{{ trans('main.you_must_take') }}</strong>
															<ul class="list">
																@if(count($reservation->offer->includes) > 0)
																	@foreach ($reservation->offer->includes as $include)
																		<li>{{ $include }}</li>
																	@endforeach
																@endif
															</ul>
														</div>
													</div>
													<div class="col">
														<ul class="timing">
															@if(isset($reservation->reserve_date) && isset($reservation->offer->duration) && isset($reservation->time['start'])
																&& isset($reservation->time['end']) && isset($reservation->offer->price) && isset($reservation->persons))
																<li class="time">
																	<img src="{{ asset('images/clock.svg') }}" alt="Time icon" class="timing-icon">
																	<strong class="title">{{ trans('emails.day') }}
																		: {{ date("d/m/Y", strtotime($reservation->reserve_date)) }}</strong>
																	<strong>
																		<span>{{ trans('main.duration') }} : </span> {{ $reservation->offer->duration }} hrs
																	</strong>
																	@if ($reservation->time)
																		<strong>
																			<span>{{ trans('main.schedule') }} :</span> {{ date("H:i", strtotime($reservation->time['start'])) }}
																			{{ trans('emails.to') }} {{ date("H:i", strtotime($reservation->time['end'])) }}
																		</strong>
																	@endif
																	<strong>
																		<span>{{ trans('main.summary') }}: </span>{{ session('currency.type') }}
																		$ {{ number_format(($reservation->offer->price * $reservation->persons), 0, ".", ".") }}
																	</strong>
																</li>
															@endif

															@if(isset($reservation->persons))
																<li class="person">
																	<img src="{{ asset('images/happy.svg') }}" alt="Person icon" class="timing-icon">
																	<strong>
																		<span>{{ $reservation->persons }}</span> {{ trans('persons') }}
																	</strong>
																</li>
															@endif

															@if(isset($reservation->offer->real_price) && isset($reservation->persons))
																<li class="money">
																	<img src="{{ asset('images/coin.svg') }}" alt="Coin icon" class="timing-icon">
																	<strong>Pagar en agencia</strong>
																	<strong class="title">CLP
																		$ {{ number_format(($reservation->offer->real_price * $reservation->persons), 0, ".", ".") }}</strong>
																</li>
															@endif

															{{--@if(\Carbon\Carbon::parse($reservation->reserve_date) > \Carbon\Carbon::now())--}}
																<div class="delete_offer">
																	<a href="{{ action('ReservationController@cancelReservation', $reservation->id) }}">{{ trans('main.cancel_activity') }}</a>
																</div>
															{{--@endif--}}
														</ul>
													</div>
												</div>
											</div>
										</li>
									@endif
								@endforeach
							</ul>
							<div class="print_notification_wrapper">
								<span>{{ trans('main.you_can_print') }} </span>
								<a href="#" class="btn btn-success to_print" data-print-text="{{ trans('main.print_btn') }}">{{ trans('main.pick_activities_btn') }}</a>
							</div>
						</div>
					@endif

					@if(isset($user->special_offers))
						<ul>
							@foreach($user->special_offers as $offer)
								<li>{{ $offer->offer->activity->name }} - {{ $offer->offer_date }}</li>
							@endforeach
						</ul>
					@endif

				</div>
			</div>
		</div>
	</main>

	<div class="modal fade" tabindex="-1" role="dialog" id="printWarning">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a href="#" data-dismiss="modal" class="close">close</a>
					<h4 class="modal-title">Check an activity</h4>
				</div>
				<div class="modal-body">
					<p>Check at least one activity to print.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade reservation-modal accept-modal" tabindex="-1" role="dialog" id="accept-offer-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header reservation-modal__header">
					<button data-dismiss="modal" class="reservation-modal__close-button"></button>
				</div>
				<div class="modal-body reservation-modal__body">
					<p class="reservation-modal__paragraph">{{ trans('main.you_want_to_accept') }} <strong>Aguaventura</strong> {{ trans('main.from(s)') }} <strong>$ 120.000</strong> ?</p>
					<p class="reservation-modal__paragraph">
						{{ trans('main.first_choose_the_time') }}
						<span class="time-select">
							<select>
								<option selected value="">{{ trans('main.schedule') }}</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</span>
					</p>
					<div class="accept-modal__buttons">
						<button class="accept-modal__button accept-modal__button_success">Yes</button>
						<button class="accept-modal__button accept-modal__button_deny">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade reservation-modal offer-modal" tabindex="-1" role="dialog" id="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header reservation-modal__header">
					<button data-dismiss="modal" class="reservation-modal__close-button"></button>
				</div>
				<div class="modal-body reservation-modal__body">
					<header class="offer-modal__header">
						asd
					</header>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a href="#" data-dismiss="modal" class="close">close</a>
					<h4 class="modal-title">Cancelar Actividad</h4>
				</div>
				<div class="modal-body">
					<p>Usted tiene 2 días para cancelar sin que la agencia le cobre una multa de 10%.</p>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-success" id="confirm_cancel">CONFIRMAR</a>
					<a href="#" class="btn btn-warning" data-dismiss="modal">CANCELAR</a>
				</div>
			</div>
		</div>
	</div>
@stop
