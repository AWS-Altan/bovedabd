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
						<h3><span class="head-font capitalize-font">Port-In</span></h3>
						<section>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-sm-9">
												<div class="form-wrap" style="display: inline-block;">
													    <div class="help-block" style="color:#9E1D22; font-weight: bold;">
													    	Todos los Port-In ocurren en el  horario definido por el ABD. Sólo aplica si se tiene integración directa con el ABD
													    </div>	
														<form id="form_identify">
															<div class="form-group">
															</div>

															<div class="row" id="formatLineBatch">
																<div class="col-sm-9 mb-60" style = "width: 100%">
																	<div class="form-group mt-20 mb-10">
																		<label class="control-label mb-10 text-left">Formato</label>
																		<label id="inputFormatSample" type="text" class="form-control filled-input">Formato por línea</label>
																	
																		<label class="control-label mb-10 text-left">Ejemplo</label>
																		<label id="inputLineSample" type="text" class="form-control filled-input">
																		Ejemplo por línea
																		</label>
																	</div>
																	
																	<div class="form-group">
																		<a href="{{ route('batch.example.download')}}" class="btn btn-primary btn-xs">Descargar Ejemplo</a>
																	</div>
																	<br>

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

		operations['PortIn'] = {
			'text': 'Port-In',
			'format': 'MSISDN transitorio||MSISDN portado||||||Y',
			'sample': '5532698452||5532689574||||||Y',
			'path': '/ac/v1/msisdns/portas-in-c'
		}

		$( "#inputFileData" ).change(function( event ) {
			event.preventDefault();
			$('#inputErrors').hide();
			$( "#finish" ).hide();

			var file_data = $('#inputFileData')[0].files[0]; 

			if (file_data){
				
				var form_data = new FormData();
				form_data.append("file", file_data);
				form_data.append("path", operations['PortIn'].path);

				//bloqueo();
				$.blockUI({ message: 'Validando archivo ...',css: { 
	            	border: 'none', 
	            	padding: '15px', 
	            	backgroundColor: '#000', 
	            	'-webkit-border-radius': '10px', 
	            	'-moz-border-radius': '10px', 
	            	opacity: .5, 
	            	color: '#fff' 
	        	} });

		        $.ajax({
		            url: "{{ route('batch.validate.file') }}",
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
		        	console.log( obj );
		        	$('#inputErrors').show();
		            if (  obj.statusCode!= null && obj.statusCode!=200 )  {
		            	$('#result').empty();
		            	$('#result').show();
						if ( obj.error ){

							$('#result').append('<label class="help-block mb-30 text-left" style="color: red">No es posible cargar el archivo seleccionado debido a los siguientes errores en el formato<br></label>');

							
							$.each(obj.error, function(keyTipo,valueTipo){
								
								$('#result').append('<strong> ' + valueTipo.length +' '+ keyTipo + '</strong><br>');
								
								$.each(valueTipo,function(index){
									if (index<10){
									$('#result').append('' + valueTipo[index] + '<br>');
									}
								})
								
							}) 
								
							
							$( "#finish" ).hide();
						}
		            }else{
		            	$('#result').empty();
		            	$('#inputErrors').hide();
		            	$( "#finish" ).show();
						
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

	        }
		});

		var Batch = function () {
			var file_data = $('#inputFileData')[0].files[0]; 
			var form_data = new FormData();
			form_data.append("file", file_data);
			form_data.append("path", operations['PortIn'].path);

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
		        	console.log( obj );
		            if (  obj.statusCode!= null && obj.statusCode!=200 )  {
		            	$('#result').empty();
						if ( obj.detail ){
							$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.detail+'</strong>');
						}
						if ( obj.description ){
							$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.description+'</strong>');
						}
						if ( obj.error ){
							$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.error+'</strong>');
						}
		            }else{
		            	$('#result').empty();
						$('#result').append('<label class="help-block mb-30 text-left"><strong>TransactionId : </strong>'+obj.transaction.id+'');
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
		        	$('#inputFormatSample').empty();
		        	$('#inputLineSample').empty();
		        	$('#inputFormatSample').append(operations['PortIn'].format);
		        	$('#inputLineSample').append(operations['PortIn'].sample);

				    $( "#finish" ).text('Ejecutar');
				    $( "#finish" ).hide();
				    $( "#finish" ).click(function() {
				    	
					    	if ($('#inputFileData').val() ) {
					    		var file_data = $('#inputFileData')[0].files[0];   
								var form_data = new FormData();
								
								form_data.append("file", file_data);
								form_data.append("path", operations['PortIn'].path );

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
						        	console.log( obj );
						            //if(obj.statusCode){
						            if (  obj.statusCode!= null && obj.statusCode!=200 )  {	
						            	$('#result').empty();
						            	if ( obj.detail ){
											$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.detail+'</strong>');
										}
										if ( obj.description ){
											$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.description+'</strong>');
										}
										if ( obj.error ){
											$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>'+obj.error+'</strong>');
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
						
					});

		        }
		    };
        }
        Batch().init();

	});
	
</script>
@endsection