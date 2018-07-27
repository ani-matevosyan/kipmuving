<li class="offer-item">
    <header>
        <div class="rating">
            <!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
            <!-- <span>120 comentarios</span> -->
        </div>
        <div class="text">
            <h2>
                <a href="{{ action('ActivityController@getActivity', $offer->activity['id']) }}">{{ $offer->activity['name'] }}</a>
            </h2>
			<div class="ta-code">
				{!! $offer->activity['tripadvisor_code'] !!}
			</div>
        </div>
    </header>
	<div class="row">
		<div class="col-md-4 col-sm-5 col-xs-12">
			@if($offer->includes)
				<div class="list-box">
					<strong class="title">{{ trans('main.what_includes') }}:</strong>
					<ul>
						@foreach ($offer->includes as $include)
							<li>{{ $include }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
		<div class="col-md-8 col-sm-7 col-xs-12">
			<div class="select-activity">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<ul class="timing1">
							<li class="time">
								@if($offer->duration)
									<strong>{{ trans('main.duration') }}:<span> {{ $offer->duration }}hrs </span></strong>
								@endif
								@if($offer->available_time)
									<strong>{{ trans('main.schedule') }}: <span>{{ $offer->schedule['start'] }} - {{ $offer->schedule['end'] }}</span></strong>
								@endif
								{{--@if($offer['start_time'] && $offer['end_time'])--}}
									{{--<strong><span>{{ trans('main.schedule') }}--}}
											{{--:</span> {{ date('H:i', strtotime($offer['start_time'])) }}--}}
										{{--- {{ date('H:i', strtotime($offer['end_time'])) }}</strong>--}}
								{{--@endif--}}
							</li>
							@if($offer->price)
								<li class="profile">
									<select id="select-persona-{{$offer->id}}" class="persona">
										<option selected value="">{{ trans('main.persons') }}</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</li>
								@if($offer->available_time)
									<li class="profile hours" @if(count($offer->available_time) < 2) style="display: none" @endif>
										<label for="select-hours-{{$offer->id}}">Elija la opcion de horario</label>
										<select id="select-hours-{{$offer->id}}" class="hours">
											@if(count($offer->available_time) > 1)
												<option value="" selected>{{ trans('main.schedule') }}</option>
											@endif
											@if(is_array($offer->available_time))
												@foreach($offer->available_time as $time)
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
							<strong class="price" data-unit-price="{{ $offer->price }}">
								{{--<del>--}}
									{{--<small>--}}
										{{--<sub>@if(session('currency.type') === 'BRL') R @endif $ </sub>{{ number_format($offer->price, 0, '.', '.') }}--}}
									{{--</small>--}}
								{{--</del>--}}
								{{--<br>--}}
								<sub>@if(session('currency.type') === 'BRL') R$ @else $ @endif</sub> {{ number_format($offer->price, 0, '.', '.') }}
							</strong>
							<a href="#" class="btn btn-primary btn-reserve-ag"
								data-offer-id="{{ $offer->id }}">{{ trans('main.add') }}</a>
						</div>
					</div>
					@endif
				</div>
			</div>
			@if($offer->description)
				<div class="offer-item-desc">
					<p>{{ $offer->description }}</p>
				</div>
			@endif
		</div>
	</div>
	<div class="trip-adv"></div>
</li>
