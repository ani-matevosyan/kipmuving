@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="visual activity-single"
				@if ($activity['image']) style="background-image: url('/{{ $activity['image'] }}')" @endif>
	</section>

	<style>
		@if ($activity['image_icon'])
	.your-reservation.activity .head:after {
			background-image: url('/{{ $activity['image_icon'] }}')
		}
		@endif
	</style>
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">HOME</a></li>
						<li><a href="{{ action('ActivityController@index') }}">ACTIVIDADES</a></li>
						@if($activity['name'])
							<li>{{ strtoupper($activity['name']) }}</li>
						@endif
					</ul>
					<div class="your-reservation activity add new">
						@include('site.offers.offers_quickinfo')
						<header class="head">
							@if($activity['name'])
								<h1>{{ $activity['name'] }}</h1>
							@endif
							@if($activity['subtitle'])
								<strong class="sub-title">{{ $activity['subtitle'] }}</strong>
							@endif
						</header>
						<div class="row">
							<div id="activity-single-sidebar" class="col-md-4 col-sm-12 col-xs-12">
								@include('site.activities.activity-single-sidebar')
							</div>
							<div class="col-md-8 col-sm-12 col-xs-12">
								<section class="post-box">
									<div class="title-box">
										@if($activity['description'])
											<span style="font-size:14px;">{{ $activity['description'] }}</span>
										@endif
										<br><br/>
										@if ($activity['weather_embed'])
											<div class="weather-box">
												<h2>Actividad depende del clima</h2>
												<p>Esta atividad está sujeta al clima. Si llueve, muchas nubes o viento, la
													actividad
													no se realiza. Puedes percibir como estará el clima en una semana para que te
													programe cual es el mejor día para hacer esta actividad. Eliga de preferencia un
													dia
													que tenga sol.</p>
												{!! $activity['weather_embed'] !!}
											</div>
										@endif
										<nav class="subnav">
											<div class="date-time">
												<div class="text-field">
													<a href="#" class="overlay-opener">
														<input id="reserve-date"
																 type="text"
																 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
																 placeholder=""
																 value="{{-- $dt --}}">
													</a>
												</div>
											</div>
											<ul role="tablist">
												<li>Ordenar por</li>
												<li class="active"><a href="#tab2" data-toggle="tab">Recomendacion</a></li>
												<li><a href="#tab3" data-toggle="tab">Precio más bajo</a></li>
												<li><a href="#tab4" data-toggle="tab">Incluye más servicios</a></li>
											</ul>
										</nav>
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="tab2">
											<ul class="accordion">
												@foreach ($offers['recommend'] as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
											</ul>
										</div>
										<div class="tab-pane" id="tab3">
											<ul class="accordion">
												{{--											@foreach ($offers_price as $offer)--}}
												{{--												@include('site.partials.offers.list-item', array('offer' => $offer))--}}
												{{--@endforeach--}}
											</ul>
										</div>
										<div class="tab-pane" id="tab4">
											<ul class="accordion">
												{{--											@foreach ($offers_includes as $offer)--}}
												{{--												@include('site.partials.offers.list-item', array('offer' => $offer))--}}
												{{--@endforeach--}}
											</ul>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@stop
