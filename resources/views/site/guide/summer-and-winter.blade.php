@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.summer_and_winter') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.pucon_is_considered') }}<strong>{{ trans('guide.the_summer_in_la') }}</strong>{{ trans('guide.since_it_offers') }}
      <strong>{{ trans('guide.warm_water_in') }}</strong>{{ trans('guide.being_also_possible') }}
      <strong>{{ trans('guide.rivers_and_waterfalls') }}</strong>{{ trans('guide.in_the_summer') }}
      <strong>{{ trans('guide.to_the_crater') }}</strong>{{ trans('guide.one_of_the_city`s') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.in_the_winter') }}<strong>{{ trans('guide.pucon_during_the_winter') }}</strong>{{ trans('guide.although_it_usually') }}
      <strong>{{ trans('guide.practice_ski') }}</strong>{{ trans('guide.as_well_as_practice') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.to_help_you_decide') }}</p>
    <img src="{{ asset('/images/guia-summer-and-winter1.jpg') }}" alt="{{ trans('guide.summer_and_winter') }}" class="guide-content__image">
  </section>

@stop