{{--<div class="img-holder"><img src="/{{ $activity['image_thumb'] }}" onerror="this.src='/images/image-none.jpg';" alt="image description"></div>--}}
{{--<div class="caption">--}}
{{--<h2><a href="/activities/{{ $activity['id'] }}">{{ $activity['name'] }}</a></h2>--}}
{{--<p>{{ $activity['short_description'] }}<p>--}}
{{--<strong class="price"><span>Desde de</span> <sub>$</sub> {{ isset($prices[$activity['id']]) ? number_format($prices[$activity['id']], 0, ".", ".") : 'N/A' }}</strong>--}}
{{--<a href="/activities/{{ $activity['id'] }}" class="btn-primary">VISUALIZAR</a>--}}
{{--</div>--}}
<div class="img-holder"><img src="{{ $activity['image_thumb'] }}" onerror="this.src='/images/image-none.jpg';"
                             alt="image description"></div>
<div class="caption">
    <h2><a href="/activity/{{ $activity['id'] }}">{{ $activity['name'] }}</a></h2>
    <p>{{ $activity['short_description'] }}</p>
        <strong class="price"><span>{{ trans('main.from') }}</span> <sub>$</sub> 23.000</strong>
        <a href="/activity/{{ $activity['id'] }}" class="btn-primary">{{ trans('button-links.view') }}</a>
</div>
