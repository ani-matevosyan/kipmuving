@extends('site.layouts.default-new')

@section('content')

    <main>
        <div class="routes-activity-hero lazyload" data-original="{{ asset($free_activity->image) }}"></div>
        <section class="routes-activity">
            <div class="container">
                <div class="routes-activity__info-block">
                    <header>
                        <span>{{ $free_activity->name }}</span>
                        <h1>{{ $free_activity_category ?: $free_activity_category }}</h1>
                    </header>
                    <p>{{ $free_activity->description }}</p>
                    <div class="routes-activity__tabs">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <img src="{{ asset('images/route.svg') }}" alt="color route" width="37">
                                <div class="link-info">
                                    <strong>Cómo llegar en auto</strong>
                                    <p>Camino por Google Maps</p>
                                </div>
                            </li>
                        </ul>
                        <div class="routes-activity__tabs-content">
                            <div class="tab-pane" id="map-wrapper">
                                <div id="map" class="routes-activity__map"></div>
                                <script type="text/javascript">
                                    function initMap(){
                                      var pucon = {lat: -39.279351, lng: -71.968676};
                                      var thispoint = {
                                        lat: {{ $free_activity->latitude }},
                                        lng: {{ $free_activity->longitude }} };
                                      var latLng = new google.maps.LatLng(thispoint);
                                      var myOptions = {
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                      };
                                      var map = new google.maps.Map(document.getElementById("map"), myOptions);

                                      var directionsDisplay = new google.maps.DirectionsRenderer({
                                        map: map
                                      });

                                      var request = {
                                        destination: thispoint,
                                        origin: pucon,
                                        travelMode: 'DRIVING'
                                      };

                                      var directionsService = new google.maps.DirectionsService();
                                      directionsService.route(request, function (response, status) {
                                        if (status == 'OK') {
                                          directionsDisplay.setDirections(response);
                                        }
                                      });

                                      var marker = new google.maps.Marker({
                                        position: latLng,
                                        map: map,
                                        title: '{{ $free_activity_category ?: $free_activity_category }}'
                                      });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <form class="routes-activity-form">
                        <div class="routes-activity-form__calendar">
                            <label>{{ trans('main.choose_the_day') }}</label>
                            <input type="text" name="date"
                                   data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
                                   value="" required>
                        </div>
                        <div class="routes-activity-form__time">
                            <label>{{ trans('main.when_it_will_be') }}</label>
                            <select name="hours_from" required>
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
                            <span class="routes-activity-form__divider">{{ trans('main.to') }}</span>
                            <select name="hours_to" required>
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
                        </div>
                        <div class="routes-activity-form__buttons-holder">
                            <button class="btn">{{ trans('main.add') }}</button>
                        </div>
                    </form>
                </div>
                <div class="routes-activity__instagram-block">
                    <header>#{{ $free_activity->instagram_id }}</header>
                    <div class="routes-activity__instagram routes-activity__instagram_loading" id="routes-activity-instagram" data-tag="{{ $free_activity->instagram_id }}"></div>
                </div>
                <div class="routes-activity__tripadvisor-block">
                    @if($free_activity->tripadvisor_code)
                        {!! $free_activity->tripadvisor_code !!}
                    @endif
                    <script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=883&amp;locationId=2069432&amp;lang=ru&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                </div>
            </div>
        </section>
        <div id="myModalX" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="the-image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ trans('main.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="data"></div>
    </main>
@stop