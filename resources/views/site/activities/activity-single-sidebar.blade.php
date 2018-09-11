<section class="activity-basket">
	<header>{{ trans('emails.hello') }}<strong>{{ auth()->user() ? (auth()->user()->username ? ' '.auth()->user()->username : ' '.auth()->user()->first_name) : '' }}</strong>, {{ trans('main.here_is_the_view') }}:</header>
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
		<dt>{{ trans('main.persons') }}:</dt>
		<dd><span id="program_persons">{{ $count['persons'] }}</span></dd>
	</dl>
	<dl>
		<dt>{{ trans('main.total_of') }}:</dt>
		<dd>$ <span id="program_total">{{ number_format($count['total'], 0, ".", ".") }}</span></dd>
	</dl>
	<footer>
		<div class="row">
			<div class="col-xs-6">
				<a href="{{ action('CalendarController@index') }}" class="activity-basket__to-calendar"><span class="glyphicon glyphicon-calendar"></span> {{ trans('button-links.my_agenda') }}</a>
			</div>
			<div class="col-xs-6">
				<a href="{{ action('ReservationController@index') }}" class="activity-basket__to-reserve"><span class="glyphicon glyphicon-check"></span> {{ trans('main.reserve') }}</a>
			</div>
		</div>
	</footer>
</section>
<section class="important-block">
	@if ($activity->instagram_location_id || $activity->instagram_name)
		{{--<div class="activity-instagram"> --}}{{--todo delete this section--}}
			{{--@if(!$activity->instagram_location_id && $activity->instagram_name)--}}
				{{--<span class="activity-tag">{{ $activity->instagram_name }}</span>--}}
			{{--@endif--}}
			{{--<div id="instafeed5" class="instafeed"--}}
				 {{--@if($activity->instagram_location_id) data-location-id="{{ $activity->instagram_location_id }}" @endif--}}
				 {{--data-tag="{{ $activity->instagram_name }}"></div>--}}
			{{--<div class="clearfix"></div>--}}
		{{--</div>--}}
	@endif

	{{--start instagram photos--}}
	@if($activity->instagram_link)
		<div class="activity-instagram">
			@if($activity->instagram_name)
				<span class="activity-tag">{{ $activity->instagram_name }}</span>
			@endif
			<div id="" class="photos" data-tag="{{$hashtag}}">
				@foreach($photos as $key=>$data)
					@if($key > 8)
						@break
					@endif
					<div class="col-sm-4 col-xs-2 in-image-activity">
						<a href="{{$data['thumbnail_src']}}"><img src="{{$data['thumbnail_src'] }}"></a>
					</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
		</div>
	@endif
	{{--end instagram photos--}}

	{{--start google search photos--}}
	@if($activity->google_search_word)
		<div class="googleSearchedPhotos">
			@if($photos_google)
				<img src="https://www.google.com.ua/images/branding/googleg/1x/googleg_standard_color_128dp.png" width="22px" height="22px"/>
			@endif
			<div id="" class="photos" data-tag="{{$hashtag}}">
				{{--<div class="row">--}}
				@foreach($photos_google as $key=>$data)
					@if($key > 8)
						@break
					@endif
						<div class="col-sm-4 col-xs-2 in-image-activity">
							<a href="{{$data}}"><img src="{{$data}}"></a>
						</div>
{{--					@if(($key+1)%3 == 0 && $key != 0 )</div><div class="row">@endif--}}

				@endforeach
						{{--</div>--}}
			</div>
			<div class="clearfix"></div>
		</div>
		<hr class="google_alertBox_hr">
	@endif
	{{--end google search photos--}}

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
