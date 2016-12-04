 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div class="detail-box active-tab" id="m-box-1">
<div class="all-activities custom_title">
    <header class="light-blue">
        <h1>Caminhando</h1>
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
                <img src="images/play-button.svg" alt="play description" width="33" height="33">
                <p><strong>Clique em cima dos ícones para ter mais informações</strong></p>
            </div> 
        </div>
        <div class="col-md-7">
            <div class="placeholder-info">
                <p>Iconografia</p>
                <ul> 
                    <li class="active">
                        <a href="#sub-tab-info1">
                            <div class="ico">
                                <img src="images/placeholder.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='images/ico16.png'">
                            </div>
                            <p><strong>Um pequeno circuito</strong> que pode fazer para 
                                conhecer as principais ruas e locais onde 
                                poderá tirar foto e apreciar o Vulcão Villarrica</p>
                        </a>
                    </li> 
                    <li>
                        <a href="#sub-tab-info2">
                            <div class="ico">
                                <img src="images/placeholder2.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='images/ico16.png'">
                            </div>
                            <p><strong>As ruas principais  </strong>onde estão os negocios, 
                                lojas, restaurantes e cassino. As demais ruas, 
                                normalmente são de casas.</p>
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
            <iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/rafaelzarro.1c21lk6l/attribution,share.html?access_token=pk.eyJ1IjoicmFmYWVsemFycm8iLCJhIjoickFLaV9oZyJ9.Z-bQZFRg4kXflAMaV9Jifw'></iframe>
            <button type="button" class="maximize-map" data-toggle="modal" data-target="#myModal"></button>                                                    
        </div>
    </div>
    <div class="col-md-6 map-description">
        <div class="sub-tab-info active-sub-tab" id="sub-tab-info1">                                                    
            <h3>Miradores Praia Grande e La Poza</h3>
            <p>Destes dois miradores, poderá ver o Vulcão Villarrica e também a Praia Grande Pucón. 
                São dois cenários que valem a pena serem vistos. São os clássicos para serem visitados 
                e apreciados. Abaixo algumas fotos destes dois locais.</p>
        </div>
        <div class="sub-tab-info" id="sub-tab-info2">                                                    
            <h3>Ruas principais</h3>
            <p>Aqui te apresentamos as atrações mais visitadas das ruas de Pucón.</p>
            <div class="col-xs-1">
                <div class="row">
                    <img src="images/placeholderred.svg" alt="placeholderrred" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="sub-tab-sub-sec-red">
                    <h3>O’Higgins</h3>
                    <p>A principal rua de Pucón. Pode encontrar agencias de turismo. a prefeitura, 
                        restaurantes e bares.</p>
                    <div class="sub-tab-sec">
                        <strong>Restaurantes</strong>
                        <p><span>Fiorentinni</span> - massas </p>
                        <p><span>Trawen</span> - comida local e internacional</p>
                    </div>
                    <div class="sub-tab-sec">
                        <strong>Lojas</strong>
                        <p><span>Falabella</span> - eletrónicos e roupas </p>
                        <p><span>North Face</span> - roupa outdoor</p>
                        <p><span>Rockford</span> - roupa outdoor</p>
                    </div>
                    <div class="sub-tab-sec">
                        <strong>Agencias</strong>
                        <p><span>Patagonia Experience</span></p>
                        <p><span>Politur</span></p>
                    </div>
                </div>

            </div>
            <div class="col-xs-1">
                <div class="row">
                    <img src="images/placeholderredblue.svg" alt="placeholderrred" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="sub-tab-sub-sec-green">                                                            
                    <h3>Fresia</h3>
                    <p>Uma das principais ruas de Pucón. Onde você pode encontrar muitos 
                        restaurantes e lojas. Destacamos os principais negócios:</p>
                    <div class="sub-tab-sec">
                        <strong>Restaurantes</strong>
                        <p><span>Cassis</span> - Restaurante e Cafeteria </p>
                        <p><span>Mora</span>- Sushi</p>
                    </div>
                    <div class="sub-tab-sec">
                        <strong>Lojas</strong>
                        <p><span>Patagonia</span>  - Roupa Outdoor</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="row">
                    <img src="images/placeholder2.svg" alt="placeholderrred" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="sub-tab-sub-sec-green">                                                            
                    <h3>Ansorena</h3>
                    <p>Rua onde está o Cassino de Pucon</p>

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
                            <h3>Caminhando</h3>
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
        <img src="images/instagram.svg" alt="instagram" class="img-responsive" width="28" height="28"/>
        <h4>Fotos de Instagram</h4><strong>#pucon</strong>
       <div id="instafeed1" class="instafeed">

       </div>
    </div>
</div>
</div>
@stop