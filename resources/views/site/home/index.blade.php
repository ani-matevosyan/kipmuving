@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="visual home" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
		<div class="gradoverlay"></div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<form action="/activity/search" class="activity-form" id="activity-form" method="post">
							{{ csrf_field() }}
							<strong class="title">{{ trans('main.what_activities_search') }}</strong>
							<div class="holder">
								<select class="form-control" id="activity_id" name="activity_id">
									@foreach ($activitiesList as $item)
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
								<div class="text-field">
									<input id="activity_date"
												 type="text"
												 name="activity_date"
												 value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"
												 placeholder="{{ trans('form.date') }}"
												 class="form-control"
												 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'/>
								</div>
								<input type="submit" value="{{ trans('button-links.search') }}" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<main id="main">
		{{--<section class="best-price-section">--}}
			{{--<div class="container">--}}
				{{--<header class="best-price-section__header">--}}
					{{--<div class="best-price-section__header-wrapper">--}}
						{{--<h2 class="best-price-section__title">{{ trans('main.the_best_price') }}</h2>--}}
						{{--<p class="best-price-section__title-description">{{ trans('main.you_have_preference') }}</p>--}}
					{{--</div>--}}
				{{--</header>--}}
				{{--<p class="best-price-section__summary">--}}
					{{--<strong>{{ trans('main.choose_dates_and_activities') }}</strong>--}}
					{{--{{ trans('main.agencies_will_send') }}--}}
					{{--<strong>{{ trans('main.offers') }}</strong>--}}
					{{--{{ trans('main.and_you_can') }}--}}
					{{--<strong>{{ trans('main.price&quality') }}</strong>.--}}
				{{--</p>--}}
				{{--<ul class="steps-list">--}}
					{{--<li class="steps-list__item">--}}
						{{--<figure class="steps-list__figure">--}}
							{{--<img src="{{ asset('/images/mountains.svg') }}" alt="Mountains icon" class="steps-list__icon">--}}
							{{--<figcaption class="steps-list__figcaption">1</figcaption>--}}
						{{--</figure>--}}
						{{--<p class="steps-list__name">{{ trans('main.choose_the') }}<strong>{{ trans('main.activities') }}</strong></p>--}}
					{{--</li>--}}
					{{--<li class="steps-list__item">--}}
						{{--<figure class="steps-list__figure">--}}
							{{--<img src="{{ asset('/images/percentage-discount.svg') }}" alt="Percent icon" class="steps-list__icon">--}}
							{{--<figcaption class="steps-list__figcaption">2</figcaption>--}}
						{{--</figure>--}}
						{{--<p class="steps-list__name">{{ trans('main.receive_the') }}<strong>{{ trans('main.offers') }}</strong></p>--}}
					{{--</li>--}}
					{{--<li class="steps-list__item">--}}
						{{--<figure class="steps-list__figure">--}}
							{{--<img src="{{ asset('/images/point-at.svg') }}" alt="Point at icon" class="steps-list__icon">--}}
							{{--<figcaption class="steps-list__figcaption">3</figcaption>--}}
						{{--</figure>--}}
						{{--<p class="steps-list__name">{{ trans('main.decide_the') }}<strong>{{ trans('main.best') }}</strong></p>--}}
					{{--</li>--}}
					{{--<li class="steps-list__item">--}}
						{{--<figure class="steps-list__figure">--}}
							{{--<img src="{{ asset('/images/cup.svg') }}" alt="Cup icon" class="steps-list__icon">--}}
							{{--<figcaption class="steps-list__figcaption">4</figcaption>--}}
						{{--</figure>--}}
						{{--<p class="steps-list__name">{{ trans('main.you_are_the') }}<strong>{{ trans('main.winner') }}</strong></p>--}}
					{{--</li>--}}
				{{--</ul>--}}
			{{--</div>--}}
		{{--</section>--}}
		<section id="guia" class="s_guia">
			<div class="container">
				<div class="col-md-5 col-md-push-2">
					<div class="section_title">
						<h2>
							@if(app()->getLocale() == 'es_ES' || app()->getLocale() == 'pt')
								<span class="size1">{{ trans('main.guide') }}</span>
								<span class="size4">{{ trans('main.complete') }}</span>
								<span class="size2">pucon</span>
								<span class="size3">{{ trans('main.free') }}</span>
							@elseif(app()->getLocale() == 'en')
								<span class="size4">{{ trans('main.complete') }}</span>
								<span class="size2">pucon</span>
								<span class="size1">{{ trans('main.guide') }}</span>
								<span class="size3">{{ trans('main.free') }}</span>
							@endif
						</h2>
					</div>
				</div>
				<div class="col-md-2 col-md-pull-5">
					<ul>
						<li>
							<a href="{{ action('FreePagesController@getBicicleta') }}">
								<img src="{{ asset('images/bicycle-grey.svg') }}" alt="bicycle">
							</a>
							{{ trans('main.bicycle') }}
						</li>
						<li>
							<a href="{{ action('FreePagesController@getDecarro') }}">
								<img src="{{ asset('images/bus-grey.svg') }}" alt="bus">
							</a>
							{{ trans('main.bus') }}
						</li>
						<li>
							<a href="{{ action('FreePagesController@getTourcultural') }}">
								<img src="{{ asset('images/car-grey.svg') }}" alt="car">
							</a>
							{{ trans('main.car') }}
						</li>
						<li>
							<a href="{{ action('FreePagesController@index') }}">
								<img src="{{ asset('images/hikking-grey.svg') }}" alt="hikking">
							</a>
							{{ trans('main.walking') }}
						</li>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="go-to-guide">
						<p><span>{{ trans('main.all_answers_here') }}</span> {{ trans('main.what_you_need_to_know_to_enjoy') }}
						</p>
						<p class="tegs"><span>{{ trans('main.maps_guides_addresses_suggestions') }}</span></p>
						<a href="{{ action('FreePagesController@index') }}" class="btn-orange">
							<img src="{{ asset('images/arrow.png') }}" alt="">
							{{ trans('button-links.go_to_guide') }}
						</a>
					</div>
				</div>
			</div>
		</section>
		<section class="s_allactivities">
			<div class="container">

				<header>
					<h2>{{ trans('main.activities_in_pucon') }}</h2>
					<p>{{ trans('main.first_choose_your_itinerary') }}</p>
				</header>

				<div class="all-activities">
					<div class="row">
						<?php $key = 0; ?>
						@foreach($activities as $activity)
							<div class="col-md-3 col-sm-6 col-xs-12 col">
								@include('site.partials.activities.all-list-item-arr')
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


				<div class="btn-holder">
					<a href="{{ action('ActivityController@index') }}"
						 class="btn btn-success">{{ trans('button-links.see_all_activities') }}</a>
				</div>
			</div>
		</section>
		<section id="viagem" class="s_viagem">
			<div class="container">
				<div class="block-wrapper">
					<div class="block">
						<h3>{{ trans('main.more_than_activities', ['activities' => 40]) }}</h3>
						<p>{{ trans('main.all_activities_in_one_place') }}</p>
					</div>
					<div class="block">
						<h3>{{ trans('main.more_time') }}</h3>
						<p>{{ trans('main.enjoy_your_entire_trip') }}</p>
					</div>
					<div class="block">
						<h3>{{ trans('main.all_agencies_together') }}</h3>
						<p>{{ trans('main.what_you_can_see_here') }}</p>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop
