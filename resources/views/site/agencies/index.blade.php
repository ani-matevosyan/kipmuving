@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	{{--<section class="visual activities-all" style="background-image: url(/images/top{{$img_index}}.jpg);">--}}
	<section class="visual activities-all" style="background-image: url({{ url('/images/top'.$imageIndex.'.jpg') }})">
	</section>
	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="breadcrumb">
						<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
						<li><a href="{{ action('AgencyController@index') }}">{{ trans('button-links.agencies') }}</a></li>
					</ul>
					<div class="your-reservation activity add" style="padding-bottom: 0px;">
						@include('site.offers.offers_quickinfo')
					</div>
					<div class="all-activities new">
						<header>
							<h1>{{ trans('button-links.agencies') }}</h1>
							<p>{{ trans('main.this_activity_is_an_alternative_of') }}</p>
						</header>
						<div class="row">
							<?php $key = 0; ?>
							@foreach($agencies->sortBy('name') as $agency)
								<div class="col-md-3 col-sm-6 col-xs-12 col">
									@include('site.partials.agencies.all-list-item')
								</div>
								<?php ++$key?>
								@if($key === 2)
									<div class="clearfix visible-sm-block"></div>
								@elseif($key===4)
									<div class="clearfix visible-md-block"></div>
									<div class="clearfix visible-lg-block"></div>
									<div class="clearfix visible-sm-block"></div>
									<?php $key = 0; ?>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</main>
@stop
