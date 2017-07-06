@extends('site.layouts.default-new')

@section('content')

	@if(session()->has('success'))
		<p class="alert-success">{{ session('success') }}</p>
	@elseif(session()->has('error'))
		<p class="alert-warning">{{ session('error') }}</p>
	@endif

	<form action="{{ action('AgencyEmailsController@sendEmails') }}" method="post">
		{{ csrf_field() }}

		@if($agencies->where('region', 'pucon'))

			<h4>Pucon agencies</h4>

			<ul>
				@foreach($agencies->where('region', 'pucon') as $agency)
					<li>

						<input type="checkbox" name="agencies[]" id="agency-{{ $agency->id }}" value="{{ $agency->id }}">
						<label for="agency-{{ $agency->id }}">{{ $agency->name }}</label>

					</li>
				@endforeach
			</ul>
		@endif

		@if($agencies->where('region', 'atacama'))

			<h4>Pucon agencies</h4>

			<ul>
				@foreach($agencies->where('region', 'atacama') as $key => $agency)
					<li>

						<input type="checkbox" name="agencies[]" id="agency-{{ $agency->id }}" value="{{ $agency->id }}">
						<label for="agency-{{ $agency->id }}">{{ $agency->name }}</label>

					</li>
				@endforeach
			</ul>
		@endif

		<textarea name="message" id="message" cols="30" rows="10" required>{{ old('message') }}</textarea>

		<button type="submit">Go</button>

	</form>
@stop