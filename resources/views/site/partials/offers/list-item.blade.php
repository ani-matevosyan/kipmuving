@if($offer->agency)
	<li class="offer-item">
		<header>
			<div class="ico">
				<img src="/{{ $offer->agency->image_icon }}"
					  onerror="this.src='/images/image-none.jpg';"
					  alt="agency image">
			</div>
			<div class="rating">
				<!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
				<!-- <span>120 comentarios</span> -->
			</div>
			<div class="text">
				@if($offer->agency->id && $offer->agency->name)
					<h2>
						<a href="{{ action('AgencyController@getAgency', $offer->agency->id) }}">{{ $offer->agency->name }}</a>
					</h2>
				@endif
				@if($offer->agency->address)
					<strong class="sub-title">
						<span>{{ $offer->agency->address }}</span>
					</strong>
				@endif
			</div>
		</header>
	<div class="row">
		@if(count($offer->includes) > 0)
			<div class="col-md-5 col-sm-5 col-xs-12">
				<div class="list-box">
					<strong class="title">{{ trans('main.what_includes') }}:</strong>
					<ul>
						{{--{!! dd($offer['includes']) !!}--}}
						@if(is_array($offer->includes))
							@foreach ($offer->includes as $include)
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
							@if($offer->duration)
								<li>
									<strong><span>{{ trans('main.duration') }}:</span> {{ $offer->duration }}hrs </strong>
									{{--<strong><span>{{ trans('main.schedule') }}--}}
											{{--:</span> {{ date('H:i', strtotime($offer['start_time'])) }}--}}
										{{--- {{ date('H:i', strtotime($offer['end_time'])) }}</strong>--}}
								</li>
							@endif
							<li class="profile">
								<select id="select-persona-{{$offer->id}}" class="persona">
									<option selected value="">{{ trans('main.amount_of_people') }}</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
								</select>
							</li>
							@if($offer->available_time)
								<li class="profile hours">
									<label for="select-hours-{{$offer->id}}">Elija la opcion de horario</label>
									<select id="select-hours-{{$offer->id}}" class="hours">
										<option selected value="">{{ trans('main.schedule') }}</option>
										@if(is_array($offer->available_time))
											@foreach($offer->available_time as $time)
												<option value="{{ $time['start'].'-'.$time['end'] }}">{{ $time['start'].'-'.$time['end'] }}</option>
											@endforeach
										@endif
									</select>
								</li>
							@endif
						</ul>
					</div>
					@if($offer['price'])
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div>
								<strong class="price" data-unit-price="{{ $offer->price_offer }}">
									<sub>@if(session('currency.type') === 'BRL') R$ @else $ @endif</sub>{{ number_format($offer->price, 0, '.', '.') }}
								</strong>
								<a href="#" class="btn btn-primary btn-reserve"
									data-offer-id="{{ $offer->id }}">{{ trans('main.add') }}</a>
							</div>
						</div>
					@endif
				</div>
			</div>
			@if(isset($offer['description']))
				<div class="offer-item-desc">
					<p>{{ $offer['description'] }}</p>
				</div>
			@endif
		</div>
	<!-- <div class="col-md-3 col-sm-3 col-xs-12">
      <strong class="price" data-unit-price="{{ $offer->price_offer }}"><sub>$</sub> {{ number_format ($offer->price_offer, 0, '.', '.') }}</strong>
      <a href="#" class="btn btn-primary btn-reserve" data-offer-id="{{ $offer->id }}">AGREGAR</a>
    </div> -->
	</div>

</li>
@endif