@extends('site.layouts.default-new')

@section('content')

    <main id="main">
        <header class="guide-header">
            <h2 class="guide-header__title">Preguntas Frecuentes</h2>
            <nav class="guide-header__navigation">
                <ul class="guide-header__navigation-list">
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Como chegar a Pucón
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link guide-header__navigation-link_active">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Lojas e Serviços
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Transportes
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Verao e Inverno
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Onde dormir
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Vida noturna
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Ciudad y Zonas
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Que comer
                        </a>
                    </li>
                    <li class="guide-header__navigation-item">
                        <a href="" class="guide-header__navigation-link">
                            <img src="https://d2si0b2wb4t75n.cloudfront.net/assets/safari-pin-icon-1d550476a108d421232f49039844e035.svg" alt="" class="guide-header__icon">
                            Dinheiro
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Subpage -->
        @yield('subpage')
        <!-- ./ subpage -->

    </main>

@stop