<section class="activity-basket">
	<header>{{ trans('emails.hello') }} <strong>Rafael</strong>, {{ trans('main.here_is_the_view') }}:</header>
	<dl>
		<dt>{{ trans('main.confirmed') }}:</dt>
		<dd>
			<ul class="activity-basket__confirms-list">
				{{--<li>--}}
					{{--<button></button>--}}
					{{--15/11 - Rafting Bajo--}}
				{{--</li>--}}
				{{--<li>--}}
					{{--<button></button>--}}
					{{--16/11 - Volcán--}}
				{{--</li>--}}
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
		<dd><span id="program_subscriptions">{{ $count['special_offers'] }}</span></dd>
		{{--{{ trans('main.still_no_offers') }}--}}
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
		<p>{{ trans('main.important') }} {{ trans('main.about_this_activity') }}</p>
		<strong class="title">{{ trans('main.minimum_age') }}
			: <span>{{ $activity['min_age'] }} {{ trans('main.years') }}</span></strong>
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
	{{--<div class="box faq">--}}
		{{--<strong class="title">Preguntas Freentes</strong>--}}
		{{--<ul>--}}
			{{--<li>Como chegar a Pucon</li>--}}
			{{--<li>Tiempo</li>--}}
			{{--<li>Barrios y Zonas</li>--}}
			{{--<li>Compras</li>--}}
			{{--<li>Onde ficar</li>--}}
			{{--<li>Que comer</li>--}}
			{{--<li>Transportes</li>--}}
			{{--<li>Vida noturna</li>--}}
			{{--<li>Dinheiro</li>--}}
		{{--</ul>--}}
	{{--</div>--}}
	@if($activity->tripadvisor_code)
		<div class="box tripadvisor">
			{!! $activity->tripadvisor_code !!}
		</div>
	@endif
	{{--<div class="booking">--}}
		{{--<ins class="bookingaff" data-aid="1279314" data-target_aid="" data-prod="dfl2" data-width="100%" data-height="auto" data-lang="xb" data-currency="USD" data-dest_id="-897376" data-dest_type="city" data-df_duration="1" data-df_num_properties="5">--}}
			{{--<!-- Anything inside will go away once widget is loaded. -->--}}
			{{--<a href="//www.booking.com?aid=">Booking.com</a>--}}
		{{--</ins>--}}
		{{--<script type="text/javascript">--}}
			{{--(function(d, sc, u) {--}}
				{{--var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];--}}
				{{--s.type = 'text/javascript';--}}
				{{--s.async = true;--}}
				{{--s.src = u + '?v=' + (+new Date());--}}
				{{--p.parentNode.insertBefore(s,p);--}}
			{{--})(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');--}}
		{{--</script>--}}
	{{--</div>--}}
	<div class="img-tour" id="image-tour">
		@if (count($activity->images) > 0)
			<div class="row">
				<div class="col-sm-12">
					<a href="/{{ $activity->images[0] }}" rel="prettyPhoto[gallery1]">
						<img src="/{{ $activity->images[0] }}" onerror="this.src='/images/image-none.jpg';">
					</a>
				</div>
			</div>
		@endif
		<div class="row">
			@for($i = 1; $i < count($activity->images); $i++)
				<div class="col-sm-6">
					<a href="/{{ $activity->images[$i] }}" rel="prettyPhoto[gallery1]">
						<img src="/{{ $activity->images[$i] }}" onerror="this.src='/images/image-none.jpg';">
					</a>
				</div>
			@endfor
		</div>
	</div>
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
