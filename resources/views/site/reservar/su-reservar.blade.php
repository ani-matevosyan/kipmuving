@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<main id="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-sm-12">

					@if (! empty($message))
						<header class="reservation-header">
							<h1 class="reservation-header__title">{{ $message }}</h1>
						</header>
					@else
						<header class="reservation-page__header">
							<h1 class="reservation-page__title">{{ trans('main.these_are_your_activities') }}</h1>
							<p class="reservation-page__description">{{ trans('main.please') }} <span class="user-name">{{ $user->username ? $user->username : $user->first_name }}</span> {{ trans('main.confirm_below_the_activities') }}</p>
						</header>
					@endif

					@if(count($reservation->offers) > 0)
						<section class="s-offers">
							<ul class="your-offers basket_reservations" id="your-offers-list">
								@foreach($reservation->offers as $key => $offer)
									<li class="your-offers__item" fake_id="{{ $key }}">
										<h3 class="your-offers__name">
											<a class="your-offers__name-link" href="{{ action('ActivityController@getActivity', $offer->activity->id) }}">
												{{ $offer->activity->name }}</a>
										</h3>
										<div class="your-offers__info-block">
											<p class="your-offers__paragraph"><strong>{{ trans('main.agency') }}</strong>: {{  $offer->agency->name }}</p>
											<p class="your-offers__paragraph"><strong>{{ trans('main.address') }}</strong>: {{ $offer->agency->address }}</p>
										</div>
										<div class="your-offers__info-block">
											<p class="your-offers__paragraph">
												<strong>{{ trans('form.day') }}</strong>:
												{{ $offer->reservation['date'] }}
											</p>
											<p class="your-offers__paragraph">
												<strong>{{ trans('main.duration') }}</strong>:
												{{  $offer->duration }} hrs</p>
											<p class="your-offers__paragraph">
												<strong>{{ trans('main.schedule') }}</strong>:
												{{ \Carbon\Carbon::parse($offer->reservation['time']['start'])->format('H:i') }}
												{{ trans('emails.to') }}
												{{ \Carbon\Carbon::parse($offer->reservation['time']['end'])->format('H:i') }}
											</p>
											<p class="your-offers__paragraph"><strong>{{ trans('main.persons') }}</strong>: {{ $offer->reservation['persons'] }}</p>
										</div>
										<p class="your-offers__paragraph"><strong>{{ trans('main.total_of') }}</strong>: <span class="price"> {{ session('currency.type') }}
												$ {{ number_format($offer->reservation['persons'] * $offer->price, 0, '.', '.') }}</span></p>

										<div class="your-offers__cancel">
											<a class="your-offers__cancel-button cancelReservationBtn"  fake_id="{{ $key }}">
												{{ trans('main.cancel_activity') }}
											</a>
										</div>
									</li>
								@endforeach
							</ul>

							<div class="chosen-offers-list__additional-information">
								<p class="chosen-offers-list__important"><strong>{{ trans('main.important') }}:</strong> {{ $offer->important }}</p>
								<p class="chosen-offers-list__cancellation"><strong>{{ trans('main.cost_to_cancel') }}:</strong> {{ $offer->cancellation_rules }}</p>
							</div>

						</section>
					@endif

						{{--todo delete this section, see && false--}}
					@if(count($special_offers) > 0 && false)
						<section class="picked-offers_special">
							<h2 class="picked-offers__title picked-offers__title_special">{{ trans('main.receive_offers') }}</h2>
							<ul class="chosen-offers-list">
								@foreach ($special_offers as $offer)
									<li class="chosen-offers-list__item chosen-offers-list__item_special">
										<header class="chosen-offers-list__header chosen-offers-list__header_special">
											<h3 class="chosen-offers-list__name">
												<a href="{{ action('ActivityController@getActivity', $offer['activity_id']) }}" class="chosen-offers-list__name-link">{{ $offer['activity_name'] }}</a>
											</h3>
										</header>
										<div class="chosen-offers-list__information chosen-offers-list__information_special">
											<p class="chosen-offers-list__request-sent">{{ trans('main.we_send_this') }}<strong>{{ $offer['count_agencies'] }} {{ trans('main.agencies') }}</strong></p>
											<div class="chosen-offers-list__order-information chosen-offers-list__order-information_special">
												<ul class="order-information-list">
													<li class="order-information-list__item order-information-list__item_special order-information-list__item_time">
														<strong class="order-information-list__point order-information-list__point_date">{{ trans('form.day') }}: {{ $offer['date'] }}</strong>
													</li>
													<li class="order-information-list__item order-information-list__item_special order-information-list__item_persons">
														<p class="order-information-list__point"><strong>{{ $offer['persons'] }}</strong> {{ trans('main.persons') }}</p>
													</li>
												</ul>
											</div>
										</div>
									</li>
								@endforeach
							</ul>
						</section>
					@endif



					@if (empty($message))
						<section class="s-more-details">
							<p class="s-more-details__paragraph">{{ trans('main.to_confirm_your_activities') }}
								<strong>{{ trans('main.confirm') }}</strong>.
								{{ trans('main.you_got_mail') }}
							</p>
							<strong class="s-more-details__title">{{ trans('main.to_cancel_your_reservation') }}</strong>
							<p class="s-more-details__paragraph">{{ trans('main.you_will_receive_info_about_agency') }}</p>
							<strong class="s-more-details__title">{{ trans('main.general_information') }}</strong>
							<p class="s-more-details__paragraph">{{ trans('main.please_note_that_you_are_hiring') }}</p>
						</section>
					@endif
				</div>
				<div class="col-md-4 col-sm-12">
					<aside class="sidebar">

						<section class="s-program">
							<div class="s-program__content @if(session('currency.type') === 'BRL') s-program__content_brl-curr @endif">

								<div class="activity-basket">
									<header>{{ trans('emails.hello') }} <strong>{{ auth()->user() ? (auth()->user()->username ? auth()->user()->username : auth()->user()->first_name) : trans('main.guest') }}</strong>, {{ trans('main.here_is_the_view') }}:</header>
									<dl>
										<dt>{{ trans('main.confirmed') }}:</dt>
										<dd>
											<ul class="activity-basket__confirms-list">
												@if(isset($reservation->offers) && count($reservation->offers) > 0)
													@foreach ($reservation->offers as $key => $offer)
														<li fake_id="{{  $key }}">
															<button data-offer-id="{{ $key }}"></button>
															{{ \Carbon\Carbon::createFromFormat('d/m/Y', $offer->reservation['date'])->format('d/m') }} {{ $offer->activity->name  }}
														</li>
													@endforeach
												@endif
											</ul>
										</dd>
									</dl>
									<dl>
										<dt>{{ trans('main.persons') }}:</dt>
										<dd><span id="program_persons">{{ $count['persons'] }}</span></dd>
									</dl>
									<dl>
										<dt>{{ trans('main.total_of') }}:</dt>
										<dd>$ <span id="program_total">{{  number_format($reservation->total[session('currency.type')], 0, ".", ".") }}</span></dd>
									</dl>
									<footer>
										<div class="row">
											<a href="{{ action('ReservationController@reserve') }}" class="activity-basket__to-reserve"><span class="glyphicon glyphicon-check"></span> {{ trans('main.reserve') }}</a>
										</div>
									</footer>
								</div>

								{{--todo delete special offers basket, see && false--}}
								@if(isset($special_offers) && count($special_offers) > 0 && false)
									<div class="s-program__basket">
										<header class="s-program__header s-program__header_subscription">
											<h3 class="s-program__title s-program__title_subscription">{{ trans('main.receive_offers') }}</h3>
											<p class="s-program__offers-count">
												<span id="count-activities">{{ count($special_offers) }}</span>
												@if(count($special_offers) > 1) {{ trans('main.activities') }} @else  {{ trans('main.activity') }} @endif
											</p>
										</header>
										<ul class="basket-list basket-list_subscription">
											@foreach ($special_offers as $key => $offer)
												<li class="basket-list__item basket-list__item_subscription">
													<a class="basket-list__delete-button" href="{{ action('SpecialOffersController@removeFromBasket', ['oid' => $key]) }}"></a>
													<h4 class="basket-list__name">{{ $offer['activity_name'] }}</h4>
												</li>
											@endforeach
										</ul>
									</div>
								@endif
							</div>
						</section>
						<div class="note">
							* {{ trans('main.keep_in_mind') }}
						</div>
					</aside>
				</div>
			</div>

			<div class="modal fade" id="cancelActivityModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div class="clearfix"></div>
							<h4 class="modal-title">Confirma que deseas eliminar la reserva:</h4>
						</div>
						<div class="modal-body">
							<div class="theActivity"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning cancelReservationOK">Si, deseo eliminarla</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>

	<script>
        window.translateData = {
            still_no_offers: '{{ trans('main.still_no_offers') }}'
        }
	</script>

@stop
