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
            <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1c6ffepl.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
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
                            <div id="TA_cdsratingsonlynarrow315" class="TA_cdsratingsonlynarrow">
                            <ul id="lZ3kNy" class="TA_links s3bEH7Kos8">
                            <li id="gAnIMwAU75V" class="1eQjoSfmDPLi">
                            <a target="_blank" href="https://www.tripadvisor.com.br/"><img src="https://www.tripadvisor.com.br/img/cdsi/img2/branding/tripadvisor_logo_transp_340x80-18034-2.png" alt="TripAdvisor"/></a>
                            </li>
                            </ul>
                            </div>
                            <script src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=315&amp;locationId=3181592&amp;lang=pt&amp;border=false&amp;display_version=2"></script>
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
       <div id="instafeed2">
            <span id="instafeed2_1"></span>
            <span id="instafeed2_2"></span>
            <span id="instafeed2_3"></span>
       </div>

    </div>
</div>
</div>
@stop