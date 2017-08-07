@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('main.transportation_in') }}</h1>
        <p class="guide-content__paragraph">{{ trans('main.pucon_is_small') }}<strong>{{ trans('main.accessible_by_foot') }}</strong>{{ trans('main.with_main_streets') }}<strong>{{ trans('main.transportation_person') }}</strong>{{ trans('main.per_jorney') }}<strong>{{ trans('main.uber_also') }}</strong>{{ trans('main.use_cab') }}<strong>U$ 3</strong>{{ trans('main.for_a_ride') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.visit_near_pucon') }}<strong>{{ trans('main.villarrica') }}</strong>{{ trans('main.possible_to_use') }}<strong>{{ trans('main.minibus') }}</strong>{{ trans('main.departing_from') }}<strong>Calle Uruguay, 540</strong>{{ trans('main.in_the_center_of') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.natural_attractions') }}</p>
        <img src="{{ asset('/images/guide-transportation1.jpg') }}" alt="{{ trans('main.transportation') }}" class="guide-content__image">
    </section>

@stop