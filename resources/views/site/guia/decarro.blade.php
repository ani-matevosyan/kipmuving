@extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')
	<div class="detail-box active-tab" id="m-box-3">
		<div class="all-activities custom_title custom_title">
			<header class="light-blue">
				<h1>{{ trans('main.by_car_or_bus') }}</h1>
				<p>{{ trans('main.car_small_text') }}</p>
			</header>
		</div>
		<div class="infor-bar">
			<div class="row">
				<div class="col-xs-12">
					<p>{{ trans('main.car_big_text') }}</p>
				</div>
			</div>
		</div>

		{{ $activities[0]['short_description'] }}

		<div class="guide-places-plates-wrapper">
			@if(count($activities->where('category', '=', 'Ditch')) > 0)
				<h2>Ditch</h2>
				<div class="guide-places-plates">
					@foreach($activities->where('category', '=', 'Ditch') as $activity)
						@include('site.partials.guia.all-list-item')
					@endforeach
				</div>
			@endif
			@if(count($activities->where('category', '=', 'Cats')) > 0)
				<h2>Cats</h2>
				<div class="guide-places-plates">
					@foreach($activities->where('category', '=', 'Cats') as $activity)
						@include('site.partials.guia.all-list-item')
					@endforeach
				</div>
			@endif
		</div>
		<button class="btn test-btn">Test</button>
	</div>
	<script type="text/javascript" src="{{ asset('/js/ResizeSensor.min.js') }}"></script>
@stop