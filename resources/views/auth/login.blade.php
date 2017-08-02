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
			<div class="page-header">
				<h1><strong>{{ trans('main.login') }}</strong></h1>
				<p class="registration__text">{{ trans('main.login_to_modify') }}</p>

				@if(session()->has('error'))
					<div class="alert alert-danger" role="alert">
						{{ session('error') }}
					</div>
				@endif

				<form class="form-horizontal registration registration-login " method="POST" action="/login" accept-charset="UTF-8">
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
						<div class="form-group log-in-services">
							<p class="log-in-services__text">Or Log In with with one of these services</p>
							<a class="btn log-in-services__button" href="{{ route('auth.facebook') }}">
								<img src="{{ asset('/images/facebook-button.png') }}" class="log-in-services__image" alt="facebook icon">
							</a>
							<a class="btn log-in-services__button" href="{{ route('auth.google') }}">
								<img src="{{ asset('/images/google-plus-button.png') }}" class="log-in-services__image" alt="google plus icon">
							</a>
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
