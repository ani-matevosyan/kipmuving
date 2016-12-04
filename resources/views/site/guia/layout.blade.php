 @extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
<section class="visual activities-all" style="background-image: url({{ url('/images/top'.$imageIndex.'.jpg') }})">
</section>
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/css/instafeed/guia-instafeed.css') }}">
 <main id="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">GUIA</a></li> 
                </ul>
                <div class="your-reservation activity">
                    <div class="container your-reservation activity custom_add">
                        @include('site.offers.offers_quickinfo')
                    </div>
                    <div class="row">
                        <div class="flex_wrapper">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ action('GuiaController@index') }}" id="box-1">
                                <div class="map-box-1 click-tab">
                                        <div class="map-heading">
                                            <h2>Caminhando</h2>
                                            <p>Conhcer Pucón caminhando.Principais ruas e atrativos da cidade,</p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ action('GuiaController@getBicicleta') }}" id="box-2">
                                    <div class="map-box-2 click-tab">
                                        <div class="map-heading">
                                            <h2>Bicicleta</h2>
                                            <p>Trilhas e roteiros que pode pedalar
                                                e conhcer coisas bacanas</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ action('GuiaController@getDecarro') }}" id="box-3">
                                <div class="map-box-3 click-tab">
                                        <div class="map-heading">
                                            <h2>De Carro ou Ônibus</h2>
                                            <p>Os passeios tradicionais que a 
                                                maioria dos turistas fazem</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ action('GuiaController@getTourcultural') }}" id="box-4">
                                <div class="map-box-4 click-tab">
                                        <div class="map-heading">
                                            <h2>Tour Cultural</h2>
                                            <p>Conheça Pucón pelos Mapuches
                                                Uma experiencia inesquecível</p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                        </div>
                    </div> 

                    <!-- Subpage -->
                    @yield('subpage')
                    <!-- ./ subpage -->

                    <div id="myModalX" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <!-- <h4 class="modal-title">Confirmation</h4> -->
                                </div>
                                <div class="modal-body">
                                    <div id="the-image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- MODAL END -->
                    <div id="data"> <!-- Keep this div for instafeed information -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop