@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="reservetionsTable">
            {!! $reservationsTable !!}
        </div>
    </div>


@stop