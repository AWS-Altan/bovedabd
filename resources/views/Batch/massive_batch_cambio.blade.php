
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
						<h3><span class="head-font capitalize-font">Cambios Masivos de Usuarios</span></h3>
						<section>

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
                            <div class="row" id="message_error">
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

    function bloqueo()
    {
        //realizo el bloqueo de pantalla
        $.blockUI({ message: 'Procesando ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });
    }//bloqueo

    /******************************
     *  Historial Modificaciones
     * 2020/12/30 - modificacion de colores y omicion de resultado de carga
    ******************************/
    function loadfile($file_data){
        var form_data = new FormData();
        form_data.append("file", $file_data);
	    $.ajax({
            url: "{{ route('batch.masive_change.load') }}",
            type: 'POST',
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
			contentType: false,
            processData: false,
            data: form_data
        }).done(function (response)
        {
            executeCharge($file_data);
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
    }//loadfile

    function executeCharge($file_data){
        var data = {};
        data.file  = $file_data.name;

        $.ajax({
            url: "{{ route('batch.masive_change.exec') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
        }).done(function (response)
        {
            jsJLresp = jQuery.parseJSON(response);
            $('#message_error').empty();
            $('#result').empty();
            if(jsJLresp.details == "Success")
            {
                $('#result').append('<label class="help-block mb-30 text-left" style="color: green"><strong>' + jsJLresp.details + '</strong>');
            }else{
                $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>' + jsJLresp.details + '</strong>');
            }//else
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
    }//executeCharge

    // Funcion de Fin de Vista, ejecucion
    function finished(){
		$('#previous').hide();
		if ($('#inputFileData').val() )
		{
            var file_data = $('#inputFileData')[0].files[0];
			var extension = file_data.name.substr( 0,6);
			if ( extension.toUpperCase() != 'CAMBIO')
			{
				$('#inputErrors').show();
				$('#result').empty();
				$('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite archivos de cambio</strong>');
				return;
			}//if
            bloqueo();
            loadfile(file_data);
            // comienzo ejecución de carga
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

                    $('#message_error').empty();
				    //initializePlugins2();

				    $( "#finish" ).click(function() {
                        //Aqui va el codigo de cuando se presiona el boton
                    });
		        }
		    };
        }


        Operations2().init();
    });// fin de inicio de pantall

</script>
@endsection

