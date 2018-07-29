<!doctype html>
<html lang="{{ $currentLocale['code'] ? $currentLocale['code'] : 'en' }}">

<head>
	@include('site.head.metatags')

	@if(isset($title))
		<title>Aventuras Chile: {{ $title }}</title>
	@else
		<title>Aventuras Chile</title>
	@endif

	@include('site.head.styles')
</head>

{{--{{ dd(session('cities')) }}--}}
<body>
<div class="main-wrapper">
	<header class="main-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<div class="logo">
						<a href="{{ asset('/') }}" class="logo_a">
							<img src="{{ asset('/images/siteImages/logo_av.svg') }}" alt="Aventuras Chile logo">
						</a>
						<div class="dropdown pucon-state">
							<span data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								Pucon <span class="glyphicon glyphicon-triangle-bottom"></span>
							</span>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Pucon</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="mobile-sidebar">
					<header>
						<div class="mobile-sidebar__logo">
							<a href="{{ asset('/') }}">
								<img src="{{ asset('/images/aventuraschile_logo.png') }}" alt="Aventuras Chile logo">
							</a>
						</div>
						<button class="mobile-sidebar__close-btn"></button>
					</header>
					<div class="col-md-3 col-md-push-6 col-sm-8">
						<div class="main-header__right-side">
							{{--  <span class="info-btn"></span>  --}}
							<div class="dropdown language">
								<span data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<img src="{{ asset('/images/'.$currentLocale['code'].'-flag.svg') }}"
										alt="image description">
								</span>
								<ul class="dropdown-menu">
									@foreach($locales as $locale)
										<li>
											<a href="{{ action('LocaleController@setLocale', $locale['code']) }}">
												<img src="{{ asset('/images/'.$locale['code'].'-flag.svg') }}"
														alt="image description">
												<span>{{ $locale['name'] }}</span>
											</a>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="dropdown currency">
								<span data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									{{ session('currency.type') }} $
								</span>
								<ul class="dropdown-menu">
									@foreach(session('currencies') as $currency)
										@continue($currency == session('currency.type'))
										<li>
											<a href="{{ action('CurrencyController@setCurrency', $currency) }}">{{ $currency }}</a>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="main-header__divider"></div>
							@if (!Auth::guest())
								<div class="dropdown profile">
									<span data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="auth" title="{{ $currentUser['username'] ? $currentUser['username'] : $currentUser['first_name'] }}">
										{{ $currentUser['username'] ? $currentUser['username'] : $currentUser['first_name'] }}
									</span>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ action('UserController@getUser') }}" title="{{ trans('main.my_account') }}">
												{{ trans('main.my_account') }}
											</a>
											<hr>
										</li>
										<li>
											<a href="{{ action('UserController@getUserReservations') }}" title="{{ trans('main.my_reservations') }}">
												{{ trans('main.my_reservations') }}
											</a>
											<hr>
										</li>
										<li>
											<form id="logout-form" action="{{ url('/logout') }}" method="POST">
												<button type="submit">{{ trans('main.log_out') }}</button>
											</form>
										</li>
									</ul>
								</div>
							@else
								<a href="{{ url('/login') }}" class="auth">{{trans('main.login')}}</a>
							@endif
							<a href="{{ action('ReservationController@index') }}" class="shopping-cart">
								<img src="{{ asset('/images/cart.svg') }}" alt="Shopping cart icon">
								<span id="header-cart">{{ $count['special_offers'] + $count['offers'] }}</span>
							</a>
						</div>
					</div>
					<div class="col-md-6 col-md-pull-3 col-xs-12">
						<nav>
							<ul>
								<li>
									<a href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a>
								</li>
								{{--  <li>
									<a href="{{ action('AgencyController@index') }}">{{ trans('button-links.agencies') }}</a>
								</li>  --}}
								<li>
									<a href="{{ action('RoutesController@index') }}">{{ trans('button-links.guides_and_itineraries') }}</a>
								</li>
								<li>
									<a href="{{ action('GuideController@howToGetToPucon') }}">{{ trans('button-links.useful_information') }}</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="burger">
					<span></span>
				</div>
				<div class="main-header__overlay"></div>
			</div>
		</div>
	</header>

	@yield('content')

	<footer id="footer" class="main-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-4 col-xs-12 foot-block">
					<strong class="title">Aventuras Chile</strong>
					<nav class="footer-nav">
						<ul>
							<li><a href="{{ action('AboutController@index') }}">{{ trans('main.who_are_we') }}</a></li>
						</ul>
					</nav>
					<div class="made-with">{{ trans('main.made_with') }} <span class="heart"></span></div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12 foot-block">
					<strong class="title">{{ trans('main.where_we_are') }}</strong>
					<address class="address">
						<span class="adress-first-child">Colo Colo 485 - Pucón - Chile</span>
						<span>+56 9 6479 5729</span>
					</address>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12 foot-block">
					<strong class="title">Web</strong>
					<div class="social-links">
						<ul>
							<li>
								<a href="https://www.facebook.com/KipMuving-693742520728748/" rel="nofollow noopener" target="_blank"><img src="{{ asset('/images/facebook-dark-blue.svg') }}" width="13px" alt="facebook logo"></a>
							</li>
							<li>
								<a href="https://www.instagram.com/Aventuras Chile/" rel="nofollow noopener" target="_blank"><img src="{{ asset('/images/instagram-dark-blue.svg') }}" width="13px" alt="instagram logo"></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 col-sm-12 col-xs-12 foot-block">
					<div class="contact-form-wrapper">
						<strong class="title">{{ trans('main.contact_us') }}</strong>
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
							{{--<div class="sub-row captcha-row" style="display:none;">--}}
								{{--<label for="captcha">captcha</label>--}}
								{{--<div class="text-field captcha-field">--}}
									{{--{!! Recaptcha::render(['lang' => app()->getLocale(), 'theme' => 'dark']) !!}--}}
								{{--</div>--}}
							{{--</div>--}}
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

{{--<script>--}}
    {{--window.FCSP = 'a7159e9ba0d267713e72384e8a748dc4';--}}
{{--</script>--}}
{{--<script src="https://chat-assets.frontapp.com/v1/chat.bundle.js"></script>--}}


<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
    window.__lc.license = 9901030;
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
<!-- End of LiveChat code -->
</body>
</html>
