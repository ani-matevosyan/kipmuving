@extends('site.layouts.default-new')

@section('content')

	<main>
		<section class="s-plans">
			<div class="container">
				<div class="filters">
					<button class="filters__open-modal" id="open-filters">{{ trans('main.filters') }} <span></span></button>
					<div class="filters__modal" id="filters-modal">
						<div class="filters__buttons">
							<button id="confirm-filters">{{ trans('button-links.confirm') }} <span></span></button>
							<button id="cancel-filters">{{ trans('main.cancel') }}</button>
						</div>
						<div class="filters__container">
							<div class="filters__block">
								<h3>{{ trans('main.how_is_the_weather') }}</h3>
								<div class="filters__list filters__list_2">
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Sun">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.sun') }}
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Cold">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.cold') }}
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Warm">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.warm') }}
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Rain">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.rain') }}
									</label>
								</div>
							</div>
							<div class="filters__block">
								<h3>{{ trans('main.it_can_be_made') }}</h3>
								<div class="filters__list">
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Morning">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.morning') }}
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Afternoon">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.afternoon') }}
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Night">
										<span class="custom-checkbox__mark"></span>
										{{ trans('main.night') }}
									</label>
								</div>
							</div>
							<div class="filters__block">
								<h3>{{ trans('main.the_intensity') }}</h3>
								<div class="filters__intensity-checkboxes">
									<label>
										<input type="checkbox" name="intensity" value="1">
										<span class="filters__intensity-mark"><span></span></span>
									</label>
									<label>
										<input type="checkbox" name="intensity" value="2">
										<span class="filters__intensity-mark"><span></span></span>
									</label>
									<label>
										<input type="checkbox" name="intensity" value="3">
										<span class="filters__intensity-mark"><span></span></span>
									</label>
									<label>
										<input type="checkbox" name="intensity" value="4">
										<span class="filters__intensity-mark"><span></span></span>
									</label>
								</div>
							</div>
							<div class="filters__block">
								<h3>{{ trans('main.that_has') }}</h3>
								<div class="filters__list filters__list_3">
									<label class="custom-checkbox" title="{{ trans('main.hiking') }}">
										<input type="checkbox" name="categories" value="hiking">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/hiking-icon.png') }}" alt="Hiking icon">
										{{ trans('main.hiking') }}
									</label>
									<label class="custom-checkbox" title="{{ trans('main.view(the)') }}">
										<input type="checkbox" name="categories" value="view">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/photo-icon.png') }}" alt="Photo icon">
										{{ trans('main.view(the)') }}
									</label>
									<label class="custom-checkbox" title="{{ trans('main.ski') }}">
										<input type="checkbox" name="categories" value="ski">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/ski-icon.png') }}" alt="Ski icon">
										{{ trans('main.ski') }}
									</label>
									<label class="custom-checkbox" title="{{ trans('main.bicycle') }}">
										<input type="checkbox" name="categories" value="bicycle">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/bicycle-icon.png') }}" alt="Bicycle icon">
										{{ trans('main.bicycle') }}
									</label>
									<label class="custom-checkbox" title="{{ trans('main.climbing') }}">
										<input type="checkbox" name="categories" value="climbing">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/climbing-icon.png') }}" alt="Climbing icon">
										{{ trans('main.climbing') }}
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="suggested-plans">
					<header>
						<h2>{{ trans('main.popular_routes') }}</h2>
						<p>{{ trans('main.we_separated_some_routes') }}</p>
						<a href="#" class="see-all-link">{{ trans('main.see_all') }}</a>
					</header>
					<ul>
						@foreach($suggestions as $suggestion)
							<li>
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
								<footer>
									<ul>
										<li><img src="{{ asset('/images/'.$suggestion->category.'-icon.png') }}" alt="hiking icon"></li>
									</ul>
									<div class="suggested-plans__intensity">
										@for($i = 1; $i <= 4; $i++)
											<span class="{{ $i === $suggestion->intensity ? 'chosen' : '' }}"></span>
										@endfor
									</div>
								</footer>
							</li>
						@endforeach


						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
						{{--<li>--}}
						{{--<figure>--}}
						{{--<a href="#">--}}
						{{--<img class="lazyload"--}}
						{{--src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="--}}
						{{--data-original="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}"--}}
						{{--alt="Title of activity">--}}
						{{--</a>--}}
						{{--</figure>--}}
						{{--<div class="suggested-plans__description">--}}
						{{--<h3><a href="#">Title blog to enter</a></h3>--}}
						{{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores consequatur--}}
						{{--doloremque dolores ducimus</p>--}}
						{{--</div>--}}
						{{--<footer>--}}
						{{--<ul>--}}
						{{--<li><img src="{{ asset('/images/bicycle-icon.png') }}" alt="bicycle icon"></li>--}}
						{{--<li><img src="{{ asset('/images/hiking-icon.png') }}" alt="hiking icon"></li>--}}
						{{--</ul>--}}
						{{--<div class="suggested-plans__intensity">--}}
						{{--<span></span>--}}
						{{--<span class="chosen"></span>--}}
						{{--<span></span>--}}
						{{--<span></span>--}}
						{{--</div>--}}
						{{--</footer>--}}
						{{--</li>--}}
					</ul>
				</div>
			</div>
		</section>
		@if(isset($free_activities) && count($free_activities) > 0)
			<section class="s-own-plans">
				<div class="container">
					<h2>{{ trans('main.create_your_own_landscape') }}</h2>
					@if($free_activities->where('page', '=', 'walking')->count() > 0)
						<div class="s-own-plans__plan-block">
							<header>
								<h3>{{ trans('main.walking') }}</h3>
								<p>{{ trans('main.discover_pucon_walking') }}</p>
								<a href="#" class="see-all-link">{{ trans('main.see_all') }}</a>
							</header>
							<ul class="s-own-plans__slider owl-carousel csHidden">
								@foreach($free_activities->where('page', '=', 'walking')->take(5)->shuffle() as $item)
									<li>
										<a href="{{ route('routes-single', ['id' => $item->id]) }}">
											<figure>
												<img class="owl-lazy"
														 data-src="{{ asset($item->image) }}"
														 alt="{{ $item->name }}">
												<figcaption>{{ $item->name }}</figcaption>
											</figure>
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if($free_activities->where('page', '=', 'cultural')->count() > 0)
						<div class="s-own-plans__plan-block">
							<header>
								<h3>{{ trans('main.cultural_tour') }}</h3>
								<p>{{ trans('main.pucon_mapuches') }}</p>
								<a href="#" class="see-all-link">{{ trans('main.see_all') }}</a>
							</header>
							<ul class="s-own-plans__slider owl-carousel csHidden">
								@foreach($free_activities->where('page', '=', 'cultural')->take(5)->shuffle() as $item)
									<li>
										<a href="{{ route('routes-single', ['id' => $item->id]) }}">
											<figure>
												<img class="owl-lazy"
														 data-src="{{ asset($item->image) }}"
														 alt="{{ $item->name }}">
												<figcaption>{{ $item->name }}</figcaption>
											</figure>
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if($free_activities->where('page', '=', 'bus')->count() > 0)
						<div class="s-own-plans__plan-block">
							<header>
								<h3>{{ trans('main.by_car_or_bus') }}</h3>
								<p>{{ trans('main.traditional_tours') }}</p>
								<a href="#" class="see-all-link">{{ trans('main.see_all') }}</a>
							</header>
							<ul class="s-own-plans__slider owl-carousel csHidden">
								@foreach($free_activities->where('page', '=', 'bus')->take(5)->shuffle() as $item)
									<li>
										<a href="{{ route('routes-single', ['id' => $item->id]) }}">
											<figure>
												<img class="owl-lazy"
														 data-src="{{ asset($item->image) }}"
														 alt="{{ $item->name }}">
												<figcaption>{{ $item->name }}</figcaption>
											</figure>
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if($free_activities->where('page', '=', 'bicycle')->count() > 0)
						<div class="s-own-plans__plan-block">
							<header>
								<h3>{{ trans('main.bicycle') }}</h3>
								<p>{{ trans('main.tracks_and_routes') }}</p>
								<a href="#" class="see-all-link">{{ trans('main.see_all') }}</a>
							</header>
							<ul class="s-own-plans__slider owl-carousel csHidden">
								@foreach($free_activities->where('page', '=', 'bicycle')->take(5)->shuffle() as $item)
									<li>
										<a href="{{ route('routes-single', ['id' => $item->id]) }}">
											<figure>
												<img class="owl-lazy"
														 data-src="{{ asset($item->image) }}"
														 alt="{{ $item->name }}">
												<figcaption>{{ $item->name }}</figcaption>
											</figure>
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</section>
		@endif
	</main>

	<script>
		window.translateData = {
			error_occured: "{{ trans('main.error_occured') }}",
			no_result_by_search: "{{ trans('main.no_result_by_search') }}"
		}
	</script>

@stop