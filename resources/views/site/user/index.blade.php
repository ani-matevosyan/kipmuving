@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="#">HOME</a></li>
						<li>Mi cuenta</li>
					</ul>
					<div class="row">
						<div class="col-xs-12">
							<div class="profile-block">
								<ul class="tablist" role="tablist">
									<li>
										<a data-toggle="tab" href="#tab1" aria-expanded="true">Mi Perfil</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab2" class="my-adv" aria-expanded="true">Mis Aventuras</a>
									</li>
								</ul>
								{{--							{{dd($user)}}--}}
								<div class="tab-content">
									<div id="tab1" class="tab-pane active">
										<header>
											<h2>Mi cuenta</h2>
											<p>Aquí están sus informaciones personales. Puedes actualizarla a cualquier
												momento.</p>
										</header>
										<form class="profile-form form-horizontal" method="post"
												action="{{ action('UserController@updateUser', $user['id']) }}"
												autocomplete="off"
												enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="my-intro">
												<div class="img-holder">
													<img src="/{{ $user['avatar'] }}" alt="your photo"
														  onerror="this.src='/images/image-none.jpg';">
													<input class="form-control" name="image" type="file">
												</div>
												<div class="text">
													<p>Las fotos frontales son muy importantes para que los anfitriones y huespedes
														peudan conocerse mejor. Hospedar a un paisaje no us muy divertido que digamos!
														por favor, sube una foto en la que se vea claramente tu cara.</p>
												</div>
											</div>
											<div class="sub-row">
												<label for="number">Nombre</label>
												<div class="text-field">
													<input type="text" placeholder="" class="form-control" id="number"
															 name="first_name" value="{{ $user['first_name'] }}">
												</div>
											</div>
											<div class="sub-row">
												<label for="lname">Apellido</label>
												<div class="text-field">
													<input type="text" placeholder="Lostarum" class="form-control" id="lname"
															 name="last_name" value="{{ $user['last_name'] }}">
												</div>
											</div>
											<div class="sub-row">
												<label>Soy</label>
												<div class="select-box">
													<div class="select-field">
														<select name="gender">
															<option value="">Sexo</option>
															<option value="m" @if ($user['gender'] == "m") selected @endif>Hombre
															</option>
															<option value="w" @if ($user['gender'] == "w") selected @endif>
																Mujer
															</option>
														</select>
													</div>

												</div>
											</div>
											<div class="sub-row">
												<label>Fecha de nacimiento</label>
												<div class="select-box">
													<?php $bday = strtotime($user['birthday']); ?>

													<div class="select-field">
														<select id="day" name="day">
															<option>Dia</option>
															@for ($i = 1; $i <= 31; $i++)
																<option value="{{ $i }}"
																		  @if ($i == date('d', $bday)) selected @endif> {{ $i }}</option>
															@endfor
														</select>
													</div>
													<div class="select-field day">
														<select id="month" name="month">
															<option value="">Mes</option>
															@for ($i = 1; $i <= 12; $i++)
																<option value="{{ $i }}"
																		  @if ($i == date('m', $bday)) selected @endif> {{ $i }}</option>
															@endfor
														</select>
													</div>
													<div class="select-field year">
														<select id="year" name="year">
															<option>Ano</option>
															@for ($i = 1960; $i < 2000; $i++)
																<option value="{{ $i }}"
																		  @if ($i == date('Y', $bday)) selected @endif> {{ $i }}</option>
															@endfor
														</select>
													</div>

												</div>
											</div>
											<div class="sub-row">
												<label for="email">Correo electronico</label>
												<div class="text-field">
													<input type="email" placeholder="" class="form-control" id="email" name="email"
															 value="{{ $user['email'] }}">
													<p>No compartimremos tu direction de correo electronico personal con otros
														usarios</p>
												</div>
											</div>
											<div class="sub-row">
												<label for="phone">Teléfono</label>
												<div class="text-field">
													<input type="text" placeholder="" class="form-control" id="phone" name="phone"
															 value="{{ $user['phone'] }}">
												</div>
											</div>
											<div class="sub-row">
												<label for=""></label>
												<div class="text-field">
													<button type="submit" class="btn btn-success">ACTUALIZAR</button>
												</div>
											</div>
											<!-- Form Actions -->
										</form>
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
										@if (Session::get('success'))
											<div class="alert info">{{ Session::get('success') }}</div>
										@endif
									</div>
									<div id="tab2" class="tab-pane">
										<header>
											<h2>Mis Aventuras</h2>
											<p>Aquí encontrarás todas sus aventuras.</p>
										</header>
										<ul class="item-list">
											{{--@foreach ($reservations as $reservation)--}}
											{{--<li>--}}
											{{--<ul class="timing">--}}
											{{--<header>--}}
											{{--<div class="ico"><img alt="image description"--}}
											{{--src="{{ $reservation->offer['activity']['image_icon'] }}">--}}
											{{--</div>--}}
											{{--<div class="text">--}}
											{{--<h2><a href="#" data-toggle="modal"--}}
											{{--data-target="#myModal">{{ $reservation->offer['activity']['name'] }}</a>--}}
											{{--</h2>--}}
											{{--<strong class="sub-title">{{ $reservation->offer['agency']['name'] }}--}}
											{{--<span>{{ $reservation->offer['agency']['address'] }} </span></strong>--}}
											{{--</div>--}}
											{{--</header>--}}
											{{--<li class="time">--}}
											{{--<strong--}}
											{{--class="title">Día: {{ date("d/m/Y", strtotime($reservation->reserve_date)) }}</strong>--}}
											{{--<strong><span>Duracion:</span> {{ $reservation->offer['end_hour'] - $reservation->offer['start_hour'] }}--}}
											{{--hrs</strong>--}}
											{{--<strong><span>Horario:</span> {{ $reservation->offer['start_hour'] }}--}}
											{{--:{{ $reservation->offer['start_min'] }}--}}
											{{--a {{ $reservation->offer['end_hour'] }}--}}
											{{--:{{ $reservation->offer['end_min'] }}</strong>--}}
											{{--</li>--}}
											{{--<li class="person">--}}
											{{--<strong><span>{{ $reservation->persona }}</span> persona</strong>--}}
											{{--</li>--}}
											{{--</ul>--}}
											{{--<!-- <a href="#" class="remove"><span>cancelar</span></a> -->--}}
											{{--</li>--}}
											{{--@endforeach--}}
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<!-- <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
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
					<a href="#" class="btn btn-success">CONFIRMAR</a>
					<a href="#" class="btn btn-warning">CANCELAR</a>
				</div>
			</div>
		</div>
	</div> -->
@stop
