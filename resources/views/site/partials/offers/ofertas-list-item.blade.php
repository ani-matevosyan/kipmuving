<div class="img-holder"><a href="/activities/{{ $offer->activity->id }}"><img src="/{{ $offer->activity->image_thumb }}" onerror="this.src='/images/image-none.jpg';" alt="image description"></a></div>
<div class="caption">
  <h2><a href="/activities/{{ $offer->activity->id }}">{{ $offer->activity->name }}</a></h2>
  <p>{{ $offer->activity->short_description }}<p>
  <strong class="price">
    <sub>$</sub> <del><small>{{ number_format($offer->price, 0, ".", ".") }}</small></del>&nbsp;&nbsp;{{ number_format($offer->price_offer, 0, ".", ".") }}
  </strong>
  <a href="/activities/{{ $offer->activity_id }}" class="btn-primary">VISUALIZAR</a>
</div>
