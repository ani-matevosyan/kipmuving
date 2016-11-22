@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<link href='/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='/plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/plugins/fullcalendar/lib/moment.min.js'></script>
<script src='/plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='/plugins/fullcalendar/es.js'></script>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb">
					<li><a href="#">HOME</a></li>
					<li>SU AGENDA</li>
				</ul>
				<div class="row" >
                
                <header class="head">
						<h1>Su panorama en Pucón</h1>
						<p><strong class="sub-title"><span>Aquí está su agenda.</strong> Este es el panorama que estás creando en sus vacaciones en Pucón. <Br />Puede seguir incluyendo actividades o finalizar con la reserva. Para esto, precione en el botón <strong>RESERVAR</strong>.</span></p><br />
                        <a href="/activities" class="calendarbtnactividades">INCLUIR MÁS ACTIVIDADES</a>
                        
		<Br /><Br />			
					</header>
                
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="alert alert-danger alert-overlap ">Hay actividades en el mismo día, por favor, deje apenas una actividad por día antes de seguir con su reserva. Puedes mover la actividad de un día al otro, o simplesmente eliminarla.</div>
						<br>
						<div id='calendar'></div>
						<br>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12 your-reservation">
						<section class="program-schedule">
							<h2>su programa</h2>
							<strong class="sub-title"><span>{{ $offers_count }}</span> actividades</strong>
							<ul class="offers-list">
						    <?php $oid = 0; ?>
								<?php $total_cost = 0; ?>
						    @foreach ($offers as $offer)
						      <li><a href="#" data-oid={{ $oid }}>{{ date("d/m/Y", strtotime($offer['date'])) }} - {{ $offer['offer']->activity->name }}</a></li>
									<!-- <span>$ {{ $offer['offer']->price_offer * $offer['persona']}}</span> -->
						      <?php
										$oid = $oid + 1;
										$total_cost += $offer['offer']->price_offer * $offer['persona'];
									?>
						    @endforeach
						  </ul>
							<footer class="footer">
								<a href="/reservar" class="btn-reservar btn btn-primary">RESERVAR</a>
								<strong class="total-price">$ {{ number_format($total_cost, 0, ".", ".") }} <span>con IVA</span></strong>
							</footer>
						</section>
						<section class="important-block" style="padding-bottom: 0px;">
							<div class="box alert">
								<h2>Importante</h2>
								<strong class="sub-title">Como funciona su reserva</strong>
								<p>Nosotros tenemos el objetivo de presentar las mejores opciones de paseos en Pucón para que puedas elegir teniendo el completo panorama y empezar a planificar su viaje y aprovechar todo del destino.</p>
								<p>Mostramos las mejores ofertas de todas agencias con sus atractivos. Cuando hace la reserva, hacemos la confirmación con la agencia. Recuerda que el destino donde el clima influye en la actividad. Que haremos:</p>
							</div>
						</section>
						<div class="img-chart"><img src="/images/boxhowork.svg" alt="image description" width="250" height="30" onerror="this.onerror=null; this.src='images/img-chart.jpg'"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>

	jQuery(document).ready(function() {

		jQuery('#calendar').fullCalendar({
			header: {
					left: 'prev,next today',
					center: 'title',
					right: ''
				},
			defaultView: 'agendaFourDay',
			views: {
			 agendaFourDay: {
					 type: 'agenda',
					 duration: { days: 5 },
					 buttonText: '5 days',
					 columnFormat: 'ddd D/M'
			 }
		 	},
			allDaySlot: false,
			defaultDate: '{{ $view_date }}',
			editable: false,
			// titleFormat: 'D MMM',

			eventLimit: true, // allow "more" link when too many events
			events: '/calendar/data',
			eventRender: function(event, element) {
				// console.log(element);
				// event.overlap = true;
				$(element).data('duplicate', event.duplicate);
				element.append('<br>');
				element.append('<a href="#" class="move prev" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>');
				element.append('<a href="#" class="move next" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></span></a>');
				element.append('<br>');
				element.append('<div class="agency-name">' + event.agency_name + '</div>');
				element.append('<div class="hours"><i class="glyphicon glyphicon-time"></i> ' + event.hours + ' hrs (' + event.hours_start + ' a ' + event.hours_end +')</div>');
				// element.append('<div class="hours-duration">' + + '</div>');
				element.append('<div class="persona"><i class="glyphicon glyphicon-user"></i> ' + event.persona + ' persona</div>');
				// element.append('<div class="price"> $ ' + event.price + '</div>');
				element.append('<br>');

				element.append('<a href="#" class="delete" data-oid="' + event.id + '"><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>');
			},
			eventAfterAllRender: function(view) {
				jQuery('.btn-reservar').attr("href", '/reservar');
				jQuery('.alert-overlap').hide();
				$.each(jQuery('.fc-event'), function( index, value ) {
					if (jQuery(value).data('duplicate')) {
						jQuery('.alert-overlap').show();
						$('.btn-reservar').removeAttr('href');
					}
				});
			}
		});

		jQuery(document).on("click",".fc-event.cal-offer .move",function() {
			var oid = jQuery(this).data('oid');
			var dir = jQuery(this).hasClass('prev') ? 'prev' : jQuery(this).hasClass('next') ? 'next' : '';
			$.ajax({url: "/calendar/process?a=" + dir + "&oid=" + oid, success: function(result) {
				jQuery('#calendar').fullCalendar('refetchEvents');
	    }});
    });

		jQuery(document).on("click",".fc-event.cal-offer .delete",function() {
			var oid = jQuery(this).data('oid');
			$('#delete-modal .btn-confirm').data('oid', oid);
			$('#delete-modal').modal('show');
    });

		jQuery('#delete-modal .btn-confirm').on("click", function() {
			var oid = jQuery(this).data('oid');
			$('#delete-modal').modal('hide');
			$.ajax({url: "/calendar/process?a=del&oid=" + oid, success: function(result) {
				jQuery('#calendar').fullCalendar('refetchEvents');
	    }});
    });

	});
</script>
@stop
