@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    {{--<section class="visual activities-all" style="background-image: url(/images/top{{$img_index}}.jpg);">--}}
    <section class="visual activities-all" style="background-image: url({{ url('/images/img01.jpg') }})">
    </section>
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">AGENCIAS</a></li>
                    </ul>
                    <div class="your-reservation activity add" style="padding-bottom: 0px;">
                        @include('site.offers.offers_quickinfo')
                    </div>
                    <div class="all-activities new">
                        <header>
                            <h1>Agencias</h1>
                            <p>Esta actividad es una alternativa de emoción y entretención, que no reviste mayor peligro
                                y es apta para niños, jóvenes y adultos mayores, los cuales pueden disfrutar de una
                                agradable Aventura. </p>
                        </header>
                    <!--
                        {{--<?php $col = 0; ?>--}}
                    {{--@foreach ($agencies as $agency)--}}
                    {{--@if ($col == 0)--}}
                    {{--<div class="row">--}}
                    {{--@endif--}}
                    {{--<?php $col = $col + 1; ?>--}}
                    {{--<div class="col-md-3 col-sm-6 col-xs-12 col">--}}
                    {{--@include('site.partials.agencies.all-list-item', array('agency' => $agency))--}}
                    {{--</div>--}}
                    {{--@if ($col == 4)--}}
                    {{--<?php $col = 0; ?>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    {{--@endforeach--}}
                            -->


                        <div class="row">
                            @for($i = 0; $i < 17; $i++)
                                <div class="col-md-3 col-sm-6 col-xs-12 col">
                                    @include('site.partials.agencies.all-list-item')
                                </div>
                            @endfor
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@stop
