<li class="offer-item">
    <header>
        <div class="ico">
            <img src="/{{ $offer['offerActivity']['image_icon'] }}"
                 onerror="this.src='/images/image-none.jpg';"
                 alt="agency image">
        </div>
        <div class="rating">
            <!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
            <!-- <span>120 comentarios</span> -->
        </div>
        <div class="text">
            <h2>
                <a href="{{ action('ActivityController@getActivity', $offer['activity_id']) }}">{{ $offer['activity_name'] }}</a>
            </h2>
        </div>
    </header>
	<div class="row">
		<div class="col-md-4 col-sm-5 col-xs-12">
			@if($offer['offer_includes'])
				<div class="list-box">
					<strong class="title">{{ trans('main.what_includes') }}:</strong>
					<ul>
						@foreach ($offer['offer_includes'] as $include)
							<li>{{ $include }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
		<div class="col-md-8 col-sm-4 col-xs-12">
			<div class="select-activity">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<ul class="timing1">
							<li class="time">
								@if($offer['hours'])
									<strong><span>{{ trans('main.duration') }}:</span> {{ $offer['hours'] }}hrs </strong>
								@endif
								@if($offer['start_time'] && $offer['end_time'])
									<strong><span>{{ trans('main.schedule') }}
											:</span> {{ date('H:i', strtotime($offer['start_time'])) }}
										- {{ date('H:i', strtotime($offer['end_time'])) }}</strong>
								@endif
							</li>
							@if($offer['price_offer'])
								<li class="profile">
									<select class="persona">
										<option value="">{{ trans('main.persons') }}</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</li>
								@if($offer['available_time'])
									<li class="profile hours">
										<strong><span>Elija la opcion de horario</span></strong>
										<select class="hours">
											<option disabled selected>{{ trans('main.schedule') }}</option>
											@if(is_array($offer['available_time']))
												@foreach($offer['available_time'] as $time)
													<option value="{{ $time['start'].'-'.$time['end'] }}">{{ $time['start'].'-'.$time['end'] }}</option>
												@endforeach
											@endif
										</select>
									</li>
								@endif
								<li class="cal">
									<!-- <a href="#" class="btn btn-primary">Cantidad de personas</a> -->
									<!-- <a href="#" class="overlay-opener"> -->
									<input class="reserve-date"
											 type="text"
											 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
											 placeholder=""
											 value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}">
									<!-- </a> -->
								</li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div>
							<strong class="price"
									  data-unit-price="{{ $offer['price_offer'] }}"><sub>$</sub> {{ number_format($offer['price_offer'], 0, '.', '.') }}
							</strong>
							<a href="#" class="btn btn-primary btn-reserve-ag"
								data-offer-id="{{ $offer['id'] }}">{{ trans('main.add') }}</a>
						</div>
					</div>
					@endif
				</div>
			</div>
			@if($offer['description'])
				<div style="color: #006b33; margin: 10px ; font-size: 13px;">
					<p>{{ $offer['description'] }}</p>
				</div>
			@endif
		</div>
	</div>
	<div class="trip-adv"></div>
</li>
