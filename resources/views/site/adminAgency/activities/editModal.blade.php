<div id="editActivityModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actividad</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal editActivityForm" action="/action_page.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{  $activity->name }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Valor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" class="form-control" id="price" value="{{  $activity->price }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Horario</label>
                                <div class="col-sm-9 times">

                                    @if(count($activity->hours) >= 1)
                                        <div class="timesHours">
                                            <div class="col-sm-4">
                                                <input type="text" name="start_time[]" class="form-control start_time" value="{{  $activity->hours[0]->start_time }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="end_time[]" class="form-control end_time" value="{{  $activity->hours[0]->end_time }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="operations">
                                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($activity->hours) >= 2)
                                        @php( $activity->hours->shift())
                                        @foreach($activity->hours as $item)
                                            <div class="timesHours">
                                                <div class="col-sm-4">
                                                    <input type="text" name="start_time[]" class="form-control start_time" value="{{ $item->start_time }}">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="end_time[]" class="form-control end_time" value="{{ $item->end_time }}">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="operations">
                                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Guia</label>
                                <div class="col-sm-9">
                                    <select name="providers[]" class="select2select" multiple="multiple">
                                        @foreach($providers->where('type','1') as $provider)
                                            <option value="{{$provider->id}}" @if($activity->providers->where('type','1')->contains($provider)) selected @endif >
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
                                            <option value="{{$provider->id}}" @if($activity->providers->where('type','2')->contains($provider)) selected @endif >
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
                                            <option value="{{$provider->id}}" @if($activity->providers->where('type','3')->contains($provider)) selected @endif >
                                                {{ $provider->first_name }} {{ $provider->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Minimo</label>
                                <div class="col-sm-3">
                                    <input type="text" name="min_persons" class="form-control min" value="{{  $activity->min_persons }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default deleteActivityBtn"> Eliminar </button>
                <button type="button" class="btn btn-success editActivityBtn"> Editar </button>
            </div>
        </div>
    </div>
</div>
