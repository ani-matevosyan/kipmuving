@extends('site.layouts.default-new')

@section('content')

    <main>
        <div class="container">
            <header class="suggestion-header">
                <h1>{{ $suggestion->name }}</h1>
                <span>{{ $suggestion->short_description }}</span>
                <p>{{ $suggestion->description }}</p>
            </header>
            <section class="s-suggestion">
                @if($suggestion->days && $suggestion->days->count() > 0)
                <div class="s-suggestion__content">
                    <ul class="days-list">
                        @foreach($suggestion->days as $day)
                        <li class="days-list__item">
                            <header class="days-list__header">
                                <h3>{{ $day->name }}</h3>
                                <p>{{ $day->description }}</p>
                            </header>
                            @if($day->activities)
                                <ul class="days-list__activity-list">
                                    @foreach($day->activities as $item)
                                    <li>
                                        <header>
                                            <div class="days-list__header-content">
                                                <h4>
                                                    <a href="{{ $item->activity_type == 'free' ? route('routes-single', ['id' => $item->activity_id]) : action('ActivityController@getActivity', ['id' => $item->activity_id]) }}">{{ $item->activity->name }}</a>
                                                </h4>
                                                <p>{{ $item->activity->description }}</p>
                                            </div>
										</header>
										{{--  <div class="days-list__instagram-block days-list__instagram-block_loading" id="instagram{{ $item->activity_id }}" @if($item->activity_type == 'free') data-tag="{{ $item->activity->instagram_id }}" @else data-location-id="{{ $item->activity->instagram_name }}"  @endif></div>  --}}
										<div class="days-list__instagram-block days-list__instagram-block_loading" id="instagram{{ $item->activity_id }}" data-location-id="6889842" data-tag="sportcar"></div>										
                                        <footer>
                                            @if($item->activity_type == 'free')
										<form class="routes-activity-form" data-id="{{ $item->activity_id }}">
																							<div class="routes-activity-form__calendar">
																								<label>{{ trans('main.choose_the_day') }}</label>
																								<input type="text" name="date"
																											 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
																											 value="">
																							</div>
																							<div class="routes-activity-form__time">
																								<label>{{ trans('main.when_it_will_be') }}</label>
																								<select name="hours_from">
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
																								<select name="hours_to">
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
																								<button type="submit" class="btn">{{ trans('main.add') }}</button>
																							</div>
																						</form>
																						@elseif($item->activity_type == 'paid')
																								<a href="{{ action('ActivityController@getActivity', ['id' => $item->activity_id]) }}" class="btn">visit activity page</a>
																						@endif

                                        </footer>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

							{{--{{ dd($map_points) }}--}}

                <aside class="s-suggestion__aside">
                    <div class="s-suggestion__map" id="map"></div>
                    <script>
                        var activitiesList = {!! $suggestion->map_points !!}
                      function initMap() {
                        var latLng = new google.maps.LatLng(-39.27535, -71.97380);
                        var myOptions = {
                          zoom: 15,
                          center: latLng,
                        };
                        var map = new google.maps.Map(document.getElementById("map"), myOptions);
                        var bounds  = new google.maps.LatLngBounds();
                        for (var i = 0; i < activitiesList.length; i++){
                          var activity = activitiesList[i];
                          var image = '{{ asset('images/routes-suggestion-markers/marker') }}'+activity[3]+'.png';
                          var loc = new google.maps.LatLng(activity[1], activity[2]);
                          var marker = new google.maps.Marker({
                            position: {lat: activity[1], lng: activity[2]},
                            map: map,
                            title: activity[0],
                            icon: image
                          });
                          bounds.extend(loc);
                        }
                        map.fitBounds(bounds);
                        map.panToBounds(bounds);
                      }
                    </script>
                </aside>
            </section>
        </div>
    </main>

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
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.close') }}</button>
				</div>
			</div>
		</div>
	</div>
	<div id="data"></div>

	

@stop