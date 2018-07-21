@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main" class="user-account-page">
		<div class="container-fluid">
			<header class="user-page-header user-account-page__header">
				<h1 class="user-page-header__title">{{ trans('main.my_account') }}</h1>
				<p class="user-page-header__description">{{ trans('main.here_your_personal_info') }}</p>
			</header>
			<section class="s-user-information">
				<div class="s-user-information__errors">
					{{--<div class="alert alert-error alert-danger">--}}
						{{--<strong>Error!</strong>--}}
					{{--</div>--}}

					{{--<div class="alert alert-info">Good!</div>--}}

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
				</div>

				<div class="user-form">
					{{--TODO delete this avatar form, see display:none--}}
					<div class="user-form__avatar" style="display: none">
						<div class="load-image">
							<img class="load-image__image" src="{{ $user->avatar }}" alt="your photo"
								 onerror="this.src='{{ asset('images/image-none.jpg') }}';" id="youravatar">
							<form enctype="multipart/form-data"
								  action="{{ action('UserController@updateUsersAvatar', $user->id) }}"
								  method="post" name="loadavatar" target="hiddenframe" class="load-image__form">
								{{ csrf_field() }}
								<input id="image" name="image" type="file" class="load-image__input">
								<label for="image" class="load-image__label">Upload avatar</label>
							</form>
							<iframe id="hiddenframe" name="hiddenframe"
									style="width:0px; height:0px; border:0px"></iframe>
						</div>
					</div>
					<div class="user-form__details-form">
						<form class="user-details-form" method="post"
							  action="{{ action('UserController@updateUser', $user->id) }}"
							  autocomplete="off"
							  enctype="multipart/form-data">
							{{ csrf_field() }}
                            <div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="first_name" class="user-details-form__label">{{ trans('form.first_name') }}</label>
								</div>
								<input type="text" id="first_name" name="first_name" class="user-details-form__input" value="{{ $user->first_name }}">
							</div>
							<div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="last_name" class="user-details-form__label">{{ trans('form.last_name') }}</label>
								</div>
								<input type="text" id="last_name" name="last_name" class="user-details-form__input" value="{{ $user->last_name }}">
							</div>
							<div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="email" class="user-details-form__label">{{ trans('form.email') }}</label>
								</div>
								<input type="email" id="email" name="email" class="user-details-form__input" value="{{ $user->email }}">
							</div>
							<div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="phone" class="user-details-form__label">{{ trans('form.phone') }}</label>
								</div>
								<input type="text" id="phone" name="phone" class="user-details-form__input" value="{{ $user->phone }}">
								<span>* como whastapp, su teléfono completo con +</span>
							</div>
							<div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="password" class="user-details-form__label">{{ trans('form.new_password') }}</label>
								</div>
								<input type="password" id="password" name="password" class="user-details-form__input">
							</div>
							<div class="user-details-form__form-group">
								<div class="user-details-form__label-wrap">
									<label for="password_confirmation" class="user-details-form__label">{{ trans('form.new_password_confirm') }}</label>
								</div>
								<input type="password" id="password_confirmation" name="password_confirmation" class="user-details-form__input">
							</div>
                            <div class="subscribe_check checkbox user-details-form__form-group">
                                <label for="subscribe">
                                    <input type="checkbox" name="subscribe" id="chk1" @if(old('subscribe') == 'on') checked @endif>
                                    {{ trans('form.news_subscribe') }}
                                </label>
                            </div>
							<button class="user-details-form__update-button">{{ trans('main.update') }}</button>
						</form>
					</div>
				</div>
			</section>
		</div>
	</main>
@stop
