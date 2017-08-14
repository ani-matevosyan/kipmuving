@extends('site.guide.layout')

@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">{{ trans('guide.How_to_arrive_in_Pucon') }}</h1>
        <p class="guide-content__paragraph">{{ trans('guide.Pucon_is_located') }} <strong>{{ trans('guide.488_miles') }}</strong>{{ trans('guide.Chiles_capital') }}</p>
        <h2 class="guide-content__sub-title">{{ trans('guide.Plane') }}</h2>
        <p class="guide-content__paragraph">{{ trans('guide.Pucon_has_its') }} <strong>{{ trans('guide.Santiago_and') }}</strong> {{ trans('guide.that_run_only') }}
        </p>
        <p class="guide-content__paragraph">{{ trans('guide.For_foreigners') }} <strong>{{ trans('guide.Sky_Airlines') }}</strong>.</p>
        <p class="guide-content__paragraph">{{ trans('guide.In_Temuco') }} <strong>{{ trans('guide.taxis') }}</strong>{{ trans('guide.the_most_expensive') }} <strong>{{ trans('guide.transfer') }}</strong> {{ trans('guide.at_the_airport') }}</p>
        <p class="guide-content__paragraph">{{ trans('guide.to_get_your_hotel_will_be') }} <strong>{{ trans('guide.be_foot_or_taxi') }}</strong>{{ trans('guide.since_the_city_is_small') }}</p>
        <img src="{{ asset('/images/guide-how-to-get-to-pucon1.jpg') }}" alt="Airport" class="guide-content__image">
        <h2 class="guide-content__sub-title">{{ trans('guide.Car') }}</h2>
        <p class="guide-content__paragraph">{{ trans('guide.Another_way_to_travel') }} <strong>{{ trans('guide.about_500') }}</strong>{{ trans('guide.on_Ruta') }} <strong>{{ trans('guide.tolls') }}</strong>{{ trans('guide.which_will_cost_about') }} <strong>U$ 26</strong>.</p>
        <img src="{{ asset('/images/guide-how-to-get-to-pucon2.jpg') }}" alt="Road" class="guide-content__image">
        <h2 class="guide-content__sub-title">{{ trans('guide.Bus') }}</h2>
        <p class="guide-content__paragraph">{{ trans('guide.Departing_from_Santiago') }} <strong>{{ trans('guide.JAC_Turbus') }}</strong>{{ trans('guide.The_journey_takes') }} <strong>{{ trans('guide.10_hours') }}</strong> {{ trans('guide.and_costs_between') }} <strong>{{ trans('guide.23_and_75_dollars') }}</strong>{{ trans('guide.depending_on_several_factors') }} <strong>{{ trans('guide.travelling_during_the_night') }}</strong>. </p>
        <p class="guide-content__paragraph">{{ trans('guide.Tickets_have_to_be_bought') }}</p>
        <img src="{{ asset('/images/guide-how-to-get-to-pucon3.jpg') }}" alt="Bus station" class="guide-content__image">
    </section>

@stop