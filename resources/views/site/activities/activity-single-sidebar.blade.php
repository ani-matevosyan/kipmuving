<section class="widget select-box">
	<h2>Seleccione</h2>
	<p>la actividad que quiera cambiar</p>
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
	<h2>El día</h2>
	<p>de esta actividad</p>
	<form action="#" class="raised-form-x" style="max-width:150px;">
		<div class="text-field has-ico calender">
			<input id="reserve-date-sd" type="text"
					 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
					 placeholder="Fecha" class="form-control"
					 value="{{-- $dt --}}">
		</div>
	</form>
</section>
<section class="widget summary">
	<h2>Resumen de su panorama:</h2>
	<ul class="offers-list">
		!!!OFFERS!!!
		<?php $oid = 0; ?>
		{{--@foreach ($offers as $offer)--}}
			{{--<li><a href="#" data-oid={{ $oid }}>{{ date("d/m/Y", strtotime($offer['date'])) }}--}}
{{--					- {{ $offer['offer']->activity->name }}</a></li>--}}
			<?php $oid = $oid + 1; ?>
		{{--@endforeach--}}
	</ul>
</section>
<section class="important-block">
	<div class="box alert">
		<h2>Importante</h2>
		<strong class="sub-title">sobre esta actividad</strong>
		<strong class="title">Edad mínima: {{ $activity['min_age'] }} años</strong>
	</div>
	<div class="box bring">
		<strong class="title">Que sugerimos llevar:</strong>
		<ul>
			{!! $activity['carry'] !!}
		</ul>
	</div>
	<div class="box rest">
		<strong class="title">Restriciones:</strong>
		<ul>
			{!! $activity['restrictions'] !!}
		</ul>
	</div>
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
		<h3>Donde es</h3>
		<p>Ubicación de esta actividad</p>
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
