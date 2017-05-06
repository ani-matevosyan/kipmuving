<script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.main.min.js') }}"></script>

@if(isset($scripts) && count($scripts) > 0)
	@foreach($scripts as $script)
		<script type="text/javascript" src="{{ asset($script) }}"></script>
	@endforeach
@endif

<script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.min.js') }}"></script>

{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/lib/moment.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/es.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('plugins/fullcalendar/pt.js') }}"></script>--}}





{{-- Activity single --}}
{{--<script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>--}}

{{-- To del --}}
{{--<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/mapbox.js') }}"></script>--}}

{{-- Activity single --}}
{{--<script type="text/javascript" src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>--}}

{{-- Activities --}}
{{--<script type="text/javascript" src="{{ asset('owl-carousel/owl.carousel.min.js') }}"></script>--}}

{{-- Where instagram --}}
{{--<script type="text/javascript" src="{{ asset('js/instafeed/instafeed.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/instafeed/instafeed-settings.min.js') }}"></script>--}}

{{-- Where tour --}}
{{--<script type="text/javascript" src="{{ asset('js/product.tour.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/product-tour.min.js') }}"></script>--}}

{{-- Decarro --}}
{{--<script type="text/javascript" src="{{ asset('js/ResizeSensor.min.js') }}"></script>--}}

{{-- Activities --}}
{{--<script type="text/javascript" src="{{ asset('js/floating/floating-1.12.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/floating/floating.min.js') }}"></script>--}}

{{-- Intercom --}}
{{--<script>--}}
	{{--window.intercomSettings = {--}}
		{{--app_id: "vi9dynbu"--}}
	{{--};--}}
{{--</script>--}}
{{--<script>(function () {--}}
		{{--var w = window;--}}
		{{--var ic = w.Intercom;--}}
		{{--if (typeof ic === "function") {--}}
			{{--ic('reattach_activator');--}}
			{{--ic('update', intercomSettings);--}}
		{{--} else {--}}
			{{--var d = document;--}}
			{{--var i = function () {--}}
				{{--i.c(arguments)--}}
			{{--};--}}
			{{--i.q = [];--}}
			{{--i.c = function (args) {--}}
				{{--i.q.push(args)--}}
			{{--};--}}
			{{--w.Intercom = i;--}}
			{{--function l() {--}}
				{{--var s = d.createElement('script');--}}
				{{--s.type = 'text/javascript';--}}
				{{--s.async = true;--}}
				{{--s.src = 'https://widget.intercom.io/widget/vi9dynbu';--}}
				{{--var x = d.getElementsByTagName('script')[0];--}}
				{{--x.parentNode.insertBefore(s, x);--}}
			{{--}--}}

			{{--if (w.attachEvent) {--}}
				{{--w.attachEvent('onload', l);--}}
			{{--} else {--}}
				{{--w.addEventListener('load', l, false);--}}
			{{--}--}}
		{{--}--}}
	{{--})()</script>--}}
{{-- /Intercom --}}