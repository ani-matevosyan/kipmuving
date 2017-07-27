@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Cidade e Zona</h1>
        <p class="guide-content__paragraph">Pucón está localizado na região de <strong>Araucanía</strong>, no sul do Chile, na beira do lago Villarica e perto da base do Vulcão com o mesmo nome. Em volta da cidade há também vários parques naturais, rios e cachoeiras, que oferecem a possibilidade de praticar diferentes atividades.</p>
        <p class="guide-content__paragraph">O pequeno centro urbano da cidade pode ser <strong>percorrido a pé</strong>, admirando a arquitectura interessante, uma mistura das tradições da etnia mapuche e a forte influência dos colonos alemães que chegaram na zona no século XIX.</p>
        <p class="guide-content__paragraph"><strong>A Playa Grande</strong> é uma praia de água doce cristalina e areia negra con pequenas pedras vulcânicas, que atrai turistas e locais pela sua tranqüilidade e linda vista. Perto do centro, a zona de <strong>La Poza</strong>, oferece também um passeio e vistas agradáveis, juntos de um pitoresco porto de lanchas.</p>
        <img src="{{ asset('/images/guia-city-and-zones.jpg') }}" alt="City and Zones" class="guide-content__image">
    </section>

@stop