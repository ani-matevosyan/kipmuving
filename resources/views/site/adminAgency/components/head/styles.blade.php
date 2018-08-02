{{--ALL--}}

@if(isset($styles) && count($styles) > 0)
	@foreach($styles as $style)
		@if(is_array($style))
			<link rel="stylesheet" type="text/css" media="{{ $style['media'] ? $style['media'] : 'all' }}"
						href="{{ asset($style['link'] ? $style['link'] : '') }}">
		@else
			<link rel="stylesheet" type="text/css" media="all" href="{{ asset(elixir($style)) }}">
		@endif
	@endforeach
@else
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset(elixir('css/admin-agency-common.css')) }}">
@endif

<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">