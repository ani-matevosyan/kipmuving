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
				<p class="login-page__description">{{ trans('main.log_in_at') }}<strong>Aventuras Chile</strong>{{ trans('main.or_register') }}</p>

				@if(session()->has('error'))
					<div class="alert alert-danger" role="alert">
						{{ session('error') }}
					</div>
				@endif
				<div class="row">
					<div class="login-content col-sm-6">
						<div class="login-form-div">
							<div class="login-content__social-buttons">
								<a class="social-login-button social-login-button__facebook" href="{{ route('auth.facebook') }}">{{ trans('main.login_with') }}<strong>Facebook</strong></a>
								<a class="social-login-button social-login-button__google" href="{{ route('auth.google') }}">{{ trans('main.login_with') }}<strong>Google</strong></a>
								<p class="login-content__text-between"><span class="login-content__text-between-inside">{{ trans('main.or_with_your_password') }}Aventuras Chile</span></p>
							</div>
							<form method="POST" action="/login" accept-charset="UTF-8" class="login-form">
								{{ csrf_field() }}
								<div class="login-form__group">
									<label for="email" class="login-form__label">E-mail</label>
									<input type="email" id="email" tabindex="1" name="email" class="login-form__input" value="{{ old('email') }}">
								</div>
								<div class="login-form__group">
									<label for="password" class="login-form__label">{{ trans('main.password') }}</label>
									<input type="password" id="password" tabindex="2" name="password" class="login-form__input">
								</div>
								<div class="login-form__group login-form__group_links">
									<label for="remember" class="blue-checkbox">
										<input class="blue-checkbox__input" id="remember" type="checkbox" checked name="remember">
										<span class="blue-checkbox__mark"></span>
										<span class="blue-checkbox__text">{{ trans('form.remember_me') }}</span>
									</label>
								</div>
								<button tabindex="3" type="submit" class="orange-button orange-button_block">{{ trans('button-links.login') }}</button>
							</form>
						</div>
					</div>
					<div class="login-content-no-account col-sm-6">
						<p>{{ trans('main.dont_have_account') }}</p>
						<a class="green-link" href="{{ url('/register') }}">{{ trans('main.register_here') }}</a>
					</div>
				</div>
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
