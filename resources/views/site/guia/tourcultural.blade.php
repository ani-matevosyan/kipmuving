 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')
<div id="m-box-4">
    <div class="all-activities custom_title">
        <header>
            <h1>{{ trans('main.cultural_tour') }}</h1>
            <p>{{ trans('main.cultural_small_text') }}</p>
        </header>
    </div>
    <div class="infor-bar">
        <div class="row">
            <div class="col-md-5 right-border">
                <p>{{ trans('main.cultural_big_text') }}</p>
                <div class="play-info">
                    <img src="{{ asset('../images/play-button.svg') }}" alt="play description" width="33" height="33">
                    <p><strong>{{ trans('main.click_on_the_icons_for_more_info') }}</strong></p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="placeholder-info">
                    <p>{{ trans('main.iconography') }}</p>
                    <ul>
                        <li class="active">
                            <a href="#">
                                <div class="ico">
                                    <img src="{{ asset('../images/museu.svg') }}" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='{{ asset('../images/ico16.png') }}'">
                                </div>
                                <strong>{{ trans('main.museum') }} </strong>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="ico">
                                    <img src="{{ asset('../images/artesanias.svg') }}" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='{{ asset('../images/ico16.png') }}'">
                                </div>
                                <strong>{{ trans('main.crafts') }} </strong>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="ico">
                                    <img src="{{ asset('../images/restaurantes.svg') }}" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='{{ asset('../images/ico16.png') }}'">
                                </div>
                                <strong>{{ trans('main.restaurant') }}</strong>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="map-detail">
            <div class="col-md-6">
                <iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/rafaelzarro.1cdnk6h2/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'></iframe>
                <button type="button" class="maximize-map" data-toggle="modal" data-target="#tourmodel"></button>
            </div>
        </div>
        <div class="col-md-6 map-description">
            <div class="sub-tab-tour" id="tour-cultural">
                <p>{{ trans('main.here_we_present_the_most_visited') }}</p>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('../images/museu.svg') }}" alt="placeholderrred" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="tour-sub-dark-red">
                        <h3>{{ trans('main.mapuche_museum') }}</h3>
                        <p>{{ trans('main.one_of_the_main_streets_of_pukon') }}</p>
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('../images/artesanias.svg') }}" alt="placeholderrred" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="tour-sub-light-green">
                        <h3>{{ trans('main.crafts') }} </h3>
                        <p>{{ trans('main.one_of_the_main_streets_of_pukon') }}</p>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.restaurants') }}</strong>
                            <p><strong>Cassis</strong> - {{ trans('main.restaurant_and_cafeteria') }}</p>
                            <p><strong>Mora</strong> - {{ trans('main.sushi') }}</p>
                        </div>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.stores') }}</strong>
                            <p><strong>Patagonia</strong>  - {{ trans('main.outdoor_clothing') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('../images/restaurantes.svg') }}" alt="restaurantes" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="tour-sub-light-red">
                        <h3>Comida Chilena</h3>
                        <p>{{ trans('main.street_where_is_the_casino_of_pukon') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pop-up-model">
        <div class="col-md-12">
            <!-- Modal -->
            <div class="modal fade" id="tourmodel" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>{{ trans('main.cultural_tour') }}</h3>
                        </div>
                        <div class="modal-body">
                            <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1cdnk6h2.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop