<li class="offer-item">
	<header>
		<div class="rating">
			<!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
			<!-- <span>120 comentarios</span> -->
		</div>
		<div class="text">
			<h2>
				<a href="{{ action('ActivityController@getActivity', $offer['activity_id']) }}">{{ $offer['activity_name'] }}</a>
			</h2>
			<strong class="sub-title"><span>{{-- $offer->location --}}</span></strong>
		</div>
	</header>
	<div class="row">
		<div class="col-md-5 col-sm-5 col-xs-12">
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
		<div class="col-md-7 col-sm-4 col-xs-12">
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
			<!-- <div class="row">
			 <div class="col-xs-12">
				 <div class="cancel">
					<strong class="title">Caso la actividad no ocurra:</strong>
					<p>Desde la agencia : sin costo, Desde la base : costo del transporte,Si empezaron subir : sin descuento</p>
				 </div>
			  </div>
			</div>-->
		</div>
	</div>
	@if($offer['description'])
		<div class="slide">
			<div class="note">
				<p>{{ $offer['description'] }}</p>
			</div>
		</div>
		<!-- <div class="trip-adv"></div> -->
		<strong class="more-detail">
			<a href="#" class="opener">
				<span class="more">{{ trans('main.more') }}</span>
				<span class="less">{{ trans('main.less') }}</span>
				{{ trans('main.details') }}
			</a>
		</strong>
	@endif
</li>
