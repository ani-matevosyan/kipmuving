<!doctype html>
<html lang="{{ $currentLocale['code'] ? $currentLocale['code'] : 'en' }}">

<head>
	@include('site.head.metatags')

	@if(isset($title))
		<title>KipMuving Turismo em Pucon: {{ $title }}</title>
	@else
		<title>KipMuving</title>
	@endif

	@include('site.head.styles')
</head>

{{--{{ dd(session('cities')) }}--}}
<body>
<div class="main-wrapper">

	<header class="main_header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-6">

					{{-----------------Version with picking city option---------------}}

					{{--<div class="logo-wrapper">--}}
						{{--<div class="logo">--}}
							{{--<a href="{{ action('HomeController@index') }}">--}}
								{{--<img src="{{ asset('/images/logo'.session('cities.current').'.svg') }}"--}}
									  {{--alt="image description"--}}
									  {{--onerror="this.onerror=null; this.src='{{ asset('/images/logo1.png') }}'">--}}
							{{--</a>--}}
						{{--</div>--}}
						{{--<div class="dropdown location-dropdown">--}}
							{{--<a href="#" data-toggle="dropdown">{{session('cities.current')}} <span class="glyphicon glyphicon-menu-down"></span></a>--}}
							{{--<ul class="dropdown-menu">--}}
								{{--@foreach(session('cities.list') as $city)--}}
									{{--@continue(session('cities.current') == $city)--}}
									{{--<li>--}}
										{{--<a href="{{ action('CityController@setCity', [--}}
											{{--'city' => $city,--}}
											{{--'route' => \Illuminate\Support\Facades\Request::route()->getName()--}}
										{{--]) }}">--}}
											{{--<img src="{{ asset('/images/logo'.$city.'.svg') }}" alt="Kipmuving {{ $city }} logo">{{$city}}--}}
										{{--</a>--}}
									{{--</li>--}}
								{{--@endforeach--}}
							{{--</ul>--}}
						{{--</div>--}}
					{{--</div>--}}

					{{-----------------Version without picking city option---------------}}

					<div class="logo-wrapper">
						<div class="logo">
							<a href="{{ action('HomeController@index') }}">
								<img src="{{ asset('/images/KipMuving-white.svg') }}"
									 alt="image description"
									 onerror="this.onerror=null; this.src='{{ asset('/images/logo1.png') }}'">
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-lg-push-6 col-md-4 col-md-push-5 col-xs-6">
					<div class="header-panel">
						<div class="burger-menu">
							<div class="burger"></div>
						</div>
						<div class="country">
							<div class="pick-lang">
								<img src="{{ asset('/images/'.$currentLocale['code'].'-flag.svg') }}"
									  alt="image description" class="current-lang">
								<span class="glyphicon glyphicon-triangle-top"></span>
								<ul class="choose-menu choose-lang">
									@foreach($locales as $locale)
										@if($locale['code'] != 'en')
										<li>
											<a href="{{ action('LocaleController@setLocale', $locale['code']) }}">
												<img src="{{ asset('/images/'.$locale['code'].'-flag.svg') }}"
													  alt="image description">
											</a>
										</li>
										@endif
									@endforeach
								</ul>
							</div>
							<div class="pick-curr">
								<span class="current-curr">{{ session('currency.type') }} $</span>
								<span class="glyphicon glyphicon-triangle-top"></span>
								<ul class="choose-menu choose-curr">
									@foreach(session('currencies') as $currency)
										@continue($currency == session('currency.type'))
										<li><a
													href="{{ action('CurrencyController@setCurrency', $currency) }}">{{ $currency }}</a>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
						@if (!Auth::guest())
							<div class="btn-holder dropdown">
								<div class="avatar-wrapp">
										<img src="{{ asset($currentUser['avatar']) }}"
											  onerror="this.src='{{ asset('/images/image-none.jpg') }}';"
											  alt="Account name">
								</div>
								<a href="#" data-toggle="dropdown" title="{{ $currentUser['username'] ? $currentUser['username'] : $currentUser['first_name'] }}" class="btn btn-primary orange-btn">
									{{ $currentUser['username'] ? $currentUser['username'] : $currentUser['first_name'] }}
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="{{ action('UserController@getUser') }}" class="btn btn-primary orange-btn"
										   title="{{ trans('main.my_account') }}">
											{{ trans('main.my_account') }}
										</a>
									</li>
									<li>
										<a href="{{ url('/logout') }}" class="btn btn-primary orange-btn"
										   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
										   title="SALIR">SALIR</a>
										<form id="logout-form" action="{{ url('/logout') }}" method="POST"
											  style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</div>
						@else
							<div class="btn-holder btn-holder_withoutavatar">
								<a href="{{ url('/login') }}"
									class="btn btn-primary orange-btn">{{ trans('button-links.login') }}</a>
							</div>
						@endif
						<div class="info-tour"></div>
					</div>
				</div>
				<div class="col-lg-6 col-lg-pull-3 col-md-5 col-md-pull-4 col-xs-12">
					<nav class="top_nav">
						<ul>
							<li><a
									href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a>
							</li>
							<li><a
									href="{{ action('AgencyController@index') }}">{{ trans('button-links.agencies') }}</a>
							</li>
							<li><a
									href="{{ action('GuiaController@index') }}">{{ trans('button-links.guide') }}</a>
							</li>
						</ul>
						<div class="nav-cover"></div>
					</nav>
				</div>
			</div>
		</div>
	</header>

	@yield('content')

	<footer id="footer">
		<div class="holder">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-12 box">
					<strong class="title">KipMuving</strong>
					<nav class="footer-nav">
					<ul>
					<li><a href="{{ action('AboutController@index') }}">Quien Somos</a></li>
					<li><a href="#">Contacto</a></li>
					</ul>
					</nav>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 box">
						<div class="payment-cards-wrapper">
							<ul class="payment-cards">
								@for($i = 1; $i <= 6; $i++)
									<li>
										<img src="{{ asset('/images/card'.$i.'.png') }}" alt="image description">
									</li>
								@endfor
							</ul>
							<img src="/images/pagseguro_logo.png" alt="Pagseguro logo">
							<img src="/images/payu_logo.png" alt="PayU logo">
						</div>
					</div>
					<div class="col-md-3 col-sm-5 col-xs-12 box">
						<strong class="title">{{ trans('main.where_we_are') }}</strong>
						<address class="address">
							<span class="adress-first-child">Colo Colo 485 - Pucón - Chile</span>
							<span>
								<a href="tel:56452444035" class="tel">+56 45 2444035</a>
							</span>
							<span>
								<a href="tel:56962266304" class="tel">+56 9 62266304</a>
							</span>
						</address>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 box">
						<div class="contact-form-wrapper">
							<strong class="title">{{ trans('main.contact_us') }}</strong>
							{{--rafaelzarro@gmail.com--}}
							<form action="{{ action('HomeController@sendMessage') }}" class="contact-form" method="POST">
								{{ csrf_field() }}
								<div class="sub-row">
									<label for="name">{{ trans('form.name') }}</label>
									<div class="text-field">
										<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
									</div>
								</div>
								<div class="sub-row">
									<label for="email">{{ trans('form.email') }}</label>
									<div class="text-field">
										<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
									</div>
								</div>
								<div class="sub-row">
									<label for="message">{{ trans('form.message') }}</label>
									<div class="text-field">
										<textarea rows="5" cols="5" class="form-control" id="message" name="message">{{ old('message') }}</textarea>
									</div>
								</div>
								<div class="sub-row captcha-row" style="display:none;">
									<label for="captcha">captcha</label>
									<div class="text-field captcha-field">
										{!! Recaptcha::render(['lang' => app()->getLocale(), 'theme' => 'dark']) !!}
									</div>
								</div>
								<input type="submit" value="OK" class="btn btn-success">
							</form>
							@if($errors->has('text'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('text') }}</strong>
								</div>
							@endif
							@if($errors->has('email'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('email') }}</strong>
								</div>
							@endif
							@if($errors->has('message'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('message') }}</strong>
								</div>
							@endif
							@if($errors->has('g-recaptcha-response'))
								<div class="alert alert-error alert-danger">
									<strong>{{ $errors->first('g-recaptcha-response') }}</strong>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<a href="mailto:contacto@kipmuving.com" class="email">contacto@kipmuving.com</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="message-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Por favor</h4>
			</div>
			<div class="modal-body">
				<p id="message">&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">CONFIRMAR</h4>
			</div>
			<div class="modal-body">
				<p id="message">¿Le gustaría remover esta actividad?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-success btn-confirm">CONFIRMAR</a>
				<a href="#" class="btn btn-warning" data-dismiss="modal">CANCELAR</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="map-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">MAPA</h4>
			</div>
			<div class="modal-body">
				<div id="map-container" style="width: 100%; height: 500px"></div>
			</div>
			<div class="modal-footer">
				<!-- <a href="#" class="btn btn-success btn-confirm">CONFIRMAR</a> -->
				<a href="#" class="btn btn-warning" data-dismiss="modal">CERRAR</a>
			</div>
		</div>
	</div>
</div>

{{--Scripts--}}
@include('site.foot.footer-scripts')
<script type="text/javascript">
    if (navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)) {
        var msViewportStyle = document.createElement('style');
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto !important}'
            )
        );
        document.querySelector('head').appendChild(msViewportStyle)
    }
</script>

<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '119672825260989');
	fbq('track', 'PageView');
</script>
<noscript>
	<img height="1" width="1"
			 src="https://www.facebook.com/tr?id=119672825260989&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

{{--Google analitics--}}
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-98615217-1', 'auto');
	ga('send', 'pageview');

</script>
{{--Google analitics--}}



{{--/Scripts--}}

</body>
</html>
