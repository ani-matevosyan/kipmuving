 @extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
 <main id="main">
    <div class="container">
        <div class="your-reservation activity">
            <h1>Programas gratuitos em Pucón</h1>
            <div class="flex_wrapper">
                <div class="flex_item">
                    <a href="{{ action('FreePagesController@index') }}" id="box-1">
                    <div class="map-box-1 click-tab">
                            <div class="map-heading">
                                <h3>{{ trans('main.walking') }}</h3>
                                <p>{{ trans('main.pukon_walking') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex_item">
                    <a href="{{ action('FreePagesController@getBicicleta') }}" id="box-2">
                        <div class="map-box-2 click-tab">
                            <div class="map-heading">
                                <h3>{{ trans('main.bicycle') }}</h3>
                                <p>{{ trans('main.tracks_and_routes') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex_item">
                    <a href="{{ action('FreePagesController@getDecarro') }}" id="box-3">
                    <div class="map-box-3 click-tab">
                            <div class="map-heading">
                                <h3>{{ trans('main.by_car_or_bus') }}</h3>
                                <p>{{ trans('main.traditional_tours') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex_item">
                    <a href="{{ action('FreePagesController@getTourcultural') }}" id="box-4">
                    <div class="map-box-4 click-tab">
                            <div class="map-heading">
                                <h3>{{ trans('main.cultural_tour') }}</h3>
                                <p>{{ trans('main.meet_pukon_mapuches') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Subpage -->
            @yield('subpage')
            <!-- ./ subpage -->

            <div id="myModalX" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <!-- <h4 class="modal-title">Confirmation</h4> -->
                        </div>
                        <div class="modal-body">
                            <div id="the-image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="confirm-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Por favor</h4>
                        </div>
                        <div class="modal-body">
                            <p id="message">
                                {{ trans('main.added_to_calendar') }}
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL END -->
            <div id="data"> <!-- Keep this div for instafeed information -->
            </div>
        </div>
    </div>
</main>
@stop