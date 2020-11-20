<div  id="consumos" class="tab-pane fade" role="tabpanel">
    <!-- Consumo Consultar -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id='dateInicioConsumo'>
                    <input id="consumos_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">    
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id = 'dateFinConsumo'>
                    <input id="consumos_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_consumos" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_consumos">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view" id="consumos_history_panel">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico Consumos</h6>
                <label style="color: #f73414;">(*) Estos mensajes son por proceso interno y no se contabilizan comercialmente</label>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="consumos_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Servicio</th>
                                            <th>Tipo</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Call Forwarding</th>
                                            <th>Raz&oacute;n término (llamadas)</th>
                                            <th>Resultado Envío (SMS)</th>
                                            <th>SMS Message ID</th>
                                            <th>Total</th>
                                            <th>UoM</th>
                                            <th>Roaming Nacional</th>
                                            <th>Roaming Internacional</th>
                                            <th>IMSI</th>
                                            <th>IMEI</th>
                                            <th>Access Prefix</th>
                                            <th>APN</th>
                                            <th>RatingGroup</th>
                                            <th>OfferID</th>
                                            <th>LDI</th>
                                            <th>LDI destino</th>               
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
