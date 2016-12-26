@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('AgencyController@index') }}">{{ trans('button-links.agencies') }}</a></li>
						@if($agency['name'])
							<li>{{ $agency['name'] }}</li>
						@endif
					</ul>
					<div class="your-reservation adventure new">
						<article class="main-post">
							<header>
								<h1>{{ $agency['name'] }}</h1>
								<strong class="sub-title">O`Higgins Nº211-C </strong>
							</header>
							<div class="post-holder">
								<div class="row">
									<div class="col-md-4">
										<div class="agency-photo-wrapp">
											<img src="/{{ $agency['image'] }}" alt="image description">
										</div>
									</div>
									<div class="col-md-8">
										<div class="text">
											<p>{{ $agency['description'] }}</p>
										</div>
										<div class="agency-gallery">
											<div class="row">
												<div class="col-xs-9">
													<div id="instafeed4" class="instafeed"
														  data-instagram-id="{{ $agency['instagram_id'] }}"></div>
												</div>
												<span class="agency-tag">aguaventura</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</article>
						<div class="row">
							<div class="col-md-7 col-sm-12 col-xs-12">
								<section class="post-box">
									<div class="performed-act">
										<h2>{{ trans('main.realized_activities') }}</h2>
										<p>{{ trans('main.activities_that_this_agency_performs') }}</p>
									</div>
									<ul class="accordion">
										@foreach ($offers as $offer)
											@include('site.partials.offers.list-item-ag')
										@endforeach
									</ul>
								</section>
							</div>
							<div class="col-md-4 col-md-offset-1 col-sm-12 col-xs-12">
								<div class="map-block">
									<div id="map" style="width: 100%; height: 300px"></div>
									<script type="text/javascript">
                               var latLng = new google.maps.LatLng({{ $agency['latitude'] }}, {{ $agency['longitude'] }});
                               var myOptions = {
                                   zoom: 15,
                                   center: latLng,
                                   mapTypeId: google.maps.MapTypeId.ROADMAP
                               };
                               var map = new google.maps.Map(document.getElementById("map"), myOptions);
                               var marker = new google.maps.Marker({
                                   position: latLng,
                                   map: map,
                                   title: '{{ $agency['name'] }}'
                               });
									</script>
								</div>
								<div class="ta-code">
									{!! $agency['tripadvisor_code'] !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div id="myModalX" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<!-- <h4 class="modal-title">Confirmation</h4> -->
				</div>
				<div class="modal-body">
					<div id="the-image">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.close') }}</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL END -->
	<div id="data"> <!-- Keep this div for instafeed information -->
	</div>
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/css/instafeed/instafeed.css') }}">
@stop
