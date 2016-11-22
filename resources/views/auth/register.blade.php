@extends('site.layouts.default-new')

@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">HOME</a></li>
						<li><a href="#">SU AGENDA</a></li>
						<li>su registro</li>
					</ul>
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<form class="registration" method="POST" action="{{ url('/register') }}">
								{{--<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">--}}
								{{ csrf_field() }}
								<h1>Su registro</h1>
								<p>Bienvenido al mayor sitio de aventuras de Pucón, donde podrá encontrar las mejores
									opciones y precios de las aventuras disponibles.</p>
								<div class="holder">
									<div class="subrow">
										<div class="col">
											<label for="first_name">Nombre</label>
											<div class="text-field">
												<input class="form-control" type="text" value="{{ old('first_name') }}"
														 name="first_name" id="first_name">
											</div>
										</div>
										<div class="col">
											<label for="last_name">Apellido</label>
											<div class="text-field">
												<input class="form-control" type="text" value="{{ old('last_name') }}"
														 name="last_name" id="last_name">
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="email">Email</label>
											<div class="text-field">
												<input class="form-control" value="{{ old('first_name') }}" type="email"
														 name="email" id="email">
											</div>
										</div>
										<div class="col">
											<label for="password">Clave</label>
											<div class="text-field">
												<input class="form-control" type="password" name="password" id="password">
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="birthday" class="birth">Cumpleanos</label>
											<div class="select-field month">
												<select id="month" name="month">
													<option disabled selected value="">Mes</option>
													@for ($i = 1; $i <= 12; $i++)
														<option value="{{ $i }}"> {{ $i }}</option>
													@endfor
													{{--<option>Jan</option>--}}
													{{--<option>Feb</option>--}}
													{{--<option>March</option>--}}
												</select>
											</div>
											<div class="select-field day">
												<select id="day" name="day">
													<option disabled selected value="">Dia</option>
													@for ($i = 1; $i <= 31; $i++)
														<option value="{{ $i }}"> {{ $i }}</option>
													@endfor
												</select>
											</div>
											<div class="select-field day">
												<select id="year" name="year">
													<option disabled selected value="">Ano</option>
													@for ($i = 1960; $i < 2000; $i++)
														<option value="{{ $i }}"> {{ $i }}</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="col add">
											<input type="checkbox" id="chk1" name="subscribe">
											<div class="text">
												<label for="chk1">Me gustaría recibir cupones por email</label>
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="key">Teléfono</label>
											<div class="text-field">
												<input class="form-control" type="text" name="phone" id="phone"
														 placeholder="Como Whatsapp, ejemplo: +56962266304">
											</div>
										</div>
									</div>
									<div class="text-area">
										<p>Al registrarme, acepto las Condiciones del servicio, la Política de
											Privacidad y de Cookies, la Política de reembolso y las Condiciones de la
											Garantía de KipMuving.</p>
									</div>


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
									@if($errors->has('email'))
										<div class="alert alert-error alert-danger">
											<strong>{{ $errors->first('email') }}</strong>
										</div>
									@endif
									@if($errors->has('password'))
										<div class="alert alert-error alert-danger">
											<strong>{{ $errors->first('password') }}</strong>
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
									@if($errors->has('subscribe'))
										<div class="alert alert-error alert-danger">
											<strong>{{ $errors->first('subscribe') }}</strong>
										</div>
									@endif


									@if (Session::get('error'))
										<div class="alert alert-error alert-danger">
											@if (is_array(Session::get('error')))
												{{ head(Session::get('error')) }}
											@endif
										</div>
									@endif

									@if (Session::get('notice'))
										<div class="alert">{{ Session::get('notice') }}</div>
									@endif

									<footer>
										<input type="submit" value="REGISTRAR" class="btn btn-primary">
										<div class="text-logout">¿Ya eres miembro de <a href="/login">Kipmuving?</a>
											Iniciar sesión
										</div>
									</footer>
								</div>
							</form>
						</div>
						<!-- <div class="col-md-3 col-sm-12 col-xs-12">
							 <div class="social-likes">
								  <span class="divider"></span>
								  <div class="box">
										<ul>
											 <li><a href="#" class="facebook">Registrate con Facebook</a></li>
											 <li><a href="#" class="google">Registrate con Google</a></li>
										</ul>
								  </div>
							 </div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
