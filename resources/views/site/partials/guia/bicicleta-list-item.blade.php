{{--{{ dd($activity) }}--}}
<div class="guide-places-plate-wrapper">
    <div class="guide-places-plate">
        <figure>
            <img src="{{ asset($activity->image) }}" alt="{{ $activity->name }}" class="item-image" onerror="this.src='/images/image-none.jpg';">
        </figure>
        <div class="descr">
            <h3>{{ $activity->name }}</h3>
            <p>{{ $activity->short_description }}</p>
        </div>
    </div>
    <div class="guide-place-plate-details">
        <div class="row">
            <div class="col-md-7">
                <div class="left-col">
                    <div id="map-tab-{{ $activity->id }}">
                        <div class="termas">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <h2>{{ $activity->name }}</h2>
                                </div>
                                @if($activity->tripadvisor_code)
                                    <div class="col-sm-6 mobile-left col-xs-12">
                                        <div class="pull-right">
                                            <div class="opiniones">
                                                {!! $activity->tripadvisor_code !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="detail-desc">
                            <p>{{ $activity->description }}</p>
                        </div>
                        <div class="termas-tabs">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="pill" href="#home{{ $activity->id }}">
                                        <img src="{{ asset('images/bicycle-guide.svg') }}" alt="white bus" width="43" height="29" class="img-responsive">
                                        <div class="link-info">
                                            <strong>Como chegar</strong>
                                            <p>Desde o centro de Pucón</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="pill" href="#menu{{ $activity->id }}" id="tomenu{{ $activity->id }}">
                                        <img src="{{ asset('images/route.svg') }}" alt="color route" width="37" height="38" class="img-responsive">
                                        <div class="link-info">
                                            <strong>Mapa</strong>
                                            <p>Vista do caminho</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="home{{ $activity->id }}" class="tab-pane well fade in active">
                                    <div class="tab-detail">
                                        <p>{!! $activity->bus_description !!}</p>
                                    </div>
                                    <div class="info-icons">
                                        <img src="{{ asset('images/clock.svg') }}" alt="clock" class="img-responsive" width="25" height="25"/>
                                        <p>{{ trans('main.estimated_time') }}:
                                            <strong>{{ $activity->bus_est_time }} {{ trans('main.hour') }}</strong></p>
                                    </div>
                                </div>

                                <div id="menu{{ $activity->id }}" class="tab-pane map-tab well fade">
                                    <div class="map-holder">
                                        <div id="map{{ $activity->id}}" class="bicycle-map"></div>
                                        <script type="text/javascript">

                                            var mapLoaded{{ $activity->id}} = false;

                                            function mapboxFunction{{ $activity->id}}(){
                                                mapboxgl.accessToken = 'pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw';
                                                var map = new mapboxgl.Map({
                                                    container: 'map{{ $activity->id}}',
                                                    style: 'mapbox://styles/mapbox/streets-v9'
                                                });

                                                var geoJSON = {{ $activity->route }};

                                                map.fitBounds([
                                                        geoJSON[0],
                                                        geoJSON[geoJSON.length - 1]
                                                ],{
                                                    padding: 50,
                                                    duration: 0
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
                                                                    "coordinates": {{ $activity->route }}
                                                                }
                                                            },{
                                                                "type": "Feature",
                                                                "geometry": {
                                                                    "type": "Point",
                                                                    "coordinates":  geoJSON[0]
                                                                }
                                                            },{
                                                                "type": "Feature",
                                                                "geometry": {
                                                                    "type": "Point",
                                                                    "coordinates":  geoJSON[geoJSON.length - 1]
                                                                }
                                                            }]
                                                        }
                                                    });

                                                    map.addLayer({
                                                        "id": "route-line",
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
                                                        },
                                                        "filter": ["==", "$type", "LineString"]
                                                    });
                                                    map.addLayer({
                                                        "id": "route-points",
                                                        "type": "circle",
                                                        "source": "bicycle-route",
                                                        "paint": {
                                                            "circle-radius": 6,
                                                            "circle-color": "#B42222"
                                                        },
                                                        "filter": ["==", "$type", "Point"]
                                                    });

                                                });
                                            }

                                            var mapButton{{ $activity->id}} = document.getElementById('tomenu{{ $activity->id }}');

                                            mapButton{{ $activity->id}}.addEventListener('click', function(e){
                                                if(!mapLoaded{{ $activity->id}}){
                                                    setTimeout(function(){
                                                        mapboxFunction{{ $activity->id}}();
                                                        mapLoaded{{ $activity->id}} = true;
                                                    }, 500);
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="order-theguide">
                                <form class="order-theguide-form" data-id="{{ $activity->id }}">
                                    <ul>
                                        <li>
                                            <label>Elija el dia</label>
                                            <div class="text-field has-ico calender">
                                                <input type="text" name="guide-date"
                                                       data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
                                                       placeholder="Fecha" class="form-control"
                                                       value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}" required>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="select-hours-from-{{ $activity->id }}">Cuando seria el horario</label>
                                            <select id="select-hours-from-{{ $activity->id }}" class="hours" name="hours_from" required>
                                                <option selected disabled value=""></option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                            <span class="hour-devider">a</span>
                                            <select id="select-hours-to-{{ $activity->id }}" class="hours" name="hours_to" required>
                                                <option selected disabled value=""></option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn btn-primary">Agregar mi agenda</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="right-col">
                    <img src="{{ asset('/images/instagram.svg') }}" alt="instagram" class="img-responsive" width="28" height="28"/>
                    <h4>{{ trans('main.instagram_pictures') }}</h4><strong class="instagramtag"></strong>

                    <div id="instafeed3-{{ $activity->id }}" class="instafeed" data-instaid="{{ $activity->id }}"
                         data-instatag="{{ $activity->instagram_id }}"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>