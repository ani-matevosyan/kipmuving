@extends('site.guide.layout')

{{-- Subpage --}}
@section('subpage')

    <section class="guide-content">
        <h1 class="guide-content__title">Vida noturna</h1>
        <p class="guide-content__paragraph">Pucón é uma cidade pequena e apesar de receber anualmente muito movimento turístico, a vida noturna da cidade não é tão animada como de dia. No inverno não encontrará o mesmo movimento nas ruas que no verão, altura em que o sol se põe mais tarde e por isso mais gente sai para a rua mais tarde. </p>
        <p class="guide-content__paragraph">Se quiser sair para tomar um drink depois de jantar, há vários bares e pubs na cidade. O mais conhecido é talvez o <strong>Mamas & Tapas, na Avenida O’Higgins</strong>, um pub rústico onde pode dançar e conhecer gente nova. Mesmo ao lado, no <strong>Black Forest</strong>, pode assistir música ao vivo, uma forma diferente de passar sua noite.</p>
        <p class="guide-content__paragraph">Para quem quer dançar e curtir a noite, o melhor local é a Mambo Discotheque, um club com ambiente legal, que reúne turistas e locais. A Discotheque Sala Murano, na Pasaje de Las Rosas, fica mais perto do centro da cidade e é também uma opção com bom ambiente.</p>
        <img src="{{ asset('/images/guia-nightlife.jpg') }}" alt="Night Life" class="guide-content__image">
    </section>

@stop