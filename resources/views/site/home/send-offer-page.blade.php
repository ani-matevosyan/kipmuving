@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')

    <main id="main">

        <div class="container">

            <section class="s-send-special-offer">
                <header class="special-offer-header s-send-special-offer__header">
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
                        <div class="pick-discount special-offers-list__pick-discount">
                            <p class="pick-discount__info">{{ trans('main.send_special_offer') }} {{ trans('main.with_discount_at') }} <strong>16/12/2017:</strong></p>
                            <ul class="pick-discount__list">
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button pick-discount__button_yellow">5%</a>
                                    <span class="pick-discount__end-price">$ 342.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button pick-discount__button_orange">10%</a>
                                    <span class="pick-discount__end-price">$ 324.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button pick-discount__button_red">15%</a>
                                    <span class="pick-discount__end-price">$ 306.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button pick-discount__button_purple">20%</a>
                                    <span class="pick-discount__end-price">$ 288.000</span>
                                </li>
                            </ul>
                            <span class="pick-discount__or-divider">{{ trans('main.or') }}</span>
                            <form class="pick-discount__form">
                                <input type="text" class="pick-discount__price-input" placeholder="{{ trans('main.total_price') }}">
                                <button class="price-discount__submit">OK</button>
                            </form>
                        </div>
                    </li>
                    <li class="special-offers-list__item">
                        <h2 class="special-offers-list__title">Volcán Villarrica</h2>
                        <ul class="special-offers-list__info-list">
                            <li class="special-offers-list__info-item"><strong>Date:</strong> 18/12/2017</li>
                            <li class="special-offers-list__info-item"><strong>Persons:</strong> 3</li>
                            <li class="special-offers-list__info-item"><strong>Your price:</strong> $ 120.000</li>
                            <li class="special-offers-list__info-item"><strong>Total:</strong> $ 360.000</li>
                        </ul>
                        <div class="pick-discount">
                            <p class="pick-discount__info">{{ trans('main.send_special_offer') }} {{ trans('main.with_discount_at') }} <strong>16/12/2017:</strong></p>
                            <ul class="pick-discount__list">
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button">5%</a>
                                    <span class="pick-discount__end-price">$ 342.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button">10%</a>
                                    <span class="pick-discount__end-price">$ 324.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button">15%</a>
                                    <span class="pick-discount__end-price">$ 306.000</span>
                                </li>
                                <li class="pick-discount__item">
                                    <a href="#" class="pick-discount__button">20%</a>
                                    <span class="pick-discount__end-price">$ 288.000</span>
                                </li>
                            </ul>
                            <span class="pick-discount__or-divider">{{ trans('main.or') }}</span>
                            <form class="pick-discount__form">
                                <input type="text" class="pick-discount__price-input" placeholder="{{ trans('main.total_price') }}">
                                <button class="price-discount__submit">OK</button>
                            </form>
                        </div>
                    </li>
                </ul>

            </section>

        </div>
    </main>

@stop