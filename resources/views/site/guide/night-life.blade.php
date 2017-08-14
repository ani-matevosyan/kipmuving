@extends('site.guide.layout')

@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.night_life') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.although_pucon_has') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.want-to-go-out') }}<strong>{{ trans('guide.mamas_&_tapas') }}</strong>{{ trans('guide.a_rustic_pub') }}<strong>Black
        Forest</strong>{{ trans('guide.you_can_watch') }}</p>
    <p class="guide-content__paragraph">{{ trans('guide.for_those_who') }}</p>
    <img src="{{ asset('/images/guia-nightlife.jpg') }}" alt="{{ trans('guide.night_life') }}" class="guide-content__image">
  </section>

@stop