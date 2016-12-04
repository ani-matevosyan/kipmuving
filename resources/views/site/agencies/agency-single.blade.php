@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="#">HOME</a></li>
					<li>{{ $agency['name'] }}</li>
				</ul>
				<div class="your-reservation adventure new">
					<article class="main-post">
						<header>
							<h1>{{ $agency['name'] }}</h1>
							<!-- <strong class="sub-title">O`Higgins Nº211-C </strong> -->
						</header>
						<div class="post-holder">
							<div class="align-left">
								<img src="/{{ $agency['image'] }}" alt="image description">
							</div>
							<!-- <div class="align-right"><img src="images/img16.jpg" alt="image description"></div> -->
							<div class="text">
								<!-- <div class="rating">
									<div class="star"><img alt="image description" src="images/img-star.png"></div>
									<span>120 comentarios</span>
								</div> -->
								<div class="text-holder">
									<p>{{ $agency['description'] }}</p>
								</div>
								<div class="trip-adv">

								</div>
							</div>
						</div>
					</article>
					<div class="row">
						<div class="col-md-8 col-sm-12 col-xs-12">
							<section class="post-box">
								<div class="performed-act">
									<h2>Actividades que realiza</h2>
									<p>Estas son las actividades que esta agencia realiza. Para hacer una reserva, seleciona el número de personas y después la fecha.</p>
									<!-- <div class="activites-bar">
										<ul class="activities-list">
											<li class="active">
												<a href="#" class="green">
													<div class="ico">
														<img src="/images/ico-treking.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico16.png'">
													</div>
													<strong>Trekking</strong>
												</a>
											</li>
											<li>
												<a href="#" class="orange">
													<div class="ico">
														<img src="/images/ico-rio.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico17.png'">
													</div>
													<strong>Río</strong>
												</a>
											</li>
											<li>
												<a href="#" class="yellow">
													<div class="ico">
														<img src="/images/ico-tour.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico18.png'">
													</div>
													<strong>Tour</strong>
												</a>
											</li>
											<li>
												<a href="#" class="sky-blue">
													<div class="ico">
														<img src="/images/ico-relax.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico19.png'">
													</div>
													<strong>Relax</strong>
												</a>
											</li>
											<li>
												<a href="#" class="violet">
													<div class="ico">
														<img src="/images/ico-nieve.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico20.png'">
													</div>
													<strong>Nieve</strong>
												</a>
											</li>
										</ul>
									</div> -->
								</div>
								<ul class="accordion">
									@foreach ($offers as $offer)
										@include('site.partials.offers.list-item-ag')
									@endforeach
								</ul>
							</section>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
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
@stop
