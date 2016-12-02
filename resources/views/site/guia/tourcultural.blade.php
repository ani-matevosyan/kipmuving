 @extends('site.guia.layout')

{{-- Subpage --}}
@section('subpage')

<div class="detail-box active-tab" id="m-box-4">
<div class="all-activities custom_title">
    <header class="light-blue">
        <h1>Tour Cultural</h1>
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
                        <a href="#">
                            <div class="ico">
                                <img src="../images/museu.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Museu </strong>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/artesanias.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Artesanias </strong>
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <div class="ico">
                                <img src="../images/restaurantes.svg" alt="image description" width="33" height="33" onerror="this.onerror=null; this.src='../images/ico16.png'">
                            </div>
                            <strong>Restaurante</strong>
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
            <p>Aqui te apresentamos as atrações mais visitadas das ruas de Pucón.</p>
            <div class="col-xs-1">
                <div class="row">
                    <img src="../images/museu.svg" alt="placeholderrred" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="tour-sub-dark-red">
                    <h3>Museu Mapuche</h3>
                    <p>A principal rua de Pucón. Pode encontrar agencias de turismo. a prefeitura, 
                        restaurantes e bares.</p>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="row">
                    <img src="../images/artesanias.svg" alt="placeholderrred" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="tour-sub-light-green"> 
                    <h3>Artesanias </h3>
                    <p>Uma das principais ruas de Pucón. Onde você pode encontrar muitos 
                        restaurantes e lojas. Destacamos os principais negócios:</p>
                    <div class="sub-tab-sec">
                        <strong>Restaurantes</strong>
                        <p><strong>Cassis</strong> - Restaurante e Cafeteria </p>
                        <p><strong>Mora</strong>- Sushi</p>
                    </div>
                    <div class="sub-tab-sec">
                        <strong>Lojas</strong>
                        <p><strong>Patagonia</strong>  - Roupa Outdoor</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="row">
                    <img src="../images/restaurantes.svg" alt="restaurantes" class="img-responsive" />                                                            
                </div>
            </div>
            <div class="col-xs-11">
                <div class="tour-sub-light-red">                                                            
                    <h3>Comida Chilena</h3>
                    <p>Rua onde está o Cassino de Pucon</p>

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
                        <h3>Tour Cultural</h3>
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