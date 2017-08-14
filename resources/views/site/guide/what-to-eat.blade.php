@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

	<section class="guide-content">
		<h1 class="guide-content__title">{{ trans('guide.what_to_eat') }}</h1>
		<p class="guide-content__paragraph">{{ trans('guide.finding_a_place_to_eat') }}
			<strong>{{ trans('guide.complete_gastronomic_offer') }}</strong>. {{ trans('guide.you_will_find_most_restaurants_at') }}
			<strong>{{ trans('guide.avenida_o_higgins_and_at') }}</strong> {{ trans('guide.the_only_difficulty_will_be') }}</p>
		<p class="guide-content__paragraph"><strong>{{ trans('guide.the_chilean_gastronomy_is_very_rich') }}</strong>. {{ trans('guide.you_can_expect_to_find_great_fish') }}
			<strong>{{ trans('guide.Pastel_de_Choclo') }}</strong> {{ trans('guide.and_also_many_fish') }}.</p>
		<p class="guide-content__paragraph">{{ trans('guide.Meat_is_another_very_typical_type') }}</p>
		<p class="guide-content__paragraph">{{ trans('guide.But_in_the_city_there_are_restaurants') }}
		</p>
		<p class="guide-content__paragraph">{{ trans('guide.To_those_who_are_looking_for') }}</p>
		<img src="{{ asset('/images/guia-what-to-eat.jpg') }}" alt="What to Eat" class="guide-content__image">
	</section>

@stop