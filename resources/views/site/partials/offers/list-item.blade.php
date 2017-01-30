<li class="offer-item">
	@if($offer['offerAgency'])
		<header>
			<div class="ico">
				<img src="/{{ $offer['offerAgency']['image_icon'] }}"
					  onerror="this.src='/images/image-none.jpg';"
					  alt="agency image">
			</div>
			<div class="rating">
				<!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
				<!-- <span>120 comentarios</span> -->
			</div>
			<div class="text">
				@if($offer['agency_id'] && $offer['offerAgency']['name'])
					<h2>
						<a href="{{ action('AgencyController@getAgency', $offer['offerAgency']['id']) }}">{{ $offer['offerAgency']['name'] }}</a>
					</h2>
				@endif
				@if($offer['offerAgency']['address'])
					<strong class="sub-title">
						<span>{{ $offer['offerAgency']['address'] }}</span>
					</strong>
				@endif
			</div>
			<ul class="links">
				<li>
					@if($offer['offerAgency']['name'] && $offer['offerAgency']['id'] && $offer['offerAgency']['image'] && $offer['offerAgency']['address'] && $offer['offerAgency']['description'])
						<a href="javascript:void(0)"
							data-toggle="popover"
							title="{{ $offer['offerAgency']['name'] }}"
							data-html="true"
							data-placement="bottom"
							data-container="body"
							data-trigger="focus"
							data-content="
										<img src='/{{ $offer['offerAgency']['image'] }}'>
										</a>
										<br>
										{{ $offer['offerAgency']['address'] }}
								<hr>
								{{ $offer['offerAgency']['description'] }}
								<br>
								<a href='{{ action('AgencyController@getAgency', $offer['offerAgency']['id']) }}'>info...</a>">{{ trans('main.about_the_agency') }}</a>
					@endif
				</li>
				<li>
					@if($offer['offerAgency']['latitude'] && $offer['offerAgency']['longitude'] && $offer['offerAgency']['name'])
						<a href="javascript:void(0)"
							class="btn-map"
							data-toggle="modal"
							data-lat="{{ $offer['offerAgency']['latitude'] }}"
							data-lng="{{ $offer['offerAgency']['longitude'] }}"
							data-title="{{ $offer['offerAgency']['name'] }}">{{ trans('main.show_map') }}</a>
					@endif
				</li>
			<!-- <li><a href="/agency/{{ $offer['offerAgency']['id'] }}">Condiciones</a></li> -->
			</ul>
		</header>
	@endif
	<div class="row">
		@if(count($offer['includes']) > 0)
			<div class="col-md-5 col-sm-5 col-xs-12">
				<div class="list-box">
					<strong class="title">{{ trans('main.what_includes') }}:</strong>
					<ul>
						{{--{!! dd($offer['includes']) !!}--}}
						@if(is_array($offer['includes']))
							@foreach ($offer['includes'] as $include)
								<li>{{ $include }}</li>
							@endforeach
						@endif
					</ul>
				<!-- <br />
        <strong class="title">Idiomas:</strong>
        <img src="/{{ $offer->important }}" onerror="this.src='/images/image-none.jpg';" alt="agency image">-->
				</div>
			</div>
		@endif
		<div class="col-md-7 col-sm-7 col-xs-12">
			<div class="select-activity">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<ul class="timing1">
							@if($offer['hours'])
								<li>
									<strong><span>{{ trans('main.duration') }}:</span> {{ $offer['hours'] }}hrs </strong>
									{{--<strong><span>{{ trans('main.schedule') }}--}}
											{{--:</span> {{ date('H:i', strtotime($offer['start_time'])) }}--}}
										{{--- {{ date('H:i', strtotime($offer['end_time'])) }}</strong>--}}
								</li>
							@endif
							<li class="profile">
								<select class="persona">
									<option value="">{{ trans('main.amount_of_people') }}</option>
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
						</ul>
					</div>
					{{--@if($offer['price'] && $offer['price_offer'])--}}
					@if($offer['price'])
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div>
								<strong class="price" data-unit-price="{{ $offer['price_offer'] }}">
{{--									@if ($offer['price'] != $offer['price_offer'])--}}
										<del>
											<small>
												<sub>$</sub>{{ number_format($offer['price'], 0, '.', '.') }}
											</small>
										</del>
										<br>
									{{--@endif--}}
									<sub>$</sub>{{ number_format($offer['price'] * 0.95, 0, '.', '.') }}
								</strong>
								<a href="#" class="btn btn-primary btn-reserve"
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
	<!-- <div class="col-md-3 col-sm-3 col-xs-12">
      <strong class="price" data-unit-price="{{ $offer->price_offer }}"><sub>$</sub> {{ number_format ($offer->price_offer, 0, '.', '.') }}</strong>
      <a href="#" class="btn btn-primary btn-reserve" data-offer-id="{{ $offer->id }}">AGREGAR</a>
    </div> -->
	</div>


	<div class="trip-adv"></div>

</li>
