<!doctype html>
<html lang="en">

<head>
	@include('site.adminAgency.components.head.metatags')
	@include('site.adminAgency.components.head.styles')
</head>

<body>
<div class="main-wrapper">
	<header class="main-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 col-sm-4">
					<div class="logo">
						<a href="{{ asset('/') }}" class="logo_a">
							<img src="{{ asset('/images/siteImages/logo_av.svg') }}" alt="Aventuras Chile logo">
						</a>
						<div class="dropdown pucon-state" style="display: none">
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
					<div class="col-md-1 col-md-push-9 col-sm-8">
						<div class="main-header__right-side">
							<div class="dropdown currency" style="display: none">
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
						</div>
					</div>
					<div class="col-md-9 col-md-pull-1 col-xs-12">
						<nav>
							<ul>
								<li>
									<a href="{{ action('AdminAgency\ReservationsController@index') }}">
										<img src="{{asset('/images/siteImages/adminAgency/reservas.svg')}}">
										<span class="header-menu-item">RESERVAS</span>
									</a>
								</li>
								<li>
									<a href="{{ route('adminAgency.activities') }}">
										<img src="{{asset('/images/siteImages/adminAgency/actividad.png')}}">
										<span class="header-menu-item">ACTIVIDAD</span>
									</a>
								</li>
								<li>
									<a href="">
										<img src="{{asset('/images/siteImages/adminAgency/clientes.png')}}">
										<span class="header-menu-item">CLIENTES</span>
									</a>
								</li>
								<li >
									<a href="">
										<img src="{{asset('/images/siteImages/adminAgency/proveedores.png')}}">
										<span class="header-menu-item">PROVEEDORES</span>
									</a>
								</li>
								<li>
									<a href="">
										<img src="{{asset('/images/siteImages/adminAgency/informes.png')}}">
										<span class="header-menu-item">INFORMES</span>
									</a>
								</li>
								<li>
									<a href="">
										<img src="{{asset('/images/siteImages/adminAgency/usuarios.png')}}">
										<span class="header-menu-item">USUARIOS</span>
									</a>
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


{{--Scripts--}}

@include('site.adminAgency.components.foot.footer-scripts')

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

{{--/Scripts--}}

</body>
</html>
