@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Como chegar a Pucón</h1>
        <p class="guide-content__paragraph">Pucón está a cerca de <strong>785 km a sul de Santiago</strong>, capital do Chile, e a 109 km de Temuco. Pode chegar na cidade por:</p>
        <h2 class="guide-content__sub-title">1) Avião</h2>
        <p class="guide-content__paragraph">Pucón tem o seu próprio aeroporto, com conexão a <strong>Santiago e Concepción</strong> que funcionam apenas no verão, de dezembro a janeiro. Todavia, o aeroporto de Temuco oferece conexões mais frequentes de voos, ônibus e transfer, e acaba sendo uma melhor opção.
        </p>
        <p class="guide-content__paragraph">Para os estrangeiros, a melhor alternativa seria voar para Santiago e aí pegar o avião para Temuco, com a companhia <strong>Sky Airlines ou LATAM</strong>.</p>
        <p class="guide-content__paragraph">Em Temuco, as opções para chegar em Pucón são várias: pode utilizar <strong>táxis</strong>, o método mais caro (cerca de U$ 90), devido à longa distância de cerca de 100 km; pode contratar um <strong>transfer</strong> no aeroporto, que custa U$ 18 por pessoa se compartilhar com um mínimo de 4 pessoas; ou pode ainda pegar um táxi no aeroporto <strong>até ao terminal rodoviário</strong> JAC de Temuco (Avda. Balmaceda Nº 1005, cerca de 25 km), de onde saem regularmente ônibus em direção a Pucón. Esta será a alternativa mais barata, pois a tarifa normal custa U$ 4. Porém, esta é também a opção mais demorada, porque precisa ir no centro da cidade de Temuco e depois voltar pela mesma estrada até Pucón. Do aeroporto até Temuco, o ônibus demora em torno de 40 minutos. De Temuco até Pucón demora 2 horas, totalizando quase 3 horas do aeroporto até Pucón.</p>
        <p class="guide-content__paragraph">Em Pucón, a forma mais fácil de chegar em seu hotel será a <strong>pé ou de táxi</strong>, já que a cidade é muito pequena e os terminais de ônibus estão bem no centro da cidade. A tarifa do taxi para qualquer lugar dentro do centro é de U$ 3.</p>
        <img src="{{ asset('/images/guide-how-to-get-image1.jpg') }}" alt="Airport" class="guide-content__image">
        <h2 class="guide-content__sub-title">2) Carro</h2>
        <p class="guide-content__paragraph">Uma outra forma de viajar até Pucón é dirigindo. Desde Santiago, o percurso <strong>é de 800 km</strong>, feito pela Ruta 5 Sur. A estrada tem muito boas condições para dirigir, mas considere não só o custo do aluguel do carro e do combustível, mas também os <strong>pedágios</strong>, que custarão no total cerca de <strong>U$ 26</strong>.</p>
        <img src="{{ asset('/images/guide-how-to-get-image2.jpg') }}" alt="Road" class="guide-content__image">
        <h2 class="guide-content__sub-title">3) Ônibus</h2>
        <p class="guide-content__paragraph">Partindo de Santiago, é também possível pegar um ônibus direto para Pucón, com as companhias <strong>JAC, Turbus, Pullman, Andesmar ou Condor</strong>. A viagem demora <strong>10 horas</strong> e tem um custo entre <strong>U$ 23 e U$ 75</strong>, dependendo de vários fatores como o tipo de assento. Há saídas de manhã e de noite, mas devido à longa duração da viagem, <strong>é recomendável viajar de noite</strong>. </p>
        <p class="guide-content__paragraph">As passagens teriam que ser compradas diretamente no terminal de ônibus no dia da sua viagem, porém normalmente encontra passagens com facilidade. </p>
        <img src="{{ asset('/images/guide-how-to-get-image3.jpg') }}" alt="Bus station" class="guide-content__image">
    </section>

@stop