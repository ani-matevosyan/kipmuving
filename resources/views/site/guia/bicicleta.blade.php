 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

 <div class="detail-box active-tab" id="m-box-2">
<div class="all-activities custom_title">
    <header class="light-blue">
        <h1>Bicicleta</h1>
        <p>Preparamos uma pequenha guia do que pode fazer em Pucón. </p>
    </header>
</div>
<div class="infor-bar">
    <div class="row">
        <div class="col-md-5 right-border">
            <p>
                Pelo menos um dia é necessário para caminhar e conhecer todos os 
                atrativos que possui esta linda cidade. Pucon é pequeno, em 20 
                minutos se pode conhecer todo seu encanto.
            </p>
            <div class="play-info">
                <img src="../images/play-button.svg" alt="play description" width="33" height="33">
                <p><strong>Clique em cima dos ícones para ter mais informações</strong></p>
            </div> 
        </div>
        <div class="col-md-7">
            <div class="placeholder-info">
                <p>Iconografia</p>
                <ul> 
                    <li class="active">
                        <a href="#bicicleta-sub-tab-1">
                            <div class="ico">
                                <img src="../images/turbio.svg" alt="image description" width="33" height="33" />
                            </div>
                            <strong>Cachoeira Rio Turbio</strong>
                        </a>
                    </li> 
                    <li>
                        <a href="#bicicleta-sub-tab-2">
                            <div class="ico">
                                <img src="../images/claro.svg" alt="image description" width="33" height="33" />
                            </div>
                            <strong>Ojos de Caburgua</strong>
                        </a>
                    </li> 
                    <li>
                        <a href="#bicicleta-sub-tab-3">
                            <div class="ico">
                                <img src="../images/ojos.svg" alt="image description" width="33" height="33" />
                            </div>
                            <strong>Salto El Claro</strong>
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
            <iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/rafaelzarro.1c6ffepl/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'></iframe>
            <button type="button" class="maximize-map" data-toggle="modal" data-target="#bicicleta-model"></button>                                                    
        </div>
    </div>
    <div class="col-md-6 map-description">
        <div class="sub-tab-info active-sub-tab" id="bicicleta-sub-tab-1">                                                    
            <div class="col-md-8 col-sm-7 col-xs-12">                                                        
                <h3>Cachoeira Rio Turbio</h3>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-12">
                <div class="termas">                                                        
                    <div class="pull-right">
                        <div class="opiniones">
                            <div id="TA_selfserveprop719" class="TA_selfserveprop">
                                <ul id="StEbQyO7dJ" class="TA_links Bu0Lw0ZNo">
                                    <li id="wQAL39MfV" class="KgvBfM">
                                        <a target="_blank" href="https://www.tripadvisor.es/"><img src="https://www.tripadvisor.es/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
                                    </li>
                                </ul>
                            </div>
                            <script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=719&amp;locationId=3181592&amp;lang=es&amp;rating=true&amp;nreviews=0&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                            <style>
                                #CDSWIDSSP .widSSPData .widSSPBranding dt.widSSPTagline,
                                #CDSWIDSSP .widSSPData .widSSPH18,
                                #CDSWIDSSP.widSSPnarrow .widSSPData .widSSPH11,
                                #CDSWIDSSP.widSSPnarrow .widSSPData .widSSPAll,
                                #CDSWIDSSP .widSSPData .widSSPLegal
                                {
                                    display: none;
                                }
                                #CDSWIDSSP .widSSPData{
                                    margin-top: -7px;
                                }
                                #CDSWIDSSP .widSSPData .widSSPBranding{
                                    border-bottom: none;
                                    width: 34px;
                                    left: 63px;
                                    top: 1px;
                                    overflow: hidden;
                                    position: absolute;
                                }
                                #CDSWIDSSP .widSSPData .widSSPSummary a{
                                    position: absolute;
                                    height: 26px;
                                    color: transparent;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    width: 100px;
                                    right: 73px;
                                    display: block;
                                }
                                #CDSWIDSSP.widSSPnarrow .widSSPData .widSSPTrvlRtng .widSSPOverall{
                                    text-align: center;
                                }
                                #CDSWIDSSP .widSSPData .widSSPTrvlRtng .widSSPOverall img{
                                    margin: 3px 6px 4px 30px;
                                }
                                #CDSWIDSSP .widSSPData .widSSPTrvlRtng .widSSPOverall div{
                                    white-space: nowrap;
                                    overflow: hidden;
                                    width: 120px;
                                    position: absolute;
                                    right: 0;
                                    left: 0;
                                    margin: 0 auto;
                                }
                            </style>
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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                    has been the industry's standard dummy text ever since the 1500s, when an unknown 
                    printer took a galley of type and scrambled it to make a type specimen book. It has surv
                    ived not only five centuries, but also the leap into electronic typesetting, remaining essen
                    tially unchanged. It was popularised in the 1960s with the release of Letraset sheets con
                    taining Lorem Ipsum passages, and more recently with desktop publish</p>

                <div class="bottom-tab-links">                                                                
                    <div class="row">
                        <div class="col-md-5">
                            <div class="fancy-button">
                                <a href="#">
                                    <img src="../images/gps.svg" alt="clock" class="img-responsive" width="35" height="35" />
                                    <div class="button-text">                                                                                    
                                        <strong>Ruta em GPS</strong>
                                        <p>Faça download dessa ruta</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7">                                                                        
                            <p><img src="../images/clock.svg" alt="clock" class="img-responsive" width="35" height="35" />Tempo estimado ida e volta:  <strong>2 horas e meia</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-tab-info" id="bicicleta-sub-tab-2">                                                    
            <div class="col-md-8 col-sm-7 col-xs-12">                                                        
                <h3>Ojos de Caburgua</h3>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-12">
                <div class="termas">                                                        
                    <div class="pull-right">
                        <div class="opiniones">
                            <div id="TA_cdsratingsonlynarrow1000" class="TA_cdsratingsonlynarrow">
                            <ul id="s8OzZFbED2P" class="TA_links rjbKLd">
                            <li id="vEMKb2aB7Rzd" class="bKMcCjvuzf0i">
                            <a target="_blank" href="https://www.tripadvisor.com.br/"><img src="https://www.tripadvisor.com.br/img/cdsi/img2/branding/tripadvisor_logo_transp_340x80-18034-2.png" alt="TripAdvisor"/></a>
                            </li>
                            </ul>
                            </div>
                            <script src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=1000&amp;locationId=2695264&amp;lang=pt&amp;border=false&amp;display_version=2"></script>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-12">                                                        
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                    has been the industry's standard dummy text ever since the 1500s, when an unknown 
                    printer took a galley of type and scrambled it to make a type specimen book. It has surv
                    ived not only five centuries, but also the leap into electronic typesetting, remaining essen
                    tially unchanged. It was popularised in the 1960s with the release of Letraset sheets con
                    taining Lorem Ipsum passages, and more recently with desktop publish</p>

                <div class="bottom-tab-links">                                                                
                    <div class="row">
                        <div class="col-md-5">
                            <div class="fancy-button">
                                <a href="#">
                                    <img src="../images/gps.svg" alt="clock" class="img-responsive" width="35" height="35" />
                                    <div class="button-text">                                                                                    
                                        <strong>Ruta em GPS</strong>
                                        <p>Faça download dessa ruta</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7">                                                                        
                            <p><img src="../images/clock.svg" alt="clock" class="img-responsive" width="35" height="35" />Tempo estimado ida e volta:  <strong>2 horas e meia</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-tab-info" id="bicicleta-sub-tab-3">                                                    
            <div class="col-md-8 col-sm-7 col-xs-12">                                                        
                <h3>Salto El Claro</h3>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-12">
                <div class="termas">                                                        
                    <div class="pull-right">
                        <div class="opiniones">
                            <div id="TA_cdsratingsonlynarrow71" class="TA_cdsratingsonlynarrow">
                            <ul id="4fe0m82Jt69R" class="TA_links gplBjl3Kt95">
                            <li id="VccEzAYHevu" class="j7lHjLZzjkj">
                            <a target="_blank" href="https://www.tripadvisor.com.br/"><img src="https://www.tripadvisor.com.br/img/cdsi/img2/branding/tripadvisor_logo_transp_340x80-18034-2.png" alt="TripAdvisor"/></a>
                            </li>
                            </ul>
                            </div>
                            <script src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=71&amp;locationId=7364382&amp;lang=pt&amp;border=false&amp;display_version=2"></script>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-12">                                                        
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                    has been the industry's standard dummy text ever since the 1500s, when an unknown 
                    printer took a galley of type and scrambled it to make a type specimen book. It has surv
                    ived not only five centuries, but also the leap into electronic typesetting, remaining essen
                    tially unchanged. It was popularised in the 1960s with the release of Letraset sheets con
                    taining Lorem Ipsum passages, and more recently with desktop publish</p>
                <div class="bottom-tab-links">                                                                
                    <div class="row">
                        <div class="col-md-5">
                            <div class="fancy-button">
                                <a href="#">
                                    <img src="../images/gps.svg" alt="clock" class="img-responsive" width="35" height="35" />
                                    <div class="button-text">                                                                                    
                                        <strong>Ruta em GPS</strong>
                                        <p>Faça download dessa ruta</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7">                                                                        
                            <p><img src="../images/clock.svg" alt="clock" class="img-responsive" width="35" height="35" />Tempo estimado ida e volta:  <strong>2 horas e meia</strong></p>
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
                            <h3>Bicicleta</h3>
                        </div>
                        <div class="modal-body">
                            <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1c6ffepl.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 right-col">
        <img src="../images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>

        <h4>Fotos de Instagram</h4><strong>#rioturbio #ojosdelcaburgua #saltodelclaro</strong>
       <div id="instafeed2" class="instafeed">
            <span id="instafeed2_1"></span>
            <span id="instafeed2_2"></span>
            <span id="instafeed2_3"></span>
       </div>

    </div>
</div>
</div>
@stop