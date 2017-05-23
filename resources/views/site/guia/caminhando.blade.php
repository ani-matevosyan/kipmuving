 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div id="m-box-1">

    <div class="all-activities custom_title">
        <header>
            <h1>{{ trans('main.walking') }}</h1>
            <p>{{ trans('main.walking_small_text') }}</p>
        </header>
    </div>
    <div class="infor-bar">
        <div class="row">
            <div class="col-md-5 right-border">
                <p>
                    {{ trans('main.walking_big_text') }}
                </p>
                <div class="play-info">
                    <img src="{{ asset('images/play-button.svg') }}" alt="play description" width="33" height="33">
                    <p><strong>{{ trans('main.click_on_the_icons_for_more_info') }}</strong></p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="placeholder-info">
                    <p>{{ trans('main.iconography') }}</p>
                    <ul>
                        <li class="active">
                            <a href="#sub-tab-info1">
                                <div class="ico">
                                    <img src="{{ asset('images/placeholder.svg') }}"
                                         alt="image description"
                                         width="33"
                                         height="33"
                                         onerror="this.onerror=null; this.src='{{ asset('images/ico16.png') }}'">
                                </div>
                                <p><strong>{{ trans('main.a_small_circuit') }}</strong> {{ trans('main.which_you_can_do_to_know_main_streets') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#sub-tab-info2">
                                <div class="ico">
                                    <img src="{{ asset('images/placeholder2.svg') }}" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='{{ asset('images/ico16.png') }}'">
                                </div>
                                <p><strong>{{ trans('main.the_main_streets') }}</strong> {{ trans('main.where_there_are_businesses_shops') }}</p>
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
                <iframe width='100%'
                        height='500px'
                        frameBorder='0'
                        src='https://a.tiles.mapbox.com/v4/rafaelzarro.1c21lk6l/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'>
                </iframe>
                <button type="button" class="maximize-map" data-toggle="modal" data-target="#myModal"></button>
            </div>
        </div>
        <div class="col-md-6 map-description">
            <div class="sub-tab-info active-sub-tab" id="sub-tab-info1">
                <h3>{{ trans('main.viewpoints_praia_grande') }}</h3>
                <p>{{ trans('main.from_this_two_viewpoints') }}</p>
            </div>
            <div class="sub-tab-info" id="sub-tab-info2">
                <h3>{{ trans('main.main_streets') }}</h3>
                <p>{{ trans('main.here_we_present_the_most_visited') }}</p>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('images/placeholderred.svg') }}" alt="placeholderrred" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="sub-tab-sub-sec-red">
                        <h3>O’Higgins</h3>
                        <p>{{ trans('main.the_main_street_of_pucon') }}</p>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.restaurants') }}</strong>
                            <p><span>Fiorentinni</span> - {{ trans('main.pastas') }} </p>
                            <p><span>Trawen</span> - {{ trans('main.local_and_international_food') }}</p>
                        </div>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.stores') }}</strong>
                            <p><span>Falabella</span> - {{ trans('main.electronics_and_clothing') }}</p>
                            <p><span>North Face</span> - {{ trans('main.outdoor_clothing') }}</p>
                            <p><span>Rockford</span> - {{ trans('main.outdoor_clothing') }}</p>
                        </div>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('button-links.agencies') }}</strong>
                            <p><span>Patagonia Experience</span></p>
                            <p><span>Politur</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('images/placeholderredblue.svg') }}" alt="placeholderrred" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="sub-tab-sub-sec-green">
                        <h3>Fresia</h3>
                        <p>{{ trans('main.one_of_the_main_streets_of_pukon') }}</p>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.restaurants') }}</strong>
                            <p><span>Cassis</span> - {{ trans('main.restaurant_and_cafeteria') }}</p>
                            <p><span>Mora</span>- {{ trans('main.sushi') }}</p>
                        </div>
                        <div class="sub-tab-sec">
                            <strong>{{ trans('main.stores') }}</strong>
                            <p><span>Patagonia</span>  - {{ trans('main.outdoor_clothing') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="row">
                        <img src="{{ asset('images/placeholder2.svg') }}" alt="placeholderrred" class="img-responsive" />
                    </div>
                </div>
                <div class="col-xs-11">
                    <div class="sub-tab-sub-sec-green">
                        <h3>Ansorena</h3>
                        <p>{{ trans('main.street_where_is_the_casino_of_pukon') }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="pop-up-model">
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3>{{ trans('main.walking') }}</h3>
                            </div>
                            <div class="modal-body">
                                <iframe width="100%" height="500px" frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1c21lk6l.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 right-col">
            <img src="{{ asset('images/instagram.svg') }}" alt="instagram" class="img-responsive" width="28" height="28"/>
            <h4>{{ trans('main.instagram_pictures') }}</h4><strong>#pucon</strong>
           <div id="instafeed1" class="instafeed">

           </div>
        </div>
    </div>
</div>
@stop