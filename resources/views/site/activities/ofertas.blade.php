@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<section class="visual activities-all" style="background-image: url(/images/top{{$img_index}}.jpg);">
</section>
<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="#">HOME</a></li>
					<li><a href="#">Ofertas</a></li>
				</ul>
				<div class="all-activities new">
					<header>
						<h1>Ofertas</h1>
						<p>Esta actividad es una alternativa de emoción y entretención, que no reviste mayor peligro y es apta para niños, jóvenes y adultos mayores, los cuales pueden disfrutar de una agradable Aventura. </p>
					</header>
					<div class="activites-bar">
						<ul class="activities-list">
							<li class="active">
								<a href="#trekking" class="green">
									<div class="ico">
										<img src="/images/ico-treking.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico16.png'">
									</div>
									<strong>Trekking</strong>
								</a>
							</li>
							<li>
								<a href="#rio" class="orange">
									<div class="ico">
										<img src="/images/ico-rio.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico17.png'">
									</div>
									<strong>Río</strong>
								</a>
							</li>
							<li>
								<a href="#aire" class="blue">
									<div class="ico">
										<img src="/images/ico-aire.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico18.png'">
									</div>
									<strong>Acción</strong>
								</a>
							</li>
							<li>
								<a href="#relax" class="sky-blue">
									<div class="ico">
										<img src="/images/ico-relax.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico19.png'">
									</div>
									<strong>Relax</strong>
								</a>
							</li>
							<li>
								<a href="#nieve" class="violet">
									<div class="ico">
										<img src="/images/ico-nieve.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico20.png'">
									</div>
									<strong>Nieve</strong>
								</a>
							</li>
							<li>
								<a href="#familia" class="red">
									<div class="ico">
										<img src="/images/ico-family.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico30.png'">
									</div>
									<strong>Cultural</strong>
								</a>
							</li>
						</ul>
					</div>

					<section class="activity-block" id="trekking">
						<strong class="heading">
							<span><img src="/images/Trekking.svg" alt="image description" width="40" height="40" onerror="this.onerror=null; this.src='/images/ico21.png'"></span>
							Trekking
						</strong>
						<div class="row">
							@foreach ($trekking_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
					<section class="activity-block rio" id="rio">
						<strong class="heading">
							<span><img src="/images/kayak.svg" alt="image description" width="40" height="40" onerror="this.onerror=null; this.src='/images/ico22.png'"></span>
							Rio
						</strong>
						<div class="row">
							@@foreach ($rio_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
					<section class="activity-block aire" id="aire">
						<strong class="heading">
							<span><img src="/images/aire.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico23.png'"></span>
							Acción
						</strong>
						<div class="row">
							@foreach ($aire_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
					<section class="activity-block relax" id="relax">
						<strong class="heading">
							<span><img src="/images/relax.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico24.png'"></span>
							Relax
						</strong>
						<div class="row">
							@foreach ($relax_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
					<section class="activity-block nieve" id="nieve">
						<strong class="heading">
							<span><img src="/images/skiing_ski_running.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico25.png'"></span>
							Nieve
						</strong>
						<div class="row">
							@foreach ($nieve_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
					<section class="activity-block familia" id="familia">
						<strong class="heading">
							<span><img src="/images/family.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='/images/ico25.png'"></span>
							Cultural
						</strong>
						<div class="row">
							@foreach ($familia_offers as $offer)
							<div class="col-md-3 col-sm-4 col-xs-12 col">
								@include('site.partials.offers.ofertas-list-item', array('offer' => $offer))
							</div>
							@endforeach
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
