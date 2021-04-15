    <form id="form_tabs" action="#">
        <div class="row">
            <div class="mb-10">
            <h6 class="txt-dark capitalize-font">Per&iacute;odo - Fecha Ingreso.</h6>
            </div>
            <div class="row">

                <div class="form-fecha" style=" display:flex; align-items:flex-end;">
                    <div class="col-sm-2">
                        <label class="control-label mb-5">Inicial</label>
                        <div class='input-group date' id = "dateInicioBotonRojo">
                            <input id="initialDate" type='text' class="form-control" placeholder="AÑO-MM-DD"/>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                       </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="control-label mb-5">Final</label>
                        <div class='input-group date' id = "dateFinBotonRojo">
                            <input id="finalDate" type='text' class="form-control" placeholder="AÑO-MM-DD"/>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <a id="consultaActividades" type="button" class="btn btn-primary">Buscar</a>
                        <a id="pausarActividades" type="button" class="btn btn-primary">Pausar</a>
                        <a id="reanudarActividades" type="button" class="btn btn-primary">Reanudar</a>
                        <a id="stopActividades" type="button" class="btn btn-primary">Detener Todo</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
        <br>
    </form>
    <!-- Row -->
    <div class="row">
         <div class="col-sm-12 mt-40">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="Tbl_usrdisp" class="table table-hover display" >
                                    <thead>
                                        <tr>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">ID</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Actividad</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Descripción</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Fecha Ingreso</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Fecha Termino</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Fecha pausa</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;">Fecha reanuda</th>
                                        <th style="color:#9E1D22; font-weight: bold; font-size: 11px;"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
        </div>
    </div>
    <!-- /Row -->
