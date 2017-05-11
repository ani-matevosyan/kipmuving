{{--ALL--}}
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/fonts.min.css') }}">

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

<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">