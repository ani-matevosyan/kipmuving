<div class="guide-places-plate-wrapper">
	<div class="guide-places-plate">
		<figure>
			<img src="/{{ $activity->image }}" alt="{{ $activity->name }}" class="item-image">
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
								<div class="col-sm-6 mobile-left col-xs-12">
									<div class="pull-right">
										<div class="opiniones">
											{!! $activity->tripadvisor_code !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="detail-desc">
							<p>{{ $activity->description }}</p>
						</div>
						<div class="termas-tabs">
							<ul class="nav nav-pills">
								@if($activity->bus_description && $activity->bus_est_time && $activity->bus_est_expenditure)
								<li class="active">
									<a data-toggle="pill" href="#home{{ $activity->id }}">
										<img src="../images/white-bus.svg" alt="white bus" width="43" height="29" class="img-responsive">
										<div class="link-info">
											<strong>{{ trans('main.how_to_get_there_by_bus') }}</strong>
											<p>{{ trans('main.from_the_center_of_pucon') }}</p>
										</div>
									</a>
								</li>
								@endif
								<li @if(!($activity->bus_description && $activity->bus_est_time && $activity->bus_est_expenditure)) class="active" @endif>
									<a data-toggle="pill" href="#menu{{ $activity->id }}" id="tomenu{{ $activity->id }}">
										<img src="../images/route.svg" alt="color route" width="37" height="38" class="img-responsive">
										<div class="link-info">
											<strong>{{ trans('main.how_to_get_there_by_car') }}</strong>
											<p>{{ trans('main.path_through_google_maps') }}</p>
										</div>
									</a>
								</li>
							</ul>
							<div class="tab-content">
								@if($activity->bus_description && $activity->bus_est_time && $activity->bus_est_expenditure)
									<div id="home{{ $activity->id }}" class="tab-pane well fade in active">
										<div class="tab-detail">
											<p>{!! $activity->bus_description !!}</p>
										</div>
										<div class="info-icons">
											<img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25"/>
											<p>{{ trans('main.estimated_time') }}:
												<strong>{{ $activity->bus_est_time }} {{ trans('main.hour') }}</strong></p>
										</div>
										<div class="info-icons">
											<img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25"/>
											<p>{{ trans('main.estimated_expenditure') }}:
												<strong>$ {{ number_format($activity->bus_est_expenditure, 0, ".", ".") }} {{ trans('main.per_person') }}</strong>
											</p>
											@if($activity->bus_est_service)
												<span>{{ trans('main.spa_value') }}
													: <strong>$ {{ number_format($activity->bus_est_service, 0, ".", ".") }} {{ trans('main.per_person') }}</strong></span>
											@endif
										</div>
									</div>
								@endif
								<div id="menu{{ $activity->id }}" class="tab-pane map-tab well fade @if(!($activity->bus_description && $activity->bus_est_time && $activity->bus_est_expenditure)) active @endif">
									<div class="map-holder">
										<div id="map{{ $activity->id}}" style="width: 100%; height: 300px"></div>
										<script type="text/javascript">
                        var map{{ $activity->id }};
                        var loadedmap{{ $activity->id }} = false;
                        var pucon = {lat: -39.279351, lng: -71.968676};
                        var thispoint{{ $activity->id }} = {
                            lat: {{ $activity->latitude }},
                            lng: {{ $activity->longitude}} };
                        function initMap() {
                            var latLng = new google.maps.LatLng(thispoint{{ $activity->id }});
                            var myOptions = {
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            map{{ $activity->id }} = new google.maps.Map(document.getElementById("map{{ $activity->id }}"), myOptions);

                            var directionsDisplay = new google.maps.DirectionsRenderer({
                                map: map{{ $activity->id }}
                            });

                            var request = {
                                destination: thispoint{{ $activity->id }},
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
                                map: map{{ $activity->id }},
                                title: '{{ $activity->name  }}'
                            });
                        }
                        initMap();
                        $("#tomenu{{ $activity->id }}").on('click', function () {
                            if (!loadedmap{{ $activity->id }}) {
                                setTimeout(function () {
                                    google.maps.event.trigger(map{{ $activity->id }}, 'resize');
                                    map{{ $activity->id }}.setCenter(thispoint{{ $activity->id }});
                                    map{{ $activity->id  }}.setZoom(10);
                                    loadedmap{{ $activity->id }} = true;
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
										<label for="select-hours-from-{{ $activity->id }}">Cuando seria el horario</label>
										<select id="select-hours-from-{{ $activity->id }}" class="hours">
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
											{{--@if(is_array($activity->time_ranges))--}}
												{{--@foreach($activity->time_ranges as $time)--}}
													{{--<option--}}
														{{--value="{{ $time['start'].'-'.$time['end'] }}">{{ $time['start'].'-'.$time['end'] }}</option>--}}
												{{--@endforeach--}}
											{{--@endif--}}
										</select>
										<span class="hour-devider">a</span>
										<select id="select-hours-to-{{ $activity->id }}" class="hours">
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

					<div id="instafeed3-{{ $activity->id }}" class="instafeed" data-instaid="{{ $activity->id }}"
							 data-instatag="{{ $activity->instagram_id }}"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>