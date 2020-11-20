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
						<h3><span class="head-font capitalize-font">Operaciones batch</span></h3>
						<section>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-wrap" style="display: inline-block;">
														<form id="form_identify">
															<div class="form-group">
																Seleccione la operación: 
																<select class="form-control" id="listOperations">
																  <option value="pos0">Select</option>
																</select>
															</div>

															<div class="row" id="formatLineBatch">
																<div class="col-sm-6 mb-60" style = "width: 100%">
																	<div class="form-group mt-20 mb-10">
																		<label class="control-label mb-10 text-left">Formato</label>
																		<label id="inputFormatSample" type="text" class="form-control filled-input">Formato por línea</label>
																	
																		<label class="control-label mb-10 text-left">Ejemplo</label>
																		<label id="inputLineSample" type="text" class="form-control filled-input">
																		Ejemplo por línea
																		</label>
																	</div>
																	
																	<div class="form-group">
																		Seleccione el archivo a procesar: <input type="file" data-minlength="7" class="form-control" id="inputFileData" placeholder="Archivo" data-error="Valor inválido" maxlength="20">
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
															</div>
														</form>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Row -->
							<div class="row" id="inputErrors">
								<div class="col-sm-6 mb-40">
									<div class="form-group mt-20 mb-10">
										<label class="control-label mb-10 text-left">Resultado batch</label>
										<label id="result" type="text" class="form-control filled-input"> El procesamiento se visualizará aquí </label>
										<input id="rescorde" type="hidden" name="">
									</div>
								</div>
							</div>

						</section>
						
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('jsfree')
<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 45%;
	}
</style>
<script>
	function finished(){
		
	}
	$(window).on('load', function() {
		var operations = {};
		@if( in_array(226,$permissions) )
		operations['activations'] = {
			'text': 'Activación',
			'format': 'msisdn|offeringId|Coordenadas(Opcional)|scheduleDate(Opcional)',
			'sample': '5532689574|1001000019|19.3952801,-99.1774201|20181015',
			'path': '/cm/v1/subscribers/activations'
		}
		@endif
		@if( in_array(227,$permissions) )
		operations['serviceabilities'] = {
			'text': 'Serviciabilidad',
			'format': 'Una coordenada por línea (latitud,longitud)',
			'sample': '19.439425,-99.1874727',
			'path': '/sqm/v1/network-services/serviceabilities'
		}
		@endif
		@if( in_array(228,$permissions) )
		operations['changesSIM'] = {
			'text': 'Cambio de SIM',
			'format': 'msisdn|newiccid',
			'sample': '55326985423|555698763214592',
			'path': '/cm/v1/subscribers/changesSIM'
		}
		@endif
		@if( in_array(229,$permissions) )
		operations['predeactivates'] = {
			'text': 'Predesactivación',
			'format': 'msisdn|scheduleDate(Opcional)',
			'sample': '5532689574|20181015',
			'path': '/cm/v1/subscribers/predeactivates'
		}
		@endif
		@if( in_array(230,$permissions) )
		operations['deactivates'] = {
			'text': 'Desactivación',
			'format': 'msisdn|scheduleDate(Opcional)',
			'sample': '5532689574|20181015',
			'path': '/cm/v1/subscribers/deactivates'
		}
		@endif
		@if( in_array(231,$permissions) )
		operations['suspends'] = {
			'text': 'Suspensión de tráfico E/S',
			'format': 'msisdn|scheduleDate(Opcional)',
			'sample': '5532689574|20181015',
			'path': '/cm/v1/subscribers/suspends'
		}
		@endif
		@if( in_array(232,$permissions) )
		operations['resumes'] = {
			'text': 'Reanudación de tráfico E/S',
			'format': 'msisdn|scheduleDate(Opcional)',
			'sample': '5532689574|20181015',
			'path': '/cm/v1/subscribers/resumes'
		}
		@endif
		@if( in_array(233,$permissions) )
		operations['changeslinking'] = {
			'text': 'Cambio de Vinculación',
			'format': 'msisdn|Coordenadas',
			'sample': '55326985423|19.3952801,-99.1774201',
			'path': '/cm/v1/subscribers/changeslinking'
		}
		@endif
		@if( in_array(234,$permissions) )
		operations['barrings'] = {
			'text': 'Suspensión de tráfico saliente',
			'format': 'msisdn',
			'sample': '55326985423',
			'path': '/cm/v1/subscribers/barrings'
		}
		@endif
		@if( in_array(235,$permissions) )
		operations['unbarrings'] = {
			'text': 'Reanudación de tráfico saliente',
			'format': 'msisdn',
			'sample': '55326985423',
			'path': '/cm/v1/subscribers/unbarrings'
		}
		@endif
		@if( in_array(236,$permissions) )
		operations['reactivates'] = {
			'text': 'Reactivación de usuario final',
			'format': 'msisdn|scheduleDate(Opcional)',
			'sample': '5532689574|20181015',
			'path': '/cm/v1/subscribers/reactivates'
		}
		@endif
		@if( in_array(237,$permissions) )
		operations['changesprimary'] = {
			'text': 'Cambio de Producto',
			'format': 'msisdn|OfferingId|Coordenadas(Opcional)|scheduleDate(Opcional)',
			'sample': '55326985423|1001000019|19.3952801,-99.1774201|20181015',
			'path': '/cm/v1/subscribers/changesprimary'
		}
		@endif
		@if( in_array(238,$permissions) )
		operations['purchasessupplementary'] = {
			'text': 'Compra de Producto',
			'format': 'msisdn|offeringdId|scheduleDate (Opcional)',
			'sample': '5532698452|1001000019,1001000015|20190523',
			'path': '/cm/v1/subscribers/purchasessupplementary'
		}
		@endif
		@if( in_array(239,$permissions) )
		operations['preregistrations'] = {
			'text': 'Pre registro',
			'format': 'msisdn|oferta|address (Opcional)|msisdn_ported (Opcional)|idpos (Opcional)',
			'sample': '1000203796|1000000000|23.03553,-102.6231|1000200337|123',
			'path': '/cm/v1/subscribers/preregistrations'
		}
		@endif
		var Batch = function () {
        	var initializeDatatable = function initializeDatatable() {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('batch.load') }}",
		            dataType: 'text',  // what to expect back from the PHP script, if anything
			        cache: false,
			        contentType: false,
			        processData: false,
			        data: form_data,                         
			        type: 'post',
			        success: function(php_script_response){
			            //alert(php_script_response); // display response from the PHP script, if any
			        }
		            
		        }).done(function (response) {
		        	var obj = jQuery.parseJSON(response);
		            if(obj.error){
		            	$('#result').empty();
						$('#result').append('<label class="help-block mb-30 text-left"><strong>'+obj.error+'</strong>');
		            }else{
		            	$('#result').empty();
						$('#result').append('<label class="help-block mb-30 text-left"><strong>Status : '+obj.status+'</strong>');
		            }
		            
		        })
		        .fail(function() {
		        	$('#result').empty();
					$('#result').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
		            $.unblockUI();
		        })
		        .always(function () {
		            $.unblockUI();
		        })
		    };
        	return {
		        init: function() {
		        	$('#inputErrors').hide();
		        	$('#previous').hide();
				    $( "#finish" ).text('Procesar');
				    $( "#finish" ).click(function() {
				    	if ( $('#listOperations').children("option:selected").index() > 0) {
					    	if ($('#inputFileData').val() ) {
					    		var file_data = $('#inputFileData')[0].files[0];
								var extension = file_data.name.substr( (file_data.name.lastIndexOf('.') +1));
								if ( extension.toUpperCase() != 'CSV' && extension.toUpperCase() != 'TXT'){
									$('#inputErrors').show();
									$('#result').empty();
									$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite CSV o TXT</strong>');
									return;
								}
								var form_data = new FormData();
								var selectedOperation = $('#listOperations').children("option:selected").val();
								form_data.append("file", file_data);
								form_data.append("path", operations[selectedOperation].path);
								bloqueo();
						        $.ajax({
						            url: "{{ route('batch.load') }}",
						            dataType: 'text',  // what to expect back from the PHP script, if anything
							        cache: false,
							        contentType: false,
							        processData: false,
							        data: form_data,                         
							        type: 'post'					            
						        }).done(function (response) {
						        	$('#inputErrors').show();
						        	var obj = jQuery.parseJSON(response);
						            if(obj.errorCode){
						            	$('#result').empty();
						            	if ( obj.detail ){
											$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.detail+'</strong>');
										}
										if ( obj.description ){
											$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.description+'</strong>');
										}
						            }else{
						            	$('#result').empty();
										$('#result').append('<label class="help-block mb-30 text-left"><strong>TransactionId : </strong>'+obj.transaction.id+'');
						            }
						            
						        })
						        .fail(function() {
						        	$('#result').empty();
									$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
						            $.unblockUI();
						        })
						        .always(function () {
						            $.unblockUI();
						        });
							}else{
								$('#inputErrors').show();
								$('#result').empty();
								$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Seleccione un archivo válido</strong>');
							}
						}else{
							$('#inputErrors').show();
							$('#result').empty();
							$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Seleccione una operación</strong>');
						}
					});
				    var keys = Object.keys(operations);
				    for ( var i = 0; i < keys.length; i++){
				    	var o = new Option(operations[keys[i]].text, keys[i]);
				    	$('#listOperations').append(o);
				    }
					
					$("#listOperations").on("change", function(event) { 
					    var selectedOperation = $(this).children("option:selected").val();
        				$('#inputFormatSample').empty();
        				$('#inputLineSample').empty();
        				$('#inputFormatSample').append(operations[selectedOperation].format);
        				$('#inputLineSample').append(operations[selectedOperation].sample);
					} );
		        }
		    };
        }
        Batch().init();
	});
	
</script>
@endsection