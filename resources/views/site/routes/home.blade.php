@extends('site.layouts.default-new')

@section('content')

	<main>
		<section class="s-plans">
			<div class="container">
				<div class="filters">
					<button class="filters__open-modal" id="open-filters">Filters <span></span></button>
					<div class="filters__modal" id="filters-modal">
						<div class="filters__buttons">
							<button id="confirm-filters">Confirm <span></span></button>
							<button id="cancel-filters">Cancel</button>
						</div>
						<div class="filters__container">
							<div class="filters__block">
								<h3>How is the weather</h3>
								<div class="filters__list filters__list_2">
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Sun">
										<span class="custom-checkbox__mark"></span>
										Sun
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Cold">
										<span class="custom-checkbox__mark"></span>
										Cold
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Warm">
										<span class="custom-checkbox__mark"></span>
										Warm
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="weather" value="Rain">
										<span class="custom-checkbox__mark"></span>
										Rain
									</label>
								</div>
							</div>
							<div class="filters__block">
								<h3>It can be made</h3>
								<div class="filters__list">
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Morning">
										<span class="custom-checkbox__mark"></span>
										Morning
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Afternoon">
										<span class="custom-checkbox__mark"></span>
										Afternoon
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="time" value="Night">
										<span class="custom-checkbox__mark"></span>
										Night
									</label>
								</div>
							</div>
							<div class="filters__block">
								<h3>The intensity</h3>
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
								<h3>That has</h3>
								<div class="filters__list filters__list_3">
									<label class="custom-checkbox">
										<input type="checkbox" name="categories" value="hiking">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/hiking-icon.png') }}" alt="Hiking icon">
										Hiking
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="categories" value="view">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/photo-icon.png') }}" alt="Photo icon">
										View
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="categories" value="ski">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/ski-icon.png') }}" alt="Ski icon">
										Ski
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="categories" value="bicycle">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/bicycle-icon.png') }}" alt="Bicycle icon">
										Bicycle
									</label>
									<label class="custom-checkbox">
										<input type="checkbox" name="categories" value="climbing">
										<span class="custom-checkbox__mark"></span>
										<img src="{{ asset('/images/climbing-icon.png') }}" alt="Climbing icon">
										Climbing
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="suggested-plans">
					<header>
						<h2>Suggested Plans</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
							been the
							industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
							of type
							and scrambled it to make a type spec</p>
						<a href="#" class="see-all-link">See all</a>
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
					<h2>Create you own landscape</h2>
					@if($free_activities->where('page', '=', 'walking')->count() > 0)
						<div class="s-own-plans__plan-block">
							<header>
								<h3>Caminhando</h3>
								<p>Conhcer Pucón caminhando. Principais ruas e seus atrativos</p>
								<a href="#" class="see-all-link">See all</a>
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
								<h3>Tour Cultural</h3>
								<p>Conheça Pucón pelos Mapuches uma experiencia inesquecível</p>
								<a href="#" class="see-all-link">See all</a>
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
								<h3>De Carro ou Ônibus</h3>
								<p>Os passeios tradicionais que a maioria dos turistas fazem</p>
								<a href="#" class="see-all-link">See all</a>
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
								<h3>Bicicleta</h3>
								<p>Trilhas e roteiros que pode pedalar e conhcer coisas bacanas</p>
								<a href="#" class="see-all-link">See all</a>
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

@stop