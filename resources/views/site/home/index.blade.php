@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<section class="s-banner">
			<div class="s-banner__form-container">
				<form action="/activity/search" class="banner-form" method="post">
					{{ csrf_field() }}
					<select class="banner-form__select" name="activity_id">
						@foreach ($activitiesList as $item)
							<option value="{{ $item->id }}">{{ $item->name }}</option>
						@endforeach
					</select>
					<input name="activity_date"
						   value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"
						   placeholder="{{ trans('form.date') }}"
						   class="banner-form__date"
						   data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'/>
					<input type="submit" value="{{ trans('button-links.search') }}" class="btn banner-form__submit">
				</form>
			</div>
			<div class="s-banner__content">
				<a href="{{ action('ActivityController@index') }}" class="s-banner__link"></a>
				<ul class="s-banner__partners">
					<li>
						<img src="{{ asset('images/salewa-logo.png') }}" alt="Salewa Chile logo">
					</li>
					<li>
						<img src="{{ asset('images/fjallraven-logo.png') }}" alt="Fjallraven logo">
					</li>
					<li>
						<img src="{{ asset('images/volkanica-logo.png') }}" alt="Volkanica logo">
					</li>
				</ul>
				<div class="s-banner__proposal">
					<div class="s-banner__title">
						<strong>{{ trans('main.win') }}</strong>
						<strong>10%</strong>
					</div>
					<div class="s-banner__description">
						<p>
							{{ trans('main.buy_in_stores') }}
							<strong>Volkanica</strong>
							{{ trans('main.in_marks') }}
							<strong>Fjallraven {{ trans('main.and') }} Salewa</strong>
						</p>
					</div>
				</div>
			</div>
		</section>
		{{--<section class="visual home" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">--}}
			{{--<div class="gradoverlay"></div>--}}
			{{--<div class="caption">--}}
				{{--<div class="container">--}}
					{{--<div class="row">--}}
						{{--<div class="col-xs-12">--}}
							{{--<form action="/activity/search" class="activity-form" id="activity-form" method="post">--}}
								{{--{{ csrf_field() }}--}}
								{{--<strong class="title">{{ trans('main.what_activities_search') }}</strong>--}}
								{{--<div class="holder">--}}
									{{--<select class="form-control" id="activity_id" name="activity_id">--}}
										{{--@foreach ($activitiesList as $item)--}}
											{{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
										{{--@endforeach--}}
									{{--</select>--}}
									{{--<div class="text-field">--}}
										{{--<input id="activity_date"--}}
													 {{--type="text"--}}
													 {{--name="activity_date"--}}
													 {{--value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"--}}
													 {{--placeholder="{{ trans('form.date') }}"--}}
													 {{--class="form-control"--}}
													 {{--data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'/>--}}
									{{--</div>--}}
									{{--<input type="submit" value="{{ trans('button-links.search') }}" class="btn btn-primary">--}}
								{{--</div>--}}
							{{--</form>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</section>--}}
		<section class="video-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<header class="video-section__header">
							<h2 class="video-section__title">{{ trans('main.the_best_price') }}</h2>
							<p class="video-section__description">{{ trans('main.you_deserve_to_choose') }}</p>
						</header>
						<p class="video-section__text">
							<strong class="video-section__strong">{{ trans('main.why_search_for_low') }}</strong>
							{{ trans('main.enter') }} KeepMoving.co, {{ trans('main.choose_the_best_adventures') }}
						</p>
						<a href="{{ action('ActivityController@index') }}" class="video-section__button">{{ trans('main.i_want_to_receive') }}</a>
					</div>
					<div class="col-md-6">
						<div class="video-section__video-container">
							@if( app()->getLocale() === 'pt' )
								<iframe src="https://www.youtube.com/embed/lr-TlHPJWCo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							@else
								<iframe src="https://www.youtube.com/embed/N_x9OJHMLvI?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>

		{{--To delete--}}
		{{--{{ trans('main.you_have_preference') }}--}}
		{{--{{ trans('main.choose_dates_and_activities') }}--}}
		{{--{{ trans('main.agencies_will_send') }}--}}
		{{--{{ trans('main.and_you_can') }}--}}
		{{--{{ trans('main.price&quality') }}--}}
		{{--{{ asset('/images/mountains.svg') }}--}}

		{{--<section class="best-price-section">--}}
			{{--<div class="container">--}}
				{{--<header class="best-price-section__header">--}}
					{{--<div class="best-price-section__header-wrapper">--}}
						{{--<h2 class="best-price-section__title">{{ trans('main.the_best_price') }}</h2>--}}
						{{--<p class="best-price-section__title-description"></p>--}}
					{{--</div>--}}
				{{--</header>--}}
				{{--<div class="best-price-section__content">--}}
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
								{{--<img src="{{ asset('/images/mountains.svg') }}" alt="Mountains icon" style="width: 37px" class="steps-list__icon">--}}
								{{--<figcaption class="steps-list__figcaption">1</figcaption>--}}
							{{--</figure>--}}
							{{--<p class="steps-list__name">{{ trans('main.choose_the') }}<strong class="steps-list__bold-text">{{ trans('main.activities') }}</strong></p>--}}
						{{--</li>--}}
						{{--<li class="steps-list__item">--}}
							{{--<figure class="steps-list__figure">--}}
								{{--<img src="{{ asset('/images/percentage-discount.svg') }}" alt="Percent icon" style="width: 26px" class="steps-list__icon">--}}
								{{--<figcaption class="steps-list__figcaption">2</figcaption>--}}
							{{--</figure>--}}
							{{--<p class="steps-list__name">{{ trans('main.receive_the') }}<strong class="steps-list__bold-text">{{ trans('main.offers') }}</strong></p>--}}
						{{--</li>--}}
						{{--<li class="steps-list__item">--}}
							{{--<figure class="steps-list__figure">--}}
								{{--<img src="{{ asset('/images/point-at.svg') }}" alt="Point at icon" style="width: 33px" class="steps-list__icon">--}}
								{{--<figcaption class="steps-list__figcaption">3</figcaption>--}}
							{{--</figure>--}}
							{{--<p class="steps-list__name">{{ trans('main.decide_the') }}<strong class="steps-list__bold-text">{{ trans('main.best') }}</strong></p>--}}
						{{--</li>--}}
						{{--<li class="steps-list__item">--}}
							{{--<figure class="steps-list__figure">--}}
								{{--<img src="{{ asset('/images/cup.svg') }}" alt="Cup icon" style="width: 32px" class="steps-list__icon">--}}
								{{--<figcaption class="steps-list__figcaption">4</figcaption>--}}
							{{--</figure>--}}
							{{--<p class="steps-list__name">{{ trans('main.you_are_the') }}<strong class="steps-list__bold-text">{{ trans('main.winner') }}</strong></p>--}}
						{{--</li>--}}
					{{--</ul>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</section>--}}


		@if(count($slider_activities) > 0)
			<section class="activities-slider-section">
				<div class="container">
					<header class="activities-slider-section__header">
						<h2 class="activities-slider-section__title">{{ trans('main.most_visited_in_pucon') }}</h2>
						<p class="activities-slider-section__sub-title">{{ trans('main.below_are_activities') }}</p>
					</header>
					<div id="most-visited-activities-slider" class="owl-carousel csHidden activities-slider">
						@foreach($slider_activities as $activity)
							<div class="activities-slider__item">
								<a href="{{ action('ActivityController@getActivity', $activity->id) }}" class="activities-slider__link">
									<img src="{{ asset($activity->image_thumb) }}" onerror="this.src='/images/image-none.jpg';" class="activities-slider__image" alt="{{ $activity->name }}"/>
									<h3 class="activities-slider__name">{{ $activity->name }}</h3>
									<p class="activities-slider__description">{{ $activity->short_description }}</p>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endif

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

		@if(count($random_activities) > 0)
			<section class="activities-slider-section">
				<div class="container">
					<header class="activities-slider-section__header">
						<h2 class="activities-slider-section__title">{{ trans('main.some_activities_in_pucon') }}</h2>
						<p class="activities-slider-section__sub-title">{{ trans('main.first_choose_your_itinerary') }}</p>
					</header>
					<div id="most-visited-activities-slider" class="owl-carousel csHidden activities-slider">
						@foreach($random_activities as $activity)
							<div class="activities-slider__item">
								<a href="{{ action('ActivityController@getActivity', $activity->id) }}" class="activities-slider__link">
									<img src="{{ asset($activity->image_thumb) }}" onerror="this.src='/images/image-none.jpg';" class="activities-slider__image" alt="{{ $activity->name }}"/>
									<h3 class="activities-slider__name">{{ $activity->name }}</h3>
									<p class="activities-slider__description">{{ $activity->short_description }}</p>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endif

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
