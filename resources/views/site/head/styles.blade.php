{{--ALL--}}
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/fonts.min.css') }}">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/common.min.css') }}">

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

<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">