@if(isset($scripts) && count($scripts) > 0)
	@foreach($scripts as $script)
		@if(is_array($script))
			<script type="text/javascript" async defer src="{{ $script['link'] }}"></script>
		@else
			<script type="text/javascript" src="{{ asset(elixir($script)) }}"></script>
		@endif
	@endforeach
@else
	<script type="text/javascript" src="{{ asset(elixir('js/common.js')) }}"></script>
@endif

