@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
					<li>{{ trans('main.your_agenda') }}</li>
					<li>{{ trans('main.reservation') }}</li>
				</ul>
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<form class="registration reser">
							<h1>{{ trans('main.login') }}</h1>
							<p>{{ trans('main.to_confirm_reservation') }}</p>
							<div class="holder">
								<div class="social-likes add">
									<!-- <ul>
										<li><a href="#" class="facebook">Registrate con Facebook</a></li>
										<li><a href="#" class="google">Registrate con Google</a></li>
									</ul> -->
									<a href="/register" class="btn-email">{{ trans('main.sign_up_using_your_email') }}</a>
								</div>
							</div>
							<footer>
								<div class="text-logout">{{ trans('form.already_member') }} <a href="/login">{{ trans('button-links.login') }}</a></div>
							</footer>
						</form>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
