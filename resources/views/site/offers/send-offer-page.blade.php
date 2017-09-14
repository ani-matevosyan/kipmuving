@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')

	<main id="main">

		<div class="container">

			<section class="s-send-special-offer">
				<header class="special-offer-header s-send-special-offer__header">
					<h1 class="special-offer-header__title">{{ trans('main.send_special_offer') }}</h1>
					<p class="special-offer-header__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea eaque minus quos sequi. Debitis deleniti deserunt distinctio
						ducimus eum explicabo pariatur quaerat vitae! Dolores earum neque perferendis veniam voluptas. Nam.</p>
				</header>

				@if(session()->has('message'))
					<h3>{{ session('message') }} </h3>
				@elseif(isset($message))
					<h3>{{ $message }} </h3>
				@else
					@if(isset($offer))
						<ul class="special-offers-list">

							<li class="special-offers-list__item">

								<h2 class="special-offers-list__title">
									<a href="{{ action('ActivityController@getActivity', ['id' => $offer->offer->activity->id]) }}"
										 class="special-offers-list__title-link">{{ $offer->offer->activity->name }}</a>
								</h2>

								<ul class="special-offers-list__info-list">
									<li class="special-offers-list__info-item">
										<strong>Date:</strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $offer->offer_date)->format('d/m/Y') }}
									</li>
									<li class="special-offers-list__info-item">
										<strong>Persons:</strong> {{ $offer->persons }}
									</li>
									<li class="special-offers-list__info-item">
										<strong>Your price:</strong> $ {{ number_format($offer->offer->real_price, 0, '.', '.') }}
									</li>
									<li class="special-offers-list__info-item">
										<strong>Total:</strong> $ {{ number_format($offer->offer->real_price * $offer->persons, 0, '.', '.') }}
									</li>
								</ul>

								<div class="pick-discount special-offers-list__pick-discount">
									<p class="pick-discount__info">
										{{ trans('main.send_special_offer') }} {{ trans('main.with_discount_at') }}
										<strong>{{ $offer->created_at->addDay()->format('d/m/Y') }}:</strong>
									</p>

									@if($errors->has('price'))
										<div class="alert alert-error alert-danger">
											<strong>{{ $errors->first('price') }}</strong>
										</div>
									@endif

									<ul class="pick-discount__list">
										<li class="pick-discount__item">
											<span href="#" class="pick-discount__button pick-discount__button_yellow"
														data-price="{{ number_format($offer->offer->real_price * $offer->persons * 0.95, 0, '.', '.') }}">5%</span>
											<span class="pick-discount__end-price">$ {{ number_format($offer->offer->real_price * $offer->persons * 0.95, 0, '.', '.') }}</span>
										</li>
										<li class="pick-discount__item">
											<span href="#" class="pick-discount__button pick-discount__button_orange"
														data-price="{{ number_format($offer->offer->real_price * $offer->persons * 0.9, 0, '.', '.') }}">10%</span>
											<span class="pick-discount__end-price">$ {{ number_format($offer->offer->real_price * $offer->persons * 0.9, 0, '.', '.') }}</span>
										</li>
										<li class="pick-discount__item">
											<span class="pick-discount__button pick-discount__button_red"
														data-price="{{ number_format($offer->offer->real_price * $offer->persons * 0.85, 0, '.', '.') }}">15%</span>
											<span class="pick-discount__end-price">$ {{ number_format($offer->offer->real_price * $offer->persons * 0.85, 0, '.', '.') }}</span>
										</li>
										<li class="pick-discount__item">
											<span class="pick-discount__button pick-discount__button_purple"
														data-price="{{ number_format($offer->offer->real_price * $offer->persons * 0.8, 0, '.', '.') }}">20%</span>
											<span class="pick-discount__end-price">$ {{ number_format($offer->offer->real_price * $offer->persons * 0.8, 0, '.', '.') }}</span>
										</li>
									</ul>

									<span class="pick-discount__or-divider">{{ trans('main.or') }}</span>

									<form class="pick-discount__form" id="pick-discount-form" action="{{ action('SpecialOffersController@sendOffer') }}">
										{{ csrf_field() }}
										<input class="pick-discount__price-input" placeholder="{{ trans('main.total_price') }}" name="price">
										<input type="hidden" name="s_offer_uid" value="{{ $offer->uid }}">
										<button class="pick-discount__submit">OK</button>
									</form>

								</div>
							</li>

						</ul>
					@else
						<h3>Sorry, we do not have such a record or you have already sent this offer to the user.</h3>
					@endif
				@endif


			</section>

		</div>
	</main>

@stop