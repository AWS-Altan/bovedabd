<div  id="operaciones" class="tab-pane fade" role="tabpanel">
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id = "dateInicioOperaciones">
                    <input id="op_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id = "dateFinOperaciones">
                    <input id="op_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_operations" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_operations">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view" id="operations_history_panel">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico Operaciones</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="operations_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>Fecha solicitud</th>
                                            <th>Tipo de Operaci&oacute;n</th>
                                            <th>MVNO</th>
                                            <th>Usuario</th>
                                            <th>Fecha Ejecuci&oacute;n</th>
                                            <th>Fin Ejecuci&oacute;n</th>
                                            <th>Tiempo Total</th>
                                            <th>Parámetros</th>
                                            <th>Resultado</th>
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
