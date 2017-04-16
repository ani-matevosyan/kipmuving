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

    {{ $mappoints[0]['short_description'] }}

    <div class="guide-places-plates-wrapper">
        <h2>Ditch</h2>
        <div class="guide-places-plates">
            @foreach($mappoints as $mappoint)
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/{{ $mappoint->image }}" alt="{{ $mappoint->name }}" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>{{ $mappoint->name }}</h3>
                        <p>{{ $mappoint->short_description }}</p>
                    </div>
                </div>
                <div class="guide-place-plate-details">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="left-col">
                                <div id="map-tab-{{ $mappoint->id }}">
                                    <div class="termas">
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <h2>{{ $mappoint->name }}</h2>
                                            </div>
                                            <div class="col-sm-6 mobile-left col-xs-12">
                                                <div class="pull-right">
                                                    <div class="opiniones">
                                                        {!! $mappoint->tripadvisor_code !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-desc">
                                        <p>{{ $mappoint->description }}</p>
                                    </div>
                                    <div class="termas-tabs">
                                        <ul class="nav nav-pills">
                                            <li class="active">
                                                <a data-toggle="pill" href="#home{{ $mappoint->id }}">
                                                    <img src="../images/white-bus.svg" alt="white bus" width="43" height="29" class="img-responsive">
                                                    <div class="link-info">
                                                        <strong>{{ trans('main.how_to_get_there_by_bus') }}</strong>
                                                        <p>{{ trans('main.from_the_center_of_pucon') }}</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="pill" href="#menu{{ $mappoint->id }}" id="tomenu{{ $mappoint->id }}">
                                                    <img src="../images/route.svg" alt="color route" width="37" height="38" class="img-responsive">
                                                    <div class="link-info">
                                                        <strong>{{ trans('main.how_to_get_there_by_car') }}</strong>
                                                        <p>{{ trans('main.path_through_google_maps') }}</p>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            @if($mappoint->bus_description)
                                                <div id="home{{ $mappoint->id }}" class="tab-pane well fade in active">
                                                    <div class="tab-detail">
                                                        <p>{!! $mappoint->bus_description !!}</p>
                                                    </div>
                                                    @if($mappoint->bus_est_time)
                                                        <div class="info-icons">
                                                            <img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25" />
                                                            <p>{{ trans('main.estimated_time') }}: <strong>{{ $mappoint->bus_est_time }} {{ trans('main.hour') }}</strong></p>
                                                        </div>
                                                    @endif
                                                    @if($mappoint->bus_est_expenditure)
                                                        <div class="info-icons">
                                                            <img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25" />
                                                            <p>{{ trans('main.estimated_expenditure') }}:  <strong>$ {{ number_format($mappoint->bus_est_expenditure, 0, ".", ".") }} {{ trans('main.per_person') }}</strong></p>
                                                            @if($mappoint->bus_est_service)
                                                                <span>{{ trans('main.spa_value') }}: <strong>$ {{ number_format($mappoint->bus_est_service, 0, ".", ".") }} {{ trans('main.per_person') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                            <div id="menu{{ $mappoint->id }}" class="tab-pane map-tab well fade">
                                                <div class="map-holder">
                                                    <div id="map{{ $mappoint->id}}" style="width: 100%; height: 300px"></div>
                                                    <script type="text/javascript">
                                                        var map{{ $mappoint->id }};
                                                        var loadedmap{{ $mappoint->id }} = false;
                                                        var pucon = {lat: -39.279351, lng: -71.968676};
                                                        var thispoint{{ $mappoint->id }} = {lat: {{ $mappoint->latitude }}, lng: {{ $mappoint->longitude}} };
                                                        function initMap(){
                                                            var latLng = new google.maps.LatLng(thispoint{{ $mappoint->id }});
                                                            var myOptions = {
                                                                mapTypeId: google.maps.MapTypeId.ROADMAP
                                                            };
                                                            map{{ $mappoint->id }} = new google.maps.Map(document.getElementById("map{{ $mappoint->id }}"), myOptions);

                                                            var directionsDisplay = new google.maps.DirectionsRenderer({
                                                                map: map{{ $mappoint->id }}
                                                            });

                                                            var request = {
                                                                destination: thispoint{{ $mappoint->id }},
                                                                origin: pucon,
                                                                travelMode: 'DRIVING'
                                                            };

                                                            var directionsService = new google.maps.DirectionsService();
                                                            directionsService.route(request, function(response, status) {
                                                                if (status == 'OK') {
                                                                    directionsDisplay.setDirections(response);
                                                                }
                                                            });

                                                            var marker = new google.maps.Marker({
                                                                position: latLng,
                                                                map: map{{ $mappoint->id }},
                                                                title: '{{ $mappoint->name  }}'
                                                            });
                                                        }
                                                        initMap();
                                                        $("#tomenu{{ $mappoint->id }}").on('click', function(){
                                                            if(!loadedmap{{ $mappoint->id }}){
                                                                setTimeout(function(){
                                                                    google.maps.event.trigger(map{{ $mappoint->id }}, 'resize');
                                                                    map{{ $mappoint->id }}.setCenter(thispoint{{ $mappoint->id }});
                                                                    map{{ $mappoint->id  }}.setZoom(10);
                                                                    loadedmap{{ $mappoint->id }} = true;
                                                                }, 200)
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-theguide">
                                            <ul>
                                                <li>
                                                    <strong>Elija el dia</strong>
                                                    <div class="text-field has-ico calender">
                                                        <input id="reserve-date-sd" type="text"
                                                               data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
                                                               placeholder="Fecha" class="form-control"
                                                               value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="select-hours-{{ $mappoint->id }}">Elija el opcion de horario</label>
                                                    <select id="select-hours-{{ $mappoint->id }}" class="hours">
                                                        <option selected disabled value="">{{ trans('main.schedule') }}</option>
                                                        @if(is_array($mappoint->time_ranges))
                                                            @foreach($mappoint->time_ranges as $time)
                                                                <option value="{{ $time['start'].'-'.$time['end'] }}">{{ $time['start'].'-'.$time['end'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </li>
                                            </ul>
                                            <a href="#" class="btn btn-primary" data-offer-id="1">Agregar mi agenda</a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="right-col">
                                <img src="../images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>
                                <h4>{{ trans('main.instagram_pictures') }}</h4><strong class="instagramtag"></strong>

                                <div id="instafeed3" class="instafeed" data-instaid="{{ $mappoint->id }}" data-instatag="{{ $mappoint->instagram_id }}"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <button class="btn test-btn">Test</button>
</div>
</div>
<script type="text/javascript" src="{{ asset('/js/ResizeSensor.min.js') }}"></script>
@stop