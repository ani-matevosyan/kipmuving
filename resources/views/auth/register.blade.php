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
								<h1>{{ trans('main.register') }}</h1>
								<p>{{ trans('main.welcome_to_site') }}</p>
								<div class="holder">
									<div class="subrow">
										<div class="col">
											<label for="first_name">{{ trans('form.first_name') }}</label>
											<div class="text-field">
												<input class="form-control" type="text" value="{{ old('first_name') }}"
														 name="first_name" id="first_name" placeholder="{{ trans('form.first_name_placeholder') }}">
											</div>
										</div>
										<div class="col">
											<label for="last_name">{{ trans('form.last_name') }}</label>
											<div class="text-field">
												<input class="form-control" type="text" value="{{ old('last_name') }}"
														 name="last_name" id="last_name" placeholder="{{ trans('form.last_name_placeholder') }}">
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="email">{{ trans('form.email') }}</label>
											<div class="text-field">
												<input class="form-control" value="{{ old('email') }}" type="email"
														 name="email" id="email" placeholder="{{ trans('form.email_placeholder') }}">
											</div>
										</div>
										<div class="col">
											<label for="password">{{ trans('form.password') }}</label>
											<div class="text-field">
												<input class="form-control" type="password" name="password"
														 id="password" placeholder="{{ trans('form.password_placeholder') }}">
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="birthday" class="birth">{{ trans('form.birthday') }}</label>
											<div class="select-field month">
												{{--<p>{{ old('month') }}</p>--}}
												<select id="month" name="month">
													<option disabled selected value="">{{ trans('form.month') }}</option>
													@for ($i = 1; $i <= 12; $i++)
														<option value="{{ $i }}" @if(old('month') == $i) selected @endif> {{ $i }}</option>
													@endfor
													{{--<option>Jan</option>--}}
													{{--<option>Feb</option>--}}
													{{--<option>March</option>--}}
												</select>
											</div>
											<div class="select-field day">
												<select id="day" name="day">
													<option disabled selected value="">{{ trans('form.day') }}</option>
													@for ($i = 1; $i <= 31; $i++)
														<option value="{{ $i }}" @if(old('day') == $i) selected @endif> {{ $i }}</option>
													@endfor
												</select>
											</div>
											<div class="select-field day">
												<select id="year" name="year">
													<option disabled selected value="">{{ trans('form.year') }}</option>
													@for ($i = 1960; $i < 2000; $i++)
														<option value="{{ $i }}" @if(old('year') == $i) selected @endif> {{ $i }}</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="col add">
											<input type="checkbox" id="chk1" name="subscribe" @if(old('subscribe') == 'on') checked @endif>
											<div class="text">
												<label for="chk1">{{ trans('form.news_subscribe') }}</label>
											</div>
										</div>
									</div>
									<div class="subrow">
										<div class="col">
											<label for="key">{{ trans('form.phone') }}</label>
											<div class="text-field">
												<input class="form-control" type="text" name="phone" id="phone"
														 placeholder="{{ trans('form.phone_placeholder') }}" value="{{ old('phone') }}">
											</div>
										</div>
									</div>
									<div class="text-area">
										<p>{{ trans('form.accept_terms') }}</p>
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
										<input type="submit" value="{{ trans('button-links.register') }}" class="btn btn-primary">
										<div class="text-logout">{{ trans('form.already_member') }} <a href="/login">{{ trans('button-links.login') }}</a>
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
