<div class="img-holder">
	<a href="{{ action('ActivityController@getActivity', $activity['id'] ? $activity['id'] : 0) }}">
		<img src="{{ $activity['image_thumb'] }}"
			  onerror="this.src='/images/image-none.jpg';"
			  alt="image description">
	</a>
</div>
<div class="caption">
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
