@extends('site.layouts.default-new')

{{-- Content --}}
@section('content')
    <main id="main">
        <section class="s_about_page visual">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ action('HomeController@index') }}">{{ trans('main.home') }}</a></li>
                    <li><a href="{{ action('AboutController@index') }}">Quien Somos</a></li>
                </ul>
                <div class="about_content">
                    <p><strong>KipMuving</strong> surgio de la necesidad de ofrecer al visitante de Pucon, mejores opcion de eleccion de la agencia de turismo y
                        tambien ampliar sus posibilidades de paseos en la ciudad. Por medio de convenios con las agencias, podemos beneficios:</p>
                    <ul>
                        <li>
                            <img src="images/about_icon1.png" alt="Discount" class="item-icon">
                            <strong>Descuento de 10% </strong><br>
                            sobre cada actividad
                        </li>
                        <li>
                            <img src="images/about_icon2.png" alt="Discount" class="item-icon">
                            <strong>Facilitad de encontrar</strong> todas las agencias <br>
                            y actividades en un mismo lugar
                        </li>
                        <li>
                            <img src="images/about_icon3.png" alt="Discount" class="item-icon">
                            <strong>Armar un panorama completo</strong> <br>
                            en la ciudad y programar su viaje
                        </li>
                    </ul>
                    <p>Y para la agencia, los beneficios son:</p>
                    <ul>
                        <li>
                            <img src="images/about_icon4.png" alt="Discount" class="item-icon">
                            <strong>Mayor visibilidad</strong>
                        </li>
                        <li>
                            <img src="images/about_icon5.png" alt="Discount" class="item-icon">
                            <strong>Mejor competitividad,</strong> independiente de la <br>
                            localizacion fisica, y si por la calidad del servicio y precio
                        </li>
                    </ul>
                    <p>Asi <strong>KipMuving</strong> urge para suplir una necesidad del sector de aventuras, donde el usuario
                        <br> tiene mas opciones y las agencias mas visibilidad.  Y el usuario apenas colabora con 3% del
                        <br>
                        valor total de sus actividades. Esto sirve para cubrir gastos y seguir mejorando la aplicacion web.</p>
                </div>
            </div>
        </section>
    </main>
@stop