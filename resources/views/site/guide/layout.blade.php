@extends('site.layouts.default-new')

@section('content')

	<div class="guides">

		<nav class="guide-navigation">
			<div class="container">
				<h2 class="guide-navigation__title">Preguntas Frecuentes</h2>
				<ul class="guide-navigation__list">
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@howToGetToPucon') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-how-to-get-to-pucon' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon1.png') }}" alt="How to get to Pucon" class="guide-navigation__icon">
							Como chegar a Pucón
						</a>
					</li>
					<li class="guide-navigation__item">
						{{--<a href="{{ action('GuideController@getMarkets') }}" class="guide-navigation__link guide-navigation__link_active">--}}
						{{--<img src="{{ asset('/images/guide-icon4.png') }}" alt="Shops and Services" class="guide-navigation__icon">--}}
						{{--Lojas e Serviços--}}
						{{--</a>--}}
						<a href="{{ action('GuideController@shopsAndServices') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-shops-and-services' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon4.png') }}" alt="Shops and Services" class="guide-navigation__icon">
							Lojas e Serviços
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@transportation') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-transportation' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon7.png') }}" alt="Transportation" class="guide-navigation__icon">
							Transportes
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@summerAndWinter') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-summer-and-winter' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon2.png') }}" alt="Summer and winter" class="guide-navigation__icon">
							Verao e Inverno
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@whereToSleep') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-where-to-sleep' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon5.png') }}" alt="Where to sleep" class="guide-navigation__icon">
							Onde dormir
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@nightLife') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-night-life' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon8.png') }}" alt="Night life" class="guide-navigation__icon">
							Vida noturna
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@cityAndZones') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-city-and-zones' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon3.png') }}" alt="City and Zones" class="guide-navigation__icon">
							Ciudad y Zonas
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@whatToEat') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-what-to-eat' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon6.png') }}" alt="What to eat" class="guide-navigation__icon">
							Que comer
						</a>
					</li>
					<li class="guide-navigation__item">
						<a href="{{ action('GuideController@money') }}"
						   class="guide-navigation__link{{ Route::currentRouteName() === 'guide-money' ? '_active' : '' }}">
							<img src="{{ asset('/images/guide-icon9.png') }}" alt="Money" class="guide-navigation__icon">
							Dinheiro
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<main id="main">
			<div class="container">
				<!-- Subpage -->
			@yield('subpage')
			<!-- ./ subpage -->
			</div>
		</main>

		<div class="container">

			<?php $activity = \App\Activity::find(48) ?>


			<div class="comments-block">

				<header class="comments-block__header">
					<div class="comments-block__titles @if (auth()->user()) comments-block__titles_registered @endif">
						<h3 class="comments-block__title">{{ trans('main.ask') }}</h3>
						@if(!auth()->user())
							<p class="comments-block__description">{{ trans('main.you_should_be_registered') }}</p>
						@endif
					</div>
					@if (auth()->user())
						<form id="comments-block__form" class="comments-block__form" data-answerText="{{ trans('button-links.answer') }}"
						      action="{{ action('GuideController@addComment') }}" method="get">
							{{ csrf_field() }}
							<textarea class="comments-block__textarea" name="message" id="message" rows="3"></textarea>
							<input type="hidden" value="" name="comment_id">
							<input type="hidden" value="{{ Route::currentRouteName() }}" name="guide_page">
							<button type="submit" class="btn btn-dark-blue comments-block__send-button">{{ trans('main.send') }}</button>
						</form>
					@else
						<a href="{{ url('/login') }}" class="btn btn-dark-blue comments-block__enter-button">{{ trans('button-links.login') }}</a>
					@endif
				</header>

				<?php $comments = \App\GuideComment::where('guide_page', '=', Route::currentRouteName())->get(); ?>

				<ul class="comments-block__comments">
					@if(auth()->user() && auth()->user()->hasRole(['developer', 'admin']))

						@if(isset($comments) && count($comments) > 0)
							@foreach($comments as $comment)
								<li class="comments-block__comment">
									<header class="comments-block__comment-header">
										<img src="{{ $comment->user->avatar }}" alt="User name" class="comments-block__user-image"
										     onerror="this.onerror=null; this.src='{{ asset('/images/image-none.jpg') }}'">
										<strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
										<span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>

										@if(!isset($comment->answer))
											<a href="{{ $comment->id }}" class="comments-block__answer-button">{{ trans('button-links.answer') }}</a>
										@endif

									</header>
									<p class="comments-block__text">{{ $comment->question }}</p>
								</li>

								@if(isset($comment->answer))
									<li class="comments-block__comment comments-block__comment_answer">
										<p class="comments-block__text">{{ $comment->answer }}</p>
									</li>
								@endif

							@endforeach
						@endif

					@else

						@if(isset($comments) && count($comments->where('answer', '<>', null)) > 0)
							@foreach($comments->where('answer', '<>', null) as $comment)
								<li class="comments-block__comment">
									<header class="comments-block__comment-header">
										<img src="{{ asset($comment->user->avatar) }}" alt="User name" class="comments-block__user-image"
										     onerror="this.onerror=null; this.src='{{ asset('/images/image-none.jpg') }}'">
										<strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
										<span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>
									</header>
									<p class="comments-block__text">{{ $comment->question }}</p>
								</li>
								<li class="comments-block__comment comments-block__comment_answer">
									<p class="comments-block__text">{{ $comment->answer }}</p>
								</li>
							@endforeach
						@endif

					@endif
				</ul>

			</div>

		</div>

	</div>

@stop