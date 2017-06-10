<!doctype html>
<html>

<head>
	@include('site.head.metatags')

	<title>KipMuving Turismo</title>

	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/fonts.min.css') }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/entrance-style.min.css') }}">

	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

</head>
<body>
<header>
	<h1>
		<span>Kipmuving</span>
		<a href="#"><img src="{{ url('/images/KipMuving-white.svg') }}" alt="Kipmuving logo"></a>
	</h1>
</header>

<div class="slogan-wrapper">
	<div class="slogan">
		<strong>Chile, mejor destino turismo de aventura 2017</strong>
		<span>¿A donde quieres ir, Norte or Sur?</span>
	</div>
</div>

<div class="entrance-options">
	<div class="option atacama">
		<a href="{{ action('CityController@setCity', ['city' => 'atacama', 'route' => 'home']) }}">Atacama</a>
	</div>
	<div class="option pucon">
		<a href="{{ action('CityController@setCity', ['city' => 'pucon', 'route' => 'home']) }}">Pucón</a>
	</div>
</div>

<div class="descr">
	<p>KipMuving es el mayor portal de agencias de turismo y aventuras. Todas las agencias de Atacama y Pucón en un sólo lugar.
		Puedes comprar precios y servicios. <strong>Todas con 10% de descuento.</strong> La mejor opción para crear su panorama.</p>
</div>
<footer>

	<a href="/" class="kipmuving">www.kipmuving.com</a>
	<div class="soc-links">
		<a href="#"><img src="{{ url('/images/instagram-white.svg') }}" alt="instagram"></a>
		<a href="#"><img src="{{ url('/images/facebook.svg') }}" alt="facebook"></a>
	</div>

</footer>
</body>
</html>