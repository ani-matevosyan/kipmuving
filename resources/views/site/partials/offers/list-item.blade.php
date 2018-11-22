@if($offer->agency)
	<li class="offer-item">
		<header>
			<div class="ico">
				<img src="/{{ $offer->agency->image_icon }}"
					  onerror="this.src='/images/image-none.jpg';"
					  alt="agency image">
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
									<p>{{ trans('main.duration') }}: <strong>{{ $offer->duration }}hrs</strong> </p>
								</li>
							@endif
							@if($offer->available_time)
								<li class="profile hours @if(count($offer->available_time) < 2) without_choice @endif">
									<label for="select-hours-{{$offer->id}}">{{ trans('main.schedule') }}: <strong>{{ $offer->schedule['start'] }} - {{ $offer->schedule['end'] }}</strong></label>
									<select id="select-hours-{{$offer->id}}" class="hours" @if(count($offer->available_time) < 2) style="display: none" @endif>
										@if(count($offer->available_time) > 1)
											<option selected value="">{{ trans('main.schedule') }}</option>
										@endif
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
							<div class="text-right">
								@if($offer->old_price)
									<del>
										@if(session('currency.type') === 'BRL') R$ @else $ @endif
										{{ number_format($offer->old_price, 0, '.', '.') }}
									</del>
								@endif
							</div>
							<div>
								<strong class="price" data-unit-price="{{ $offer->price }}">
									<sub>@if(session('currency.type') === 'BRL') R$ @else $ @endif</sub>{{ number_format($offer->price, 0, '.', '.') }}
								</strong>
								<a href="#" class="btn select-activity__add-button"
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
	</div>

</li>
@endif