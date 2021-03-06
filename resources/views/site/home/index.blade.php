@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">

		<section class="s-banner">
			<div class="owl-carousel owl-theme s-banner__slider">
				<div class="item" id="item-1"></div>
				{{--<div class="item" id="item-2"></div>--}}
			</div>
			<div class="s-banner__termas-geometricas" onclick="window.open( '{{ action('ActivityController@getActivity', $tGActivity->id) }}','_top' ); return false;">
				<p>Termas Geométricas</p>
				@if($tGActivity->tripadvisor_code)
					<div class="box tripadvisor">
						{!! $tGActivity->tripadvisor_code !!}
					</div>
				@endif
			</div>
			<div class="s-banner__price" onclick="window.open( '{{ action('ActivityController@getActivity', $tGActivity->id) }}','_top' ); return false;">
				<div class="minP">
					<p>{{ trans('main.from') }}</p>
					<span>
						@if(session('currency.type') === 'BRL')
							R$
						@else
							$
						@endif
					</span>
					<span>
						@if(session('currency.type') === 'CLP')
							{{ number_format($tGActivity->offers->min('price'), 0, ".", ",") }}
						@else
							{{ number_format($tGActivity->offers->min('price'), 2, ".", ",") }}
						@endif
					</span>
				</div>

					<a href="{{ action('ActivityController@getActivity', $tGActivity->id) }}">
						<div></div>
					</a>
				</div>
			{{--</a>--}}
		</section>


		<section class="win-10-section">
			<div class="row">
				<div class="col-sm-6 win-10">
					<div class="row">
						<div class="col-xs-4">
							<img src="{{ asset('images/siteImages/partners.png') }}" class="partners" alt="Aventuras chile partners">
						</div>
						<div class="col-xs-8">
							<h2>
								{{ trans('main.win_10_p') }}
							</h2>
							<p>
								{{ trans('main.win_10_text') }}
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 donamos-2">
					<div class="row">
						<div class="col-xs-4">
							<img src="{{ asset('images/siteImages/sprout.svg') }}" class="donamos" alt="donamos">
						</div>
						<div class="col-xs-8">
							<h2>
								{{ trans('main.donate_2_p') }}
							</h2>
							<p>
								{{ trans('main.donate_2_text') }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>


		{{--todo add translations, delete this--}}
		<section class="best-price-section">
			<div class="row">
				<div class="col-sm-6 best-price">
					<header class="best-price-section__header">
						<h2 class="best-price-section__title">{{ trans('main.the_best_price') }}</h2>
					</header>
					<p class="best-price-section__text">
						<span>{{ trans('main.why_search_for_low') }}</span>
						{{ trans('main.enter') }} aventuraschile.com, {{ trans('main.choose_the_best_adventures') }}
					</p>
					<div class="best-price-section__video-container pantalla-video">
						@if( app()->getLocale() === 'pt' )
							<iframe src="https://www.youtube.com/embed/lr-TlHPJWCo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						@else
							<iframe src="https://www.youtube.com/embed/N_x9OJHMLvI?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						@endif
					</div>
				</div>
				<div class="col-sm-6 free-guide">
					<img class="vectorial-img" src="{{ asset('images/vectorial.png') }}"  usemap="#freeGuide">
					<map name="freeGuide">
						<area shape="rect" coords="0,0,71,54" href="{{ action('FreePagesController@getBicicleta') }}" alt="free Guide">
						<area shape="rect" coords="120,0,195,54" href="{{ action('FreePagesController@getDecarro') }}" alt="free Guide">
						<area shape="rect" coords="265,0,336,54" href="{{ action('FreePagesController@getTourcultural') }}" alt="free Guide">
						<area shape="rect" coords="415,0,461,54" href="{{ action('FreePagesController@index') }}" alt="free Guide">
					</map>
					<div class="row">
						<div class="col-xs-6 free-guide__textFG">
							<p class="guia">
								Guia
								<span class="gratuito">
								Gratuito
							</span>
							</p>
						</div>
						<div class="col-xs-6 free-guide__textMB">
							<p class="hecho">
								Hecho por  quien sabe:
								<span class="guias">
								guias locales
							</span>
							</p>
						</div>
					</div>
					<div class="row free-guide__textText">
						<p>
							A diferença: feito por guias locais.
						</p>
						<p>
							Tienen la experienciay saben cuales son las mejores actividades.
							Todas as respostas estão aquí. O que você precisa saber
							para aproveitar seus dias em Pucón no melhor estilo.
						</p>
						<p>
							Mapas, Guias, Endereços, Sugestões
						</p>
					</div>
					<a href="{{ action('FreePagesController@index') }}" class="row free-guide__GO">
						<div>
							<span class="glyphicon glyphicon-menu-right"></span>
							<span>Ir ao guía</span>
						</div>
					</a>
				</div>
			</div>
		</section>


		@if(count($slider_activities) > 0)
			<section class="activities-slider-section most-visited">
				<div class="container-fluid">
					<header class="activities-slider-section__header">
						<h2 class="activities-slider-section__title most-visited">{{ trans('main.most_visited_in_pucon') }}</h2>
						<p class="activities-slider-section__sub-title">{{ trans('main.activities_stand_out') }}</p>
						<a href="{{ route('activities') }}" class="see-all-link">{{ trans('main.see_all') }} <span class="glyphicon glyphicon-menu-right"></span></a>
					</header>
					<div id="most-visited-activities-slider" class="owl-carousel csHidden activities-slider">
						@foreach($slider_activities as $activity)
							<div class="activities-slider__item">
								<a href="{{ action('ActivityController@getActivity', $activity->id) }}" class="activities-slider__link">
									<figure>
										<img src="{{ asset($activity->image_thumb) }}" onerror="this.src='/images/image-none.jpg';" class="activities-slider__image" alt="{{ $activity->name }}"/>
									</figure>
									<h3 class="activities-slider__name">{{ $activity->name }}</h3>
									<p class="activities-slider__description">{{ $activity->short_description }}</p>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endif


		@if(count($suggestions) > 0)
			<section class="activities-slider-section suggested-plans">
				<div class="container-fluid">
					<header class="activities-slider-section__header">
						<h2 class="activities-slider-section__title">{{ trans('main.itinerary_suggestions') }}</h2>
						<p class="activities-slider-section__sub-title">{{ trans('main.some_ideas_for_you') }}</p>
						<a href="{{ route('routes.home') }}" class="see-all-link">{{ trans('main.see_all') }} <span class="glyphicon glyphicon-menu-right"></span></a>
					</header>
					<div id="most-visited-activities-slider" class="owl-carousel csHidden activities-slider">
						@foreach($suggestions as $suggestion)
							<div class="activities-slider__item">
								<figure>
									<a href="{{ route('suggestions-single', ['id' => $suggestion->id]) }}">
										<img class="lazyload"
											 src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
											 data-original="{{ asset($suggestion->image) }}"
											 alt="{{ $suggestion->name }}">
									</a>
								</figure>
								<div class="suggested-plans__description">
									<h3><a href="{{ route('suggestions-single', ['id' => $suggestion->id]) }}">{{ $suggestion->name }}</a></h3>
									<p>{{ $suggestion->short_description }}</p>
								</div>
								<footer style="display: none">
									<ul>
										<li><img src="{{ asset('/images/'.$suggestion->category.'-icon.png') }}" alt="hiking icon"></li>
									</ul>
									<div class="suggested-plans__intensity">
										@for($i = 1; $i <= 4; $i++)
											<span class="{{ $i === $suggestion->intensity ? 'chosen' : '' }}"></span>
										@endfor
									</div>
								</footer>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endif


		{{--<section id="guia" class="s_guia">--}}
			{{--<div class="container">--}}
				{{--<div class="col-md-5 col-md-push-2">--}}
					{{--<div class="section_title">--}}
						{{--<h2>--}}
							{{--@if(app()->getLocale() == 'es_ES' || app()->getLocale() == 'pt')--}}
								{{--<span class="size1">{{ trans('main.guide') }}</span>--}}
								{{--<span class="size4">{{ trans('main.complete') }}</span>--}}
								{{--<span class="size2">pucon</span>--}}
								{{--<span class="size3">{{ trans('main.free') }}</span>--}}
							{{--@elseif(app()->getLocale() == 'en')--}}
								{{--<span class="size4">{{ trans('main.complete') }}</span>--}}
								{{--<span class="size2">pucon</span>--}}
								{{--<span class="size1">{{ trans('main.guide') }}</span>--}}
								{{--<span class="size3">{{ trans('main.free') }}</span>--}}
							{{--@endif--}}
						{{--</h2>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-2 col-md-pull-5">--}}
					{{--<ul>--}}
						{{--<li>--}}
							{{--<a href="{{ action('FreePagesController@getBicicleta') }}">--}}
								{{--<img src="{{ asset('images/bicycle-grey.svg') }}" alt="bicycle">--}}
							{{--</a>--}}
							{{--{{ trans('main.bicycle') }}--}}
						{{--</li>--}}
						{{--<li>--}}
							{{--<a href="{{ action('FreePagesController@getDecarro') }}">--}}
								{{--<img src="{{ asset('images/bus-grey.svg') }}" alt="bus">--}}
							{{--</a>--}}
							{{--{{ trans('main.bus') }}--}}
						{{--</li>--}}
						{{--<li>--}}
							{{--<a href="{{ action('FreePagesController@getTourcultural') }}">--}}
								{{--<img src="{{ asset('images/car-grey.svg') }}" alt="car">--}}
							{{--</a>--}}
							{{--{{ trans('main.car') }}--}}
						{{--</li>--}}
						{{--<li>--}}
							{{--<a href="{{ action('FreePagesController@index') }}">--}}
								{{--<img src="{{ asset('images/hikking-grey.svg') }}" alt="hikking">--}}
							{{--</a>--}}
							{{--{{ trans('main.walking') }}--}}
						{{--</li>--}}
					{{--</ul>--}}
				{{--</div>--}}
				{{--<div class="col-md-5">--}}
					{{--<div class="go-to-guide">--}}
						{{--<p><span>{{ trans('main.all_answers_here') }}</span> {{ trans('main.what_you_need_to_know_to_enjoy') }}--}}
						{{--</p>--}}
						{{--<p class="tegs"><span>{{ trans('main.maps_guides_addresses_suggestions') }}</span></p>--}}
						{{--<a href="{{ action('FreePagesController@index') }}" class="btn-orange">--}}
							{{--<img src="{{ asset('images/arrow.png') }}" alt="">--}}
							{{--{{ trans('button-links.go_to_guide') }}--}}
						{{--</a>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</section>--}}


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
