@extends('layouts.app')

@section('content')
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div id="example-basic">
						<h3><span class="head-font capitalize-font">Identificar Suscriptor</span></h3>
						<section>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group mb-0">
										<div class="row">
											 @include('layouts.identify')
										</div>
									</div>
								</div>
							</div>
							<div class="row" id="message_error">
							</div>
							<!-- /Row -->
						</section>

						<h3><span class="head-font capitalize-font">Producto y Oferta</span></h3>
						<section>
							<form id="stepdos">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-wrap">
										<div class="form-group">
											<label class="control-label mb-10" for="productoName">Producto:</label>
											<select id="product" class="form-control" name="country">
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-wrap">
										<div class="form-group">
											<label class="control-label mb-10" for="ofertaName">Oferta:</label>
											<select id="offert" class="form-control" name="country">
												<option></option>
											</select>
											<div class="form-group mt-20 mb-10">
													<dl class="row">
														<dt class="col-sm-6">Velocidad Downlink (Mbps)</dt>
														<dd class="col-sm-6">
															<p id="pass1"> </p>
														</dd>
														<dt class="col-sm-6">Velocidad Uplink</dt>
														<dd class="col-sm-6">
															<p id="passup"></p>
														</dd>
														<dt class="col-sm-6">Ciclo Individual</dt>
														<dd class="col-sm-6">
															<p id="pass2"> </p>
														</dd>
														<dt class="col-sm-6">Voz</dt>
														<dd class="col-sm-6">
															<p id="passvoz"> </p>
														</dd>
														<dt class="col-sm-6">Sms</dt>
														<dd class="col-sm-6">
															<p id="passsms"> </p>
														</dd>
														<dt class="col-sm-6">Datos</dt>
														<dd class="col-sm-6">
															<p id="passdatos"> </p>
														</dd>
														<dt class="col-sm-6">Eventos</dt>
														<dd class="col-sm-6">
															<p id="passeventos"> </p>
														</dd>
														<dt class="col-sm-6">Redirect</dt>
														<dd class="col-sm-6">
															<p id="pass4"> </p>
														</dd>
														<dt class="col-sm-6">Renovaci&oacute;n automática</dt>
														<dd class="col-sm-6">
															<p id="pass5"> </p>
														</dd>
														<dt class="col-sm-6">Multiactivar</dt>
														<dd class="col-sm-6">
															<p id="pass6"> </p>
														</dd>
														<dt class="col-sm-6 prueba">Throttling1</dt>
														<dd class="col-sm-6 prueba">
															<p id="pass7"> </p>
														</dd>
														<dt class="col-sm-6 prueba">Throttling2</dt>
														<dd class="col-sm-6 prueba">
															<p id="pass8"> </p>
														</dd>
														<dt class="col-sm-6">Permite fecha inicio y fin</dt>
														<dd class="col-sm-6">
															<p id="pass9"> </p>
														</dd>
														<dt class="col-sm-6">Detecta movilidad</dt>
														<dd class="col-sm-6">
															<p id="passmovi"></p>
														</dd>
														<dt class="col-sm-6">Detecta suspensi&oacute;n</dt>
														<dd class="col-sm-6">
															<p id="passsus"></p>
														</dd>
													</dl>
												</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row" id="message_error_offert">
							</div>
							</form>
						</section>
						<h3><span class="head-font capitalize-font">Serviciabilidad</span></h3>
						<section>
							<form id="steptres">
							<!-- Row -->
							<div class="row">
								<div class="col-lg-12">
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group mb-3">
														<label class="control-label mb-10 text-left">Latitud:</label>
														<input id="latitud" type="text" class="form-control" maxlength="11" placeholder="Ej: 19.3959336">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group mb-3">
														<label class="control-label mb-10 text-left">Longitud:</label>
														<input id="longitud" type="text" class="form-control" maxlength="11" placeholder="Ej: -99.176576">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group mb-3">

													</div>
												</div>
											</div>
											<div class="form-group"> 
												<div class="mt-20 mb-20">
													<button id="consulta" type="button" class="btn btn-success"><span class="btn-text">Consultar Serviciabilidad</span></button>
												</div>
											</div>
										</div>

										<div class="col-sm-6 mb-40">
											<div class="form-group mt-20 mb-10">
												<label class="control-label mb-10 text-left">Resultado búsqueda</label>
												<label id="result" type="text" class="form-control filled-input"> El resultado de la búsqueda se visualizará aquí </label>
												<input id="rescorde" type="hidden" name="">
											</div>
										</div>
									</div>
									<!-- </div> -->
								</div>
							</div>
							<!-- /Row -->
							</form>
						</section>
						<h3><span class="head-font capitalize-font">Fechas del Servicio</span></h3>
						<section>
							<form id="form_tabs" action="#">
								<div class="row">
									<div class="form-group mt-10">
										<div class="col-sm-4 mb-20">
											<label class="control-label mb-10">Fecha Alta:</label>
											<div class='input-group' >
												<input type='date' id="txtDate" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
											</div>
										</div>
										<div id="divdate1" class="col-sm-4 mb-20">
											<label class="control-label mb-10">Fecha inicio:</label>
											<div class='input-group' >
												<div class='input-group' >
													<input type='date' id="txtDate2" class="inputCal" /> <label id="cleardate" onclick="cleardate2()"> Limpiar fecha </label>
												</div>
											</div>
										</div>
										<div id="divdate2" class="col-sm-4 mb-20">
											<label class="control-label mb-10">Fecha fin:</label>
											<div class='input-group' >
												<div class='input-group' >
													<input type='date' id="txtDate3" class="inputCal" /> <label id="cleardate" onclick="cleardate3()"> Limpiar fecha </label>
												</div>												
											</div>
										</div>
									</div>
								</div>

								<div class="row" style="display: flex; align-items: flex-end;">
									<div class="col-sm-3">
										<div class='forn-group'>
											<label class="control-label mb-10">Identificador POS (Opcional)</label>
											<input id="idpos" type='text' class="form-control" placeholder="IdPoS" maxlength="15" />
										</div>
									</div>
								</div>
								<br>

								<div class="row">
									<div class="col-sm-7">
										<div class="table-wrap">
	              							<div class="table-responsive">
								            	<table class="table table-striped table-bordered mb-0">
								                	<th class="text-center" colspan="4"><strong>Resumen 	</strong></th>
									                <tr>
										                 <th><strong>MSISDN:</strong></th>
										                 <td><p id="msisdn"> </p></td>
										                 <th><strong>IMSI:</strong></th>
										                 <td><p id="imsi"> </p></td>
									                </tr>
									                <tr>
										                 <th><strong>ICC:</strong></th>
										                 <td><p id="icc"> </p></td>
										                 <th><strong>Velocidad Downlink (Mbps):</strong></th>
										                 <td><p id="pass11"> </p></td>
									                </tr>
									                <tr>
										                <th><strong>Voz:</strong></th>
										                <td><p id="pass2voz"> </p></td>
										                <th><strong>Sms:</strong></th>
										                <td><p id="pass2sms"> </p></td>
									                </tr>
									                <tr>
										                <th><strong>Datos:</strong></th>
										                <td><p id="pass2datos"> </p></td>
										                <th><strong>Eventos:</strong></th>
										                <td><p id="pass2eventos"> </p></td>
									                </tr>
									                <tr>
										                 <th><strong>Redirect:</strong></th>
										                 <td><p id="pass44"> </p></td>
										                 <th><strong>Renovaci&oacute;n automática:</strong></th>
										                 <td><p id="pass55"> </p></td>
									                </tr>
									                <tr>
										                 <th><strong>Multiactivar:</strong></th>
										                 <td><p id="pass66"> </p></td>
										                 <th><strong>"Ciclo Individual":</strong></th>
										                 <td><p id="pass22"> </p></td>
									                </tr>
									                <tr>
									                	<th><strong>Throttling1:</strong></th>
										                 <td><p id="pass77"> </p></td>
										                 <th><strong>Throttling2:</strong></th>
										                 <td><p id="pass88"> </p></td>
									                </tr>
									                <tr id="trcorde">
									                	<th><strong>Latitud:</strong></th>
										                <td><p id="lati"> </p></td>
										                <th><strong>Longitud:</strong></th>
										                <td><p id="long"> </p></td>
									                </tr>
								               </table>

	              							</div>

	             						</div>
									</div>
								</div>
								<br/>

								<div class="row" style="display: none; align-items: flex-end;">
									<div class="col-sm-3">
										<div class='forn-group'>
											<label class="control-label mb-10">IMEI (Opcional)</label>
											<input id="secondstep" type='number' class="form-control" placeholder="IMEI" maxlength="16" />
										</div>
									</div>

									<div class="col-sm-3">
										<label class="control-label mb-10"></label>
										<div class="form-actions button-search">
											<a class="btn btn-success btn" href="#"><span>Consultar Características</span></a>
										</div>
									</div>

									<div class="col-sm-6">
										<label class="control-label mb-10">Características</label>
										<div class="form-actions button-search">
											<input type="text" class="form-control filled-input" value="El resultado de la búsqueda se visualizará aquí">
										</div>
									</div>
								</div>
								<br>
								<div class="row" style="display: none; align-items: flex-end;">
										Si desea de manera informativa puede consultar las características del equipo para revisar si está homologado.
								</div>
								
								<div class="row">
									<div id="message" class="col-sm-7">
									</div>
									<div class="form-actions button-search" id="boton" style="text-align: center;">
										<a class="btn btn-success btn" href="{{ route('imei.alta.index')  }}"><span>Aceptar</span></a>
									</div>
								</div>


							</form>
						</section>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('jsfree')
<script>
	mapeo = ["128Kbps/128Kbps","512Kbps/512Kbps","1Mbps/1Mbps","256Kbps/256Kbps","300Kbps/300Kbps","200Kbps/200Kbps","1.5Mbps/100Mbps","1.5Mbps/100Mbps","2Mbps/100Mbps","2Mbps/100Mbps","2Mbps/100Mbps","3Mbps/100Mbps","3Mbps/100Mbps","3Mbps/100Mbps","4Mbps/100Mbps","5Mbps/0.5Mbps","5Mbps/1Mbps","5Mbps/100Mbps","5Mbps/1.5Mbps","10Mbps/100Mbps","10Mbps/3Mbps","10Mbps/2Mbps","10Mbps/1Mbps","12Mbps/100Mbps","12Mbps/100Mbps","15Mbps/100Mbps","15Mbps/100Mbps","15Mbps/100Mbps","20Mbps/100Mbps","20Mbps/6Mbps","20Mbps/4Mbps","20Mbps/2Mbps","25Mbps/100Mbps","25Mbps/100Mbps","30Mbps/100Mbps","30Mbps/100Mbps","30Mbps/100Mbps","32Mbps/100Mbps","32Mbps/100Mbps","32Mbps/100Mbps","35Mbps/100Mbps","35Mbps/100Mbps","35Mbps/100Mbps","40Mbps/100Mbps","40Mbps/100Mbps","40Mbps/100Mbps","45Mbps/100Mbps","45Mbps/100Mbps","45Mbps/100Mbps","50Mbps/100Mbps","50Mbps/100Mbps","100Mbps/100Mbps"];
	mapeoserv = { "broadband00": "SinVelocidad", "broadband01": "1Mbps", "broadband05": "5Mbps", "broadband5": "5Mbps", "broadband10": "10Mbps", "broadband15": "15Mbps", "broadband20": "20Mbps", "broadband25": "25Mbps", "broadband30": "30Mbps", "broadband99": "BestEffort", }

	function changenull( valor ){
		if(valor == null || valor == 'NULL' || valor == ""){ 
			valor = 'N/A';
		}
		return valor;
	}

	function mapeos( valor ) {
		var mp = changenull(valor);
		if ( mp !== 'N/A' ) {
			return mapeo[mp];
		}else{
			return 'N/A';
		}
	}

	function doblenaa(val1, val2) {
		if(changenull(val1) == "N/A" || changenull(val2) == "N/A"){
			inicio = "N/A";
		}else{
			inicio = changenull(val1) + " " + changenull(val2);
		}

		return inicio;
	}

	function doblena(val1, val2) {
		if(changenull(val1) == "N/A" && changenull(val2) == "N/A"){
			inicio = "N/A";
		}else{
			inicio = changenull(val1) + " " + changenull(val2);
		}

		return inicio;
	}
	function ValidateNext() {
		var dato=$('#inputData').val();
		if (patrones[tipo_campo].test(dato)) {
			identifyalta();
			return true;
		} else {
			$("#inputData").css({'border' : '1px solid #f73414'});
			$("#message_error").css('color', '#f73414');
			$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
			return false;
		}
	}

	function validoffert(){
		$('#divdate2').hide();
		$('#divdate1').hide();
		if($("#offert :selected").val() == '') {
			$('#message_error_offert').empty();
			$('#message_error_offert').append('<label class="help-block mb-30 text-left"><strong>Seleccione una oferta</strong> ');
   			return false;
		}

		if ($("#product :selected").val() !== 'HBB') {
			return true;
		}

		$('#next').hide();
		return true;
	}

	function validcordenadas() {
		ofer = $("#offert :selected").val();
		rescorde = $("#rescorde").val();
		var separatee = ofer.split(',');
		$('#boton').hide();

		if ($("#product :selected").val() !== 'HBB') {
			$('#trcorde').hide();

			$.blockUI({ message: 'Procesando ...',css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
	        
			$.ajax({
				url: "{{ route('support.call.validfeature') }}",
				type: 'GET',
			 	data: {
			 		'value': separatee[0]
			 	}
			}).done(function(response) {
	        	var obj = jQuery.parseJSON(response);
	        	//console.log(obj);
	        	if ( !obj.error && obj.additionalDates == "true") {
	        		$('#divdate2').show();
	        		$('#divdate1').show();
	        	}else{
	        		$('#result').empty();
					$('#result').append('<label class="alert-danger mb-30 text-left">Error :<strong>'+ obj.error +' </strong> al validar FIFF en oferta</label>');	        		
	        	}
	        }).fail(function() {
	        	$('#result').empty();
				$('#result').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong> al validar coordenadas</label>');
	        	$.unblockUI();
	        }).always(function() {
				$.unblockUI();
	        }); 

			return true;
		}

		$('#trcorde').show();

		return true;
	}

	function validateFIFF() {
		offer = $("#offert :selected").val().split(',')[0];

		if (offer) {
			$.blockUI({ message: 'Procesando ...',css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
	        
			$.ajax({
				url: "{{ route('support.call.validfeature') }}",
				type: 'GET',
			 	contentType: 'application/json',
			    data: {"value": offer}
			}).done(function(response) {
	        	var obj = jQuery.parseJSON(response);
	        	if ( !obj.error ) {
	        		if ( obj.additionalDates == "true" ){
	        			$("#pass9").text( "SI" );
	        			return true;
	        		}else{
	        			$("#pass9").text( "NO" );
	        		}
	        	}else{
	        		$('#result').empty();
					$('#result').append('<label class="alert-danger mb-30 text-left">Error :<strong>'+ obj.error +' </strong> al validar FIFF en oferta</label>');
	        	}
	        }).fail(function() {
	        	$('#result').empty();
				$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> al validar FIFF en oferta</label>');
	        	$.unblockUI();
	        }).always(function() {
				$.unblockUI();
	        });
		}
		return false;
	}

	function identifyalta(){
        $('#message,#setmsisdn,#setimsi,#setimei,#seticc,#setmsisdn2').empty();
  		$.blockUI({ message: 'Procesando ...',css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } });
		$.ajax({
			url: "{{ route('imei.call.identify') }}",
			type: 'GET',
		 	data: {
		 		'type': tipo_campo,
		 		'value': $('#inputData').val()
		 	}
		})
        .done(function(response) {
        	obj = jQuery.parseJSON(response);
        })
        .fail(function() {
	        	$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong> al identificar suscriptor</label>');
	        	$.unblockUI();
	        })
        .always(function() {
        	$.unblockUI();
        	if(obj.error){
        		$('#value').val('');
				$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong></label> ');
				$( "#previous" ).trigger( "click" );
        	}else{
        		$("#msisdn").text( ' '+changenull(obj.msisdn) );
        		$("#imsi").text( ' '+changenull(obj.imsi) );
        		$("#icc").text( ' '+changenull(obj.iccid) );
        		$('#message_error').empty();
        		/*$.ajax({
					url: "{{ route('support.call.valid') }}",
					type: 'GET',
				 	data: {
				 		'type': tipo_campo,
				 		'value': obj.msisdn
				 	}
				}).done(function(response) {
					var obj2 = jQuery.parseJSON(response);
        			//console.log(obj2);
        			if(obj2.preactive == "false"){
        				$('#value').val('');
						$('#message_error').empty();
						$('#message_error').append('<label class="help-block mb-30 text-left"><strong>El MSISDN '+ $('#inputData').val() +' se encuentra en un estado que no permite la operación de Alta</strong> ');
						$( "#previous" ).trigger( "click" );
        			}
				})*/
				$.blockUI({ message: 'Procesando ...',css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
		        } });
				$.ajax({
					url: "{{ route('support.call.profile') }}",
					type: 'GET',
				 	data: {
				 		'value': obj.msisdn
				 	}
				}).done(function(response) {
					var obj2 = jQuery.parseJSON(response);
					//console.log(obj2);
					var defaultFirstChars = '10000';
					var offerType = obj2.responseSubscriber.primaryOffering.offeringId.toString();
        			if(obj2.responseSubscriber.status.subStatus != "Idle" && !offerType.startsWith(defaultFirstChars)){
        				$('#value').val('');
						$('#message_error').empty();
						$('#message_error').append('<label class="help-block mb-30 text-left"><strong>El MSISDN '+ $('#inputData').val() +' se encuentra en un estado que no permite la operación de Alta</strong></label>');
						$( "#previous" ).trigger( "click" );
        			}
				})
		        .fail(function() {
		        	$('#message_error').empty();
					$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong> profile al consultar el estado del suscriptor</label>');
		        	$.unblockUI();
		        }).always(function() {
		        	if ($('select#product option').length > 0 ){
        				$('select#product').prop('indexSelected',0).trigger('change');
		        	}
		        	$.unblockUI();
		        });
	        }
			
        });
	}

	function serviceability( vserv ) {
		ofer = $("#offert :selected").val();
		rescorde = $("#rescorde").val();
		var separatee = ofer.split(',');
		$.blockUI({ message: 'Procesando ...',css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } });
		$.ajax({
			url: "{{ route('support.call.validchoose') }}",
			type: 'GET',
		 	data: {
		 		'value': separatee[0],
		 		'serviceability': rescorde
		 	}
		})
        .done(function(response) {
        	obj3 = jQuery.parseJSON(response);
        }).fail(function() {
        	$('#result').empty();
			$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> al validar serviciabilidad</label>');
        }).always(function() {
        	if(obj3.readyToActivate == "false"){
        		//console.log('entra');
        		$('#result').empty();
        		$("#result").text('La Serviciabilidad en las coordenadas proporcionadas es menor que la velocidad de la Oferta elegida, por lo que no se puede continuar con el Alta. Favor de elegir una nueva oferta, o consultar serviciabilidad con unas nuevas coordenadas. \n En estas coordenadas se soporta una serviciabilidad de hasta: '+ mapeoserv[vserv]);
        		//$( "#previous" ).trigger( "click" );
        		
        	}else{
        		$('#next').show();
        		$.blockUI({ message: 'Procesando ...',css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
		        } });  
				$.ajax({
					url: "{{ route('support.call.validfeature') }}",
					type: 'GET',
				 	contentType: 'application/json',
				    data: {"value": offer}
				}).done(function(response) {
		        	var obj = jQuery.parseJSON(response);
		        	if ( !obj.error ) {
		        		if ( obj.additionalDates == "true" ){
				        	$('#divdate2').show();
				        	$('#divdate1').show();
		        		}
		        	}else{
		        		$('#result').empty();
						$('#result').append('<label class="alert-danger mb-30 text-left">Error validar FIFF en oferta:<strong>'+obj.error+'</strong> en serviciabilidad</label>');
		        	}
		        }).fail(function() {
		        	$('#result').empty();
					$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> validar FIFF en oferta en serviciabilidad</label>');
		        }).always(function(){
		    		$.unblockUI();    	
		        });
        	}
        	$.unblockUI();
        });
	}

	function finished(){
		$('#message').empty();
		ofer = $("#offert :selected").val();
		var separatee = ofer.split(',');

		$('#finish').hide();
		$('#previous').hide();
		$.blockUI({ message: 'Procesando ...',css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } });
        $.ajax({
			url: "{{ route('support.call.activation') }}",
			type: 'GET',
		 	data: {
			 	'date': $('#txtDate').val(),
			 	'date2': $('#txtDate2').val(),
			 	'date3': $('#txtDate3').val(),
			 	'value': obj.msisdn,
			 	'offer': separatee[0],
			 	'idPoS': $('#idpos').val(),
				'coordinates': $('#latitud').val()+','+$('#longitud').val()
			}
		}).done(function(response) {
        	var obj = jQuery.parseJSON(response);
        	//console.log(obj);
        	if(obj.error){
        		$('#message').empty();
        		$('#message').append('<label class="alert-danger mb-30 text-left">Activaci&oacute;n del '+tipo_campo.toUpperCase()+' '+ $('#inputData').val() + '<strong> no exitosa</strong>  <br>'+obj.error+' </label>');
        		$('#boton').show();
        	}else{
        		$('#message').empty();
        		$('#message').text('El Alta del '+tipo_campo.toUpperCase()+' '+ $('#inputData').val() +' en fecha '+  obj.date +' fue exitoso, con el Order ID '+ obj.order_id);
        		$('#boton').show();
        	}
            
        }).fail(function() {
	        	$('#message').empty();
				$('#message').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en activaci&oacute;n</label>');
	        	$.unblockUI();
	        }).always(function() {
			$.unblockUI();
        });
	}

	$(window).on('load', function() {
		$('#divdate2').hide();
		$('#divdate1').hide();
		$.ajax({
			url: "{{ route('support.call.offer') }}",
			type: 'GET',
		 	data: {}
		})
        .done(function(response) {
        	var obj = jQuery.parseJSON(response);
        	glob = obj; 
        	//console.log('offertas:');
        	//console.log(obj);
        	$.each( obj.products, function( key, value ) {
        		offerts = value;
			  	$('#product').append(
                    $('<option></option>').val(key).html(key)
                );
			  	$.each( value, function( key, value ) {
			  		$('#offert').append(
	                    $('<option></option>').val(value.offeringId+','+value.detail.offeringId).html(value.offeringId+' - '+value.productName)
	                );
			  	});
			});
        })
        .fail(function() {
	        	$.unblockUI();
	        })
        .always(function() {
			if ( $("#product").val() == "HBB" ) { $("#example-basic-t-2").show() }else{ $("#example-basic-t-2").hide() }
        });
        $('#product').on('change', function() {
        	var llave = this.value;
        	//console.log(llave);
        	$('#offert').empty();
        	$.each( glob.products, function( key, value ) {
        		if( key == llave ){
        			$.each( value, function( key, value ) {
				  		$('#offert').append(
		                    $('<option></option>').val(value.offeringId+','+value.detail.offeringId).html(value.offeringId+' - '+value.productName)
		                );
				  	});
				  	$('#offert').trigger('change');
        		}
        	});
        });
        $('#offert').on('change', function() {
        	var separate = this.value.split(',');
        	if ( $("#product").val() == "HBB" ) { $("#example-basic-t-2").show() }else{ $("#example-basic-t-2").hide() }
        	$.each( glob.products, function( key, value ) {

			  	$.each( value, function( key, value ) {
			  		if( value.offeringId == separate[0] ){
			  			$("#pass9").text( "NO" );
			  			validateFIFF();
			  			//console.log(value);
			  			if( $("#product").val() == "HBB" || $("#product").val() == "TEST" || $("#product").val() == "Test" ){
			  				
			  				$("#pass1, #pass11").text( changenull(value.speedMbps) );
				  			$("#pass2, #pass22").text( changenull(value.validity) );
				  				
				  			$("#passvoz, #pass2voz").text( doblena(value.detail.voice, value.detail.voiceUnit) );
				  			$("#passsms, #pass2sms").text( doblena(value.detail.sms, value.detail.smsUnit) );
				  			$("#passdatos, #pass2datos").text( doblena(value.detail.freeUnitsGb, value.detail.freeUnitsUnit) );
				  			$("#passeventos, #pass2eventos").text( doblena(value.detail.balance, value.detail.balanceUnit) );

				  			$("#pass4, #pass44").text( changenull(value.redirect) );
				  			var pass5 = changenull(value.detail.renewal);
				  			if (pass5 == "Y") {pass5 = "SI";}else{pass5="NO";}
				  			$("#pass5, #pass55").text( pass5 );
				  			var pass6 = changenull(value.detail.buyback);
				  			if (pass6 == "Y") {pass6 = "SI";}else{pass6="NO";}
				  			$("#pass6, #pass66").text( pass6 );
				  			$("#pass7, #pass77").text( doblenaa( doblenaa(value.detail.throttling1, value.detail.throttling1Unit)+" "+mapeos(value.detail.throttling1Policy) ) );
				  			$("#pass8, #pass88").text( doblenaa( doblenaa(value.detail.throttling2, value.detail.throttling2Unit)+" "+mapeos(value.detail.throttling2Policy) ) );
				  			$("#passup").text( "BE" );

				  			var passmovi = changenull(value.detectMobility);
				  			if (passmovi == "Y") {passmovi = "SI";}else{passmovi="NO";}
				  			$("#passmovi").text( passmovi );
				  			var passsus = changenull(value.suspendMobility);
				  			if (passsus == "Y") {passsus = "SI";}else{passsus="NO";}
				  			$("#passsus").text( passsus );
			  			
			  			}else{
			  				
			  				$("#pass1, #pass11").text( changenull(value.detail.speedMbps) );
				  			$("#pass2, #pass22").text( changenull(value.validity) );

				  			$("#passvoz, #pass2voz").text( doblena(value.detail.voice, value.detail.voiceUnit) );
				  			$("#passsms, #pass2sms").text( doblena(value.detail.sms, value.detail.smsUnit) );
				  			$("#passdatos, #pass2datos").text( doblena(value.detail.freeUnitsGb, value.detail.freeUnitsUnit) );
				  			$("#passeventos, #pass2eventos").text( doblena(value.detail.balance, value.detail.balanceUnit) );

				  			$("#pass4, #pass44").text( changenull(value.redirect) );
				  			var pass5 = changenull(value.detail.renewal);
				  			if (pass5 == "Y") {pass5 = "SI";}else{pass5="NO";}
				  			$("#pass5, #pass55").text( pass5 );
				  			var pass6 = changenull(value.detail.buyback);
				  			if (pass6 == "Y") {pass6 = "SI";}else{pass6="NO";}
				  			$("#pass6, #pass66").text( pass6 );
				  			$("#pass7, #pass77").text( doblenaa( doblenaa(value.detail.throttling1, value.detail.throttling1Unit)+" "+mapeos(value.detail.throttling1Policy) ) );
				  			$("#pass8, #pass88").text( doblenaa( doblenaa(value.detail.throttling2, value.detail.throttling2Unit)+" "+mapeos(value.detail.throttling2Policy) ) );
				  			
				  			$("#passup").text( "BE" );

				  			$("#passmovi").text( "N/A" );
				  			$("#passsus").text( "N/A" );
			  			}
			  		}
			  		
			  	});
			});
		});

        $( "#consulta" ).click(function() {
        	valid = valida_cordenadas();
			if(!valid){
				$('#result').empty();
				$("#result").text('Cordenadas no validas');
				return false;
			}
			$.blockUI({ message: 'Procesando ...',css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
	        $.ajax({
				url: "{{ route('support.call.serviceability') }}",
				type: 'GET',
			 	data: {
				 	'value': $('#value').val(),
				 	'coordinates': $('#latitud').val()+','+$('#longitud').val()
				}
			})
	        .done(function(response) {
	        	var obj = jQuery.parseJSON(response);
	        	//console.log(obj);
	            if(obj.error){
	            	//console.log('fail')
					$('#result').empty();
					$('#result').text(' '+ obj.error);
					$('#next').hide();
				}else{
					$('#result').empty();
					if ( obj.result == 'Without Coverage' || obj.result == 'Without serviceability. ' ) { 
						$('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
						$.unblockUI();
					}
					else if( obj.result == 'E-WOC' ){
						$('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
						$.unblockUI();
					}
					else if( obj.result == 'E-BLK' || obj.result == 'Site blocked by capacity' ){
						$('#result').text('Sitio bloqueado por capacidad. Por favor intente consultar nuevamente con coordenadas diferentes.');
						$.unblockUI();
					}
					else if( obj.result == 'E-RES' || obj.result == 'Restricted site' ){
						$('#result').text('Sitio restringido. Por favor intente consultar nuevamente con coordenadas diferentes.');
						$.unblockUI();
					}
					else if( obj.result == 'E-NSL' ){
						$('#result').text('Sitio bloqueado por infraestructura. Por favor intente consultar nuevamente con coordenadas diferentes.');
						$.unblockUI();
					}
					else{
						$('#lati').text($('#latitud').val());
						$('#long').text($('#longitud').val());
						
						if(obj.description && obj.description == 'High occupancy'){
							$('#result').text('En estas coordenadas se soporta una serviciabilidad de hasta: '+ mapeoserv[obj.result] + '(Alta ocupación). Por lo tanto puede continuar con la Alta.');
						}else{
							$('#result').text('En estas coordenadas se soporta una serviciabilidad de hasta: '+ mapeoserv[obj.result] + '. Por lo tanto puede continuar con la Alta.');
						}
						
						$('#rescorde').val(obj.result);
						serviceability(obj.result);
					}
				}
	        })
	        .fail(function() {
	        	$('#result').empty();
				$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en serviciabilidad</label>');
	        	$.unblockUI();
	        })
	        .always(function() {
	        	$.unblockUI();
	        });
		});

	});
	
	
</script>
@endsection
@section('js')
	$("#latitud").keyup(function (e) {
		val = $("#latitud").val().replace(/^(0*)/,"");
	 	$("#latitud").val(val.replace(/[^0-9\-.]/g,''));
	 	val2 = $("#latitud").val();
	 	if( val2 < -91 || val2 > 91 ){
			$("#latitud").val('')
	 	}
        if ((event.which != 46 || $("#latitud").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
   	});

   	$("#latitud").blur(function (e) {
		val = $("#latitud").val();
		if (!patrones['latitud'].test(val)) {
		 $("#latitud").val('');
		}
   	});

   	$("#longitud").blur(function (e) {
		val = $("#longitud").val();
		if (!patrones['longitud'].test(val)) {
		 $("#longitud").val('');
		}
   	});

   	$("#longitud").keyup(function (e) {
		val = $("#longitud").val().replace(/^(0*)/,"");
	 	$("#longitud").val(val.replace(/[^0-9\-.]/g,''));
	 	val2 = $("#longitud").val();
	 	if( val2 < -181 || val2 > 181 ){
			$("#longitud").val('')
	 	}
        if ((event.which != 46 || $("#longitud").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
   	});

@endsection
