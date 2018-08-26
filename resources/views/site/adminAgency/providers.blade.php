@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="under-header"></div>
    <div class="container-fluid">

        <div id="providersTable"></div>
        <div class="providerTypes">
            <div class="row">
                <div class="col-sm-2 col-xs-5 text-center">
                   <div class="tipo">
                       <p>Tipo:</p>
                       <ul>
                           <li><span class="deleteProvider"></span> Guia </li>
                           <li><span class="deleteProvider"></span> Asistentes </li>
                           <li><span class="deleteProvider"></span> Transportista </li>
                       </ul>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-xs-5 text-center">
                    <button type="button" class="btn btn-success addProviderType"> Adicionar </button>
                </div>
            </div>
        </div>
    </div>


@stop

<script type="text/javascript">
    const providersTableData = JSON.parse('{!! json_encode($providers) !!}');
</script>