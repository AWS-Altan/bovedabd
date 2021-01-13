<!-- Blade de manejo de catalogo de dispositivos-->
<!-- Historial Modificaciones-->
<!--    2020-01-06 Creacion -->

                                <div class="panel panel-default">
                                    <!-- Header Subseccion Información General-->
                                    <div class="panel-heading">
    								    Informaci&oacute;n General Dispositivo
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas Ambiente - Dirección -->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Ambiente</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="id_selAmbiente" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="selectAmbienteError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Dirección</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="id_direccion" placeholder="Ingrese la dirección a la que pertenece el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtDireccioneError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas Gerencia DEscripción-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Gerencia</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_gerencia" placeholder="Ingrese la gerencia a la que pertenece el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtGerenciaError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Descripción</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_descripcion" placeholder="Ingrese la descripción del equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtDescripcionError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas ID del equipo - Estado-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">ID del Equipo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_idEquipo" placeholder="Ingrese el ID (nombre) del equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtIDEquipoError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Estado</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="id_selEstado" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="selectEstadoError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <!-- Header Subseccion Información del Equipo-->
                                    <div class="panel-heading">
    								    Información del Equipo
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas Marca - Modelo-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Marca</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Marca" placeholder="Ingrese la Marca del Equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtMarcaerror"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Modelo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Modelo" placeholder="Ingrese el módelo del equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtModeloError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas Serie - Sistema Operativo -->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Serie</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Serie" placeholder="Ingrese el Número de serie del equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtSerieError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Sistema Operativo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="Id_sistemaOp" placeholder="Ingrese el Sistema Operativo del Equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtSisOPError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas Tipo - Tipo Aplicativo-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Tipo dispositivo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_tipoEquipo" placeholder="Ingrese el tipo de equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtTipoerror"></div>
												    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Tipo Aplicativo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_tipoApp" placeholder="Ingrese el tipo de aplicativo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtTipoApperror"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								    Datos Ubicación
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas Tablero - Voltaje-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Tablero Alimentación</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_tablero" placeholder="Ingrese el identificador del tablero" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtTableroerror"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Voltaje Alimentación</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_voltaje" placeholder="Ingrese el voltaje del equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtVoltajeError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas Coordenadas-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Coordenadas</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_coodenadas1" placeholder="Ingrese Latitud" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtCoord1Error"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_coodenadas2" placeholder="Ingrese Longitud" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtCoord2Error"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas Fila - Rack -->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo Fila - -->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Fila</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_fila" placeholder="Ingrese la fila en la que se localiza el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtFilaError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Rack</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_rack" placeholder="Ingrese el Rack en el que se localiza el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtRackError"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas Sala - Site -->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Sala</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Sala" placeholder="Ingrese la sala donde se localiza el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtSalaError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Site</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Site" placeholder="Ingrese el Site donde se localiza el equipo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtSiteError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas Unidad-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Unidad</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_Unidad" placeholder="Ingrese la unidad" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtUnidadError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								    Información de red
                                    </div>
                                    <div class="card-body">
                                        <!--renglon-->
                                        <div class="row">
                                            <!-- columnas IP - IP Aplicativa-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">IP</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_IP" placeholder="Ingrese la IP" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtIPError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">IP Aplicativa</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_IPApp" placeholder="Ingrese la IP de aplicativo" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtIPAppError"></div>
												    </div>
                                                </div>
                                            </div>
                                            <!-- columnas IP Operativa - IP Soporte-->
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">IP Operativa</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_IPOper" placeholder="Ingrese la IP de Operación" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtIPOPError"></div>
                                                    </div>
                                                    <!--campo-->
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">IP Soporte</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="id_IPSop" placeholder="Ingrese la IP de Soporte" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="txtIPSopError"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
