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
                                    <li><span class="deleteProviderTypeBtn" provider-type-id="{{ $type->id }}"></span> {{ $type->name }} </li>
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

    <div id="addProviderModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Datos personales</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal addProviderForm" action="/action_page.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="name" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Pais</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="country" class="form-control" id="country">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Ciudad</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="city" class="form-control" id="city">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Dirección</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" id="address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="identity" class="form-control" id="identity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Teléfono</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" id="phone" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Tipo</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="type form-control">
                                            @foreach($providerTypes as $item)
                                                <option value="{{$item->id}}">
                                                    {{ ucfirst($item->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group comment">
                                    <label class="control-label col-sm-2" for="pwd">Comentario</label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" class="form-control" id="comment" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal providerActivitiesForm" action="/action_page.php">
                        <div class="activities">
                            <p>Actividades</p>
                            <div class="row activity">
                                <div class="col-sm-4">
                                    <select name="activities[]" class="activity form-control">
                                        @foreach($activities as $item)
                                            <option value="{{$item->id}}">
                                                {{ ucfirst($item->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="prices[]" class="form-control " placeholder="Valor">
                                </div>
                                <div class="col-sm-2">
                                    <div class="operations">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                        {{--<span class="glyphicon glyphicon-remove"></span>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success addProviderBtn">Adicionar </button>
                </div>
            </div>
        </div>
    </div>

    <div class="editProviderModal"></div>
    
    <div id="deleteProviderOkModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Por favor confirmar</h4>
                </div>
                <div class="modal-body">
                    <p> ¿De verdad quiere eliminar proveedor <span id="providerNameSpan"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger deleteProviderOkBtn"> Sí  </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                </div>
            </div>
        </div>
    </div>


@stop

<script type="text/javascript">
    const providersTableData = JSON.parse('{!! json_encode($providers) !!}');
    const activities = JSON.parse('{!! json_encode($activities) !!}');
</script>