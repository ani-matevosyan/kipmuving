@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Lojas e Serviços</h1>
        <p class="guide-content__paragraph">As principais zonas de comércio na cidade são a <strong>Avenida O’Higgins</strong>, assim como as ruas <strong>Ansorena, Fresia, Palguín, Alderete e Urrutia</strong>.</p>
        <p class="guide-content__paragraph">Além de super e mini mercados, existem várias lojas de roupa e artigos desportivos, assim como de produtos eletrônicos. Há também lojas de artesanato local, onde pode comprar “recuerdos” de Pucón, para levar de volta para casa. O comércio local funciona entre as <strong>09 e as 20 horas</strong>, mas várias lojas fecham para a "siesta" depois do almoço.</p>
        <p class="guide-content__paragraph">Na cidade há ainda vários serviços úteis, como o Hospital San Francisco Pucón, farmácias, lavandarias e um oficina para automóveis.</p>
        <img src="{{ asset('/images/guide-markets-image1.jpg') }}" alt="Shops and Services" class="guide-content__image">
    </section>

@stop