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
								<div class="row">
									<div class="col-xs-1 agency-name">
										<h1>{{ $agency->name }}</h1>
									</div>
									<div class="col-xs-5">
										<div class="ta-code">
											{!! $agency->tripadvisor_code !!}
										</div>
									</div>
								</div>
								<strong class="sub-title">O`Higgins Nº211-C </strong>
							</header>
							<div class="row">
								<div class="col-md-8">
									<div class="post-holder">
										<div class="row">
											<div class="col-sm-5 agency-img">
												<div class="agency-photo-wrapp">
													<img src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-original="/{{ $agency->image }}" alt="image description" onerror="this.src='/images/image-none.jpg';" class="lazyload">
												</div>
											</div>
											<div class="col-sm-6 agency-text">
												<div class="text">
													<p>{{ $agency->description }}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									@if($agency->instagram_id)
										<div class="agency-gallery">
											<div class="row">
												@if($agency->instagram_name)
													<div class="col-xs-12">
														<span class="agency-tag">{{ $agency->instagram_name }}</span>
													</div>
												@endif
												<div class="col-xs-12">
													<div id="instafeed4" class="instafeed"
														 data-instagram-id="{{ $agency['instagram_id'] }}"></div>
												</div>
											</div>
										</div>
									@endif
								</div>
							</div>
						</article>
						<div class="row">
							<div class="col-md-4 col-md-push-8 col-sm-12 col-xs-12">
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

								</aside>
							</div>
							<div class="col-md-8 col-md-pull-4 col-sm-12 col-xs-12">

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
