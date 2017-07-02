@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="#">HOME</a></li>
					<li><a href="#">SU AGENDA</a></li>
					<li>su registro</li>
				</ul>
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<form class="registration" method="POST" action="/registro">
							<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
							<h1>Su registro</h1>
							<p>Bienvenido al mayor sitio de aventuras de Pucón, donde podrá encontrar las mejores opciones y precios de las aventuras disponibles.</p>
							<div class="holder">
								<div class="subrow">
									<div class="col">
										<label for="first_name">Nombre</label>
										<div class="text-field">
											<input class="form-control" placeholder="" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name') }}}" required>
										</div>
									</div>
									<div class="col">
										<label for="last_name">Apellido</label>
										<div class="text-field">
											<input class="form-control" placeholder="" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name') }}}" required>
										</div>
									</div>
								</div>
								<div class="subrow">
									<div class="col">
										<label for="email">Email</label>
										<div class="text-field">
											  <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}" required>
										</div>
									</div>
									<div class="col">
										<label for="key">Clave</label>
										<div class="text-field">
												<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password" required>
										</div>
									</div>
								</div>
								<div class="subrow">
									<div class="col">
										<label for="birthday" class="birth">Cumpleanos</label>
										<div class="select-field month">
											<select id="month" name="month">
												<option value="">Mes</option>
												@for ($i = 1; $i <= 12; $i++)
												  <option value="{{ $i }}"> {{ $i }}</option>
												@endfor
												<option>Jan</option>
												<option>Feb</option>
												<option>March</option>
											</select>
										</div>
										<div class="select-field day">
											<select id="day" name="day">
												<option>Dia</option>
												@for ($i = 1; $i <= 31; $i++)
												  <option value="{{ $i }}"> {{ $i }}</option>
												@endfor
											</select>
										</div>
										<div class="select-field day">
											<select id="year" name="year">
												<option>Ano</option>
												@for ($i = 1960; $i < 2000; $i++)
												  <option value="{{ $i }}"> {{ $i }}</option>
												@endfor
											</select>
										</div>
									</div>
									<div class="col add">
										<input type="checkbox" id="chk1">
										<div class="text"><label for="chk1">Me gustaría recibir cupones por email</label></div>
									</div>
								</div>
								<div class="subrow">
									<div class="col">
										<label for="key">Teléfono</label>
										<div class="text-field">
												<input class="form-control" type="text" name="phone" id="phone" placeholder="Como Whatsapp, ejemplo: +56962266304" required>
										</div>
									</div>
								</div>
								<div class="text-area">
									<p>Al registrarme, acepto las Condiciones del servicio, la Política de Privacidad y de Cookies, la Política de reembolso y las Condiciones de la Garantía de KipMuving.</p>
								</div>

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
									<div class="text-logout">¿Ya eres miembro de <a href="/login">Kipmuving?</a> Iniciar sesión</div>
								</footer>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
