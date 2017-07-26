@extends('site.layouts.default-new')

@section('content')

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

@stop