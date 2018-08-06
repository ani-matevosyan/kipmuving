@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="under-header"></div>
    <div class="container-fluid">
        <div class="reservationsTable">
            <div class="resTable">
                <div class="rTable">
                    {!! $reservationsTable !!}
                </div>
            </div>
            <div class="totalPrice">
                <div class="price">Total Venta:</div>
            </div>
            <div class="hasMinPersons">
                <div class="confirmed">
                    <div class="square"></div>
                    <span>Confirmado</span>
                </div>
                <div class="notYetMin">
                    <div class="square"></div>
                    <span>No hay el mínimo</span>
                </div>
            </div>
        </div>
    </div>


@stop