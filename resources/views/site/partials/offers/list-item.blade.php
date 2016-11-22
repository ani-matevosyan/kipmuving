<li class="offer-item">
  <header>
    <div class="ico"><img src="/{{ $offer->agency->image_icon }}" onerror="this.src='/images/image-none.jpg';" alt="agency image"></div>
    <div class="rating">
      <!-- <div class="star"><img src="images/img-star.png" alt="image description"></div> -->
      <!-- <span>120 comentarios</span> -->
    </div>
    <div class="text">
      <h2><a href="/agencias/{{ $offer->agency_id }}">{{ $offer->agency->name }}</a></h2>
      <strong class="sub-title"><span>{{ $offer->agency->address }}</span></strong>
    </div>
    <ul class="links">
      <li>
        <a href="javascript:void(0)" data-toggle="popover" title="{{ $offer->agency->name }}" data-html="true" data-placement="bottom" data-container="body"  data-trigger="focus"
          data-content="<a href='/agencias/{{ $offer->agency->id }}'><img src='/{{ $offer->agency->image }}'></a> <br>{{ $offer->agency->address }}<hr>{{ $offer->agency->description }}<br><a href='/agencias/{{ $offer->agency->id }}'>Más información...</a>">Sobre a agencia</a>
      </li>
      <li><a href="javascript:void(0)" class="btn-map" data-toggle="modal" data-lat="{{ $offer->agency->latitude }}" data-lng="{{ $offer->agency->longitude }}" data-title="{{ $offer->agency->name }}">Mostrar mapa</a></li>
    <!-- <li><a href="/agency/{{ $offer->agency_id }}">Condiciones</a></li> -->
    </ul>
  </header>
  <div class="row">
    <div class="col-md-5 col-sm-5 col-xs-12">
      <div class="list-box">
        <strong class="title">Que incluye:</strong>
        <ul>
        	@foreach (json_decode($offer->includes) as $include)
           <li>{{ $include }}</li>
          @endforeach
        </ul>
       <!-- <br />
        <strong class="title">Idiomas:</strong>
        <img src="/{{ $offer->important }}" onerror="this.src='/images/image-none.jpg';" alt="agency image">-->
      </div>
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <ul class="timing1">
            <li>
              <strong><span>Duración:</span> {{ $offer->getHours() }}hrs </strong>
              <strong><span>Horario:</span> {{ sprintf("%02d", $offer->start_hour) }}:{{ sprintf("%02d", $offer->start_min) }} - {{ sprintf("%02d", $offer->end_hour) }}:{{ sprintf("%02d", $offer->end_min) }}</strong>
            </li>
            <li class="profile">
              <select class="persona">
                <option value="">Cantidad de Personas</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div><strong class="price" data-unit-price="{{ $offer->price_offer }}">
              <?php if ($offer->price != $offer->price_offer) { ?><del><small><sub>$</sub>{{ number_format ($offer->price, 0, '.', '.') }}</small></del><Br /><?php } ?><sub>$</sub>{{ number_format ($offer->price_offer, 0, '.', '.') }}</strong><a href="#" class="btn btn-primary btn-reserve" data-offer-id="{{ $offer->id }}">AGREGAR</a></div>
        </div>      
      </div>
      <div style="color: #006b33; margin: 10px ; font-size: 13px;"><p>{{ $offer->desc }}</p></div>
    </div>
    <!-- <div class="col-md-3 col-sm-3 col-xs-12">
      <strong class="price" data-unit-price="{{ $offer->price_offer }}"><sub>$</sub> {{ number_format ($offer->price_offer, 0, '.', '.') }}</strong>
      <a href="#" class="btn btn-primary btn-reserve" data-offer-id="{{ $offer->id }}">AGREGAR</a>
    </div> -->
  </div>
  
    
  
  <div class="trip-adv"></div> 
  
  </strong>
</li>
