 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div class="detail-box active-tab" id="m-box-3">
<div class="all-activities custom_title custom_title">
    <header class="light-blue">
        <h1>De Carro ou de Ônibus</h1>
        <p>Preparamos uma pequenha guia do que pode fazer em Pucón. </p>
    </header>
</div>
<div class="infor-bar">
    <div class="row">
        <div class="col-md-5 right-border">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting 
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley.</p>
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
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Para visitar </strong>
                            <p>e tirar foto</p>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder2.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Melhores termas: </strong>
                            <p>Para relaixar</p>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/placeholder3.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Parques Nacionais</strong>
                            <p>Increíveis parques</p>
                        </a>
                    </li> 

                </ul> 
            </div>
        </div>
    </div>
</div>                                    
<div class="row">
    <div class="map-detail">
        <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1c6j5igk.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
    </div>
</div>


<div class="row">
    <div class="col-sm-7 left-col">                                            
        <div class="termas"> 
            <div class="row">
                <div class="col-sm-6 col-xs-12">                                                        
                    <h2>Termas Menetúe</h2>
                </div>
                <div class="col-sm-6 mobile-left col-xs-12">                                                        
                    <div class="pull-right">
                        <div class="opiniones">
                            <div id="TA_cdsratingsonlynarrow193" class="TA_cdsratingsonlynarrow">
                            <ul id="dzS9IU75yb" class="TA_links Y59dGpsNxC">
                            <li id="WwGABY8" class="gXALfDE133">
                            <a target="_blank" href="https://www.tripadvisor.com.br/"><img src="https://www.tripadvisor.com.br/img/cdsi/img2/branding/tripadvisor_logo_transp_340x80-18034-2.png" alt="TripAdvisor"/></a>
                            </li>
                            </ul>
                            </div>
                            <script src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=193&amp;locationId=1419889&amp;lang=pt&amp;border=false&amp;display_version=2"></script>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="detail-desc">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                has been the industry's standard dummy text ever since the 1500s, when an unknown 
                printer took a galley of type and scrambled it to make a type specimen book. It has surv
                ived not only five centuries, but also the leap into electronic typesetting, remaining essen
                tially unchanged. It was popularised in the 1960s with the release of Letraset sheets con
                taining Lorem Ipsum passages, and more recently with desktop publish</p> 
        </div>
        <div class="termas-tabs">
            <ul class="nav nav-pills">
                <li class="active">
                    <a data-toggle="pill" href="#home">
                        <img src="../images/white-bus.svg" alt="white bus" width="43" height="29" class="img-responsive">
                        <div class="link-info">                                                                
                            <strong>Como chegar de ônibus</strong>
                            <p>Desde o centro de Pucón</p>
                        </div>
                    </a>
                </li> 
                <li>
                    <a data-toggle="pill" href="#menu1">
                        <img src="../images/route.svg" alt="color route" width="37" height="38" class="img-responsive">
                        <div class="link-info">                                                                
                            <strong>Como chegar de carro</strong>
                            <p>Caminho pelo Google Maps</p>
                        </div>
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane well fade in active">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tab-detail">
                                <p>Deve tomar o ônibus locais que está na rua 
                                    Palguin até Catripulli. O ônibus custa $ 1.000
                                    pesos por pessoa e sai nos horários indicados 
                                    abaixo. Em Catripulli deve tomar um taxi
                                    até as temas Menetue.</p>
                            </div>
                            <div class="info-icons">
                                <img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25" />
                                <p>Tempo estimado:  <strong>1 hora</strong></p>
                            </div>
                            <div class="info-icons">
                                <img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25" />
                                <p>Gasto estimado:  <strong>$ 2.000 por pessoa</strong></p>
                                <span>Valor das termas:  <strong>$ 17.000 por pessoa </strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-holder">
                                <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1cdljp85.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane well fade">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tab-detail">
                                <p>Deve tomar o ônibus locais que está na rua 
                                    Palguin até Catripulli. O ônibus custa $ 1.000
                                    pesos por pessoa e sai nos horários indicados 
                                    abaixo. Em Catripulli deve tomar um taxi
                                    até as temas Menetue.</p>
                            </div>
                            <div class="info-icons">
                                <img src="../images/clock.svg" alt="clock" class="img-responsive" width="25" height="25" />
                                <p>Tempo estimado:  <strong>1 hora</strong></p>
                            </div>
                            <div class="info-icons">
                                <img src="../images/coin.svg" alt="coin" class="img-responsive" width="25" height="25" />
                                <p>Gasto estimado:  <strong>$ 2.000 por pessoa</strong></p>
                                <span>Valor das termas:  <strong>$ 17.000 por pessoa </strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-holder">
                                <iframe frameBorder="0" src="https://a.tiles.mapbox.com/v4/rafaelzarro.1cdljp85.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw"></iframe>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-md-12 text-center">                                                    
                <a href="#" class="yello-button">INCLUIR NO MEU PANORAMA</a>
            </div> 
        </div>


    </div>
    <div class="col-md-5 right-col" style="overflow: hidden; height: 650px;">
        <img src="../images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>
        <h4>Fotos de Instagram</h4><strong>#termasmenetue</strong>
 
            <div id="instafeed3">

            </div>
        </div> 
    </div>
</div>
</div>
@stop