@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    <main id="main">
        <section class="s_about_page">
            <div class="container">
                <div class="about_content">
                    <p><strong>KeepMoving</strong>{{ trans('main.emerged_from_the_need') }}</p>
                    <ul>
                        <li>
                            <img src="{{ asset('images/target.svg') }}" alt="Target" class="item-icon">
                            <strong>{{ trans('main.easy_to_find') }}</strong>{{ trans('main.all_agencies_and') }}
                        </li>
                        <li>
                            <img src="{{ asset('images/list.svg') }}" alt="List" class="item-icon">
                            <strong>{{ trans('main.build_complete_panorama') }}</strong>{{ trans('main.in_the_city_and') }}
                        </li>
                    </ul>
                    <p>{{ trans('main.and_for_the_agency') }}</p>
                    <ul>
                        <li>
                            <img src="{{ asset('images/creativity.svg') }}" alt="Creativity" class="item-icon">
                            <strong>{{ trans('main.high_visibility') }}</strong>
                        </li>
                        <li>
                            <img src="{{ asset('images/strength.svg') }}" alt="Strength" class="item-icon">
                            <strong>{{ trans('main.better_competitiveness') }}</strong>{{ trans('main.independent_of_location') }}
                        </li>
                    </ul>
                    <p>{{ trans('main.so') }}<strong>KeepMoving</strong>{{ trans('main.urges_to_meet') }}</p>
                    <div class="whosmaking">
                        <p>{{ trans('main.who_made') }}<strong>KeepMoving</strong>:</p>
                        <ul>
                            <li>
                                <img src="{{ asset('images/rafael_zarro.jpg') }}" alt="Rafael Zarro">
                                <strong>Rafael Zarro</strong> - {{ trans('main.creator_and_designer') }}
                            </li>
                            <li>
                                <img src="{{ asset('images/solodovnikow.jpg') }}" alt="Oleksandr Solodovnikov">
                                <strong>Oleksandr Solodovnikov</strong> - {{ trans('main.developer') }}
                            </li>
                            <li>

                                <img src="{{ asset('images/liapota.jpg') }}" alt="Hlib Liapota">
                                <strong>Hlib Liapota</strong> - {{ trans('main.developer') }}
                            </li>
                        </ul>
                    </div>
                    <p class="credits">{{ trans('main.credits') }}: <a target="_blank" href="http://flaticon.com/">http://flaticon.com/</a></p>
                </div>
            </div>
        </section>
    </main>
@stop