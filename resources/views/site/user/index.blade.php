@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
				<li>{{ trans('main.my_account') }}</li>
			</ul>
			<div class="profile-block">
				<div class="my_profile">
					<div class="row">
						<div class="col-md-8">
							<header>
								<h2>{{ trans('main.my_account') }}</h2>
								<p>{{ trans('main.here_your_personal_info') }}</p>
							</header>

							@if($errors->has('first_name'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('first_name') }}</strong>
								</div>
							@endif
							@if($errors->has('last_name'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('last_name') }}</strong>
								</div>
							@endif
							@if($errors->has('gender'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('gender') }}</strong>
								</div>
							@endif
							@if($errors->has('email'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('email') }}</strong>
								</div>
							@endif
							@if($errors->has('month'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('month') }}</strong>
								</div>
							@endif
							@if($errors->has('day'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('day') }}</strong>
								</div>
							@endif
							@if($errors->has('year'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('year') }}</strong>
								</div>
							@endif
							@if($errors->has('phone'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('phone') }}</strong>
								</div>
							@endif
							@if($errors->has('image'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('image') }}</strong>
								</div>
							@endif
							@if($errors->has('password'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('password') }}</strong>
								</div>
							@endif
							@if($errors->has('confirm_password'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('confirm_password') }}</strong>
								</div>
							@endif
							@if (Session::get('success'))
								<div class="alert alert-info">{{ Session::get('success') }}</div>
							@endif
							<div class="row">
								<div class="col-sm-2">
									<div class="my-intro">
										<div class="img-holder">
											<img src="/{{ $user->avatar }}" alt="your photo"
													 onerror="this.src='/images/image-none.jpg';" id="youravatar">
											<form enctype="multipart/form-data"
														action="{{ action('UserController@updateUsersAvatar', $user->id) }}"
														method="post" name="loadavatar" target="hiddenframe" class="loadavatar">
												{{ csrf_field() }}
												<input id="image" name="image" type="file">
												<label for="image">Upload avatar</label>
											</form>
											<iframe id="hiddenframe" name="hiddenframe"
															style="width:0px; height:0px; border:0px"></iframe>
										</div>
									</div>
								</div>
								<form class="profile-form form-horizontal" method="post"
											action="{{ action('UserController@updateUser', $user->id) }}"
											autocomplete="off"
											enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="col-sm-10">
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="number">{{ trans('form.first_name') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="text" placeholder="" class="form-control" id="number"
																	 name="first_name" value="{{ $user->first_name }}">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="lname">{{ trans('form.last_name') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="text" placeholder="" class="form-control" id="lname"
																	 name="last_name" value="{{ $user->last_name }}">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="email">{{ trans('form.email') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="email" placeholder="" class="form-control" id="email"
																	 name="email"
																	 value="{{ $user->email }}">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="phone">{{ trans('form.phone') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="text" placeholder="" class="form-control" id="phone" name="phone"
																	 value="{{ $user->phone }}">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="phone">{{ trans('form.new_password') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="password" class="form-control" id="password" name="password">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="row">
												<div class="col-xs-3">
													<label for="phone">{{ trans('form.new_password_confirm') }}</label>
												</div>
												<div class="col-xs-9">
													<div class="text-field">
														<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
													</div>
												</div>
											</div>
										</div>
										<div class="sub-row">
											<div class="text-field">
												<button type="submit" class="btn btn-success">{{ trans('main.update') }}</button>
											</div>
										</div>
										<!-- Form Actions -->
									</div>
									{{--</div>--}}
								</form>
							</div>
						</div>
					</div>
					@if($user->reservations)
						<div class="my_adventures">
							<header>
								<h2>{{ trans('main.my_adventures') }}</h2>
								<p>{{ trans('main.here_you_will_find_adventures') }}</p>
							</header>
							<ul class="item-list">
								@foreach ($user->reservations->where('status', true) as $reservation)
									{{--{{ dd($user->reservations[2]->offer) }}--}}
									@if($reservation->offer)
										<li>
											<input type="checkbox" name="to_print" value="{{$reservation['id']}}">
											<ul class="timing">
												<header>
													<div class="ico">
														<img alt="image description"
																 src="{{ asset($reservation->offer->activity['image_icon']) }}"
																 onerror="this.src='{{ asset('/images/image-none.jpg') }}';">
													</div>
													<div class="text">
														<h2>
															<a href="{{ action('ActivityController@getActivity', $reservation->offer->activity['id']) }}" data-toggle="modal"
																 data-target="#myModal">{{ $reservation->offer->activity['name'] }}</a>
														</h2>
														<strong class="sub-title">
															{{ $reservation->offer->agency->name }}
														</strong>
													</div>
												</header>
												<li class="time">
													<strong class="title">{{ trans('emails.day') }}
														: {{ date("d/m/Y", strtotime($reservation->reserve_date)) }}</strong>
													<strong>
											<span>{{ trans('main.duration') }}
												:</span> {{ $reservation->offer->duration }} hrs
													</strong>
													@if ($reservation->time)
														<strong>
											<span>{{ trans('main.schedule') }}
												:</span> {{ date("H:i", strtotime($reservation->time['start'])) }}
															{{ trans('emails.to') }} {{ date("H:i", strtotime($reservation->time['end'])) }}
														</strong>
													@endif
													<strong>
														<span>Summary: </span>{{ session('currency.type') }}
														$ {{ number_format($reservation->offer->price * (1 - config('kipmuving.discount')), 0, ".", ".") }}
													</strong>
												</li>
												<li class="person">
													<strong>
														<span>{{ $reservation->persons }}</span> {{ trans('persons') }}
													</strong>
												</li>
												@if(\Carbon\Carbon::parse($reservation->reserve_date) > \Carbon\Carbon::now())
													<div class="delete_offer">
														<a
															href="{{ action('ReservationController@cancelReservation', $reservation->id) }}">{{ trans('main.cancel_activity') }}</a>
													</div>
												@endif
											</ul>
										</li>
									@endif
								@endforeach
							</ul>
							You can print your reservation. <button class="to_print">Choose what to print</button>
						</div>
					@endif
				</div>
			</div>

			<div class="your-reservation" style="display: none">
				<div class="s_reservar">
					<ul class="accordion">
						<li class="accordion-li">
							<div class="print-li-header">
								<a href="/">
									<img src="http://kipmuving.lo/images/kipmuving-atacama-logo.png" alt="Kipmuving logo">
								</a>
							</div>
							<header>
								<div class="ico">
									<img src="/images/image-none.jpg" onerror="this.src='/images/image-none.jpg';" alt="agency image">
								</div>
								<div class="text">
									<h2>
										<a href="http://kipmuving.lo/activity/16">Ascenso y bajada ski Volcán Villarrica</a>
									</h2>
									<strong class="sub-title">Aguaventura <span>Palguín 336</span></strong>
								</div>
							</header>
							<div class="activity_description">
								<div class="row">
									<div class="col-sm-6 col-xs-12">
										<div class="list-box">
											<strong class="title">Debes llevar</strong>
											<ul class="list">
												<li>Transporte ida y vuelta</li>
												<li>Equipo de seguridad</li>
												<li>Guía Profesional</li>
												<li>Entrada a los Parques</li>
												<li>Seguro de accidentes</li>
												<li>Crampones</li>
												<li>Piolet</li>
												<li>Cubre pantalón</li>
												<li>Guantes</li>
												<li>Casco de seguridad</li>
												<li>Guantes y protector de guante</li>
												<li>Chaqueta</li>
												<li>Guantes</li>
											</ul>
										</div>
									</div>
									<div class="col-sm-6 col-xs-12">
										<ul class="timing">
											<li class="time">
												<img src="http://kipmuving.lo/images/clock.svg" alt="Time icon" class="timing-icon">
												<strong class="title">
													Día: 09/06/2017
												</strong>
												<strong>
																				<span>Duración
																					:</span> 12
													hrs
												</strong>
												<strong>
																				<span>Horario
																					:</span> 06:30
													a 18:00
												</strong>
											</li>
											<li class="person">
												<img src="http://kipmuving.lo/images/happy.svg" alt="Person icon" class="timing-icon">
												<strong>
													<span>1</span> personas
												</strong>
											</li>
											<li class="money">
												<img src="http://kipmuving.lo/images/coin.svg" alt="Coin icon" class="timing-icon">
												<strong>Pagar en agencia</strong>
												<strong class="title">$ 85 500 </strong>
											</li>
										</ul>
									</div>
								</div>
								<strong class="price">
									<sub> $ </sub>  85.500

								</strong>
							</div>
							<div id="reservetour1" class="reservation-info-block">
								<div class="important">
									<p><strong class="title">Importante:</strong> Debes acercarte a la agencia una día antes para confirmar la actividad y pagar por ella. También confirmar tu lugar de alojamiento en Pucón.</p>
								</div>
								<div class="cancellation_rules">
									<p><span>Costos para cancelar: </span>Se puede cancelar hasta 3 días de anticipación.</p>
								</div>
							</div>
							<div class="print-li-footer">
								<a href="/">www.kipmuving.com</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
	</main>
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
