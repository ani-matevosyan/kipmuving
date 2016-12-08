<div class="img-holder">
	<a href="{{ action('ActivityController@getActivity', $activity['id'] ? $activity['id'] : 0) }}">
		<img src="{{ $activity['image_thumb'] }}"
			  onerror="this.src='/images/image-none.jpg';"
			  alt="image description">
	</a>
</div>
<div class="caption">
	@if($activity['available_night'] || $activity['available_day'] || $activity['available_high'] || $activity['available_low'] )
	<div class="activity-icons">
		<ul>
			@if($activity['available_day'])
			<li>
				<div class="ico">
					<img src="images/day.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='images/ico16.png'">
					<p>Actividad Diurna <span class="glyphicon glyphicon-triangle-bottom"></span></p>
				</div>
			</li>
			@endif
			@if($activity['available_night'])
			<li>
				<div class="ico">
					<img src="images/night.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='images/ico17.png'">
					<p>Actividad Noturna <span class="glyphicon glyphicon-triangle-bottom"></span></p>
				</div>
			</li>
			@endif
			@if($activity['available_high'])
			<li>
				<div class="ico">
					<img src="images/down-arrow.svg" alt="image description" width="25" height="25" onerror="this.onerror=null; this.src='images/ico18.png'">
					<p>Baja: de marzo a noviembre <span class="glyphicon glyphicon-triangle-bottom"></span></p>
				</div>
			</li>
			@endif
			@if($activity['available_low'])
			<li>
				<div class="ico">
					<img src="images/up-arrow.svg" alt="image description" width="25" height="25" onerror="this.onerror=null; this.src='images/ico19.png'">
					<p>Alta: de diciembre a marzo <span class="glyphicon glyphicon-triangle-bottom"></span></p>
				</div>
			</li>
			@endif
		</ul>
	</div>
	@endif
	@if($activity['id'] && $activity['name'])
		<h2>
			<a href="{{ action('ActivityController@getActivity', $activity['id']) }}">{{ $activity['name'] }}</a>
		</h2>
	@endif
	@if($activity['short_description'])
		<p>{{ $activity['short_description'] }}<p>
	@endif
	@if($activity['price'])
	<strong class="price"><span>Desde de</span> <sub>$</sub>{{ $activity['price'] }}</strong>
	@endif
	<a href="{{ action('ActivityController@getActivity', $activity['id']) }}" class="btn-primary">VISUALIZAR</a>
</div>
