@extends('site.layouts.default-new')

@section('content')

    <div class="guides">

        <nav class="guide-navigation">
            <div class="container">
                <h2 class="guide-navigation__title">Preguntas Frecuentes</h2>
                <ul class="guide-navigation__list">
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon1.png') }}" alt="How to get to Pucon" class="guide-navigation__icon">
                            Como chegar a Pucón
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link guide-navigation__link_active">
                            <img src="{{ asset('/images/guide-icon4.png') }}" alt="Shops and Services" class="guide-navigation__icon">
                            Lojas e Serviços
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon7.png') }}" alt="Transportation" class="guide-navigation__icon">
                            Transportes
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon2.png') }}" alt="Summer and winter" class="guide-navigation__icon">
                            Verao e Inverno
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon5.png') }}" alt="Where sleep" class="guide-navigation__icon">
                            Onde dormir
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon8.png') }}" alt="Night life" class="guide-navigation__icon">
                            Vida noturna
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon3.png') }}" alt="City and Zones" class="guide-navigation__icon">
                            Ciudad y Zonas
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon6.png') }}" alt="What to eat" class="guide-navigation__icon">
                            Que comer
                        </a>
                    </li>
                    <li class="guide-navigation__item">
                        <a href="" class="guide-navigation__link">
                            <img src="{{ asset('/images/guide-icon9.png') }}" alt="Money" class="guide-navigation__icon">
                            Dinheiro
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main id="main">
            <div class="container">
                <!-- Subpage -->
                @yield('subpage')
                <!-- ./ subpage -->
            </div>
        </main>

        <div class="container">

            <div class="comments-block">

                <header class="comments-block__header">
                    {{--<div class="comments-block__titles @if (auth()->user()) comments-block__titles_registered @endif">--}}
                    <div class="comments-block__titles">
                        <h3 class="comments-block__title">{{ trans('main.ask') }}</h3>
                        <p class="comments-block__description">{{ trans('main.you_should_be_registered') }}</p>
                    </div>
                    {{--<form id="comments-block__form" data-answerText="{{ trans('button-links.answer') }}" class="comments-block__form" action="{{ action('ActivityController@addComment') }}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<textarea class="comments-block__textarea" name="message" id="message" rows="3"></textarea>--}}
                        {{--<input type="hidden" value="" name="comment_id">--}}
                        {{--<input type="hidden" value="{{ $activity->id }}" name="activity_id">--}}
                        {{--<button type="submit" class="btn btn-dark-blue comments-block__send-button">{{ trans('main.send') }}</button>--}}
                    {{--</form>--}}
                    <a href="{{ url('/login') }}" class="btn btn-dark-blue comments-block__enter-button">{{ trans('button-links.login') }}</a>
                </header>

                <ul class="comments-block__comments">

                    <li class="comments-block__comment">
                        <header class="comments-block__comment-header">
                            <img src="{{ asset('/uploads/users/wiJdG1481622645x2qJA.jpg') }}" alt="User name" class="comments-block__user-image">
                            <strong class="comments-block__user-name">Orlando Bloom</strong>
                            <span class="comments-block__date">01.01.1999</span>
                            <a href="22" class="comments-block__answer-button">{{ trans('button-links.answer') }}</a>
                        </header>
                        <p class="comments-block__text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores cumque dicta enim id ipsa itaque laudantium placeat soluta velit vitae! Delectus dignissimos dolore dolores nesciunt nostrum numquam perferendis saepe voluptatum. </p>
                    </li>

                    <li class="comments-block__comment comments-block__comment_answer">
                        <p class="comments-block__text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolorem eos ex fuga impedit incidunt, ipsum iste libero minima modi nam obcaecati omnis perspiciatis quibusdam quos soluta temporibus totam ut. </p>
                    </li>

                </ul>

            </div>

        </div>

    </div>

@stop