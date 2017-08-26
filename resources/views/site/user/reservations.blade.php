@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
				<li><a href="{{ action('UserController@getUser') }}">{{ trans('main.my_account') }}</a></li>
				<li>Reservations</li>
			</ul>
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

															@if(\Carbon\Carbon::parse($reservation->reserve_date) > \Carbon\Carbon::now())
																<div class="delete_offer">
																	<a href="{{ action('ReservationController@cancelReservation', $reservation->id) }}">{{ trans('main.cancel_activity') }}</a>
																</div>
															@endif
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
