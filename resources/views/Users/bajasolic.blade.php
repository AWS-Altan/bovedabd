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
						<h3><span class="head-font capitalize-font">Busqueda de Solicitantes</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Tmplate busqueda solicitante -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_Users')
										    </div>
									    </div>
								    </div>
							    </div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Confirmación Deshabilitación</span></h3>
						<section>
                            <form id="step_two">
                                <!-- Panel -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos Solicitante
                                    </div>
                                    <div class="card-body">
                                        <!-- Campo de Correo de Solicitante -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Correo Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Mail_user" placeholder="Ingrese el correo del solicitante" data-error="Valor inválido" maxlength="150" disabled>
													    <div class="help-block with-errors" id="err_msg_Mail_user"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Nombre de solicitante -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Nombre Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_NombreAlta" placeholder="Ingrese el Nombre Completo del solicitante" data-error="Valor inválido" maxlength="150" disabled>
													    <div class="help-block with-errors" id="err_msg_NombreAlta"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                        <div>
                            <div align="center">
                                <!-- Texto de Menajes -->
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="row" id="message_error">
						        </div>
                            </div>
                        </div>
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



    // funcion para cambio de pestaña
    function ValidateNext() {
        //Validacion de campo de busqueda Input data del layou te busqueda
        var dato=$('#inputData').val();

        //REalizo validacion de que el dato este correcto
		if (patrones[tipo_campo].test(dato))
        {
            console.log("Evalar");
            console.log(dato);
        	fun_llena_catalog("6",dato);
            return true;

		} else {
		    $("#inputData").css({'border' : '1px solid #f73414'});
			$("#message_error").css('color', '#f73414');
			$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
            return false;
        }//else
	}


    function fun_llena_catalog(iJL_catalog,sJLMail)
    {
        console.log(' Obtengo catalogo '+ iJL_catalog+' '+sJLMail);
        //Realizo el bloqueo de la pantalla
		$.blockUI({ message: 'Procesando ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });

        var jsonchange = {};
            jsonchange.type= iJL_catalog;
            jsonchange.mail= sJLMail;

        $.ajax({
            url: "{{ route('Users.call.catalogs_view_solic') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsonchange)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("Ejecución Catalogo " + obj.status);
            console.log(obj);
            //$('#cbo_ID_Responsable').append($('<option></option>').val('').html('N/A'));

            console.log('resultado de busqueda');
            sjl_resbus=obj.data[0];
            console.log(sjl_resbus);
            if ( sjl_resbus.status=="ok" )
            {
                $('#cmd_Mail_user').val(sjl_resbus.infouser[0].send_mail);
                $('#cmd_NombreAlta').val(sjl_resbus.infouser[0].send_username);
                $('#message_error').empty();

            }
            else
            {
                console.log("usuario incorrecto ");
                $('#message_error').empty();
                $('#message_error').append('<label class="help-block mb-30 text-center" style="color: red"><strong>Solicitante No encontrado</strong> ');
                $( "#previous" ).trigger( "click" );
				$( "#previous" ).hide();
                return false;
            }
            return obj;
        })
        .fail(function() {
            //algo
            console.log("Error extracción de catalogo ");
            $( "#finish" ).hide();
            $('#message_error').empty();
            $('#message_error').append('<label class="help-block mb-30 text-center"><strong>Solicitante no encontrado</strong>');
        })
        .always(function() {
            //algo
            console.log("Catalogo always ");
            $.unblockUI();
        });

    }//fun_llena_catalog


    // funcion para ejecutar Borrado
    function fun_ejecuta_borrado(sJLMail)
    {
        $('#message_error').empty();
        //$('#message_error').append('Borro');

        //Bloqueo la pantalla
        $.blockUI({ message: 'Procesando ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });

        //Ejecuto la busqueda del dato
        var jsonchange = {};            
            jsonchange.mail= sJLMail;

        $.ajax({
            url: "{{ route('Users.call.Change_solstatus') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsonchange)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log(obj);
            if ( obj.status=="ok" )
            {
                $('#message_error').empty();
                $('#message_error').append('<label class="help-block mb-30 text-center" style="color: black"><strong>Solicitante Deshabilitado</strong> ');
            }
            else
            {
                $('#message_error').empty();
                $('#message_error').append('<label class="help-block mb-30 text-center" style="color: red"><strong>Solicitante No Deshabilitado</strong> ');
            }

        })
        .fail(function() {
	        	$('#message_error').empty();
                $('#message_error').append('<label class="help-block mb-30 text-center"><strong>Solicitante no encontrado</strong>');
                $( "#previous" ).trigger( "click" );
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
        		$('#value').val('');
				$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-center"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}else{
                // coloco los datos en los txt

                // configuro la siguiente pestaña

                // $('#previous').show();
                $( "#finish" ).text('Borrar');

                $.unblockUI();
	        }// Else
            $.unblockUI();
        });


    }//fun_ejecuta_busqueda


    // Funcion de Fin de Vista, ejecucion
    function finished(){
        //Borro el registro
        console.log('Ejecución de Borrado');
        fun_ejecuta_borrado($('#cmd_Mail_user').val());
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
                    $( "#finish" ).text('Deshabilitar');
                    //$('#finish').hide();
                    //$('#finish').hide();

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
