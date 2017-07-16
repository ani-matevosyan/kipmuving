@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
	<section class="activities-hero" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
		<div class="container">
			@include('site.offers.offers_quickinfo', ['classPlace' => 'program-schedule_activities'])
		</div>
		<div class="activities-slider-wrapper">
			<div class="container">
				<header>
					<h2>{{ trans('main.the_most_requested') }}</h2>
					<p>{{ trans('main.below_are_the_activities') }}</p>
				</header>
				<div class="col-xs-12">
					<div id="activities-slider" class="csHidden">
						<div class="item">
							<a href="/activity/10">
								<img src="{{ asset('/uploads/activity/_nAqlH-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Termas Geométricas"/>
								<h3>Termas Geométricas</h3>
							</a>
						</div>
						<div class="item">
							<a href="/activity/3">
								<img src="{{ asset('/uploads/activity/_GmaWx-VolcánVillarrica_mini.jpg') }}" onerror="this.src='/images/image-none.jpg';"
								     alt="Trekking Volcán Villarrica"/>
								<h3>Trekking Volcán Villarrica</h3>
							</a>
						</div>
						<div class="item">
							<a href="/activity/5">
								<img src="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Rafting Alto"/>
								<h3>Rafting Alto</h3>
							</a>
						</div>
						<div class="item">
							<a href="/activity/2">
								<img src="{{ asset('/uploads/activity/_kpEoA-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Rafting Bajo"/>
								<h3>Rafting Bajo</h3>
							</a>
						</div>
						<div class="item">
							<a href="/activity/4">
								<img src="{{ asset('/uploads/activity/_ERPJI-2.jpg') }}" onerror="this.src='/images/image-none.jpg';"
								     alt="Tour por la zona + Termas"/>
								<h3>Tour por la zona + Termas</h3>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<main id="main">
		<div class="container">
			<div class="filters">
				<a href="#" class="btn btn-open-filters">Filters</a>
				<div class="filters-modal">
					<div class="filters-modal-buttons">
						<a href="#" class="btn btn-success btn-confirm-filters">Confirm <span></span></a>
						<a href="#" class="btn btn-cancel-filters">Cancel</a>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="filters-group filters-group-first-child">
								<strong class="title">Por Estilo</strong>
								<div class="row">
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="trekking-style" value="Trekking">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="trekking-style">Trekking</label>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="accion-style" value="Aire">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="accion-style">Accion</label>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="nieve-style" value="Nieve">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="nieve-style">Nieve</label>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="rio-style" value="Rio">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="rio-style">Rio</label>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="relax-style" value="Relax">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="relax-style">Relax</label>
										</div>
									</div>
									<div class="col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="style" id="cultural-style" value="Familia">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="cultural-style">Cultural</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="filters-group">
								<strong class="title">Periodo</strong>
								<div class="row">
									<div class="col-md-6 col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="period" id="day-period" value="Actividad Diurna">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="day-period">Actividad Diurna</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="period" id="summer-period" value="Verano">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="summer-period">Verano</label>
											<img src="{{ asset('/images/day.svg') }}" alt="Day">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="period" id="night-period" value="Actividad Noturna">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="night-period">Actividad Noturna</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-4 col-xs-6">
										<div class="filter-item">
											<div class="custom-checkbox">
												<input type="checkbox" name="period" id="winter-period" value="Invierno">
												<div class="custom-checkbox-mark"></div>
											</div>
											<label for="winter-period">Invierno</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="filters-group filter-group-range">
								<strong class="title">Rango de Precios</strong>
								<div class="filter-item filter-item-range">
									<input type="text" readonly class="slider-range-output">
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
			</div>
		</div>
	</main>

	<div id="pass-variable" data-daydesc="{{ trans('main.day_activity') }}" data-nightdescr="{{ trans('main.night_activity') }}"
		 data-summerdescr="{{ trans('main.march_to_november') }}" data-winterdescr="{{ trans('main.december_to_march') }}"
		 data-textfrom="{{ trans('main.from') }}" data-buttontext="{{ trans('button-links.view') }}"></div>

@stop
