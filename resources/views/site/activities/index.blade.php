@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')

	{{--<section class="activities-hero" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">--}}

		{{--<div class="container">--}}
			{{--@include('site.offers.offers_quickinfo', ['classPlace' => 'program-schedule_activities'])--}}
		{{--</div>--}}

		{{--@if(isset($slider_activities) && count($slider_activities) > 0)--}}
			{{--<div class="activities-slider-wrapper">--}}
				{{--<div class="container">--}}
					{{--<header>--}}
						{{--<h2>{{ trans('main.the_most_requested') }}</h2>--}}
						{{--<p>{{ trans('main.below_are_the_activities') }}</p>--}}
					{{--</header>--}}
					{{--<div id="activities-slider" class="csHidden">--}}
						{{--@foreach($slider_activities as $activity)--}}
							{{--<div class="item">--}}
								{{--<a href="{{ action('ActivityController@getActivity', $activity->id) }}">--}}
									{{--<img src="{{ asset($activity->image_thumb) }}" onerror="this.src='/images/image-none.jpg';" alt="{{ $activity->name }}"/>--}}
									{{--<h3>{{ $activity->name }}</h3>--}}
								{{--</a>--}}
							{{--</div>--}}
						{{--@endforeach--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--@endif--}}

	{{--</section>--}}

	<main id="main">
		<section class="visited-activities-section">
			<div class="container">
				<header class="visited-activities-section__header">
					<h2 class="visited-activities-section__title">{{ trans('main.most_visited_in_pucon') }}</h2>
					<p class="visited-activities-section__sub-title">{{ trans('main.below_are_activities') }}</p>
				</header>
				<div class="top-activities">
					@foreach($slider_activities as $activity)
						<div class="top-activities__item">
							<a href="{{ action('ActivityController@getActivity', $activity->id) }}" class="top-activities__link">
								<img src="{{ asset($activity->image_thumb) }}" alt="{{ $activity->name }}" class="top-activities__image">
								<div class="top-activities__info">
									<h3 class="top-activities__name">{{ $activity->name }}</h3>
									<p class="top-activities__description">{{ $activity->short_description }}</p>
									<div class="top-activities__approximate-price">
										<span class="top-activities__price-text">{{ trans('main.from') }}</span>
										<strong class="top-activities__price"><sub class="top-activities__sub">@if(session('currency.type') === 'BRL') R$ @else
													$ @endif</sub> {{ number_format($activity->offers->min('price'), 0, ".", ".") }}</strong>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</section>
		<div class="container">
			@include('site.offers.offers_quickinfo', ['classPlace' => 'program-schedule_activities'])
			<div class="filters">
				<a href="#" class="btn btn-open-filters">Filters <span></span></a>
				<div class="filters-modal">
					<div class="filters-modal-buttons">
						<a href="#" class="btn btn-success btn-confirm-filters">Confirm <span></span></a>
						<a href="#" class="btn btn-cancel-filters">Cancel</a>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="filters-group filters-group-first-child">
								<strong class="title">Por Estilo</strong>
								<div class="filters-group__content">
									<div class="row">
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="trekking-style" value="Trekking">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="trekking-style">Trekking</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="accion-style" value="Aire">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="accion-style">Accion</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="nieve-style" value="Nieve">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="nieve-style">Nieve</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="rio-style" value="Rio">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="rio-style">Rio</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="relax-style" value="Relax">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="relax-style">Relax</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="cultural-style" value="Familia">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="cultural-style">Cultural</label>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="style" id="сiclismo-style" value="Ciclismo">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="сiclismo-style">Ciclismo</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="filters-group">
								<strong class="title">Periodo</strong>
								<div class="filters-group__content">
									<div class="row">
										<div class="col-sm-12 col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="period" id="day-period" value="Actividad Diurna">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="day-period">Actividad Diurna</label>
											</div>
										</div>
										<div class="col-sm-12 col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="period" id="night-period" value="Actividad Noturna">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="night-period">Actividad Noturna</label>
											</div>
										</div>
										<div class="col-sm-12 col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="period" id="summer-period" value="Verano">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="summer-period">Verano</label>
												<img src="{{ asset('/images/day.svg') }}" alt="Day">
											</div>
										</div>
										<div class="col-sm-12 col-xs-6">
											<div class="filter-item">
												<div class="custom-checkbox">
													<input type="checkbox" name="period" id="winter-period" value="Invierno">
													<div class="custom-checkbox-mark"></div>
												</div>
												<label for="winter-period">Invierno</label>
												<img src="{{ asset('/images/cloud-icon.png') }}" alt="Cloud icon">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="filters-group filter-group-range">
								<strong class="title">Rango de Precios</strong>
								<div class="filter-item filter-item-range">
									<input readonly class="slider-range-output">
									<div id="slider-range"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="all-activities">
				@if(count($activities->where('styles', 'Trekking')) > 0)
					<section class="activity-block trekking">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/Trekking.svg') }}"
									 alt="image description"
									 width="40"
									 height="40"
									 onerror="this.onerror=null; this.src='/images/ico21.png'">
						</span>
							{{ trans('main.trekking') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Trekking') as $activity)
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
				@if(count($activities->where('styles', 'Rio')) > 0)
					<section class="activity-block rio">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/kayak.svg') }}"
									 alt="image description"
									 width="40"
									 height="40"
									 onerror="this.onerror=null; this.src='/images/ico22.png'">
						</span>
							{{ trans('main.river') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Rio') as $activity)
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
				@if(count($activities->where('styles', 'Aire')) > 0)
					<section class="activity-block aire">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/aire.svg') }}"
									 alt="image description"
									 width="33"
									 height="33"
									 onerror="this.onerror=null; this.src='/images/ico23.png'">
						</span>
							{{ trans('main.action') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Aire') as $activity)
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
				@if(count($activities->where('styles', 'Relax')) > 0)
					<section class="activity-block relax">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/relax.svg') }}"
									 alt="image description"
									 width="33"
									 height="33"
									 onerror="this.onerror=null; this.src='/images/ico24.png'">
						</span>
							{{ trans('main.relax') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Relax') as $activity)
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
				@if(count($activities->where('styles', 'Nieve')) > 0)
					<section class="activity-block nieve">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/skiing_ski_running.svg') }}"
									 alt="image description"
									 width="33"
									 height="33"
									 onerror="this.onerror=null; this.src='/images/ico25.png'">
						</span>
							{{ trans('main.snow') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Nieve') as $activity)
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
				@if(count($activities->where('styles', 'Familia')) > 0)
					<section class="activity-block familia">
						<strong class="heading">
						<span>
							<img src="{{ asset('/images/family.svg') }}"
									 alt="image description"
									 width="33"
									 height="33"
									 onerror="this.onerror=null; this.src='/images/ico25.png'">
						</span>
							{{ trans('main.cultural') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Familia') as $activity)
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
				@if(count($activities->where('styles', 'Ciclismo')) > 0)
					<section class="activity-block ciclimo">
						<strong class="heading">
							{{ trans('main.cycling') }}
						</strong>
						<div class="row">
							<?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
							@foreach ($activities->where('styles', 'Ciclismo') as $activity)
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
	</main>

	<div id="pass-variable" data-daydesc="{{ trans('main.day_activity') }}" data-nightdescr="{{ trans('main.night_activity') }}"
			 data-summerdescr="{{ trans('main.march_to_november') }}" data-winterdescr="{{ trans('main.december_to_march') }}"
			 data-textfrom="{{ trans('main.from') }}" data-buttontext="{{ trans('button-links.view') }}"
			 data-cat-trekking="{{ trans('main.trekking') }}" data-cat-rio="{{ trans('main.river') }}"
			 data-cat-aire="{{ trans('main.action') }}" data-cat-relax="{{ trans('main.relax') }}"
			 data-cat-nieve="{{ trans('main.snow') }}" data-cat-cultural="{{ trans('main.cultural') }}"
			 data-cat-ciclismo="{{ trans('main.cycling') }}"></div>

@stop
