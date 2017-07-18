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
        @if(count($activities->where('category', '=', 'Visual')) > 0)
            <h2>Visual</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Visual') as $activity)
                    @include('site.partials.guia.bicicleta-list-item')
                @endforeach
            </div>
        @endif
        @if(count($activities->where('category', '=', 'Caminatas')) > 0)
            <h2>Caminatas</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Caminatas') as $activity)
                    @include('site.partials.guia.bicicleta-list-item')
                @endforeach
            </div>
        @endif
        @if(count($activities->where('category', '=', 'Termas')) > 0)
            <h2>Termas</h2>
            <div class="guide-places-plates">
                @foreach($activities->where('category', '=', 'Termas') as $activity)
                    @include('site.partials.guia.bicicleta-list-item')
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


    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.38.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.38.0/mapbox-gl.css' rel='stylesheet' />
    <div id='map'></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFsY29ybnVzIiwiYSI6ImNqNHI0MHRrajBodWwzM3BjN2RhenJ1MnQifQ.tUfKaBZecMpeZ6vYh1QKyQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: [-71.969,-39.275],
            zoom: 16.5
        });

        map.on('load', function () {


            map.addSource("bicycle-route",{
                "type": "geojson",
                "data": {
                    "type": "FeatureCollection",
                    "features": [{
                        "type": "Feature",
                        "geometry": {
                            "type": "LineString",
                            "coordinates": [
                                [
                                    -71.97168394357989,
                                    -39.27540274218929
                                ],
                                [
                                    -71.96968540399888,
                                    -39.274812746394296
                                ],
                                [
                                    -71.96952450462979,
                                    -39.27479963531452
                                ],
                                [
                                    -71.9691349587763,
                                    -39.27495041251989
                                ],
                                [
                                    -71.96882162842064,
                                    -39.2751274114309
                                ],
                                [
                                    -71.968508298065,
                                    -39.27480619086175
                                ],
                                [
                                    -71.96864379226817,
                                    -39.27470785772992
                                ],
                                [
                                    -71.96813568898577,
                                    -39.274294857097644
                                ]
                            ]
                        }
                    },{
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                -71.97168394357989,
                                -39.27540274218929
                            ]
                        }
                    },{
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                                -71.96813568898577,
                                -39.274294857097644
                            ]
                        }
                    }]
                }
            });

            map.addLayer({
                "id": "route",
                "type": "line",
                "source": "bicycle-route",
                "layout": {
                    "line-join": "round",
                    "line-cap": "round"
                },
                "paint": {
                    "line-color": "#73B2DF",
                    "line-width": 5,
                    "line-opacity": 0.8
                }
            });
            map.addLayer({
                "id": "points",
                "type": "circles",
                "source": "bicycle-route",
                "paint": {
                    "circle-radius": 6,
                    "circle-color": "#B42222"
                }
            });
        });
    </script>

    <style>
        #map{
            height: 500px;
            width: 100%;
        }
    </style>

</div>

@stop