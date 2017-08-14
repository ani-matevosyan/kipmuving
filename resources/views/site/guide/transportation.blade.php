@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.transportation_in') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.pucon_is_small') }}<strong>{{ trans('guide.accessible_by_foot') }}</strong>{{ trans('guide.with_main_streets') }}
      <strong>{{ trans('guide.transportation_person') }}</strong>{{ trans('guide.per_jorney') }}<strong>{{ trans('guide.uber_also') }}</strong>{{ trans('guide.use_cab') }}<strong>U$
        3</strong>{{ trans('guide.for_a_ride') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.visit_near_pucon') }}<strong>{{ trans('guide.villarrica') }}</strong>{{ trans('guide.possible_to_use') }}
      <strong>{{ trans('guide.minibus') }}</strong>{{ trans('guide.departing_from') }}<strong>Calle Uruguay, 540</strong>{{ trans('guide.in_the_center_of') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.natural_attractions') }}</p>
    <img src="{{ asset('/images/guide-transportation1.jpg') }}" alt="{{ trans('guide.transportation') }}" class="guide-content__image">
  </section>

@stop