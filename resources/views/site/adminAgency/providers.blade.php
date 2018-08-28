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
                           @if( count($providerTypes) > 0 )
                               @foreach($providerTypes as $type )
                                    <li><span class="deleteProvider"></span> {{ $type->name }} </li>
                               @endforeach
                           @endif
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

    <div id="addProviderTypeModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Adicionar tipo</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="text" name="provider_type" class="form-control providerType">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success addProviderTypeBtn">Adicionar </button>
                </div>
            </div>
        </div>
    </div>


@stop

<script type="text/javascript">
    const providersTableData = JSON.parse('{!! json_encode($providers) !!}');
</script>