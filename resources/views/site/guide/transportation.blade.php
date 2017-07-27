@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Transportes na Cidade</h1>
        <p class="guide-content__paragraph">Pucón é uma cidade pequena e o <strong>centro da cidade é facilmente acessível a pé</strong>, podendo em poucos minutos chegar nas principais ruas da cidade (O´Higgins, Fresia, Ansorena e Lincoyan). Não existe ônibus dentro da cidade, mas se preferir, existe um serviço de coletivos (táxis compartilhados) para distâncias menores dentro da cidade, que custa menos de <strong>U$ 1 por pessoa</strong>, por trajeto. Mais recentemente chegou <strong>Uber na cidade</strong>. Pode também utilizar os táxis, que são naturalmente mais caros, pelo menos <strong>U$ 3</strong> por uma corrida dentro da cidade. Uma outra opção é alugar um carro. As principais companhias de aluguel têm estações em Pucón, mas é recomendável reservar com antecedência.</p>
        <p class="guide-content__paragraph">Para visitar outras cidades perto de Pucón, como <strong>Villarrica e Caburgua</strong>, é possível utilizar o <strong>micro-ônibus</strong>, que parte da <strong>Calle Uruguay, 540</strong>, no centro da cidade.</p>
        <p class="guide-content__paragraph">Grande parte das atrações naturais da região não estão localizadas perto do centro. É por isso que todos os nossos programas incluem transporte de ida e volta para a atividade, para que não tenha que se preocupar com mais nada a não ser desfrutar.</p>
        <img src="{{ asset('/images/guide-transportation1.jpg') }}" alt="Transportation" class="guide-content__image">
    </section>

@stop