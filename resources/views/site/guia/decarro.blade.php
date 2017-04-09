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

    <div class="guide-places-plates-wrapper">
        <h2>Visual</h2>
        <div class="guide-places-plates">
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Villarrica</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Base del Volcan</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Salto Mariman</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Saltos Palguin</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Caburgua</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="guide-places-plates-wrapper">
        <h2>Caminatas</h2>
        <div class="guide-places-plates">
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>El Cani</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details" style="height: auto; background: none;">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="left-col">
                                <?php $countVisible = 0; $gencount = -1; $firstVisibleIndex = null; $firstVisibleId; ?>
                                @foreach($mappoints['features'] as $mappoint)
                                    <?php $gencount++ ?>
                                    @if($mappoint['properties']['description'])
                                        <?php
                                        if($firstVisibleIndex === null)
                                        {
                                            $firstVisibleIndex = $gencount;
                                            $firstVisibleId = $mappoint['id'];
                                        }
                                        ?>
                                        <div class="map-tab @if($countVisible === 0) active @endif" id="map-tab-{{ $mappoint['id'] }}">
                                            <div class="termas">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <h2>{{$mappoint['properties']['title']}}</h2>
                                                    </div>
                                                    <div class="col-sm-6 mobile-left col-xs-12">
                                                        <div class="pull-right">
                                                            <div class="opiniones">
                                                                {!! $mappoint['properties']['tripadvisor_code'] !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-desc">
                                                <p>{{$mappoint['properties']['description']}}</p>
                                            </div>
                                            <div class="termas-tabs">
                                                <ul class="nav nav-pills">
                                                    <li class="active">
                                                        <a data-toggle="pill" href="#home{{$countVisible}}">
                                                            <img src="../images/white-bus.svg" alt="white bus" width="43" height="29" class="img-responsive">
                                                            <div class="link-info">
                                                                <strong>{{ trans('main.how_to_get_there_by_bus') }}</strong>
                                                                <p>{{ trans('main.from_the_center_of_pucon') }}</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="pill" href="#menu{{$countVisible}}" id="tomenu{{$countVisible}}">
                                                            <img src="../images/route.svg" alt="color route" width="37" height="38" class="img-responsive">
                                                            <div class="link-info">
                                                                <strong>{{ trans('main.how_to_get_there_by_car') }}</strong>
                                                                <p>{{ trans('main.path_through_google_maps') }}</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    @if($mappoint['properties']['bus_description'])
                                                        <div id="home{{$countVisible}}" class="tab-pane well fade in active">
                                                            <div class="tab-detail">
                                                                <p>{!! $mappoint['properties']['bus_description'] !!}</p>
                                                            </div>
                                                            @if($mappoint['properties']['bus_estimated_time'])
                                                                <div class="info-icons">
                                                                    <img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25" />
                                                                    <p>{{ trans('main.estimated_time') }}: <strong>{{ $mappoint['properties']['bus_estimated_time'] }} {{ trans('main.hour') }}</strong></p>
                                                                </div>
                                                            @endif
                                                            @if($mappoint['properties']['bus_estimated_expenditure'])
                                                                <div class="info-icons">
                                                                    <img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25" />
                                                                    <p>{{ trans('main.estimated_expenditure') }}:  <strong>$ {{ number_format($mappoint['properties']['bus_estimated_expenditure'], 0, ".", ".") }} {{ trans('main.per_person') }}</strong></p>
                                                                    @if($mappoint['properties']['bus_estimated_service'])
                                                                        <span>{{ trans('main.spa_value') }}: <strong>$ {{ number_format($mappoint['properties']['bus_estimated_service'], 0, ".", ".") }} {{ trans('main.per_person') }}</strong></span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div id="menu{{$countVisible}}" class="tab-pane map-tab well fade">
                                                        <div class="map-holder">
                                                            <div id="map{{$countVisible}}" style="width: 100%; height: 300px"></div>
                                                            <script type="text/javascript">
                                                                var map{{$countVisible}};
                                                                var loadedmap{{$countVisible}} = false;
                                                                var pucon = {lat: -39.279351, lng: -71.968676};
                                                                var thispoint{{$countVisible}} = {lat: {{ $mappoint['geometry']['coordinates'][1] }}, lng: {{ $mappoint['geometry']['coordinates'][0] }} };
                                                                function initMap(){
                                                                    var latLng = new google.maps.LatLng(thispoint{{$countVisible}});
                                                                    var myOptions = {
                                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                                    };
                                                                    map{{$countVisible}} = new google.maps.Map(document.getElementById("map{{$countVisible}}"), myOptions);

                                                                    var directionsDisplay = new google.maps.DirectionsRenderer({
                                                                        map: map{{$countVisible}}
                                                                    });

                                                                    var request = {
                                                                        destination: thispoint{{$countVisible}},
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
                                                                        map: map{{$countVisible}},
                                                                        title: '{{ $mappoint['properties']['title'] }}'
                                                                    });
                                                                }
                                                                initMap();
                                                                $("#tomenu{{$countVisible}}").on('click', function(){
                                                                    if(!loadedmap{{$countVisible}}){
                                                                        setTimeout(function(){
                                                                            google.maps.event.trigger(map{{$countVisible}}, 'resize');
                                                                            map{{$countVisible}}.setCenter(thispoint{{$countVisible}});
                                                                            map{{$countVisible}}.setZoom(10);
                                                                            loadedmap{{$countVisible}} = true;
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
                                                            <strong>Elija el opcion de horario</strong>
                                                            <select class="persona">
                                                                <option value="">{{ trans('main.schedule') }}</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                                <option value="4">Four</option>
                                                            </select>
                                                        </li>
                                                    </ul>
                                                    <a href="#" class="btn btn-primary" data-offer-id="1">Agregar mi agenda</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $countVisible++ ?>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="right-col">
                                <img src="../images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>
                                <h4>{{ trans('main.instagram_pictures') }}</h4><strong class="instagramtag"></strong>

                                <div id="instafeed3" class="instafeed" data-instaid="{{ $firstVisibleId }}" data-instatag="{{ $mappoints['features'][$firstVisibleIndex]['properties']['title'] }}"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Huerquehue</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>El Caro</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="guide-places-plates-wrapper">
        <h2>Termas</h2>
        <div class="guide-places-plates">
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Peumayen</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Huife</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Quimeyco</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Los Pozones</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Palguin</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Geometricas</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Menetue</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="guide-places-plates-wrapper">
        <h2>Test</h2>
        <div class="guide-places-plates">
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Peumayen</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Huife</h3>
                        <p>Tenemos todas las rutas que las rutas que necesitas paranecesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Quimeyco</h3>
                        <p>Tenemos todas las rutas que nlas rutas que necesitas paralas rutas que necesitas paraecesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Los Pozones</h3>
                        <p>Tenemos todas las rutas que necesitlas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paraas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Palguin</h3>
                        <p>Tenemos todas las rutas que necesitlas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paraas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Geometricas</h3>
                        <p>Tenemos todas las rutas que necesitas plas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paraara disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Menetue</h3>
                        <p>Tenemos todas las rutas que necesitaslas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas para para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Peumayen</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar comlas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas parao damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Huife</h3>
                        <p>Tenemos todas las rutas que necesitas para disflas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas parautar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Quimeyco</h3>
                        <p>Tenemos todas las rutas que necesitas para disflas rutas que necesitas paralas rutas que necesitas parautar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Peumayen</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutlas rutas que necesitas paraar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Huife</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Quimeyco</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutalas rutas que necesitas parar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Los Pozones</h3>
                        <p>Tenemos todas las rutas que necesitas para disfulas rutas que necesitas paralas rutas que necesitas paratar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
            <div class="guide-places-plate-wrapper">
                <div class="guide-places-plate">
                    <figure>
                        <img src="/images/img17.jpg" alt="Villaria" class="item-image">
                    </figure>
                    <div class="descr">
                        <h3>Palguin</h3>
                        <p>Tenemos todas las rutas que necesitas para disfutalas rutas que necesitas paralas rutas que necesitas paralas rutas que necesitas parar como damene sobre tu coatro rued rued as de los principales atractivos de la ciudad, como los ojosd d el Caburgua</p>
                    </div>
                </div>
                <div class="guide-place-plate-details"></div>
            </div>
        </div>
    </div>

    <div>

    </div>

</div>
</div>
@stop