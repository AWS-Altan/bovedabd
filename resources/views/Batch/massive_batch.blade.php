
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

    function loadfile($file_data){
        var form_data = new FormData();
        form_data.append("file", $file_data);
        bloqueo();
	    $.ajax({
            url: "{{ route('batch.masive_alta.load') }}",
            type: 'POST',
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
			contentType: false,
            processData: false,
            data: form_data
        }).done(function (response)
        {
            $('#message_text').append("sisfen 1 ");
            //$('#inputErrors').show();
            //var obj = jQuery.parseJSON(response);
            $('#result').append(response);
            $('#message_text').append("sisfen 1.5 ");

            executeCharge($file_data);
            $('#message_text').append("sisfen 1.7 ");
            $.unblockUI();
	    })
	    .fail(function() {
            $('#message_text').append("sisfen 2 " + response);
            $('#result').empty();
            $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
            $('#message_text').append("sisfen 2.5 " + response);
			$.unblockUI();
	    })
	    .always(function () {
            $('#message_text').append("sisfen 6 " + response);
            $('#inputErrors').append(response);
            $('#message_text').append("sisfen 6.5 " + response);
			$.unblockUI();
        });
    }//loadfile

    function executeCharge($file_data){
        var data = {};
        data.file  = $file_data.name;

        $.ajax({
            url: "{{ route('batch.masive_alta.exec') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
        }).done(function (response)
        {
            $('#message_text').append("sisfen 2.1 ");
            $('#message_text').append($response);
            $('#inputErrors').show();
            $('#result').append($response);
            $.unblockUI();
		})
		.fail(function() {
            $('#result').empty();
            $('#message_text').append("sisfen 2.4 ");
            $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
			$.unblockUI();
		})
		.always(function () {
            $('#message_text').append("sisfen 2.8 ");
            $('#inputErrors').append(response);
			$.unblockUI();
		});
    }//executeCharge


    // Funcion de Fin de Vista, ejecucion
    function finished(){
		$('#previous').hide();
		if ($('#inputFileData').val() )
		{
            var file_data = $('#inputFileData')[0].files[0];
            var extension = file_data.name.substr( 0,4);
            $('#message_text').append("sisfen 0 Tipo de Archivo " + extension);
			if ( extension.toUpperCase() != 'ALTA')
			{
				$('#inputErrors').show();
				$('#result').empty();
				$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite archivos de alta</strong>');
				return;
            }//if

            $('#message_text').append("sisfen 4 load");
            loadfile(file_data);
            // comienzo ejecución de carga

            $('#message_text').append("sisfen 5 exec");
            $.unblockUI();


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

