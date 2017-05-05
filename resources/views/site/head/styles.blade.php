{{--ALL--}}
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/fonts.css') }}">

@if(isset($styles) && count($styles) > 0)
	@foreach($styles as $style)
		@if(is_array($style))
			<link rel="stylesheet" type="text/css" media="{{ $style['media'] ? $style['media'] : 'all' }}"
						href="{{ asset($style['link'] ? $style['link'] : '') }}">
		@else
			<link rel="stylesheet" type="text/css" media="all" href="{{ asset($style) }}">
		@endif
	@endforeach
@endif

<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/brand.min.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/custom.min.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/style.min.css') }}">


{{--Guide without decarro--}}
{{--<link rel='stylesheet' type="text/css" media="all" href='{{ asset('css/mapbox/mapbox.css') }}'/>--}}

{{--Datepicker--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/jquery-ui.min.css') }}" >--}}

{{--Calendar page--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">--}}
{{--<link rel="stylesheet" type="text/css" media="print" href="{{ asset('plugins/fullcalendar/fullcalendar.print.css') }}" >--}}

{{--Where tour--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/product-tour.min.css') }}" >--}}

{{--Activity single--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/prettyPhoto.css') }}" >--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/chosen/chosen.min.css') }}" >--}}

{{--Where instagram--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/instafeed/instafeed.min.css') }}">--}}

{{--Activities page--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('owl-carousel/owl.carousel.css') }}">--}}
{{--<link rel="stylesheet" type="text/css" media="all" href="{{ asset('owl-carousel/owl.theme.css') }}">--}}

{{--To del--}}
<link rel='stylesheet' type="text/css" href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900'>

<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

{{--All--}}
<script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
{{--Where google maps--}}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8"></script>

{{--Calendar page footer--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/lib/moment.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/es.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/pt.js') }}"></script>--}}
