@extends('layouts.app')

<!-- Nombre: consulta.blade.php -->
<!-- Descripcion: pantalla con busqueda -->
<!-- historial Modificaciones -->
<!-- 	2020/11/11 - Mantener -->
<!--  -->


@section('content')
<div class="col-sm-12">
	<div class="panel panel-default card-view">
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<div class="form-wrap">

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
											<button id="consulta" type="button" class="btn btn-success">
												<span class="btn-text">									@if($isMob=='true')
														Consultar Cobertura
													@else
														Consultar Serviciabilidad
												    @endif
												</span>
											</button>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mb-40">
									<div class="form-group mt-20 mb-10">
										<label class="control-label mb-10 text-left">Resultado búsqueda</label>
										<label id="result" type="text" class="form-control filled-input"> El resultado de la búsqueda se visualizará aquí </label>
										<input id="rescorde" type="hidden" name="">
										<input id="isMob" type="hidden" name="" value={{$isMob}}>
									</div>
								</div>
							</div>
							<!-- </div> -->
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('jsfree')
<script>
	mapeoserv = { "broadband00": "SinVelocidad", "broadband01": "1Mbps","broadband5": "5Mbps", "broadband05": "5Mbps", "broadband10": "10Mbps", "broadband15": "15Mbps", "broadband20": "20Mbps", "broadband25": "25Mbps", "broadband30": "30Mbps", "broadband99": "BestEffort", }
	$(window).on('load', function() {
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
				 	'coordinates': $('#latitud').val()+','+$('#longitud').val(),
				 	'isMob':$('#isMob').val()
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
					if( $('#isMob').val()=='true'){
						$('#lati').text($('#latitud').val());
						$('#long').text($('#longitud').val());

						$('#result').text( obj.result  );
						$('#rescorde').val(obj.result);
						$('#next').show();

					}else if( $('#isMob').val()=='false'){

						if ( obj.result == 'Without Coverage' || obj.result == 'Without serviceability. ' ) {
							$('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
						}
						else if( obj.result == 'E-WOC' ){
							$('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
						}
						else if( obj.result == 'E-BLK' || obj.result == 'Site blocked by capacity' ){
							$('#result').text('Sitio bloqueado por capacidad. Por favor intente consultar nuevamente con coordenadas diferentes.');
						}
						else if( obj.result == 'E-RES' || obj.result == 'Restricted site' ){
							$('#result').text('Sitio restringido. Por favor intente consultar nuevamente con coordenadas diferentes.');
						}
						else if( obj.result == 'E-NSL' ){
							$('#result').text('Sitio bloqueado por infraestructura. Por favor intente consultar nuevamente con coordenadas diferentes.');
						}
						else{
							$('#lati').text($('#latitud').val());
							$('#long').text($('#longitud').val());

							if(obj.description && obj.description == 'High occupancy'){
								$('#result').text('En estas coordenadas se soporta una serviciabilidad de hasta: '+ mapeoserv[obj.result] + '. (Alta ocupación)' );
							}else{
								$('#result').text('En estas coordenadas se soporta una serviciabilidad de hasta: '+ mapeoserv[obj.result] + '.');
							}
							$('#rescorde').val(obj.result);
							$('#next').show();
						}
					}
				}
	        })
	        .fail(function() {
	        	$('#result').empty();
				$('#result').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong></label>');
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
