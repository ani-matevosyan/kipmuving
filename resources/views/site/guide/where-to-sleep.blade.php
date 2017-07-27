@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Onde dormir</h1>
        <p class="guide-content__paragraph">Apesar de ser uma cidade pequena, há muitos hóteis em Pucón. A escolha do local de hospedagem depende do tipo de viajante e do tipo de experiência que está buscando. Pode encontrar desde hotéis de <strong>5 estrelas, a “Bed&Breakfasts”, cabanas ou hostels</strong>, no centro da cidade, na beira do lago ou na montanha.</p>
        <p class="guide-content__paragraph">Qualquer que seja sua escolha, o importante é que considere o transporte que vai usar durante a sua estadia na cidade. Se planejar se deslocar a pé, é mais prático se hospedar no centro da cidade, pois todo o comércio e serviços estão próximos. Se alugar um carro e tiver mais autonomia para se deslocar, será mais fácil usufruir de uma hospedagem na montanha.</p>
        <img src="{{ asset('/images/guia-where-to-sleep.jpg') }}" alt="Where to sleep" class="guide-content__image">
    </section>

@stop