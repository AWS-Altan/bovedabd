<div  id="movilidad" class="tab-pane fade" role="tabpanel">
    <!-- Oferta Actual -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id = "dateInicioMovilidad">
                    <input id="mov_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id = "dateFinMovilidad">
                    <input id="mov_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_movilidad" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_movilidad">

    </div>
    <div class="mb-10">
        
    </div>

    <div class="panel panel-historico card-view" id="movilidad_susp_history_panel">
        <h6 class="txt-dark capitalize-font">Suspensi&oacute;n Por Control De Movilidad</h6>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table id="movilidad_susp_history" class="table table-hover display" >
                            <thead>
                                <tr>
                                    <th>Fecha detecci&oacute;n</th>                                  
                                    <th>Hora detecci&oacute;n</th>
                                    <th>Fecha suspensi&oacute;n</th>                                  
                                    <th>Hora suspensi&oacute;n</th>
                                    <th>MSISDN</th>
                                    <th>IMSI</th>
                                    <th>BE</th>
                                </tr>
                            </thead>  
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-historico card-view" id="movilidad_res_history_panel">
        <h6 class="txt-dark capitalize-font">Reanudaci&oacute;n Por Control De Movilidad</h6>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table id="movilidad_res_history" class="table table-hover display" >
                            <thead>
                                <tr>
                                    <th>Fecha detecci&oacute;n</th>                                  
                                    <th>Hora detecci&oacute;n</th>
                                    <th>Fecha reanudaci&oacute;n</th>                                  
                                    <th>Hora reanudaci&oacute;n</th>
                                    <th>MSISDN</th>
                                    <th>IMSI</th>
                                    <th>BE</th>
                                </tr>
                            </thead>  
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
