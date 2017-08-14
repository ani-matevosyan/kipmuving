@extends('site.guide.layout')

@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.city_and_region') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.pucon_is_located') }}<strong>Araucanía</strong>{{ trans('guide.region_in_the_south') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.the_small_urban_center') }}<strong>{{ trans('guide.explored_by_foot') }}</strong>{{ trans('guide.admiring_interesting') }}
    </p>
    <p class="guide-content__paragraph"><strong>{{ trans('guide.playa_glande') }}</strong>{{ trans('guide.is_a_beach') }}<strong>La Poza</strong>{{ trans('guide.area_offers') }}
    </p>
    <img src="{{ asset('/images/guide-city-and-region.jpg') }}" alt="{{ trans('guide.city_and_region') }}" class="guide-content__image">
  </section>

@stop