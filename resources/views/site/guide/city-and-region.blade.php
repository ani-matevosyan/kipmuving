@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('main.city_and_region') }}</h1>
        <p class="guide-content__paragraph">{{ trans('main.pucon_is_located') }}<strong>Araucanía</strong>{{ trans('main.region_in_the_south') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.the_small_urban_center') }}<strong>{{ trans('main.explored_by_foot') }}</strong>{{ trans('main.admiring_interesting') }}</p>
        <p class="guide-content__paragraph"><strong>{{ trans('main.playa_glande') }}</strong>{{ trans('main.is_a_beach') }}<strong>La Poza</strong>{{ trans('main.area_offers') }}</p>
        <img src="{{ asset('/images/guide-city-and-region.jpg') }}" alt="{{ trans('main.city_and_region') }}" class="guide-content__image">
    </section>

@stop