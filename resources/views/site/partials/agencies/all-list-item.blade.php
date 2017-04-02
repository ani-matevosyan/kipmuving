@if($agency)
	<div class="img-holder">
		<a href="{{ action('AgencyController@getAgency', $agency->id) }}">
			<img src="{{ asset($agency->image) }}"
				  onerror="this.src='{{ asset('/images/image-none.jpg') }}';"
				  alt="image description">
		</a>
	</div>
	<div class="caption">
		@if($agency->name)
			<h2>
				<a href="{{ action('AgencyController@getAgency', $agency->id) }}">{{ $agency->name }}</a>
			</h2>
		@endif
		@if($agency->description)
			<p>{{ $agency->description }}<p>
		@endif
	</div>
@endif