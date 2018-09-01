<div id="editProviderModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Datos personales</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal editProviderForm" action="/action_page.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $provider->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Pais</label>
                                <div class="col-sm-9">
                                    <input type="text" name="country" class="form-control" id="country" valueCode="{{ $provider->country }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">ID</label>
                                <div class="col-sm-9">
                                    <input type="text" name="identity" class="form-control" id="identity" value="{{ $provider->identity }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Dirección</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="address" value="{{ $provider->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" id="email" value="{{ $provider->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Teléfono</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $provider->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd">Tipo</label>
                                <div class="col-sm-9">
                                    <select name="type" class="type form-control">
                                        @foreach($providerTypes as $item)
                                            <option value="{{$item->id}}" @if($provider->type == $item->id) selected @endif>
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
                                    <textarea name="comment" class="form-control" id="comment" >{{ $provider->comment }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <form class="form-horizontal providerActivitiesEditForm" action="/action_page.php">
                    <div class="activities">
                        <p>Actividades</p>
                        @php($c = 0)
                        @foreach($provider->activities as $activity)
                            @php($c++)
                            <div class="row activity">
                                <div class="col-sm-4">
                                    <select name="activities[]" class="activity form-control">
                                        @foreach($activities as $item)
                                            <option value="{{$item->id}}" @if($item->id == $activity->id) selected @endif>
                                                {{ ucfirst($item->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="prices[]" class="form-control " placeholder="Valor" value="{{$activity->pivot->price}}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="operations">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                        @if($c != 1)
                                            <span class="glyphicon glyphicon-remove"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
                <button type="button" class="btn btn-success editProviderBtn" provider_id="{{ $provider->id }}"> Editar </button>
            </div>
        </div>
    </div>
</div>
