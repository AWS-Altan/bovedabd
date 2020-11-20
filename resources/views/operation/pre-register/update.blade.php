<div class="col-sm-12">
	<div class="panel panel-default card-view">
		<div class="panel-heading">
			<div class="clearfix"></div>
		</div>
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<h3><span class="head-font">Actualización de pre registro</span></h3>
				</br>
				<section>
					<form id="frmCreatePreRegister">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-wrap">
									<div class="form-group">
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtPreRegistro">Id PreRegistro:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtPreRegistro" placeholder="Id PreRegistro">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtMSISDN">MSISDN:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtMSISDN" placeholder="MSISDN del suscriptor" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtCoordenadas">Coordenadas:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtCoordenadas" placeholder="Coordenadas" data-error="Valor inválido" maxlength="20">
												<input type="text" data-minlength="7" class="form-control" id="txtCoordenadasDisabled" placeholder="Coordenadas" data-error="Valor inválido" maxlength="20" >
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtIdPos">Id POS:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtIdPos" placeholder="Id POS" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtMsisdnPorted">MSISDN Ported:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtMsisdnPorted" placeholder="MSISDN Ported" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtFechaPreregistro">Fecha PreRegistro:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtFechaPreregistro" placeholder="Fecha PreRegistro" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtEstado">Estado:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtEstado" placeholder="Estado" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtFechaEstado">Fecha estado:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtFechaEstado" placeholder="Fecha de Estado">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtOrderId">Order id:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtOrderId" placeholder="Order Id" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtErrorCode">Error code:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtErrorCode" placeholder="Error code" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="txtErrorDescription">Descripción de error:</label>
												<input type="text" data-minlength="7" class="form-control" id="txtErrorDescription" placeholder="Descripción de error" data-error="Valor inválido" maxlength="20">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-wrap">
									<div class="form-group">

										<label class="control-label mb-10" for="cboProducto">Producto:</label>
										<select id="cboProducto" class="form-control" name="cboProducto">
										</select>
									</div>
								</div>
								<div class="form-wrap">
									<div class="form-group">
										<label class="control-label mb-10" for="cboOferta">Oferta:</label>
										<select id="cboOferta" class="form-control" name="cboOferta">
										</select>
									</div>
								</div>
								<div class="form-group mt-20 mb-10">
									<label class="control-label mb-10" for="lblDetalleOferta">Detalle de Oferta:</label>
									<dl class="row">
										<dt class="col-sm-6">Velocidad Downlink (Mbps)</dt>
										<dd class="col-sm-6">
											<p id="lblDownlink"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Velocidad Uplink</dt>
										<dd class="col-sm-6">
											<p id="lblUplink">Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Ciclo Individual</dt>
										<dd class="col-sm-6">
											<p id="lblCiclo"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Voz</dt>
										<dd class="col-sm-6">
											<p id="lblVoz"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Sms</dt>
										<dd class="col-sm-6">
											<p id="lblSms"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Datos</dt>
										<dd class="col-sm-6">
											<p id="lblDatos"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Eventos</dt>
										<dd class="col-sm-6">
											<p id="lblEventos"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Redirect</dt>
										<dd class="col-sm-6">
											<p id="lblRedirect"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Renovaci&oacute;n automática</dt>
										<dd class="col-sm-6">
											<p id="lblRenovacion"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Multiactivar</dt>
										<dd class="col-sm-6">
											<p id="lblMultiactivar"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6 prueba">Throttling1</dt>
										<dd class="col-sm-6 prueba">
											<p id="lblThrottling"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6 prueba">Throttling2</dt>
										<dd class="col-sm-6 prueba">
											<p id="lblThrottling2"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Permite fecha inicio y fin</dt>
										<dd class="col-sm-6">
											<p id="lblFIFF"> Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Detecta movilidad</dt>
										<dd class="col-sm-6">
											<p id="lblMovility">Sin asignar</p>
										</dd>
										<dt class="col-sm-6">Detecta suspensi&oacute;n</dt>
										<dd class="col-sm-6">
											<p id="lblDetectaSuspension">Sin asignar</p>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</form>

					<!-- The Modal -->
					<div id="modalMaps" class="modal">

						<!-- Modal content -->
						<div class="modal-content">
							<div class="modal-header">
								<span class="close">&times;</span>
							</div>
							<div class="modal-body">
								@include('operation.pre-register.map-search')
							</div>
							<div class="modal-footer">
								<div id="btnCreate" style="text-align: right;">
									<a class="btn btn-success btn" id="btnRegresar"><span>Regresar</span></a>
									<a class="btn btn-success btn" id="btnSeleccionar"><span>Seleccionar</span></a>
								</div>
							</div>
						</div>
					</div>

					<div id="modalUpdate" class="modal">
						<!-- Modal content -->
						<div class="modal-content" style="height: 40%; width: 30%; margin-top: 10%; margin-left: 40%;">
							<div class="modal-header">
								<span class="close" id="closeUpdate">&times;</span>
							</div>
							<div class="modal-body">
								<h2>Pre registro exitoso</h2>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" id="lblPrintIdPreregister"><strong>Id Pre: </strong> 12543</label>
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" id="lblPrintMsisdn"><strong>MSISDN: </strong> 5510684279</label>
											</div>
										</div>		
									</div>
									<div class="col-sm-6">
									<div class="form-wrap">
										<div class="form-group">
												<label class="control-label mb-10" id="lblPrintOfferingId"><strong>Id de oferta: </strong> 1234567890</label>
											</div>
										</div>
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" id="lblPrintCoordinates"><strong>Coordenadas: </strong> 19.12345, 99.12345</label>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div id="btnCreate" style="text-align: center;">
									<a class="btn btn-success btn" id="btnRegresarPrint"><span>Cerrar</span></a>
									<a class="btn btn-success btn" id="btnPrint"><span>Imprimir</span></a>
								</div>
							</div>
						</div>
					</div>
				</section>

				<div id="message" class="col-sm-5">
			</div>
		</div>
	</div>
</div>