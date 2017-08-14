@extends('site.guide.layout')

@section('subpage')

  <section class="guide-content">
    <h1 class="guide-content__title">{{ trans('guide.Money') }}</h1>
    <p class="guide-content__paragraph">{{ trans('guide.Chiles_official_currency_is_the') }} <strong>{{ trans('guide.Chilean_Peso') }}</strong> {{ trans('guide.represented_by_the_symbol') }} <strong>{{ trans('guide.at_the_ATMs') }}</strong> {{ trans('guide.exchange_money') }} <strong>{{ trans('guide.at_the_exchange_offices') }}</strong> {{ trans('guide.you_may_need_Pesos_during_the_journey') }}</p>
    <img src="{{ asset('/images/guia-money.jpg') }}" alt="Money" class="guide-content__image">
  </section>

@stop