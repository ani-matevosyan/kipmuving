@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('main.summer_and_winter') }}</h1>
        <p class="guide-content__paragraph">{{ trans('main.pucon_is_considered') }}<strong>{{ trans('main.the_summer_in_la') }}</strong>{{ trans('main.since_it_offers') }}<strong>{{ trans('main.warm_water_in') }}</strong>{{ trans('main.being_also_possible') }}<strong>{{ trans('main.rivers_and_waterfalls') }}</strong>{{ trans('main.in_the_summer') }}<strong>{{ trans('main.to_the_crater') }}</strong>{{ trans('main.one_of_the_city`s') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.in_the_winter') }}<strong>{{ trans('main.pucon_during_the_winter') }}</strong>{{ trans('main.although_it_usually') }}<strong>{{ trans('main.practice_ski') }}</strong>{{ trans('main.as_well_as_practice') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.to_help_you_decide') }}</p>
        <img src="{{ asset('/images/guia-summer-and-winter1.jpg') }}" alt="{{ trans('main.summer_and_winter') }}" class="guide-content__image">
    </section>

@stop