@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    <section class="visual activities-all" style="background-image: url({{ url('/images/img0'.$imageIndex.'.jpg') }})">
        <div class="gradoverlay"></div>
    </section>
    <section>
        <div class="container">
            {{--<div class="row">--}}
            {{--<div class="col-xs-12">--}}
            {{--<ul class="breadcrumb">--}}
            {{--<li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>--}}
            {{--<li><a href="{{ action('ActivityController@index') }}">{{ trans('button-links.activities') }}</a></li>--}}
            {{--</ul>--}}
            <div class="your-reservation activity add all-activities" style="padding-bottom: 0px;">
                @include('site.offers.offers_quickinfo')
                <div class="tenprocent">
                    em todos <br>
                    os precos
                </div>
            </div>
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="all-activities new all-activities-header">--}}
            {{--<header>--}}
            {{--<h1>{{ trans('main.all_activities_in_pucon') }}</h1>--}}
            {{--<p>{{ trans('main.below_you_will_find_all_the_activities') }}</p>--}}
            {{--</header>--}}
            {{--</div>--}}
        </div>
    </section>
    <!--Slider section-->
    <section id="first-slider-sec" class="csHidden">
        <div class="container">
            <header>
                <h2>{{ trans('main.the_most_requested') }}</h2>
                <p>{{ trans('main.below_are_the_activities') }}</p>
            </header>
            <div class="col-xs-12">
                <div id="cpa-slider-1">
                    <div class="item">
                        <a href="/activity/10">
                            <img src="{{ asset('/uploads/activity/_nAqlH-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Termas Geométricas"/>
                            <h3>Termas Geométricas</h3>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activity/3">
                            <img src="{{ asset('/uploads/activity/_GmaWx-VolcánVillarrica_mini.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Trekking Volcán Villarrica"/>
                            <h3>Trekking Volcán Villarrica</h3>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activity/5">
                            <img src="{{ asset('/uploads/activity/_zNYN9-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Rafting Alto"/>
                            <h3>Rafting Alto</h3>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activity/2">
                            <img src="{{ asset('/uploads/activity/_kpEoA-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Rafting Bajo"/>
                            <h3>Rafting Bajo</h3>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/activity/4">
                            <img src="{{ asset('/uploads/activity/_ERPJI-2.jpg') }}" onerror="this.src='/images/image-none.jpg';" alt="Tour por la zona + Termas"/>
                            <h3>Tour por la zona + Termas</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Slider section-->
    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="all-activities new">

                        <div class="activites-bar">
                            <div class="activities-panel">
                                <div id="floatdiv" class="floatdiv">
                                    <ul class="activities-list">
                                        <li>
                                            <a href="#trekking" class="green">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-treking.svg') }}" alt="image description"
                                                         width="33" height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico16.png'">
                                                </div>
                                                <strong>{{ trans('main.trekking') }}</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#rio" class="orange">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-rio.svg') }}" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico17.png'">
                                                </div>
                                                <strong>{{ trans('main.river') }}</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#aire" class="blue">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-aire.svg') }}" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico18.png'">
                                                </div>
                                                <strong>{{ trans('main.action') }}</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#relax" class="sky-blue">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-relax.svg') }}" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico19.png'">
                                                </div>
                                                <strong>{{ trans('main.relax') }}</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#nieve" class="violet">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-nieve.svg') }}" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico20.png'">
                                                </div>
                                                <strong>{{ trans('main.snow') }}</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#familia" class="red">
                                                <div class="ico">
                                                    <img src="{{ asset('/images/ico-family.svg') }}" alt="image description" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='/images/ico30.png'">
                                                </div>
                                                <strong>{{ trans('main.cultural') }}</strong>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="activities-info" id="activities-info">
                                    <p><strong>{{ trans('main.iconography') }}</strong></p>
                                    <ul>
                                        <li class="active">
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="{{ asset('images/day.svg') }}" alt="day icon" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='images/ico16.png'">
                                                </div>
                                                <p>{{ trans('main.day_activity') }}</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="{{ asset('images/night.svg') }}" alt="night icon" width="33"
                                                         height="33"
                                                         onerror="this.onerror=null; this.src='images/ico17.png'">
                                                </div>
                                                <p>{{ trans('main.night_activity') }}</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img class="down-arrow-icon" src="{{ asset('images/down-arrow.svg') }}" alt="arrow down icon" width="25"
                                                         height="25"
                                                         onerror="this.onerror=null; this.src='images/ico18.png'">
                                                </div>
                                                <p>{{ trans('main.march_to_november') }}</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="ico">
                                                    <img src="{{ asset('images/up-arrow.svg') }}" alt="arrow up icon" width="25"
                                                         height="25"
                                                         onerror="this.onerror=null; this.src='images/ico19.png'">
                                                </div>
                                                <p>{{ trans('main.december_to_march') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- <nav class="subnav">
                                      <ul>
                                                 <li><a href="#">Ordenar por</a></li>
                                                 <li class="active"><a href="#">Recomendacion</a></li>
                                                 <li><a href="#">Precio más alto</a></li>
                                                 <li><a href="#">Gratuito</a></li>
                                      </ul>
                            </nav> -->
                        </div>

                        @if(count($activities->where('styles', 'Trekking')) > 0)
                            <section class="activity-block" id="trekking">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/Trekking.svg') }}"
                                         alt="image description"
                                         width="40"
                                         height="40"
                                         onerror="this.onerror=null; this.src='/images/ico21.png'">
								</span>
                                    {{ trans('main.trekking') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Trekking') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                        @if(count($activities->where('styles', 'Rio')) > 0)
                            <section class="activity-block rio" id="rio">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/kayak.svg') }}"
                                         alt="image description"
                                         width="40"
                                         height="40"
                                         onerror="this.onerror=null; this.src='/images/ico22.png'">
								</span>
                                    {{ trans('main.river') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Rio') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                        @if(count($activities->where('styles', 'Aire')) > 0)
                            <section class="activity-block aire" id="aire">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/aire.svg') }}"
                                         alt="image description"
                                         width="33"
                                         height="33"
                                         onerror="this.onerror=null; this.src='/images/ico23.png'">
								</span>
                                    {{ trans('main.action') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Aire') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                        @if(count($activities->where('styles', 'Relax')) > 0)
                            <section class="activity-block relax" id="relax">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/relax.svg') }}"
                                         alt="image description"
                                         width="33"
                                         height="33"
                                         onerror="this.onerror=null; this.src='/images/ico24.png'">
								</span>
                                    {{ trans('main.relax') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Relax') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                        @if(count($activities->where('styles', 'Nieve')) > 0)
                            <section class="activity-block nieve" id="nieve">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/skiing_ski_running.svg') }}"
                                         alt="image description"
                                         width="33"
                                         height="33"
                                         onerror="this.onerror=null; this.src='/images/ico25.png'">
								</span>
                                    {{ trans('main.snow') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Nieve') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                        @if(count($activities->where('styles', 'Familia')) > 0)
                            <section class="activity-block familia" id="familia">
                                <strong class="heading">
								<span>
									<img src="{{ asset('/images/family.svg') }}"
                                         alt="image description"
                                         width="33"
                                         height="33"
                                         onerror="this.onerror=null; this.src='/images/ico25.png'">
								</span>
                                    {{ trans('main.cultural') }}
                                </strong>
                                <div class="row">
                                    <?php $key_for_4_col = 0; $key_for_3_col = 0; ?>
                                    @foreach ($activities->where('styles', 'Familia') as $activity)
                                        <div class="col-md-3 col-sm-4 col-xs-12 col">
                                            @include('site.partials.activities.all-list-item')
                                        </div>
                                        <?php ++$key_for_4_col; ++$key_for_3_col; ?>
                                        @if($key_for_4_col ===4 )
                                            <div class="clearfix visible-lg-block"></div>
                                            <div class="clearfix visible-md-block"></div>
                                            <?php $key_for_4_col = 0; ?>
                                        @endif
                                        @if($key_for_3_col ===3 )
                                            <div class="clearfix visible-sm-block"></div>
                                            <?php $key_for_3_col = 0; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
