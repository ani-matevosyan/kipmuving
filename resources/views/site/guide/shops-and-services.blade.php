@extends('site.guide.layout')

@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.shops_and_services') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.the_main_shopping') }}<strong>Avenida O’Higgins</strong>{{ trans('guide.as_well_as') }}<strong>Ansorena, Fresia, Palguín,
        Alderete e Urrutia</strong>.</p>
    <p class="guide-content__paragraph">{{ trans('guide.besides_supermarkets') }}<strong>{{ trans('guide.8_to_9') }}</strong>{{ trans('guide.but_many_places') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.city_there') }}</p>
    <img src="{{ asset('/images/guide-shops-and-services1.jpg') }}" alt="{{ trans('guide.shops_and_services') }}" class="guide-content__image">
  </section>

@stop