@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    <section class="visual home" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
        <div class="gradoverlay"></div>
        <div class="caption">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <form action="/activity/search" class="activity-form" id="activity-form" method="post">
                            {{ csrf_field() }}
                            <strong class="title">{{ trans('main.what_activities_search') }}</strong>
                            <div class="holder">
                                <div class="col">
                                    <select class="form-control" id="activity_id" name="activity_id">
                                        @foreach ($activitiesList as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-second">
                                    <div class="sub-col">
                                        <div class="text-field has-ico calender">
                                            <input id="activity_date"
                                                   type="text"
                                                   name="activity_date"
                                                   value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"
                                                   placeholder="{{ trans('form.date') }}"
                                                   class="form-control"
                                                   data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'/>
                                        </div>
                                    </div>
                                    <div class="sub-col sub-col-second">
                                        <input type="submit" value="{{ trans('button-links.search') }}" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <p class="form_under_p">{{ trans('main.less') }} <span>{{ config('kipmuving.discount') * 100 }}
                                    %</span> {{ trans('main.in_all_activities') }}</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main id="main">
        <div class="container">
            @include('site.offers.offers_quickinfo', ['classPlace' => 'program-schedule_home'])
        </div>
        <div class="line-box">
            <div class="line-wrap">
                <p>{{ trans('main.all_activities_in_single_place') }}</p>
            </div>
        </div>
        <section id="guia" class="s_guia">
            <div class="container">
                <div class="col-md-5 col-md-push-2">
                    <div class="section_title">
                        <h2>
                            @if(app()->getLocale() == 'es_ES' || app()->getLocale() == 'pt')
                                <span class="size1">{{ trans('main.guide') }}</span>
                                <span class="size4">{{ trans('main.complete') }}</span>
                                <span class="size2">pucon</span>
                                <span class="size3">{{ trans('main.free') }}</span>
                            @elseif(app()->getLocale() == 'en')
                                <span class="size4">{{ trans('main.complete') }}</span>
                                <span class="size2">pucon</span>
                                <span class="size1">{{ trans('main.guide') }}</span>
                                <span class="size3">{{ trans('main.free') }}</span>
                            @endif
                        </h2>
                    </div>
                </div>
                <div class="col-md-2 col-md-pull-5">
                    <ul>
                        <li>
                            <a href="{{ action('GuiaController@index') }}">
                                <img src="{{ asset('images/bicycle-grey.svg') }}" alt="bicycle">
                            </a>
                            {{ trans('main.bicycle') }}
                        </li>
                        <li>
                            <a href="{{ action('GuiaController@index') }}">
                                <img src="{{ asset('images/bus-grey.svg') }}" alt="bus">
                            </a>
                            {{ trans('main.bus') }}
                        </li>
                        <li>
                            <a href="{{ action('GuiaController@index') }}">
                                <img src="{{ asset('images/car-grey.svg') }}" alt="car">
                            </a>
                            {{ trans('main.car') }}
                        </li>
                        <li>
                            <a href="{{ action('GuiaController@index') }}">
                                <img src="{{ asset('images/hikking-grey.svg') }}" alt="hikking">
                            </a>
                            {{ trans('main.walking') }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="go-to-guide">
                        <p><span>{{ trans('main.all_answers_here') }}</span> {{ trans('main.what_you_need_to_know_to_enjoy') }}
                        </p>
                        <p class="tegs"><span>{{ trans('main.maps_guides_addresses_suggestions') }}</span></p>
                        <a href="{{ action('GuiaController@index') }}" class="btn-orange">
                            <img src="{{ asset('images/arrow.png') }}" alt="">
                            {{ trans('button-links.go_to_guide') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="howitworks" class="s_howitworks">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="section_title">
                            <h2>{{ trans('main.how_does_it_work') }} <span>KipMuving</span></h2>
                            <p>{{ trans('main.best_deals') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="howitworks_block">
                            <img src="{{ asset('images/10.svg') }}" alt="">
                            <p><span>KipMuving</span> {{ trans('main.has_an_agreement') }}
                                <span>{{ trans('main.preferential_prices') }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="howitworks_block">
                            <img src="{{ asset('images/umbrella.svg') }}" alt="">
                            <p>
                                <span>{{ trans('main.supporters') }}</span> {{ trans('main.with_a_small_commission') }}
                                <span>{{ config('kipmuving.service_fee') * 100 }}
                                    %</span> {{ trans('main.for_any_reservation_will_pay_for_site') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="howitworks_block last-child">
                            <img src="{{ asset('images/broken-link.svg') }}" alt="">
                            <p>{{ trans('main.we_make') }} <span>{{ trans('main.your_union_with_the_agency') }}</span>
                                {{ trans('main.you_pay_your_tours') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--<div class="text-bar">--}}
        {{--<div class="container">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-6 col-sm-6 col-xs-12 col">--}}
        {{--<div class="img-holder"><img src="images/img33.png" alt=""></div>--}}
        {{--<div class="text">--}}
        {{--<strong class="value">1%</strong>--}}
        {{--<div class="txt">{{ trans('main.for_the_organization') }}--}}
        {{--<strong>{{ trans('main.parks_for_chili') }}</strong></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-6 col-sm-6 col-xs-12 col">--}}
        {{--<p>{{ trans('main.kipmuving_is_aware_that_nature') }} http://www.parquesparachile.cl/</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="all-activities" style="padding-top: 50px;">
            <div class="container">
                <header>
                    <h1>{{ trans('main.activities_in_pucon') }}</h1>
                    <p>{{ trans('main.first_choose_your_itinerary') }}</p>
                </header>


                <div class="row">
                    <?php $key = 0; ?>
                    @foreach($activities as $activity)
                        <div class="col-md-3 col-sm-6 col-xs-12 col">
                            @include('site.partials.activities.all-list-item-arr')
                        </div>
                        <?php ++$key?>
                        @if($key === 2)
                            <div class="clearfix visible-sm-block"></div>
                        @elseif($key===4)
                            <div class="clearfix visible-md-block"></div>
                            <div class="clearfix visible-lg-block"></div>
                            <div class="clearfix visible-sm-block"></div>
                            <?php $key = 0; ?>
                        @endif
                    @endforeach
                </div>


                <div class="btn-holder">
                    <a href="{{ action('ActivityController@index') }}"
                       class="btn btn-success">{{ trans('button-links.see_all_activities') }}</a>
                </div>
            </div>
        </div>
        <section id="viagem" class="s_viagem">
            <div class="container">
                <div class="block-wrapper">
                    <div class="block">
                        <h3>{{ trans('main.more_than_activities', ['activities' => 40]) }}</h3>
                        <p>{{ trans('main.all_activities_in_one_place') }}</p>
                    </div>
                    <div class="block">
                        <h3>{{ trans('main.more_time') }}</h3>
                        <p>{{ trans('main.enjoy_your_entire_trip') }}</p>
                    </div>
                    <div class="block">
                        <h3>{{ trans('main.all_agencies_together') }}</h3>
                        <p>{{ trans('main.what_you_can_see_here') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop
