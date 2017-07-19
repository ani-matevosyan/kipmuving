@extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div id="m-box-2">

    <div class="guide-header">
        <header>
            <h1>{{ trans('main.bicycle') }}</h1>
            <p>{{ trans('main.bicycle_small_text') }}</p>
        </header>
    </div>
    <div class="infor-bar">
        <p>{{ trans('main.bicycle_big_text') }}</p>
    </div>

		<div class="guide-places-plates-wrapper">
			@if(count($activities->where('page', '=', 'bicycle')->where('category', '=', 'Visual')) > 0)
				<h2>Visual</h2>
				<div class="guide-places-plates">
					@foreach($activities->where('page', '=', 'bicycle')->where('category', '=', 'Visual') as $activity)
						@include('site.partials.guia.bicicleta-list-item')
					@endforeach
				</div>
			@endif
			@if(count($activities->where('page', '=', 'bicycle')->where('category', '=', 'Caminatas')) > 0)
				<h2>Caminatas</h2>
				<div class="guide-places-plates">
					@foreach($activities->where('page', '=', 'bicycle')->where('category', '=', 'Caminatas') as $activity)
						@include('site.partials.guia.bicicleta-list-item')
					@endforeach
				</div>
			@endif
			@if(count($activities->where('page', '=', 'bicycle')->where('category', '=', 'Termas')) > 0)
				<h2>Termas</h2>
				<div class="guide-places-plates">
					@foreach($activities->where('page', '=', 'bicycle')->where('category', '=', 'Termas') as $activity)
						@include('site.partials.guia.bicicleta-list-item')
					@endforeach
				</div>
			@endif
		</div>

</div>

@stop