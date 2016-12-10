<div class="img-holder"><img src="{{ asset($activity['image_thumb']) }}" onerror="this.src='{{ asset('/images/image-none.jpg') }}';"
                             alt="image description"></div>
<div class="caption">
    <h2><a href="{{ action('ActivityController@getActivity', $activity['id']) }}">{{ $activity['name'] }}</a></h2>
    <p>{{ $activity['short_description'] }}</p>
        <strong class="price"><span>{{ trans('main.from') }}</span> <sub>$</sub>{{ number_format($activity['price'], 0, ".", ".") }}</strong>
        <a href="{{ action('ActivityController@getActivity', $activity['id']) }}" class="btn-primary">{{ trans('button-links.view') }}</a>
</div>
