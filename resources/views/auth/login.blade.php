@extends('site.layouts.default-new')


{{-- Web site Title --}}
{{--@section('title')--}}
{{--{{ Lang::get('user/user.login') }} ::--}}
{{--@parent--}}
{{--@stop--}}

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="login-page">
				<h1 class="login-page__title">{{ trans('main.login') }}</h1>
				<p class="login-page__description">{{ trans('main.log_in_at') }}<strong>KeepMoving</strong>{{ trans('main.or_register') }}</p>

				@if(session()->has('error'))
					<div class="alert alert-danger" role="alert">
						{{ session('error') }}
					</div>
				@endif

				<div class="login-content">
					<div class="login-content__social-buttons">
						<a class="social-login-button social-login-button__facebook" href="{{ route('auth.facebook') }}">Iniciar sesión con <strong>Facebook</strong></a>
						<a class="social-login-button social-login-button__google" href="{{ route('auth.google') }}">Iniciar sesión con <strong>Google</strong></a>
						<p class="login-content__text-between">o con su email y clave en KeepMoving</p>
					</div>
					{{--<form method="POST" action="/login" accept-charset="UTF-8" class="login-form">--}}
						{{--{{ csrf_field() }}--}}
						{{--<div class="login-form__group">--}}
							{{--<label for="email" class="login-form__label">Email</label>--}}
							{{--<input type="email" id="email" tabindex="1" name="email" class="login-form__input" value="{{ old('email') }}">--}}
						{{--</div>--}}
						{{--<div class="login-form__group">--}}
							{{--<label for="password" class="login-form__label">Clave</label>--}}
							{{--<input type="password" id="password" tabindex="2" name="password" class="login-form__input">--}}
						{{--</div>--}}
					{{--</form>--}}
				</div>



				<form class="form-horizontal registration registration-login" method="POST" action="/login" accept-charset="UTF-8">
					{{ csrf_field() }}
					<fieldset>
						<div class="form-group">
							<div class="col-md-4">
								<label class="control-label" for="email">
									{{ trans('form.email') }}
								</label>
							</div>
							<div class="col-md-8">
								<div class="text-field">
									<input class="form-control" tabindex="1" type="text" name="email" id="email" value="{{ old('email') }}">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<label class="control-label" for="password">
									{{ trans('form.password') }}
								</label>
							</div>
							<div class="col-md-8">
								<div class="text-field">
									<input class="form-control" tabindex="2" type="password" name="password" id="password">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="checkbox">
									<div class="rememberme">
										<label for="remember">
											<input type="checkbox" name="remember" id="remember" checked>&nbsp;&nbsp;
											{{ trans('form.remember_me') }}
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="confirmlogin">
									<a href="{{ url('/register') }}">¿No tienes una cuenta?</a>
									<button tabindex="3" type="submit" class="btn btn-primary">{{ trans('button-links.login') }}</button>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
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
				@if(Session::has('success'))
					<div class="alert alert-info" role="alert">
						{{Session::get('success')}}
					</div>
				@endif
				@if(Session::has('fail'))
					<div class="alert alert-info" role="alert">
						{{Session::get('fail')}}
					</div>
				@endif
				@if(Session::has('info'))
					<div class="alert alert-info" role="alert">
						{{Session::get('info')}}
					</div>
				@endif
			</div>
		</div>
	</main>
@stop
