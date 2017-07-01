@extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div id="m-box-2">

    <div class="guide-header">
        <header>
            <h1>{{ trans('main.bicycle') }}</h1>
            <p>{{ trans('main.bicycle_small_text') }}</p>
        </header>
    </div>
    <div class="infor-bar">
        <div class="row">
            <div class="col-md-5 right-border">
                <p>{{ trans('main.bicycle_big_text') }}</p>
                <div class="play-info">
                    <img src="{{ asset('/images/play-button.svg') }}" alt="play description" width="33" height="33">
                    <p><strong>{{ trans('main.click_on_the_icons_for_more_info') }}</strong></p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="placeholder-info">
                    <p>{{ trans('main.iconography') }}</p>
                    <ul>
                        <li class="active">
                            <a href="#bicicleta-sub-tab-1">
                                <div class="ico">
                                    <img src="{{ asset('/images/turbio.svg') }}" alt="image description" width="33" height="33"/>
                                </div>
                                <strong>{{ trans('main.rio_turbio_waterfall') }}</strong>
                            </a>
                        </li>
                        <li>
                            <a href="#bicicleta-sub-tab-2">
                                <div class="ico">
                                    <img src="{{ asset('/images/claro.svg') }}" alt="image description" width="33" height="33"/>
                                </div>
                                <strong>{{ trans('main.eyes_of_caburgua') }}</strong>
                            </a>
                        </li>
                        <li>
                            <a href="#bicicleta-sub-tab-3">
                                <div class="ico">
                                    <img src="{{ asset('/images/ojos.svg') }}" alt="image description" width="33" height="33"/>
                                </div>
                                <strong>{{ trans('main.jump_the_light') }}</strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="map-detail">
            <div class="col-md-6 right-border">
                <iframe width='100%' height='500px' frameBorder='0'
                          src='https://a.tiles.mapbox.com/v4/rafaelzarro.1c6ffepl/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'></iframe>
                <button type="button" class="maximize-map" data-toggle="modal" data-target="#bicicleta-model"></button>
            </div>
        </div>
        <div class="col-md-6 map-description">
            <div class="sub-tab-info active-sub-tab" id="bicicleta-sub-tab-1">
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <h3>{{ trans('main.rio_turbio_waterfall') }}</h3>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="termas">
                        <div class="pull-right">
                            <div class="opiniones">
                                <div id="TA_selfserveprop719" class="TA_selfserveprop">
                                    <ul id="StEbQyO7dJ" class="TA_links Bu0Lw0ZNo">
                                        <li id="wQAL39MfV" class="KgvBfM">
                                            <a target="_blank" href="https://www.tripadvisor.es/"><img
                                                    src="https://www.tripadvisor.es/img/cdsi/img2/branding/150_logo-11900-2.png"
                                                    alt="TripAdvisor"/></a>
                                        </li>
                                    </ul>
                                </div>
                                <?php app()->getLocale() == 'es_ES' ? $language = 'es_CL' : $language = app()->getLocale(); ?>
                                <script
                                    src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=719&amp;locationId=3181592&amp;lang={{ $language }}&amp;rating=true&amp;nreviews=0&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                            </div>
                            {{--<div class="opiniones">--}}
                            {{--<br>--}}
                            {{--<a href="https://www.tripadvisor.com.ar/Hotel_Review-g312848-d301975-Reviews-m25698-Llao_Llao_Hotel_and_Resort_Golf_Spa-San_Carlos_de_Bariloche_Province_of_Rio_Negr.html#REVIEWS" target="_blank" rel="nofollow" onclick="ga('send', 'event', 'Saliente', 'Click', 'Bariloche > Hotels > Botón Trip Advisor > Llao Llao Hotel &amp; Resort');">--}}
                            {{--<span class="ta"><img src="https://www.tripadvisor.com.ar/img/cdsi/img2/ratings/traveler/3.5-25698-5.png"></span>--}}
                            {{--</a>--}}
                            {{--<br>--}}
                            {{--<a href="https://www.tripadvisor.com.ar/Hotel_Review-g312848-d301975-Reviews-m25698-Llao_Llao_Hotel_and_Resort_Golf_Spa-San_Carlos_de_Bariloche_Province_of_Rio_Negr.html#REVIEWS" target="_blank" rel="nofollow" onclick="ga('send', 'event', 'Saliente', 'Click', 'Bariloche > Hotels > Link Trip Advisor > Llao Llao Hotel &amp; Resort');">--}}
                            {{--Basado en 1889 comentarios--}}
                            {{--</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>{{ trans('main.rio_turbio_waterfall_text') }}</p>

                    <div class="bottom-tab-links">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="fancy-button">
                                    <a href="#">
                                        <img src="{{ asset('/images/gps.svg') }}" alt="clock" class="img-responsive" width="35"
                                              height="35"/>
                                        <div class="button-text">
                                            <strong>{{ trans('main.gps_route') }}</strong>
                                            <p>{{ trans('main.download_this_route') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p><img src="{{ asset('/images/clock.svg') }}" alt="clock" class="img-responsive" width="35"
                                          height="35"/>{{ trans('main.estimated_time_round_trip') }}:
                                    <strong>2.5 {{ trans('hours') }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-tab-info" id="bicicleta-sub-tab-2">
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <h3>{{ trans('main.eyes_of_caburgua') }}</h3>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="termas">
                        <div class="pull-right">
                            <div class="opiniones">
                                <div id="TA_selfserveprop621" class="TA_selfserveprop">
                                    <ul id="wNySVp" class="TA_links TOlu3lX">
                                        <li id="Kbbvpl1jH" class="keK1YUIay">
                                            <a target="_blank" href="https://www.tripadvisor.cl/"><img
                                                    src="https://www.tripadvisor.cl/img/cdsi/img2/branding/150_logo-11900-2.png"
                                                    alt="TripAdvisor"/></a>
                                        </li>
                                    </ul>
                                </div>
                                <script
                                    src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=621&amp;locationId=2695264&amp;lang={{ $language }}&amp;rating=true&amp;nreviews=0&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>{{ trans('main.eyes_of_caburgua_text') }}</p>

                    <div class="bottom-tab-links">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="fancy-button">
                                    <a href="#">
                                        <img src="{{ asset('../images/gps.svg') }}" alt="clock" class="img-responsive" width="35"
                                              height="35"/>
                                        <div class="button-text">
                                            <strong>{{ trans('main.gps_route') }}</strong>
                                            <p>{{ trans('main.download_this_route') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p><img src="{{ asset('../images/clock.svg') }}" alt="clock" class="img-responsive" width="35"
                                          height="35"/>{{ trans('main.estimated_time_round_trip') }}:
                                    <strong>2.5 {{ trans('hours') }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-tab-info" id="bicicleta-sub-tab-3">
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <h3>{{ trans('main.jump_the_light') }}</h3>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="termas">
                        <div class="pull-right">
                            <div class="opiniones">
                                <div id="TA_selfserveprop943" class="TA_selfserveprop">
                                    <ul id="DZLqawAQrRO" class="TA_links EH9gCELf80">
                                        <li id="OChJxuJ" class="khcluu">
                                            <a target="_blank" href="https://www.tripadvisor.cl/"><img
                                                    src="https://www.tripadvisor.cl/img/cdsi/img2/branding/150_logo-11900-2.png"
                                                    alt="TripAdvisor"/></a>
                                        </li>
                                    </ul>
                                </div>
                                <script
                                    src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=943&amp;locationId=7364382&amp;lang={{ $language }}&amp;rating=true&amp;nreviews=0&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>{{ trans('main.jump_the_light_text') }}</p>
                    <div class="bottom-tab-links">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="fancy-button">
                                    <a href="#">
                                        <img src="{{ asset('../images/gps.svg') }}" alt="clock" class="img-responsive" width="35"
                                              height="35"/>
                                        <div class="button-text">
                                            <strong>{{ trans('main.gps_route') }}</strong>
                                            <p>{{ trans('main.download_this_route') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p><img src="{{ asset('../images/clock.svg') }}" alt="clock" class="img-responsive" width="35" height="35"/>{{ trans('main.estimated_time_round_trip') }}: <strong>2.5 {{ trans('hours') }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pop-up-model">
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="bicicleta-model" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3>{{ trans('main.bicycle') }}</h3>
                            </div>
                            <div class="modal-body">
                                <iframe frameBorder="0"
                                          src="https://a.tiles.mapbox.com/v4/rafaelzarro.1c6ffepl.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 right-col">
            <img src="{{ asset('../images/instagram.svg') }}" alt="instagram" class="img-responsive" width="28" height="28"/>

            <h4>{{ trans('main.instagram_pictures') }}</h4><strong>#rioturbio #ojosdelcaburgua #saltodelclaro</strong>
            <div id="instafeed2" class="instafeed">
                <span id="instafeed2_1"></span>
                <span id="instafeed2_2"></span>
                <span id="instafeed2_3"></span>
            </div>

        </div>
    </div>
</div>
@stop