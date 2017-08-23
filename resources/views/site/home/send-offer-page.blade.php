@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')

    <main id="main">

        <div class="container">

            <section class="s-send-special-offer">
                <header class="special-offer-header">
                    <h1 class="special-offer-header__title">{{ trans('main.send_special_offer') }}</h1>
                    <p class="special-offer-header__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea eaque minus quos sequi. Debitis deleniti deserunt distinctio ducimus eum explicabo pariatur quaerat vitae! Dolores earum neque perferendis veniam voluptas. Nam.</p>
                </header>

                <ul class="special-offers-list">
                    <li class="special-offers-list__item">
                        <h2 class="special-offers-list__title">Volcán Villarrica</h2>
                        <ul class="special-offers-list__info-list">
                            <li class="special-offers-list__info-item"><strong>Date:</strong> 18/12/2017</li>
                            <li class="special-offers-list__info-item"><strong>Persons:</strong> 3</li>
                            <li class="special-offers-list__info-item"><strong>Your price:</strong> $ 120.000</li>
                            <li class="special-offers-list__info-item"><strong>Total:</strong> $ 360.000</li>
                        </ul>

                    </li>
                </ul>

            </section>

        </div>
    </main>

@stop