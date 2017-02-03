@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="visual activities-all" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
	</section>

	<script type="text/javascript" src="{{ asset('/js/floating-1.12.js') }}">
	</script>

	<script type="text/javascript">
       floatingMenu.add('floatdiv',
           {
               // Represents distance from top or
               // bottom browser window border
               // depending upon property used.
               // Only one should be specified.
               targetTop: 10,
               // targetBottom: 0,

               // prohibits movement on x-axis
               prohibitXMovement: true,
               // Remove this one if you don't
               // want snap effect
               snap: true
           });
	</script>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a></li>
					</ul>
					<div class="your-reservation activity add" style="padding-bottom: 0px;">
						@include('site.offers.offers_quickinfo')
					</div>
				</div>
			</div>
			<div class="all-activities new all-activities-header">
				<header>
					<h1>{{ trans('main.all_activities_in_pucon') }}</h1>
					<p>{{ trans('main.below_you_will_find_all_the_activities') }}</p>
				</header>
			</div>
		</div>
	</section>
	<!--Slider section-->
	<section id="first-slider-sec" class="csHidden">
		<div class="container">
			<div class="col-xs-12">
				<div class="col-md-4">
					<h1>{{ trans('main.the_most_requested') }}</h1>
				</div>
				<div class="col-md-8 row">
					<p>{{ trans('main.below_are_the_activities') }}</p>
				</div>
			</div>
			<div class="col-xs-12">
				<div id="cpa-slider-1">
					<div class="item">
						<a href="/activity/3">
							<img src="/uploads/activity/ GmaWx-VolcánVillarrica_mini.jpg" alt="Trekking Volcán Villarrica"/>
							<h2>Trekking Volcán Villarrica</h2>
						</a>
					</div>
					<div class="item">
						<a href="/activity/5">
							<img src="/uploads/activity/ zNYN9-2.jpg" alt="Rafting Alto"/>
							<h2>Rafting Alto</h2>
						</a>
					</div>
					<div class="item">
						<a href="/activity/2">
							<img src="/uploads/activity/ kpEoA-2.jpg" alt="Rafting Bajo"/>
							<h2>Rafting Bajo</h2>
						</a>
					</div>
					<div class="item">
						<a href="/activity/4">
							<img src="/uploads/activity/ ERPJI-2.jpg" alt="Tour por la zona + Termas"/>
							<h2>Tour por la zona + Termas</h2>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End Slider section-->
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="all-activities new">

						<div class="activites-bar">

							<div style="position:relative; height:60px; z-index:100">
								<div id="floatdiv" style="position:absolute;">
									<ul class="activities-list">
										<li class="active">
											<a href="#trekking" class="green">
												<div class="ico">
													<img src="/images/ico-treking.svg" alt="image description"
														  width="33" height="33"
														  onerror="this.onerror=null; this.src='/images/ico16.png'">
												</div>
												<strong>{{ trans('main.trekking') }}</strong>
											</a>
										</li>
										<li>
											<a href="#rio" class="orange">
												<div class="ico">
													<img src="/images/ico-rio.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='/images/ico17.png'">
												</div>
												<strong>{{ trans('main.river') }}</strong>
											</a>
										</li>
										<li>
											<a href="#aire" class="blue">
												<div class="ico">
													<img src="/images/ico-aire.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='/images/ico18.png'">
												</div>
												<strong>{{ trans('main.action') }}</strong>
											</a>
										</li>
										<li>
											<a href="#relax" class="sky-blue">
												<div class="ico">
													<img src="/images/ico-relax.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='/images/ico19.png'">
												</div>
												<strong>{{ trans('main.relax') }}</strong>
											</a>
										</li>
										<li>
											<a href="#nieve" class="violet">
												<div class="ico">
													<img src="/images/ico-nieve.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='/images/ico20.png'">
												</div>
												<strong>{{ trans('main.snow') }}</strong>
											</a>
										</li>
										<li>
											<a href="#familia" class="red">
												<div class="ico">
													<img src="/images/ico-family.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='/images/ico30.png'">
												</div>
												<strong>{{ trans('main.cultural') }}</strong>
											</a>
										</li>
									</ul>
								</div>
								<div class="activities-info" id="activities-info">
									<p><strong>{{ trans('main.iconography') }}</strong></p>
									<ul>
										<li class="active">
											<a href="#">
												<div class="ico">
													<img src="images/day.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='images/ico16.png'">
												</div>
												<p>{{ trans('main.day_activity') }}</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="ico">
													<img src="images/night.svg" alt="image description" width="33"
														  height="33"
														  onerror="this.onerror=null; this.src='images/ico17.png'">
												</div>
												<p>{{ trans('main.night_activity') }}</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="ico">
													<img src="images/down-arrow.svg" alt="image description" width="25"
														  height="25"
														  onerror="this.onerror=null; this.src='images/ico18.png'">
												</div>
												<p>{{ trans('main.march_to_november') }}</p>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="ico">
													<img src="images/up-arrow.svg" alt="image description" width="25"
														  height="25"
														  onerror="this.onerror=null; this.src='images/ico19.png'">
												</div>
												<p>{{ trans('main.december_to_march') }}</p>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<!-- <nav class="subnav">
									  <ul>
												 <li><a href="#">Ordenar por</a></li>
												 <li class="active"><a href="#">Recomendacion</a></li>
												 <li><a href="#">Precio más alto</a></li>
												 <li><a href="#">Gratuito</a></li>
									  </ul>
							</nav> -->
						</div>

						@if(count($activities['trekking']) > 0)
						<section class="activity-block" id="trekking">
							<strong class="heading">
								<span>
									<img src="/images/Trekking.svg"
										  alt="image description"
										  width="40"
										  height="40"
										  onerror="this.onerror=null; this.src='/images/ico21.png'">
								</span>
								{{ trans('main.trekking') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['trekking'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
						@if(count($activities['rio']) > 0)
						<section class="activity-block rio" id="rio">
							<strong class="heading">
								<span>
									<img src="/images/kayak.svg"
										  alt="image description"
										  width="40"
										  height="40"
										  onerror="this.onerror=null; this.src='/images/ico22.png'">
								</span>
								{{ trans('main.river') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['rio'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
						@if(count($activities['aire']) > 0)
						<section class="activity-block aire" id="aire">
							<strong class="heading">
								<span>
									<img src="/images/aire.svg"
										  alt="image description"
										  width="33"
										  height="33"
										  onerror="this.onerror=null; this.src='/images/ico23.png'">
								</span>
								{{ trans('main.action') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['aire'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
						@if(count($activities['relax']) > 0)
						<section class="activity-block relax" id="relax">
							<strong class="heading">
								<span>
									<img src="/images/relax.svg"
										  alt="image description"
										  width="33"
										  height="33"
										  onerror="this.onerror=null; this.src='/images/ico24.png'">
								</span>
								{{ trans('main.relax') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['relax'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
						@if(count($activities['nieve']) > 0)
						<section class="activity-block nieve" id="nieve">
							<strong class="heading">
								<span>
									<img src="/images/skiing_ski_running.svg"
										  alt="image description"
										  width="33"
										  height="33"
										  onerror="this.onerror=null; this.src='/images/ico25.png'">
								</span>
								{{ trans('main.snow') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['nieve'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
						@if(count($activities['familia']) > 0)
						<section class="activity-block familia" id="familia">
							<strong class="heading">
								<span>
									<img src="/images/family.svg"
										  alt="image description"
										  width="33"
										  height="33"
										  onerror="this.onerror=null; this.src='/images/ico25.png'">
								</span>
								{{ trans('main.cultural') }}
							</strong>
							<div class="row">
								<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
								@foreach ($activities['familia'] as $activity)
									<div class="col-md-3 col-sm-4 col-xs-12 col">
										@include('site.partials.activities.all-list-item')
									</div>
									<?php ++$key_for_4_col; ++$key_for_3_col; ?>
									@if($key_for_4_col ===4 )
										<div class="clearfix visible-lg-block"></div>
										<div class="clearfix visible-md-block"></div>
										<?php $key_for_4_col = 0; ?>
									@endif
									@if($key_for_3_col ===3 )
										<div class="clearfix visible-sm-block"></div>
										<?php $key_for_3_col = 0; ?>
									@endif
								@endforeach
							</div>
						</section>
						@endif
					</div>
				</div>
			</div>
		</div>
	</main>
@stop
