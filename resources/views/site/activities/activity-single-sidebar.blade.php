<section class="activity-basket">
	<header>{{ trans('emails.hello') }} <strong>{{ auth()->user() ? (auth()->user()->username ? auth()->user()->username : auth()->user()->first_name) : trans('main.guest') }}</strong>, {{ trans('main.here_is_the_view') }}:</header>
	<dl>
		<dt>{{ trans('main.confirmed') }}:</dt>
		<dd>
			<ul class="activity-basket__confirms-list">
				@if($offers['selected'])
					@foreach ($offers['selected'] as $offer)
						<li>
							<button data-offer-id="{{$offer['offer_id']}}"></button>
							{{ \Carbon\Carbon::createFromFormat('d/m/Y', $offer['date'])->format('d/m') }} {{ $offer['name'] }}
						</li>
					@endforeach
				@endif
			</ul>
		</dd>
	</dl>
	<dl>
		<dt>{{ trans('main.receive_offers') }}:</dt>
		<dd><span id="program_subscriptions">@if($count['special_offers'] > 0) {{ $count['special_offers'] }} @else {{ trans('main.still_no_offers') }} @endif</span></dd>
	</dl>
	<dl>
		<dt>{{ trans('main.persons') }}:</dt>
		<dd><span id="program_persons">{{ $count['persons'] }}</span></dd>
	</dl>
	<dl>
		<dt>{{ trans('main.total_of') }}:</dt>
		<dd>$ <span id="program_total">{{ number_format($count['total'], 0, ".", ".") }}</span></dd>
	</dl>
	<footer>
		<a href="{{ action('CalendarController@index') }}" class="activity-basket__to-calendar">{{ trans('button-links.my_agenda') }}</a>
		<a href="{{ action('ReservationController@index') }}" class="activity-basket__to-reserve">{{ trans('main.reserve') }}</a>
	</footer>
</section>
<section class="important-block">
	<div class="box alert">
		<p>{{ trans('main.minimum_age') }}: <strong>{{ $activity['min_age'] }} {{ trans('main.years') }}</strong></p>
	</div>
	@if($activity->carry)
		<div class="box bring">
			<strong class="title">{{ trans('main.what_to_bring') }}:</strong>
			<ul>
				@foreach($activity->carry as $item)
					<li>{{ $item }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@if($activity->restrictions)
		<div class="box rest">
			<strong class="title">{{ trans('main.restrictions') }}:</strong>
			<ul>
				@foreach($activity->restrictions as $item)
					<li>{{ $item }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if ($activity->instagram_location_id || $activity->instagram_name)
		<div class="activity-instagram">
			@if(is_null($activity->instagram_location_id) && $activity->instagram_name)
				<span class="activity-tag">{{ $activity->instagram_name }}</span>
			@endif
			<div id="instafeed5" class="instafeed"
					 @if($activity->instagram_location_id) data-location-id="{{ $activity->instagram_location_id }}" @endif
					 data-tag="{{ $activity->instagram_name }}"></div>
			<div class="clearfix"></div>
		</div>
	@endif
	@if($activity->tripadvisor_code)
		<div class="box tripadvisor">
			{!! $activity->tripadvisor_code !!}
		</div>
	@endif
	{{--<div class="img-tour" id="image-tour">--}}
		{{--@if (count($activity->images) > 0)--}}
			{{--<div class="row">--}}
				{{--<div class="col-sm-12">--}}
					{{--<a href="/{{ $activity->images[0] }}" rel="prettyPhoto[gallery1]">--}}
						{{--<img src="/{{ $activity->images[0] }}" onerror="this.src='/images/image-none.jpg';">--}}
					{{--</a>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--@endif--}}
		{{--<div class="row">--}}
			{{--@for($i = 1; $i < count($activity->images); $i++)--}}
				{{--<div class="col-sm-6">--}}
					{{--<a href="/{{ $activity->images[$i] }}" rel="prettyPhoto[gallery1]">--}}
						{{--<img src="/{{ $activity->images[$i] }}" onerror="this.src='/images/image-none.jpg';">--}}
					{{--</a>--}}
				{{--</div>--}}
			{{--@endfor--}}
		{{--</div>--}}
	{{--</div>--}}
	<div class="location">
		<header>
			<h3>{{ trans('main.where_is') }}</h3>
			<p>{{ trans('main.location_of_this_activity') }}</p>
		</header>
		<div class="map-holder">
			<div id="map" style="width: 100%; height: 300px"></div>
			<script type="text/javascript">
      	function initMap() {
					var latLng = new google.maps.LatLng({{ $activity->latitude }}, {{ $activity->longitude }});
					var myOptions = {
						zoom: 10,
						center: latLng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById("map"), myOptions);
					var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						title: '{{ $activity->name }}'
					});
				}
			</script>
		</div>
	</div>
</section>
