@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('main.night_life') }}</h1>
        <p class="guide-content__paragraph">{{ trans('main.although_pucon_has') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.want-to-go-out') }}<strong>{{ trans('main.mamas_&_tapas') }}</strong>{{ trans('main.a_rustic_pub') }}<strong>Black Forest</strong>{{ trans('main.you_can_watch') }}</p>
        <p class="guide-content__paragraph">{{ trans('main.for_those_who') }}</p>
        <img src="{{ asset('/images/guia-nightlife.jpg') }}" alt="{{ trans('main.night_life') }}" class="guide-content__image">
    </section>

@stop