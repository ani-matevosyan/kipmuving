@if(isset($scripts) && count($scripts) > 0)
	@foreach($scripts as $script)
		<script type="text/javascript" src="{{ asset($script) }}"></script>
	@endforeach
@else
	<script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
@endif

