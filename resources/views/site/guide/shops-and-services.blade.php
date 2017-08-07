@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('main.shops_and_services') }}</h1>
        <p class="guide-content__paragraph">{{ trans('main.the_main_shopping') }}<strong>Avenida O’Higgins</strong>{{ trans('main.as_well_as') }}<strong>Ansorena, Fresia, Palguín, Alderete e Urrutia</strong>.</p>
        <p class="guide-content__paragraph">{{ trans('main.besides_supermarkets') }}<strong>{{ trans('main.8_to_9') }}</strong>{{ trans('main.but_many_places') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.city_there') }}</p>
        <img src="{{ asset('/images/guide-shops-and-services1.jpg') }}" alt="{{ trans('main.shops_and_services') }}" class="guide-content__image">
    </section>

@stop