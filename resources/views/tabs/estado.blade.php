<div  id="status" class="tab-pane fade" role="tabpanel">
    <!-- Oferta Actual -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">Estado Actual</h6>
    </div>
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>                                                                    
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Razón</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="fecha_estado"></td>
                        <td id="hora_estado"></td>
                        <td id="status_estado"></td>
                        <td id="status_reason"></td>
                    </tr>
              </tbody>      
             </table>
        </div>
    </div>
    <!-- Oferta Actual -->
    <ul><hr class="light-grey-hr mt-40 mb-0"/></ul>
    <div class="mt-20 mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id = "dateInicioEstado">
                    <input id="status_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id = "dateFinEstado">
                    <input id="status_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_status" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_status">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view" id="state_history_panel">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico Cambio Estado</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="status_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Razón</th>               
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>    
        </div>
    </div>
    <!-- /Row -->
</div>
