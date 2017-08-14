@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.Where_to_sleep') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.Despite_being_a_small_city') }} <strong>{{ trans('guide.5_star_hotels') }}</strong>{{ trans('guide.mountain_cabins_or_hostels') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.Whichever_your_choice_is') }}</p>
    <img src="{{ asset('/images/guia-where-to-sleep.jpg') }}" alt="Where to sleep" class="guide-content__image">
  </section>

@stop