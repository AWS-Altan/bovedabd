<div  id="sim_card" class="tab-pane fade" role="tabpanel">
    <!-- SIM Actual -->
    <div class="mb-10">
        <h6 class="txt-dark capitalize-font">SIM Actual</h6>
    </div>
    <div class="table-wrap">
        <div class="table-responsive">
            @php $fecha_sim = \Carbon\Carbon::now()->tz('America/Mexico_City')->format('Y/m/d'); @endphp
            @php $hora_sim = \Carbon\Carbon::now()->tz('America/Mexico_City')->format('h:i:s'); @endphp
            <table class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>                                                                    
                        <th>Hora</th>
                        <th>IMSI</th>
                        <th>ICC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="fecha_sim">{{$fecha_sim}}</td>
                        <td id="hora_sim">{{$hora_sim}}</td>
                        <td id="imsi_sim">{{ $profile->subscriber->imsi }}</td>
                        <td id="icc_sim">{{ $profile->subscriber->iccid }}</td>
                    </tr>
              </tbody>      
             </table>
        </div>
    </div>
    <!-- SIM Actual -->
    <ul><hr class="light-grey-hr mt-40 mb-0"/></ul>
    <div class="mt-20 mb-10">
        <h6 class="txt-dark capitalize-font">Periodo – Fecha solicitud.</h6>
    </div>
    <div class="row">
        <div class="form-fecha" style=" display:flex; align-items:flex-end;">
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Inicial</label>
                <div class='input-group date' id="dateInicioSim">
                    <input id="sim_txtDate2" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
               </div>
            </div>
            <div class="col-sm-4">
                <label class="control-label mb-5">Fecha Final</label>
                <div class='input-group date' id="dateFinSim">
                    <input id="sim_txtDate3" type='text' class="form-control" placeholder="MM/DD/AÑO"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <a id="consult_sim" type="button" class="btn btn-primary">Buscar</a>
            </div>
        </div>
    </div>
    <div class="row" id="msg_sim">

    </div>

    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
            <div class="panel panel-historico card-view" id="sim_history_panel">
                <h6 class="panel-title txt-dark mt-10">Hist&oacute;rico SIM Card</h6>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="sim_history" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>IMSI</th>
                                            <th>ICC</th>                 
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