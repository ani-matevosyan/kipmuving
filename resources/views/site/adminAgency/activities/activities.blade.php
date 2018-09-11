@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="under-header">
        <button class="btn btn-success addActivity">Adicionar Actividad</button>
    </div>
    <div class="container-fluid">
        <div class="activities">
            <div class="row col-container">
                @foreach($activities as $activity)
                    <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>{{ $activity->name }}</h3>
                        <p><b>Valor: </b> {{ number_format($activity->price, 0, ",", ".")}}</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                @foreach($activity->hours as $hour)
                                   <div>{{ $hour->start_time }} a {{ $hour->end_time }}</div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        @foreach($providerTypes as $type)
                            @php($thisTypeProviders = $activity->providers->where('type', $type->id))
                            @if(count($thisTypeProviders) > 0)
                                <div class="info">
                                    <div><b>{{ ucfirst($type->name) }}: </b></div>
                                    <div>
                                        @php ($resultStr = array())
                                        @foreach($thisTypeProviders as $provider)
                                            @php ($resultStr[] = $provider->first_name . ' '.$provider->last_name )
                                        @endforeach
                                        {{ implode(", ", $resultStr) }}
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="edit-activity">
                            <div class="edit-activity-icon"  activity_id="{{ $activity->id }}">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="addActivityModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Actividad</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal addActivityForm" action="/action_page.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Nombre</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" id="name" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Valor</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control priceString" id="price" >
                                        <input type="hidden" name="price" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Horario</label>
                                    <div class="col-sm-8 times">
                                        <div class="timesHours">
                                            <div class="col-sm-4">
                                                <input type="text" name="start_time[]" class="form-control start_time">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="end_time[]" class="form-control end_time">
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="operations">
                                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group minPersons">
                                    <label class="control-label col-xs-5" for="min">Mínimo de personas</label>
                                    <div class="col col-xs-3 ">
                                        <input type="text" name="min_persons" class="form-control" id="min">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h5>Proveedores</h5>
                                </div>
                                <div class="providers row">
                                    <div class="col-sm-5 type">
                                        <select name="providerTypes" class="form-control">
                                            <option value="0">
                                                Seleccione
                                            </option>
                                            @foreach($providerTypes as $type)
                                                <option value="{{$type->id}}">
                                                    {{ ucfirst($type->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5 provider">
                                    </div>
                                    <div class="col-sm-2 operationsCol">
                                        <div class="operations">
                                            <span class="glyphicon glyphicon-plus-sign"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success addActivity"> Adicionar </button>
                </div>
            </div>
        </div>
    </div>
    <div class="editActivityModal"></div>

    <div id="deleteActivityOkModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Por favor confirmar</h4>
                </div>
                <div class="modal-body">
                    <p>¿De verdad quieres eliminar la actividad <span id="activityNameSpan"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger deleteActivityOkBtn"> Sí  </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        const providerTypes = JSON.parse('{!! json_encode($providerTypes) !!}');
        const providers = JSON.parse('{!! json_encode($providers) !!}');
    </script>

@stop