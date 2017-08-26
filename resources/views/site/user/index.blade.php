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
							<div class="form-wrapper">
								<div class="row">
									<div class="col-sm-2">
										<div class="my-intro">
											<div class="img-holder">
												<img src="{{ $user->avatar }}" alt="your photo"
													 onerror="this.src='{{ asset('images/image-none.jpg') }}';" id="youravatar">
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
									<div class="col-sm-10">
										<form class="profile-form form-horizontal" method="post"
											  action="{{ action('UserController@updateUser', $user->id) }}"
											  autocomplete="off"
											  enctype="multipart/form-data">
											{{ csrf_field() }}
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
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@stop
