@extends('layouts.app')

@section('content')
<div class="col-sm-12">
	<div class="panel panel-default card-view">
		<div class="panel-heading">
			<div class="clearfix"></div>
		</div>
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<div class="row">
					@include('operation.pre-register.create')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('jsfree')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLzOTFaRpuncsWqNpiCvkV0rq-f6xOkJs"></script>
<script async defer src="{{asset('js/map-preRegister.js')}}"></script>
<script>

	mapeo = ["128Kbps/128Kbps","512Kbps/512Kbps","1Mbps/1Mbps","256Kbps/256Kbps","300Kbps/300Kbps","200Kbps/200Kbps","1.5Mbps/100Mbps","1.5Mbps/100Mbps","2Mbps/100Mbps","2Mbps/100Mbps","2Mbps/100Mbps","3Mbps/100Mbps","3Mbps/100Mbps","3Mbps/100Mbps","4Mbps/100Mbps","5Mbps/0.5Mbps","5Mbps/1Mbps","5Mbps/100Mbps","5Mbps/1.5Mbps","10Mbps/100Mbps","10Mbps/3Mbps","10Mbps/2Mbps","10Mbps/1Mbps","12Mbps/100Mbps","12Mbps/100Mbps","15Mbps/100Mbps","15Mbps/100Mbps","15Mbps/100Mbps","20Mbps/100Mbps","20Mbps/6Mbps","20Mbps/4Mbps","20Mbps/2Mbps","25Mbps/100Mbps","25Mbps/100Mbps","30Mbps/100Mbps","30Mbps/100Mbps","30Mbps/100Mbps","32Mbps/100Mbps","32Mbps/100Mbps","32Mbps/100Mbps","35Mbps/100Mbps","35Mbps/100Mbps","35Mbps/100Mbps","40Mbps/100Mbps","40Mbps/100Mbps","40Mbps/100Mbps","45Mbps/100Mbps","45Mbps/100Mbps","45Mbps/100Mbps","50Mbps/100Mbps","50Mbps/100Mbps","100Mbps/100Mbps"];
	mapeoserv = { "broadband00": "SinVelocidad", "broadband01": "1Mbps", "broadband05": "5Mbps", "broadband10": "10Mbps", "broadband15": "15Mbps", "broadband20": "20Mbps", "broadband25": "25Mbps", "broadband30": "30Mbps", "broadband99": "BestEffort", }
	var coordinates = "";
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
		if(changenull(val1) == "N/A" || changenull(val2) == "N/A"){
			inicio = "N/A";
		}else{
			inicio = changenull(val1) + " " + changenull(val2);
		}

		return inicio;
	}
	function evalFIFF(val){
		if ( val != "N/A"  && val!= ""){
			if ( val.toUpperCase().includes('FIFF')){
				return "SI";
			}
		} 
		return "NO";

	}

	function initializeProducts() {
		var glob = {};
		$("#txtCoordenadas").prop("disabled", true );
		$.blockUI({
			message: 'Procesando ...',
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			}
		});
		$.ajax({
			url: "{{ route('support.call.offer') }}",
			type: 'GET',
			data: {}
		})
		.done(function(response) {
			var obj = jQuery.parseJSON(response);
			glob = obj;
			$.each(obj.products, function(key, value) {
				offerts = value;
				$('#cboProducto').append(
					$('<option></option>').val(key).html(key)
				);
				$.each( value, function( key, value ) {
			  		$('#cboOferta').append(
	                    $('<option></option>').val(value.offeringId).html(value.offeringId+' - '+value.productName)
	                );
				});
				$('#cboOferta').trigger('change');
			});
			if ( $("#cboProducto").val().includes("HBB") ) { 
				$("#txtCoordenadas").prop("disabled", false );
			}else{ 
				$("#txtCoordenadas").val("");
				$("#txtCoordenadas").prop("disabled", true );
			}  
		})
		.fail(function() {
			$('#result').empty();
			$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en ofertas</label>');
		})
		.always(function() {
			$.unblockUI();
		});

		$('#cboProducto').on('change', function() {
        	var llave = this.value;
        	if ( $("#cboProducto").val().includes("HBB") ) { 
				$("#txtCoordenadas").prop("disabled", false );
			}else{ 
				$("#txtCoordenadas").val("");
				$("#txtCoordenadas").prop("disabled", true );
			}
        	$('#cboOferta').empty();
        	$.each( glob.products, function( key, value ) {
        		if( key == llave ){
        			$.each( value, function( key, value ) {
				  		$('#cboOferta').append(
		                    $('<option></option>').val(value.offeringId).html(value.offeringId+' - '+value.productName)
		                );
				  	});
				  	$('#cboOferta').trigger('change');
        		}
        	});
		});
		
		
		$('#cboOferta').on('change', function() {
			$('#txtCoordenadas').val('');
        	var separate = this.value.split(',');
        	$.each( glob.products, function( key, value ) {
			  	$.each( value, function( key, value ) {
			  		if( value.offeringId == separate[0] ){
			  			$("#lblFIFF").text( evalFIFF(value.productName) );
			  			//console.log(value);
			  			if( $("#product").val() == "HBB" || $("#product").val() == "TEST" || $("#product").val() == "Test" ){
			  				
			  				$("#lblDownlink").text( changenull(value.speedMbps) );
				  			$("#lblCiclo").text( changenull(value.validity) );
				  				
				  			$("#lblVoz").text( doblena(value.detail.voice, value.detail.voiceUnit) );
				  			$("#lblSms").text( doblena(value.detail.sms, value.detail.smsUnit) );
				  			$("#lblDatos").text( doblena(value.detail.freeUnitsGb, value.detail.freeUnitsUnit) );
				  			$("#lblEventos").text( doblena(value.detail.balance, value.detail.balanceUnit) );

				  			$("#lblRedirect").text( changenull(value.redirect) );
				  			var pass5 = changenull(value.detail.renewal);
				  			if (pass5 == "Y") {pass5 = "SI";}else{pass5="NO";}
				  			$("#lblRenovacion").text( pass5 );
				  			var pass6 = changenull(value.detail.buyback);
				  			if (pass6 == "Y") {pass6 = "SI";}else{pass6="NO";}
				  			$("#lblMultiactivar").text( pass6 );
				  			$("#lblThrottling").text( doblenaa( doblenaa(value.detail.throttling1, value.detail.throttling1Unit)+" "+mapeos(value.detail.throttling1Policy) ) );
				  			$("#lblThrottling2").text( doblenaa( doblenaa(value.detail.throttling2, value.detail.throttling2Unit)+" "+mapeos(value.detail.throttling2Policy) ) );
				  			$("#lblUplink").text( "BE" );

				  			var passmovi = changenull(value.detectMobility);
				  			if (passmovi == "Y") {passmovi = "SI";}else{passmovi="NO";}
				  			$("#lblMovility").text( passmovi );
				  			var passsus = changenull(value.suspendMobility);
				  			if (passsus == "Y") {passsus = "SI";}else{passsus="NO";}
				  			$("#lblDetectaSuspension").text( passsus );
			  			
			  			}else{
			  				
			  				$("#lblDownlink").text( changenull(value.detail.speedMbps) );
				  			$("#lblCiclo").text( changenull(value.validity) );

				  			$("#lblVoz").text( doblena(value.detail.voice, value.detail.voiceUnit) );
				  			$("#lblSms").text( doblena(value.detail.sms, value.detail.smsUnit) );
				  			$("#lblDatos").text( doblena(value.detail.freeUnitsGb, value.detail.freeUnitsUnit) );
				  			$("#lblEventos").text( doblena(value.detail.balance, value.detail.balanceUnit) );

				  			$("#lblRedirect").text( changenull(value.redirect) );
				  			var pass5 = changenull(value.detail.renewal);
				  			if (pass5 == "Y") {pass5 = "SI";}else{pass5="NO";}
				  			$("#lblRenovacion").text( pass5 );
				  			var pass6 = changenull(value.detail.buyback);
				  			if (pass6 == "Y") {pass6 = "SI";}else{pass6="NO";}
				  			$("#lblMultiactivar").text( pass6 );
				  			$("#lblThrottling").text( doblenaa( doblenaa(value.detail.throttling1, value.detail.throttling1Unit)+" "+mapeos(value.detail.throttling1Policy) ) );
				  			$("#lblThrottling2").text( doblenaa( doblenaa(value.detail.throttling2, value.detail.throttling2Unit)+" "+mapeos(value.detail.throttling2Policy) ) );
				  			
				  			$("#lblUplink").text( "BE" );

				  			$("#lblMovility").text( "N/A" );
				  			$("#lblDetectaSuspension").text( "N/A" );
			  			}
			  		}
			  		
			  	});
			});
		});
	}

	function getServiceability(latlon) {
		coordinates = latlon;
		$.blockUI({
			message: 'Procesando ...',
			css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			}
		});
		$.ajax({
			url: "{{ route('support.call.serviceability') }}",
			type: 'GET',
			data: {
				'coordinates': latlon
			}
		})
		.done(function(response) {
			var obj = jQuery.parseJSON(response);
			//console.log(obj);
			if (obj.error) {
				console.log('fail')
				$('#result').empty();
				$('#result').append('<label class="alert-danger mb-30 text-left">Error: <strong>' + obj.error + '</strong> al consultar serviciabilidad</label>');
				$('#next').hide();
			} else {
				$('#result').empty();
				if (obj.result == 'Without Coverage' || obj.result == 'Without serviceability. ') {
					$("#result").css('color', '#f73414');
					$('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
					$.unblockUI();
				} else {
					$("#result").css('color', '#000000');
					$('#result').text(' ' + obj.result);
				}
			}
		})
		.fail(function() {
			$('#result').empty();
			$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong>al obtener serviciabilidad</label>');
		})
		.always(function() {
			$.unblockUI();
		});
	}

	function initializeSave(){

		$('#btnCreate').click(function(){
			var data = {};
			data.offeringId= $('#cboOferta').val();
			data.msisdnPorted= $('#txtMsisdnPorted').val();
			data.msisdn=$('#txtMSISDN').val() != "" ? $('#txtMSISDN').val() : '0000000000';
			data.address=$('#txtCoordenadas').val();
			data.idPos=$('#txtIdPos').val();
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
				url: "{{ route('support.call.pre-register') }}",
				type: 'POST',
				contentType: "application/json",
				data: JSON.stringify(data)
			}).done(function(response) {
				var obj = jQuery.parseJSON(response);
				//console.log(obj);
				if(obj.error){
					$('#message').empty();
					$('#message').append('<label class="alert-danger mb-30 text-left">Pre registro <strong>no exitoso</strong><br>' + obj.error + "</label>");
					$('#boton').show();
				}else{
					// Get the modal
					$('#lblPrintIdPreregister').html('<strong>Id Pre: </strong>'+ obj.order.id );
					$('#lblPrintMsisdn').html('<strong>MSISDN: </strong>'+ $('#txtMSISDN').val() );
					$('#lblPrintOfferingId').html('<strong>Id de oferta: </strong>'+ $('#cboOferta').val() );
					$('#lblPrintCoordinates').html('<strong>Coordenadas: </strong>'+ $('#txtCoordenadas').val() );
					var modal = document.getElementById("modalCreate");
					modal.style.display = "block";
					$('#message').empty();
					$("#message").css('color', '#000000');
					$('#message').text('El pre registro en fecha '+  formatDate(obj.effectiveDate) +' fué exitoso, con el Order ID '+ obj.order.id);
					$('#boton').show();
				}
				
			}).fail(function() {
					$('#message').empty();
					$('#message').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en pre registro</label>');
					$.unblockUI();
				}).always(function() {
				$.unblockUI();
			});
		});
	}

	function formatDate(date){
		var year = date.substring(0,4);
		var month = date.substring(4,6);
		var day = date.substring(6,8);
		var hour = date.substring(8,10);
		var mins = date.substring(10,12);
		var secs = date.substring(12,14);

		return year + '/' + month + '/' + day + ' ' + hour + ':' + mins + ':' + secs;
	}

	function initializeModal() {
		// Get the modal
		var modal = document.getElementById("modalMaps");
		// Get the button that opens the modal
		var btn = document.getElementById("txtCoordenadas");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks on the button, open the modal
		btn.onclick = function() {
			modal.style.display = "block";
			$('#result').text('');
		}
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}
		$('#btnRegresar').click(function(){
			modal.style.display = "none";
		});

		$('#btnSeleccionar').click(function(){
			var resultServ = $('#result').text();
			var velServ = parseInt(resultServ.substring('broadband'.length + 1));
			var velOferta = parseInt($('#cboOferta').val().substring(3,5));
			if ( resultServ.includes('broadband')){
				if( velOferta <= velServ && !resultServ.includes('No existe serviciabilidad') ){
					$('#txtCoordenadas').val(coordinates);
					modal.style.display = "none";
				}else{
					$('#result').text('La velocidad no es soportada en las coordenas seleccionadas. Por favor, seleccione otra dirección.');
				}
			}else{
				modal.style.display = "none";
			}
		});

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	}

	function initializeModalCreate() {
		// Get the modal
		var modal = document.getElementById("modalCreate");
		
		// Get the <span> element that closes the modal
		var span = document.getElementById("closeCreate");
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}
		$('#btnRegresarPrint').click(function(){
			modal.style.display = "none";
		});
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}

		$('#btnPrint').click(function(){
			$('#modalCreate').printThis();
		});
	}

	function initializeMap() {
		$('#consulta').click(function() {
			initMap();
		});
	}

	$(document).ready(function() {
		initializeModal();
		initializeMap();
		initializeProducts();
		initializeSave();
		initializeModalCreate();
	});
</script>
@endsection