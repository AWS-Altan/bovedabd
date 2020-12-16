
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
						<h3><span class="head-font capitalize-font">Alta Masiva de Usuarios</span></h3>
						<section>
                            <p>Seleccione el archivo a procesar:
                            <p>Archivos:
							<!-- <input type="file" name="archivos[]" class="form-control" id="inputFileData" placeholder="Archivo" data-error="Valor inválido"> -->
                            <!-- <input type="submit" value="Enviar" /> -->
							<div class="form-group">
								Seleccione el archivo a procesar: <input type="file" data-minlength="7" class="form-control" id="inputFileData" placeholder="Archivo" data-error="Valor inválido" maxlength="20">
								<div class="help-block with-errors"></div>
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
                            <!-- Texto de Menajes -->
                            <div class="row" id="message_text">
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

<!-- Inicio la programación del estilo -->
@section('jsfree')
<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 45%;
	}
</style>
<script>



    // Funcion de Fin de Vista, ejecucion
    function finished(){
        //sisfen test

		        	//$('#inputErrors').hide();
		        	$('#previous').hide();
				    //$( "#finish" ).text('Procesar');
				    //$( "#finish" ).click(function() {
					    if ($('#inputFileData').val() ) {
                            var file_data = $('#inputFileData')[0].files[0];
							var extension = file_data.name.substr( (file_data.name.lastIndexOf('.') +1));
							if ( extension.toUpperCase() != 'CSV' && extension.toUpperCase() != 'TXT'){
                                $('#message_text').append('sisfen 7');
								$('#inputErrors').show();
								$('#result').empty();
								$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite CSV o TXT</strong>');
								return;
							}
                            var form_data = new FormData();
                            // $('#message_text').append('sisfen 7.4' + file_data.name);
                            form_data.append("file", file_data);
                            bloqueo();
						    $.ajax({
                                url: "{{ route('batch.masive_alta.load') }}",
                                type: 'POST',
                                //contentType: "application/json",
                                dataType: 'text',  // what to expect back from the PHP script, if anything
                                cache: false,
							    contentType: false,
                                processData: false,
                                data: form_data
                            }).done(function (response)
                            {
                                $('#inputErrors').show();
                                var obj = jQuery.parseJSON(response);

                                $('#result').append(response);

                                $('#message_text').append('sisfen 9.5');
                                $.unblockUI();
						    })
						    .fail(function() {
                                $('#message_text').append('sisfen 14' + response);
						        $('#result').empty();
                                $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
						        $.unblockUI();
						    })
						    .always(function () {
                                $('#message_text').append('sisfen 15' + response);
                                $('#inputErrors').append(response);
						        $.unblockUI();
						    });
						}else{
                            $('#message_text').append('sisfen 16');
							$('#inputErrors').show();
							$('#result').empty();
							$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Seleccione un archivo válido</strong>');
						}
					//});
		        //}
		    //};
        //sisfen test
    } //finished
    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana


        	return {
		        init: function() {
		        	$('#previous').hide();
                    // $( "#finish" ).hide();

                    $('#message_text').empty();
				    //initializePlugins2();

				    $( "#finish" ).click(function() {
                        //Aqui va el codigo de cuando se presiona el boton
                        //$('#message').append('voy 4');
                    });
                    //$('#message').append('voy 3');
		        }
		    };
        }


        Operations2().init();
    });// fin de inicio de pantall

</script>
@endsection

