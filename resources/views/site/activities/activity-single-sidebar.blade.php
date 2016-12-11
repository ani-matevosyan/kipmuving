<section class="widget select-box">
	<h2>{{ trans('main.select') }}</h2>
	<p>{{ trans('main.the_activity_you_want_to_change') }}</p>
	<div class="text-field">
		<select class="form-control" onchange="window.location = '{{ URL::to('activity' ) }}/' + this.value;">
			@foreach ($activitiesList as $item)
				<option value="{{ $item['id'] }}" @if($item['id'] == $activity['id']) selected @endif>
					{{ $item['name'] }}
				</option>
			@endforeach
		</select>
	</div>
</section>
<section class="widget the-day">
	<h2>{{ trans('main.the_day') }}</h2>
	<p>{{ trans('main.of_this_activity') }}</p>
	<form action="#" class="raised-form-x" style="max-width:150px;">
		<div class="text-field has-ico calender">
			<input id="reserve-date-sd" type="text"
					 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
					 placeholder="Fecha" class="form-control"
					 value="{{ \Carbon\Carbon::parse(Session::get('selectedDate'))->format('d/m/Y') }}">
		</div>
	</form>
</section>
@if($offers['selected'])
	<section class="widget summary">
		<h2>{{ trans('main.summary_of_your_panorama') }}:</h2>
		<ul class="offers-list">
			@foreach ($offers['selected'] as $offer)
				<li><a href="#">{{ $offer['date'] }}
						- {{ $offer['name'] }} [{{ $offer['persons'] }} pers.]</a></li>
			@endforeach
		</ul>
	</section>
@else
	<section class="widget summary" style="display:none">
		<h2>{{ trans('main.summary_of_your_panorama') }}:</h2>
		<ul class="offers-list">
		</ul>
	</section>
@endif
<section class="important-block">
	<div class="box alert">
		<h2>{{ trans('main.important') }}</h2>
		<strong class="sub-title">{{ trans('main.about_this_activity') }}</strong>
		<strong class="title">{{ trans('main.minimum_age') }}
			: {{ $activity['min_age'] }} {{ trans('main.years') }}</strong>
	</div>
	@if($activity['carry'])
		<div class="box bring">
			<strong class="title">{{ trans('main.what_to_bring') }}:</strong>
			<ul>
				@foreach($activity['carry'] as $item)
					<li>{{ $item }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@if($activity['restrictions'])
		<div class="box rest">
			<strong class="title">{{ trans('main.restrictions') }}:</strong>
			<ul>
				@foreach($activity['restrictions'] as $item)
					<li>{{ $item }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="img-tour">
		@if (count($activity->images) > 0)
			<div class="row">
				<div class="col-sm-12">
					<a href="/{{ $activity->images[0] }}" rel="prettyPhoto[gallery1]">
						<img src="/{{ $activity->images[0] }}"/>
					</a>
				</div>
			</div>
		@endif
		<div class="row">
			@for($i = 1; $i < count($activity->images); $i++)
				<div class="col-sm-6">
					<a href="/{{ $activity->images[$i] }}" rel="prettyPhoto[gallery1]">
						<img src="/{{ $activity->images[$i] }}"/>
					</a>
				</div>
			@endfor
		</div>
	</div>
	<div class="location">
		<h3>{{ trans('main.where_is') }}</h3>
		<p>{{ trans('main.location_of_this_activity') }}</p>
		<div class="map-holder">
			<div id="map" style="width: 100%; height: 300px"></div>
			<script type="text/javascript">
             var latLng = new google.maps.LatLng({{ $activity['latitude'] }}, {{ $activity['longitude'] }});
             var myOptions = {
                 zoom: 10,
                 center: latLng,
                 mapTypeId: google.maps.MapTypeId.ROADMAP
             };
             var map = new google.maps.Map(document.getElementById("map"), myOptions);
             var marker = new google.maps.Marker({
                 position: latLng,
                 map: map,
                 title: '{{ $activity['name'] }}'
             });
			</script>
		</div>
	</div>
</section>
