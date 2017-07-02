@extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')
<div id="m-box-3">
    <div class="guide-header">
        <header>
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

    <div class="guide-places-plates-wrapper">
        @if(count($activities->where('category', '=', 'Visual')) > 0)
            <h2>Visual</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Visual') as $activity)
                    @include('site.partials.guia.deccaro-list-item')
                @endforeach
            </div>
        @endif
        @if(count($activities->where('category', '=', 'Caminatas')) > 0)
            <h2>Caminatas</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Caminatas') as $activity)
                    @include('site.partials.guia.deccaro-list-item')
                @endforeach
            </div>
        @endif
        @if(count($activities->where('category', '=', 'Termas')) > 0)
            <h2>Termas</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Termas') as $activity)
                    @include('site.partials.guia.deccaro-list-item')
                @endforeach
            </div>
        @endif
    </div>
    <script>
        function initGuideMaps(){
            @foreach($activities as $activity)
                initGuideMap{{ $activity->id }}();
            @endforeach
        }
    </script>
</div>
@stop