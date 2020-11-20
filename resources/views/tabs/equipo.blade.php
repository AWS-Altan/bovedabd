<div  id="caracteristicas" class="tab-pane fade" role="tabpanel">
    <!-- IMEI Actual -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">IMEI Actual</h6>
    </div>
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-striped table-bordered mb-0" id = "tableEquipo">
                <thead>
                    <tr>
                        <th>Fecha</th>                                                                    
                        <th>Hora</th>
                        <th>IMEI</th>
                        <th>Homologado</th>
                        <th>Soporta banda28</th>
                        <th>Soporta VoLTE</th>
                        <th>Status</th>
                        <th>Equipo (Marca/Modelo)</th>
                        <th>características soportadas por el equipo</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td id ="equipofecha"></td>
                        <td id ="equipohora"></td>
                        <td id ="equipoimei"></td>
                        <td id ="equipohomo"></td>
                        <td id ="equipoband"></td>
                        <td id ="equipovolte"></td>
                        <td id ="equipostatus"></td>
                        <td id ="equipobrand"></td>
                        <td id ="equipofeature"></td>
                    </tr>
                </tbody> 
                      
             </table>
        </div>
    </div>
    <!-- IMEI Actual -->
    <ul><hr class="light-grey-hr mt-40 mb-0"/></ul>
    <div class="mt-20 mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id = "dateInicioEquipo">
                    <input id="equipo_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id = "dateFinEquipo">
                    <input id="equipo_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_equipo" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_equipo">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view" id="equipo_history_panel">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico Cambio IMEI</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="equipo_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>IMEI</th>                
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
