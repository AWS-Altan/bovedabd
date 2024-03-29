
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
						<h3><span class="head-font capitalize-font">Alta/Actualización Masiva Cátalogo Dispositivos</span></h3>
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

    var bJL_successLoad=false; //variable para indicar que ya se realizo la carga

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
     * 2020/12/30 - omicion de resultado de carga y redireccionamiento
    ******************************/
    function loadfile($file_data){
        var form_data = new FormData();
        form_data.append("file", $file_data);


	    $.ajax({
            url: "{{ route('access.masive_dispcatalog.load') }}",
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
            console.log(response);
            // $('#inputErrors').append(response);
	    })
	    .fail(function() {
            $('#result').empty();
            $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
			$.unblockUI();
	    })
	    .always(function () {

			$.unblockUI();
        });
    }//loadfile

    /******************************
     *  Historial Modificaciones
     * 2020/12/30 - modificacion de colores y omicion de resultado de carga
    ******************************/
    function executeCharge($file_data){
        var data = {};
        data.file  = $file_data.name;

        $.ajax({
            url: "{{ route('access.masive_dispcatalog.exec') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
        }).done(function (response)
        {
            console.log(response);

            $('#message_error').empty();
            $('#inputErrors').empty();
            $('#result').empty();

            jsJLresp = jQuery.parseJSON(response);
            console.log('jsJLresp');
            console.log(jsJLresp);
            console.log('details');
            sJLdetails = jQuery.parseJSON(jsJLresp);
            console.log('json');
            console.log(sJLdetails);

            //console.log(jsJLresp.details.status);
            if(sJLdetails.status == "ok")
            {
                console.log("caso de Success");
                $('#inputErrors').append('<label class="help-block mb-30 text-left" style="color: green"><strong> ' + sJLdetails.details.details + ' ejecutadas: ' +  sJLdetails.details.ejecutadas + '</strong>');
                $("#finish" ).text('Ir a reporte');
                bJL_successLoad = true;
            }else{
                console.log("Diferente a Success");
                $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>' + sJLdetails.details + '</strong>');
            }//else

            $.unblockUI();
		})
		.fail(function() {
            $('#result').empty();
            $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Time Out</strong>');
			$.unblockUI();
		})
		.always(function () {
			$.unblockUI();
        });
    }//executeCharge


    // Funcion de Fin de Vista, ejecucion
    function finished()
    {
        if(!bJL_successLoad)
        {
            $('#previous').hide();
            if ($('#inputFileData').val() )
            {
                var file_data = $('#inputFileData')[0].files[0];
                var extension = file_data.name.substr( 0,8);
                if ( extension.toUpperCase() != 'CATALOGO')
                {

                    $('#inputErrors').show();
                    $('#result').empty();
                    $('#result').append('<label class="help-block mb-30 text-left" style="color: red"><strong>Formato incorrecto, sólo se permite archivos de CATALOGO</strong>');
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
        }//if
        else
        {
            $('#message_error').text('ejecución Redirect');
            //return redirect()->route('batch.altareport.index');

        }//else
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

