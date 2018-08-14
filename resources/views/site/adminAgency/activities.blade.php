@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="under-header">
        <button class="btn btn-success addActivity">Adicionar Actividad</button>
    </div>
    <div class="container-fluid">
        <div class="activities">
            <div class="row">
                <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>RAFTING ALTO</h3>
                        <p><b>Valor: </b> 80.000</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                <div>12:00 a 15:00</div>
                                <div>15:00 a 20:00</div>
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="edit-activity">
                            <div class="edit-activity-icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>RAFTING ALTO</h3>
                        <p><b>Valor: </b> 80.000</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                <div>12:00 a 15:00</div>
                                <div>15:00 a 20:00</div>
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="edit-activity">
                            <div class="edit-activity-icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>RAFTING ALTO</h3>
                        <p><b>Valor: </b> 80.000</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                <div>12:00 a 15:00</div>
                                <div>15:00 a 20:00</div>
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="edit-activity">
                            <div class="edit-activity-icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>RAFTING ALTO</h3>
                        <p><b>Valor: </b> 80.000</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                <div>12:00 a 15:00</div>
                                <div>15:00 a 20:00</div>
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="edit-activity">
                            <div class="edit-activity-icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-sm-4 col-xs-6">
                    <div class="activity">
                        <h3>RAFTING ALTO</h3>
                        <p><b>Valor: </b> 80.000</p>
                        <div class="activity-hours">
                            <b>Horario: </b>
                            <div class="hours">
                                <div>12:00 a 15:00</div>
                                <div>15:00 a 20:00</div>
                            </div>
                        </div>
                        <hr>
                        <div class="info">
                            <div><b>Guía: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Asistentes: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="info">
                            <div><b>Transportista: </b></div>
                            <div> name name name name</div>
                        </div>
                        <div class="edit-activity">
                            <div class="edit-activity-icon">
                            </div>
                        </div>
                    </div>
                </div>
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
                    <form class="form-horizontal" action="/action_page.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Valor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Horario</label>
                                    <div class="col-sm-9 times">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" class="hours start_time">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" class="hours end_time">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="operations">
                                                <span class="glyphicon glyphicon-plus-sign"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" class="hours start_time">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" class="hours end_time">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Guia</label>
                                    <div class="col-sm-9">
                                        <select class="select2select" multiple="multiple">
                                            <option value="JAN">Lorem Ispum</option>
                                            <option value="FEB">Dolar Sit Amet</option>
                                            <option value="FEBm">Luis Lopez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Asistentes</label>
                                    <div class="col-sm-9">
                                        <select class="select2select" multiple="multiple">
                                            <option value="JAN">Lorem Ispum</option>
                                            <option value="DFEB">Dolar Sit Amet</option>
                                            <option value="DFEB">Luis Lopez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Transportista</label>
                                    <div class="col-sm-9">
                                        <select class="select2select" multiple="multiple">
                                            <option value="JAN">Lorem Ispum</option>
                                            <option value="FEB">Dolar Sit Amet</option>
                                            <option value="FEBm">Luis Lopez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Minimo</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" class="min">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"> Adicionar </button>
                </div>
            </div>
        </div>
    </div>
@stop