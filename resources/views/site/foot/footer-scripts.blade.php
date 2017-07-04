<script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.main.min.js') }}"></script>

@if(isset($scripts) && count($scripts) > 0)
	@foreach($scripts as $script)
		<script type="text/javascript" src="{{ asset($script) }}"></script>
	@endforeach
@endif

<script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.min.js') }}"></script>