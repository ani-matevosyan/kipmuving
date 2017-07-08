@extends('site.layouts.default-new')

@section('content')

	@if(session()->has('success'))
		<p class="alert-success">{{ session('success') }}</p>
	@elseif(session()->has('error'))
		<p class="alert-warning">{{ session('error') }}</p>
	@endif

	<main id="main">

		<div class="container">

			<a href="{{url('admin')}}" class="btn btn-success" style="margin-top: 15px">Back to admin panel</a>

			<h1>Send suggestions</h1>

			<form action="{{ action('AgencyEmailsController@sendEmails') }}" method="post">
				{{ csrf_field() }}

				@if($agencies->where('region', 'pucon'))

					<h2>Pucon agencies</h2>

					<ul class="agencies">
						<div class="btn-holder">
							<a href="#" class="btn btn-primary select-all" id="select-all-1">Select All</a>
							<a href="#" class="btn btn-primary deselect-all" id="deselect-all-1">Deselect  All</a>
						</div>
						@foreach($agencies->where('region', 'pucon') as $agency)
							<li>

								<div class="custom-checkbox">
									<input type="checkbox" name="agencies[]" id="agency-{{ $agency->id }}" value="{{ $agency->id }}">
									<div class="custom-checkbox-mark"></div>
								</div>
								<label for="agency-{{ $agency->id }}">{{ $agency->name }}</label>

							</li>
						@endforeach
					</ul>
				@endif

				@if($agencies->where('region', 'atacama'))

					<h2>Atacama agencies</h2>

					<ul class="agencies">
						<div class="btn-holder">
							<a href="#" class="btn btn-primary select-all" id="select-all-2">Select All</a>
							<a href="#" class="btn btn-primary deselect-all" id="deselect-all-2">Deselect All</a>
						</div>
						@foreach($agencies->where('region', 'atacama') as $key => $agency)
							<li>
								<div class="custom-checkbox">
									<input type="checkbox" name="agencies[]" id="agency-{{ $agency->id }}" value="{{ $agency->id }}">
									<div class="custom-checkbox-mark"></div>
								</div>
								<label for="agency-{{ $agency->id }}">{{ $agency->name }}</label>

							</li>
						@endforeach
					</ul>
				@endif

				<div class="message-wrapper">
					<textarea name="message" id="message" rows="10" required>{{ old('message') }}</textarea>
					<button type="submit" class="btn btn-success">Go</button>
				</div>

			</form>

		</div>

	</main>
	<style>

		h1{
			font-size: 46px;
			font-weight: 700;
			color: #575757;
			margin: 25px 0 20px;
			text-align: center;
		}

		h2{
			font-weight: 700;
			text-transform: uppercase;
			font-size: 30px;
			margin: 0 0 30px;
			text-align: center;
		}

		.agencies .btn-holder{
			position: absolute;
			left: 0;
			top: 0;
		}

		.agencies .btn-holder .btn-primary{
			background: #ce8902;
			font-weight: 700;
		}

		.agencies{
			padding: 40px 0 0;
			margin: 0 0 40px;
			list-style: none;
			columns: 4;
			position: relative;
		}

		.agencies label{
			margin: 0;
			font-weight: 400;
			vertical-align: middle;
		}

		.agencies li{
			margin-bottom: 10px;
		}

		.custom-checkbox{
			display: inline-block;
			vertical-align: middle;
			width: 14px;
			height: 14px;
			border: 1px solid #d9d9d9;
			border-radius: 2px;
			margin-right: 2px;
			position: relative;
		}

		.custom-checkbox input[type=checkbox]{
			position: absolute;
			height: 100%;
			width: 100%;
			opacity: 0;
			margin: 0;
			z-index: 1;
		}

		.custom-checkbox-mark{
			position: absolute;
			height: 5px;
			width: 12px;
			top: 50%;
			left: 43%;
			border: 1px solid #00a651;
			border-width: 0 0 2px 2px;
			-webkit-transform: rotate(-45deg);
			-ms-transform: rotate(-45deg);
			transform: rotate(-45deg);
			display: none;
			margin: -4px 0 0 -5px;
			pointer-events: none;
		}

		.custom-checkbox input[type=checkbox]:checked + .custom-checkbox-mark{
			display: block;
		}

		.message-wrapper{
			max-width: 500px;
			margin: 0 auto 40px;
		}

		.message-wrapper textarea{
			width: 100%;
			display: block;
			margin-bottom: 10px;
			resize: vertical;
		}

		@media screen and (max-width: 991px){
			.agencies{
				columns: 3
			}
		}
		@media screen and (max-width: 767px){
			.agencies{
				columns: 2
			}
			h1{
				font-size: 30px;
			}
			h2{
				font-size: 24px;
			}
		}

		@media screen and (max-width: 500px){
			.agencies{
				columns: 1
			}
		}

	</style>


	<script>
		document.getElementById("select-all-1").addEventListener('click', selectAll);
		document.getElementById("select-all-2").addEventListener('click', selectAll);

		document.getElementById("deselect-all-1").addEventListener('click', deselectAll);
		document.getElementById("deselect-all-2").addEventListener('click', deselectAll);

		function deselectAll(e){
			e.preventDefault();
			var checkboxes = e.target.parentElement.parentElement.getElementsByTagName('input');

			for(var i=0, n=checkboxes.length;i<n;i++){
				checkboxes[i].checked = false;
			}
		}

		function selectAll(e){
			e.preventDefault();
			var checkboxes = e.target.parentElement.parentElement.getElementsByTagName('input');

			for(var i=0, n=checkboxes.length;i<n;i++){
				checkboxes[i].checked = true;
			}
		}
	</script>
@stop