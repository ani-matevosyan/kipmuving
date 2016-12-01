@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    {{--<section class="visual activities-all" style="background-image: url(/images/top{{$img_index}}.jpg);">--}}
    <section class="visual activities-all" style="background-image: url({{ url('/images/img01.jpg') }})">
    </section>

    <script
            type="text/javascript"
            src="http://www.kipmuving.com/js/floating-1.12.js">
    </script>

    <script type="text/javascript">
        floatingMenu.add('floatdiv',
                {
                    // Represents distance from top or
                    // bottom browser window border
                    // depending upon property used.
                    // Only one should be specified.
                    targetTop: 10,
                    // targetBottom: 0,

                    // prohibits movement on x-axis
                    prohibitXMovement: true,
                    // Remove this one if you don't
                    // want snap effect
                    snap: true
                });
    </script>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">ACTIVIDADES</a></li>
                    </ul>
                    <div class="your-reservation activity add" style="padding-bottom: 0px;">
                        @include('site.offers.offers_quickinfo')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Slider section-->
    <section id="first-slider-sec" class="csHidden">
        <div class="container">
            <div class="col-xs-12">
                <div class="col-md-4">
                    <h1>Os mais pedidos</h1>
                </div>
                <div class="col-md-8 row">
                    <p>Abajo están las actividades que más se destacan en Pucón y aquellas que los turistas más
                        hacen. </p>

                </div>
            </div>
            <div class="col-xs-12">
                <div id="cpa-slider-1">
                    <div class="item">
                        <a href="/activities/2">
                            <img src="/uploads/activity/ GmaWx-VolcánVillarrica_mini.jpg" onerror="this.src='/images/image-none.jpg';" alt="Trekking Volcán Villarrica"/>
                            <h2>Trekking Volcán Villarrica</h2>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activities/4">
                            <img src="/uploads/activity/ zNYN9-2.jpg" onerror="this.src='/images/image-none.jpg';" alt="Rafting Alto"/>
                            <h2>Rafting Alto</h2>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activities/1">
                            <img src="/uploads/activity/ kpEoA-2.jpg" onerror="this.src='/images/image-none.jpg';" alt="Rafting Bajo"/>
                            <h2>Rafting Bajo</h2>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activities/3">
                            <img src="/uploads/activity/ ERPJI-2.jpg" onerror="this.src='/images/image-none.jpg';" alt="Tour por la zona + Termas"/>
                            <h2>Tour por la zona + Termas</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--End Slider section-->
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="all-activities new">
                        <header>
                            <h1>Todas las actividades en Pucón</h1>
                            <p>Abajo encontrarás todas las actidades disponibiles en Pucón hechas por las agencias. Para
                                facilitar su búsqueda, separamos por estilos.</p>
                        </header>

                        <div class="activites-bar">

                            <div style="position:relative; height:60px; z-index:100">
                                <div id="floatdiv" style="position:absolute;">

                                    <ul class="activities-list">
                                        <li class="active">
                                            <a href="#trekking" class="green">
                                                <div class="ico">
                                                    <img src="/images/ico-treking.svg" alt="image description"
                                                         width="33" height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico16.png'">
                                                </div>
                                                <strong>Trekking</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#rio" class="orange">
                                                <div class="ico">
                                                    <img src="/images/ico-rio.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico17.png'">
                                                </div>
                                                <strong>Río</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#aire" class="blue">
                                                <div class="ico">
                                                    <img src="/images/ico-aire.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico18.png'">
                                                </div>
                                                <strong>Acción</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#relax" class="sky-blue">
                                                <div class="ico">
                                                    <img src="/images/ico-relax.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico19.png'">
                                                </div>
                                                <strong>Relax</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#nieve" class="violet">
                                                <div class="ico">
                                                    <img src="/images/ico-nieve.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico20.png'">
                                                </div>
                                                <strong>Nieve</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#familia" class="red">
                                                <div class="ico">
                                                    <img src="/images/ico-family.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico30.png'">
                                                </div>
                                                <strong>Cultural</strong>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="activities-info">
                                    <p><strong>Iconografia</strong></p>
                                    <ul>
                                        <li class="active">
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="images/day.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='images/ico16.png'">
                                                </div>
                                                <p>Actividad Diurna</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="images/night.svg" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='images/ico17.png'">
                                                </div>
                                                <p>Actividad Noturna</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="images/down-arrow.svg" alt="image description" width="25"
                                                         height="25"
                                                         onerror="this.onerror=null; this.src='images/ico18.png'">
                                                </div>
                                                <p>Baja: de marzo a noviembre</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="images/up-arrow.svg" alt="image description" width="25"
                                                         height="25"
                                                         onerror="this.onerror=null; this.src='images/ico19.png'">
                                                </div>
                                                <p>Alta: de diciembre a marzo</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- <nav class="subnav">
                                    <ul>
                                            <li><a href="#">Ordenar por</a></li>
                                            <li class="active"><a href="#">Recomendacion</a></li>
                                            <li><a href="#">Precio más alto</a></li>
                                            <li><a href="#">Gratuito</a></li>
                                    </ul>
                            </nav> -->
                        </div>

                        <section class="activity-block" id="trekking">
                            <strong class="heading">
                                <span><img src="/images/Trekking.svg" alt="image description" width="40" height="40"
                                           onerror="this.onerror=null; this.src='/images/ico21.png'"></span>
                                Trekking
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($trekking_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0 || $col == count($trekking_activities)) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                        <section class="activity-block rio" id="rio">
                            <strong class="heading">
                                <span><img src="/images/kayak.svg" alt="image description" width="40" height="40"
                                           onerror="this.onerror=null; this.src='/images/ico22.png'"></span>
                                Rio
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($rio_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0 || $col == count($rio_activities)) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                        <section class="activity-block aire" id="aire">
                            <strong class="heading">
                                <span><img src="/images/aire.svg" alt="image description" width="33" height="33"
                                           onerror="this.onerror=null; this.src='/images/ico23.png'"></span>
                                Acción
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($aire_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0  || $col == count($aire_activities) ) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                        <section class="activity-block relax" id="relax">
                            <strong class="heading">
                                <span><img src="/images/relax.svg" alt="image description" width="33" height="33"
                                           onerror="this.onerror=null; this.src='/images/ico24.png'"></span>
                                Relax
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($relax_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0 || $col == count($relax_activities)) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                        <section class="activity-block nieve" id="nieve">
                            <strong class="heading">
                                <span><img src="/images/skiing_ski_running.svg" alt="image description" width="33"
                                           height="33" onerror="this.onerror=null; this.src='/images/ico25.png'"></span>
                                Nieve
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($nieve_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0 || $col == count($nieve_activities)) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                        <section class="activity-block familia" id="familia">
                            <strong class="heading">
                                <span><img src="/images/family.svg" alt="image description" width="33" height="33"
                                           onerror="this.onerror=null; this.src='/images/ico25.png'"></span>
                                Cultural
                            </strong>
                            <!--
                            {{--<?php $col = 0; ?>--}}
                            {{--@foreach ($family_activities as $activity)--}}
                            {{--@if ($col%4 == 0)--}}
                            {{--<div class="row"> @endif--}}
                            {{--<div class="col-md-3 col-sm-4 col-xs-12 col">--}}
                            {{--@include('site.partials.activities.all-list-item', array('activity' => $activity, 'prices' => $min_prices))--}}
                            {{--</div>--}}
                            {{--<?php $col += 1; ?>--}}
                            {{--@if ($col%4 == 0 || $col == count($family_activities)) </div> @endif--}}
                            {{--@endforeach--}}
                            -->


                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="col-md-3 col-sm-4 col-xs-12 col">
                                        @include('site.partials.activities.all-list-item')
                                    </div>
                                @endfor
                            </div>


                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
