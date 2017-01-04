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
        <div class="col-md-5 right-border">
            <p>{{ trans('main.car_big_text') }}</p>
            <div class="play-info">
                <img src="../images/play-button.svg" alt="play description" width="33" height="33">
                <p><strong>{{ trans('main.click_on_the_icons_for_more_info') }}</strong></p>
            </div> 
        </div>
        <div class="col-md-7">
            <div class="placeholder-info">
                <p>{{ trans('main.iconography') }}</p>
                <ul> 
                    <li class="active">
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder.svg" alt="image description" width="33" height="33"
                                     onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>{{ trans('main.to_visit') }}</strong>
                            <p>{{ trans('main.and_take_photo') }}</p>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder2.svg" alt="image description" width="33" height="33"
                                     onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>{{ trans('main.best_spa') }}: </strong>
                            <p>{{ trans('main.to_relax') }}</p>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder3.svg" alt="image description" width="33" height="33"
                                     onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>{{ trans('main.national_parks') }}</strong>
                            <p>{{ trans('main.incredible_parks') }}</p>
                        </a>
                    </li> 

                </ul> 
            </div>
        </div>
    </div>
</div>                                    
<div class="row">
    <div class="map-detail" id="map" style="height: 500px; width: 100%">
        {{--<iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/rafaelzarro.1c6j5igk/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'></iframe>--}}
    </div>
</div>


<div class="row">
    <div class="col-sm-7">
        <div class="left-col">
            <?php $countVisible = 0; ?>
            @foreach($mappoints['features'] as $mappoint)
                @if($mappoint['properties']['description'])
                    <div class="map-tab @if($countVisible === 0) active @endif" id="map-tab-{{ $mappoint['id'] }}">
                        <?php $countVisible++ ?>
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
                                <li>
                                    <a data-toggle="pill" href="#home">
                                        <img src="../images/white-bus.svg" alt="white bus" width="43" height="29" class="img-responsive">
                                        <div class="link-info">
                                            <strong>{{ trans('main.how_to_get_there_by_bus') }}</strong>
                                            <p>{{ trans('main.from_the_center_of_pucon') }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="active">
                                    <a data-toggle="pill" href="#menu1">
                                        <img src="../images/route.svg" alt="color route" width="37" height="38" class="img-responsive">
                                        <div class="link-info">
                                            <strong>{{ trans('main.how_to_get_there_by_car') }}</strong>
                                            <p>{{ trans('main.path_through_google_maps') }}</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane well fade ">
                                    <div class="tab-detail">
                                        <p>{{ trans('main.you_should_take_bus') }}</p>
                                    </div>
                                    <div class="info-icons">
                                        <img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25" />
                                        <p>{{ trans('main.estimated_time') }}: <strong>1 {{ trans('main.hour') }}</strong></p>
                                    </div>
                                    <div class="info-icons">
                                        <img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25" />
                                        <p>{{ trans('main.estimated_expenditure') }}:  <strong>$ 2.000 {{ trans('main.per_person') }}</strong></p>
                                        <span>{{ trans('main.spa_value') }}: <strong>$ 17.000 {{ trans('main.per_person') }}</strong></span>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane well fade in active">
                                    <div class="map-holder">
                                        <div id="map{{$countVisible}}" style="width: 100%; height: 300px"></div>
                                        <script type="text/javascript">
                                            function initMap(){
                                                var pucon = {lat: -39.279351, lng: -71.968676};
                                                var thispoint = {lat: {{ $mappoint['geometry']['coordinates'][1] }}, lng: {{ $mappoint['geometry']['coordinates'][0] }} };
                                                var latLng = new google.maps.LatLng(thispoint);
                                                var myOptions = {
                                                    zoom: 10,
                                                    center: latLng,
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                };
                                                var map = new google.maps.Map(document.getElementById("map{{$countVisible}}"), myOptions);

                                                var directionsDisplay = new google.maps.DirectionsRenderer({
                                                    map: map
                                                });

                                                var request = {
                                                    destination: thispoint,
                                                    origin: pucon,
                                                    travelMode: 'DRIVING'
                                                };

                                                var directionsService = new google.maps.DirectionsService();
                                                directionsService.route(request, function(response, status) {
                                                    if (status == 'OK') {
                                                        // Display the route on the map.
                                                        directionsDisplay.setDirections(response);
                                                    }
                                                });

                                                var marker = new google.maps.Marker({
                                                    position: latLng,
                                                    map: map,
                                                    title: '{{ $mappoint['properties']['title'] }}'
                                                });
                                            }
                                            initMap();
                                            $(".termas-tabs li").on('click', function(){
                                                alert("ok");
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-5 right-col" style="overflow: hidden; height: 650px;">
        <img src="../images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>
        <h4>{{ trans('main.instagram_pictures') }}</h4><strong>#termasmenetue</strong>
 
            <div id="instafeed3" class="instafeed">

            </div>
        </div> 
    </div>
</div>
</div>
@stop