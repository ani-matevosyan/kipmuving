<li class="offer-item">
	{{--<header>--}}
		{{--<div class="rating">--}}
			{{--<!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->--}}
			{{--<!-- <span>120 comentarios</span> -->--}}
		{{--</div>--}}
		{{--<div class="text">--}}
			{{--<h2>--}}
				{{--<a href="{{ action('ActivityController@getActivity', $offer['activity_id']) }}">{{ $offer['activity_name'] }}</a>--}}
			{{--</h2>--}}
			{{--<strong class="sub-title"><span>--}}{{-- $offer->location --}}{{--</span></strong>--}}
		{{--</div>--}}
	{{--</header>--}}
    <header>
        <div class="ico">
            <img src="/{{ $offer['offerActivity']['image_icon'] }}"
                 onerror="this.src='/images/image-none.jpg';"
                 alt="agency image">
        </div>
        <div class="rating">
            <!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
            <!-- <span>120 comentarios</span> -->
        </div>
        <div class="text">
            <h2>
                <a href="{{ action('ActivityController@getActivity', $offer['activity_id']) }}">{{ $offer['activity_name'] }}</a>
            </h2>
            <strong class="sub-title">
                <span>Avenida O´higgins 592</span>
            </strong>
        </div>
        <ul class="links">
            <li>
                    <a href="javascript:void(0)"
                       data-toggle="popover"
                       title="Trekking Volcán Villarrica"
                       data-html="true"
                       data-placement="bottom"
                       data-container="body"
                       data-trigger="focus"
                       data-content="
										<img src='/images/uploads/472cd9cc3701c1873885aa5b70caa02e.jpg'>
										</a>
										<br>
										VIVIR LA EXPERIENCIA DEL ASCENSO AL VOLCÁN VILLARICA, EL MÁS ACTIVO DE SUDAMÉRICA
                               <hr>
                              Vivir la experiencia del ascenso al Volcán Villarica, el más activo de Sudamérica, es un clásico amado por los turistas. No se necesita ser profesional para lograrlo, pero lo que sí es indispensable son las ganas de disfrutar, trabajar en equipo, auto motivarte y superarte en conexión con la naturaleza. Es una experiencia que puede durar entre 4 y 9 horas y comienza desde la base del volcán donde se pueden ver 5 espectaculares lagos de la región como el Caburgua. Luego en la cumbre  ( a 2847m) puedes deleitarte con la vista de otros volcanes como el Quetrupillán, Lanín, Llaima, Lonquimay, Sierra Nevada, Chohuenco, Osorno, Tolhuaca. El ascenso al Volcán se hace todo el año, en invierno como en verano, acompañado de guías expertos.
                               <br>
                               <a href='/activity/3'>info...</a>">{{ trans('main.about_the_agency') }}</a>
            </li>
            <li>
                <a href="javascript:void(0)"
                   class="btn-map"
                   data-toggle="modal"
                   data-lat="-39.42011"
                   data-lng="-71.94189"
                   data-title="Trekking Volcán Villarrica">{{ trans('main.show_map') }}</a>
            </li>
        <!-- <li><a href="/agency/{{ $offer['offerAgency']['id'] }}">Condiciones</a></li> -->
        </ul>
    </header>
	<div class="row">
		<div class="col-md-4 col-sm-5 col-xs-12">
			@if($offer['offer_includes'])
				<div class="list-box">
					<strong class="title">{{ trans('main.what_includes') }}:</strong>
					<ul>
						@foreach ($offer['offer_includes'] as $include)
							<li>{{ $include }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
		<div class="col-md-8 col-sm-4 col-xs-12">
			<div class="select-activity">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<ul class="timing1">
							<li class="time">
								@if($offer['hours'])
									<strong><span>{{ trans('main.duration') }}:</span> {{ $offer['hours'] }}hrs </strong>
								@endif
								@if($offer['start_time'] && $offer['end_time'])
									<strong><span>{{ trans('main.schedule') }}
											:</span> {{ date('H:i', strtotime($offer['start_time'])) }}
										- {{ date('H:i', strtotime($offer['end_time'])) }}</strong>
								@endif
							</li>
							@if($offer['price_offer'])
								<li class="profile">
									<select class="persona">
										<option value="">{{ trans('main.persons') }}</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</li>
								<li class="cal">
									<!-- <a href="#" class="btn btn-primary">Cantidad de personas</a> -->
									<!-- <a href="#" class="overlay-opener"> -->
									<input class="reserve-date"
											 type="text"
											 data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
											 placeholder=""
											 value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}">
									<!-- </a> -->
								</li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div>
							<strong class="price"
									  data-unit-price="{{ $offer['price_offer'] }}"><sub>$</sub> {{ number_format($offer['price_offer'], 0, '.', '.') }}
							</strong>
							<a href="#" class="btn btn-primary btn-reserve-ag"
								data-offer-id="{{ $offer['id'] }}">{{ trans('main.add') }}</a>
						</div>
					</div>
					@endif
				</div>
			</div>
			@if($offer['description'])
				<div style="color: #006b33; margin: 10px ; font-size: 13px;">
					<p>{{ $offer['description'] }}</p>
				</div>
			@endif
		</div>
	</div>
	<div class="trip-adv"></div>
</li>
