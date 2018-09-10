@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')

    <section class="visual lazyload" @if ($activity->image) data-original="/{{ $activity['image'] }}" @endif>
        <div class="gradoverlay"></div>
        <div class="activity-search">
            <div class="container">
                <select id="activity-search" onchange="window.location = '{{ URL::to('activity' ) }}/' + this.value;"
                        data-noresulttext="There is no activity">
                    @foreach ($activitiesList as $item)
                        <option value="{{ $item->id }}"
                                @if($item->id == $activity->id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <main id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
{{--                    @include('site.offers.offers_quickinfo')--}}
                    <div class="your-reservation activity add new">
                        <div class="row">
                            <div id="activity-single-sidebar" class="col-md-3 col-sm-12 col-xs-12">
                                @include('site.activities.activity-single-sidebar')
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <header class="activity-title">
                                    @if($activity->name)
                                        <h1>{{ $activity->name }}</h1>
                                    @endif

                                    {{--start tripadvisor review--}}
                                        @if($activity->tripadvisor_link)
                                            <div class="tripadvisorReview">
                                                <span class="header_rating">
                                                    <div class="rs rating">
                                                        <div class="prw_rup prw_common_bubble_rating bubble_rating" data-prwidget-name="common_bubble_rating" data-prwidget-init="">
                                                            <img src="https://www.frixoshotel.com.cy/static/images/tripadvisor-grey.png" width="20" height="20"/>
                                                            <a href=""></a>
                                                            <span class="ui_bubble_rating bubble_{{$rating}}" style="font-size:15px;" property="ratingValue" content="4,5" alt="4,5 de 5 círculos"></span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=887&amp;
                                                    locationId=1762622&amp;lang=en_UK&amp;rating=true&amp;reviews=true&amp;
                                                    writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true">
                                                </script>
                                            </div>
                                        @endif
                                    {{--end tripadvisor review--}}

                                    {{--start google review--}}
                                    @if($activity->google_place_id)
                                        <img src="https://www.google.com.ua/images/branding/googleg/1x/googleg_standard_color_128dp.png"
                                             class="logoOfGoogle" width="16px" height="16px"/>
                                        <div style="display:inline-block">
                                            <div class="star-ratings-sprite">
                                                <span style="width:{{$google_rating}}%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                            <div style="display:inline;font-size:15px;margin-left:11px">
                                                <span class="Vfp4xe p13zmc" style="white-space:nowrap"></span>
                                            </div>
                                        </div>
                                    @endif
                                    {{--end google review--}}

                                </header>
                                <section class="post-box">
                                    <div class="title-box">
                                        @if($activity->description)
                                            <p class="activity-description">{{ $activity->description }}</p>
                                        @endif
                                        @if ($activity->weather_embed)
                                            <div class="weather-box">
                                                <h2>{{ trans('main.activity_depends_on_the_weather') }}</h2>
                                                <p>{{ trans('main.this_activity_is_subject_to_weather') }}</p>
                                                {!! $activity->weather_embed !!}
                                            </div>
                                        @endif
                                        <div class="get-offers">
                                            <div class="get-offers__date-persons">
                                                <div class="get-offers__sub-col">
                                                    <input id="reserve-date"
                                                           data-datepicker='{"firstDay": 1, "minDate": 1, "dateFormat": "dd/mm/yy" }'
                                                           value="{{ \Carbon\Carbon::parse(session('selectedDate'))->format('d/m/Y') }}"
                                                           class="get-offers__datepicker">
                                                </div>
                                                <div class="get-offers__sub-col">
                                                    <select id="get-offers-persons"
                                                            class="get-offers__persons-select"
                                                            data-currencySign="@if(session('currency.type') === 'BRL') R$ @else $ @endif">
                                                        <option selected value="">{{ trans('main.persons') }}</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="offers-navigation">
                                            <ul role="tablist" class="offers-navigation__list">
                                                <li class="offers-navigation__item active">
                                                    <a href="#tab2" class="offers-navigation__link"
                                                       data-toggle="tab">{{ trans('main.recommendation') }}</a>
                                                </li>
                                                <li class="offers-navigation__item">
                                                    <a href="#tab3" class="offers-navigation__link"
                                                       data-toggle="tab">{{ trans('main.lowest_price') }}</a>
                                                </li>
                                                <li class="offers-navigation__item">
                                                    <a href="#tab4" class="offers-navigation__link"
                                                       data-toggle="tab">{{ trans('main.includes_more_services') }}</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab2">
                                            <ul class="accordion">
                                                @foreach ($activity->offers->sortByDesc('recommendation') as $offer)
                                                    @include('site.partials.offers.list-item')
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <ul class="accordion">
                                                @foreach ($activity->offers->sortBy('price') as $offer)
                                                    @include('site.partials.offers.list-item')
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <ul class="accordion">
                                                @foreach ($activity->offers->sortByDesc('includes') as $offer)
                                                    @include('site.partials.offers.list-item')
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="comments-block">

                                        <header class="comments-block__header">
                                            <div class="comments-block__titles @if (auth()->user()) comments-block__titles_registered @endif">
                                                <h3 class="comments-block__title">{{ trans('main.ask') }}</h3>
                                                @if(!auth()->user())
                                                    <p class="comments-block__description">{{ trans('main.you_should_be_registered') }}</p>
                                                @endif
                                            </div>
                                            @if (auth()->user())
                                                <form id="comments-block__form" class="comments-block__form"
                                                      data-answerText="{{ trans('button-links.answer') }}"
                                                      action="{{ action('ActivityController@addComment') }}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <textarea class="comments-block__textarea" name="message"
                                                              id="message" rows="3"></textarea>
                                                    <input type="hidden" value="" name="comment_id">
                                                    <input type="hidden" value="{{ $activity->id }}" name="activity_id">
                                                    <button type="submit"
                                                            class="btn btn-dark-blue comments-block__send-button">{{ trans('main.send') }}</button>
                                                </form>
                                            @else
                                                <a href="{{ url('/login') }}"
                                                   class="btn btn-dark-blue comments-block__enter-button">{{ trans('button-links.login') }}</a>
                                            @endif
                                        </header>

                                        <ul class="comments-block__comments">
                                            @if(auth()->user() && auth()->user()->hasRole(['developer', 'admin']))

                                                @if(isset($activity->comments) && count($activity->comments) > 0)
                                                    @foreach($activity->comments as $comment)
                                                        <li class="comments-block__comment">
                                                            <header class="comments-block__comment-header">
                                                                <img src="{{ asset($comment->user->avatar) }}"
                                                                     alt="User name" class="comments-block__user-image"
                                                                     onerror="this.onerror=null; this.src='{{ asset('/images/image-none.jpg') }}'">
                                                                <strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
                                                                <span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>

                                                                @if(!isset($comment->answer))
                                                                    <a href="{{ $comment->id }}"
                                                                       class="comments-block__answer-button">{{ trans('button-links.answer') }}</a>
                                                                @endif

                                                            </header>
                                                            <p class="comments-block__text">{{ $comment->question }}</p>
                                                        </li>

                                                        @if(isset($comment->answer))
                                                            <li class="comments-block__comment comments-block__comment_answer">
                                                                <p class="comments-block__text">{{ $comment->answer }}</p>
                                                            </li>
                                                        @endif

                                                    @endforeach
                                                @endif

                                            @else

                                                @if(isset($activity->comments) && count($activity->comments->where('answer', '<>', null)) > 0)
                                                    @foreach($activity->comments->where('answer', '<>', null) as $comment)
                                                        <li class="comments-block__comment">
                                                            <header class="comments-block__comment-header">
                                                                <img src="{{ asset($comment->user->avatar) }}"
                                                                     alt="User name" class="comments-block__user-image"
                                                                     onerror="this.onerror=null; this.src='{{ asset('/images/image-none.jpg') }}'">
                                                                <strong class="comments-block__user-name">{{ $comment->user->first_name .' '. $comment->user->last_name }}</strong>
                                                                <span class="comments-block__date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y') }}</span>
                                                            </header>
                                                            <p class="comments-block__text">{{ $comment->question }}</p>
                                                        </li>
                                                        <li class="comments-block__comment comments-block__comment_answer">
                                                            <p class="comments-block__text">{{ $comment->answer }}</p>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            @endif
                                        </ul>

                                    </div>

                                </section>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 win-donamos-section">
                                <div class="row win-10">
                                    <h2>{{ trans('main.win_10_p') }}</h2>
                                    <p>{{ trans('main.win_10_text') }}</p>
                                    <img src="{{ asset('images/siteImages/partners2.png') }}" class="partners" alt="Aventuras chile partners">
                                </div>
                                <div class="row donamos-1">
                                    <h2>{{ trans('main.donate_2_p') }}</h2>
                                    <p>{{ trans('main.donate_2_text') }}</p>
                                    <img src="{{ asset('images/siteImages/sprout2.png') }}" class="sprout" alt="sprout">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="myModalX" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <!-- <h4 class="modal-title">Confirmation</h4> -->
                </div>
                <div class="modal-body">
                    <div id="the-image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('main.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END -->
    <div id="data"></div> <!-- Keep this div for instafeed information -->


    <script>
      window.translateData = {
        still_no_offers: '{{ trans('main.still_no_offers') }}'
      }
    </script>
@stop
