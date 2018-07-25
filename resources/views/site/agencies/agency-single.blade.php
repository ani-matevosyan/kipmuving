@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="your-reservation adventure new">
						<article class="main-post">
							<header>
								<h1>{{ $agency->name }}</h1>
								<strong class="sub-title">O`Higgins Nº211-C </strong>
							</header>

						</article>
						<div class="row">
							<div class="col-md-4 col-md-push-7 col-md-offset-1 col-sm-12 col-xs-12">


								<aside class="agency-aside">
									<div class="map-block">
										<div id="map" style="width: 100%; height: 300px"></div>
										<script type="text/javascript">
											function initAgencyMap() {
												var latLng = new google.maps.LatLng({{ $agency->latitude }}, {{ $agency->longitude }});
												var myOptions = {
													zoom: 15,
													center: latLng,
													mapTypeId: google.maps.MapTypeId.ROADMAP
												};
												var map = new google.maps.Map(document.getElementById("map"), myOptions);
												var marker = new google.maps.Marker({
													position: latLng,
													map: map,
													title: '{{ $agency->name }}'
												});
											}
										</script>
									</div>
									<div class="ta-code">
										{!! $agency->tripadvisor_code !!}
									</div>
									@include('site.offers.offers_quickinfo', ['classPlace' => 'program-schedule_agency'])
								</aside>
							</div>
							<div class="col-md-7 col-md-pull-5 col-sm-12 col-xs-12">
								<div class="post-holder">
									<div class="row">
										<div class="col-md-6">
											<div class="agency-photo-wrapp">
												<img src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-original="/{{ $agency->image }}" alt="image description" onerror="this.src='/images/image-none.jpg';" class="lazyload">
											</div>
										</div>
										<div class="col-md-6">
											<div class="text">
												<p>{{ $agency->description }}</p>
											</div>
											@if($agency->instagram_id)
												<div class="agency-gallery">
													<div class="row">
														<div class="col-xs-9">
															<div id="instafeed4" class="instafeed"
																 data-instagram-id="{{ $agency['instagram_id'] }}"></div>
														</div>
														@if($agency->instagram_name)
															<span class="agency-tag">{{ $agency->instagram_name }}</span>
														@endif
													</div>
												</div>
											@endif
										</div>
									</div>
								</div>
								<section class="post-box">
									<div class="performed-act">
										<h2>{{ trans('main.realized_activities') }}</h2>
										<p>{{ trans('main.activities_that_this_agency_performs') }}</p>
									</div>
									<ul class="accordion">
										@foreach ($agency->offers as $offer)
											@include('site.partials.offers.list-item-ag')
										@endforeach
									</ul>
								</section>
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
@stop
