
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
						<h3><span class="head-font capitalize-font">Baja Masiva de Usuarios</span></h3>
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
		$('#previous').hide();
		if ($('#inputFileData').val() )
		{
            var file_data = $('#inputFileData')[0].files[0];
			var extension = file_data.name.substr( 0,4);
			if ( extension.toUpperCase() != 'BAJA')
			{
				$('#inputErrors').show();
				$('#result').empty();
				$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite archivos de baja</strong>');
				return;
			}//if
            var form_data = new FormData();
            form_data.append("file", file_data);
            bloqueo();
			$.ajax({
                url: "{{ route('batch.masive_baja.load') }}",
                type: 'POST',
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
                $.unblockUI();
			})
			.fail(function() {
				$('#result').empty();
                $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
				$.unblockUI();
			})
			.always(function () {
                $('#inputErrors').append(response);
				$.unblockUI();
			});
		} //if
		else
		{
			$('#inputErrors').show();
			$('#result').empty();
			$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Seleccione un archivo válido</strong>');
		} //else
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

