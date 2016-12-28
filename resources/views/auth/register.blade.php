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
					<div class="page-header">
						<h1><strong>{{ trans('main.register') }}</strong></h1>
						<p>{{ trans('main.welcome_to_site') }}</p>

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
						@if($errors->has('password_confirmation'))
							<div class="alert alert-error alert-danger">
								<strong>{{ $errors->first('password_confirmation') }}</strong>
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
						<form class="form-horizontal registration registration-login " method="POST" action="{{ url('/register') }}" accept-charset="UTF-8">
							{{ csrf_field() }}
							<fieldset>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="first_name">
											{{ trans('form.first_name') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="1" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="last_name">
											{{ trans('form.last_name') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="2" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="email">
											{{ trans('form.email') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="3" type="email" name="email" id="email" value="{{ old('email') }}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="phone">
											{{ trans('form.phone') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="4" type="text" name="phone" id="phone" value="{{ old('phone') }}">
										</div>
										<p>* como whastapp, su teléfono completo con +</p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="phone">
											{{ trans('form.password') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="5" type="password" name="password" id="password">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label" for="phone">
											{{ trans('form.confirm_password') }}
										</label>
									</div>
									<div class="col-md-8">
										<div class="text-field">
											<input class="form-control" tabindex="5" type="password" name="password_confirmation" id="password_confirmation">
										</div>
										<div class="checkbox">
											<div class="subscribe_check">
												<label for="subscribe">
													<input type="checkbox" name="subscribe" id="chk1" @if(old('subscribe') == 'on') checked @endif>&nbsp;&nbsp;
													{{ trans('form.news_subscribe') }}
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="confirmregistration">
											<button tabindex="6" type="submit" class="btn btn-primary">{{ trans('button-links.register') }}</button>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
