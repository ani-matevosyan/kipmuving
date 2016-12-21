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
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a></li>
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
												<h2>{{ trans('main.activity_depends_on_the_weather') }}</h2>
												<p>{{ trans('main.this_activity_is_subject_to_weather') }}</p>
												{!! $activity['weather_embed'] !!}
											</div>
										@endif
										<div class="tenprocent_wrapp">
											<div class="tenprocent">
												em todos <br>
												os precos
											</div>
										</div>
										<nav class="subnav">
											<div class="date-time">
												<div class="text-field">
													<a href="#" class="overlay-opener">
														<input id="reserve-date"
																 type="text"
																 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
																 placeholder=""
																 value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}">
													</a>
												</div>
											</div>
											<ul role="tablist">
												<li>{{ trans('main.sort_by') }}</li>
												<li class="active"><a href="#tab2" data-toggle="tab">{{ trans('main.recommendation') }}</a></li>
												<li><a href="#tab3" data-toggle="tab">{{ trans('main.lowest_price') }}</a></li>
												<li><a href="#tab4" data-toggle="tab">{{ trans('main.includes_more_services') }}</a></li>
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
												@foreach ($offers['price'] as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
											</ul>
										</div>
										<div class="tab-pane" id="tab4">
											<ul class="accordion">
												@foreach ($offers['includes'] as $offer)
													@include('site.partials.offers.list-item')
												@endforeach
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
