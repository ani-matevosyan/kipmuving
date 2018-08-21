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
                        <p><b>Valor: </b> {{ $activity->price }}</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                @foreach($activity->hours as $hour)
                                   <div>{{ $hour->start_time }} a {{ $hour->end_time }}</div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div>
                                @php ($resultStr = array())
                                @foreach($activity->providers->where('type','1') as $provider)
                                    @php ($resultStr[] = $provider->first_name . ' '.$provider->last_name )
                                @endforeach
                                {{ implode(", ", $resultStr) }}
                            </div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div>
                                @php ($resultStr = array())
                                @foreach($activity->providers->where('type','2') as $provider)
                                    @php ($resultStr[] = $provider->first_name . ' '.$provider->last_name )
                                @endforeach
                                {{ implode(", ", $resultStr) }}
                            </div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div>
                                @php ($resultStr = array())
                                @foreach($activity->providers->where('type','3') as $provider)
                                    @php ($resultStr[] = $provider->first_name . ' '.$provider->last_name )
                                @endforeach
                                {{ implode(", ", $resultStr) }}
                            </div>
                        </div>
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
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="name" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Valor</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="price" class="form-control" id="price" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Horario</label>
                                    <div class="col-sm-9 times">
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
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Guia</label>
                                    <div class="col-sm-9">
                                        <select name="providers[]" class="select2select" multiple="multiple">
                                            @foreach($providers->where('type','1') as $provider)
                                                <option value="{{$provider->id}}">
                                                    {{ $provider->first_name }} {{ $provider->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Asistentes</label>
                                    <div class="col-sm-9">
                                        <select name="providers[]"class="select2select" multiple="multiple">
                                            @foreach($providers->where('type','2') as $provider)
                                                <option value="{{$provider->id}}">
                                                    {{ $provider->first_name }} {{ $provider->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Transportista</label>
                                    <div class="col-sm-9">
                                        <select name="providers[]" class="select2select" multiple="multiple">
                                            @foreach($providers->where('type','3') as $provider)
                                                <option value="{{$provider->id}}">
                                                    {{ $provider->first_name }} {{ $provider->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Minimo</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="min_persons" class="form-control min">
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
@stop