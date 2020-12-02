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
						<h3><span class="head-font capitalize-font">Busqueda de Usuario</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Template busqueda Usuario -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_Action')
										    </div>
									    </div>
								    </div>
							    </div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Revisión Contraseña</span></h3>
						<section>
                            <form id="step_two">
                                <!-- Panel -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos Usuario
                                    </div>
                                    <div class="card-body">
                                        <!-- Campo de Correo de usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Correo Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Mail_user" placeholder="Ingrese el correo del usuario" data-error="Valor inválido" maxlength="150" disabled>
													    <div class="help-block with-errors" id="err_msg_Mail_user"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Nombre de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Nombre Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_NombreAlta" placeholder="Ingrese el Nombre Completo del usuario" data-error="Valor inválido" maxlength="150" disabled>
													    <div class="help-block with-errors" id="err_msg_NombreAlta"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Contraseña -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Contraseña</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_password" placeholder="Ingrese la contrase&ntilde;a del usuario" data-error="Valor inválido" maxlength="150" disabled>
														<div class="help-block with-errors" id="err_msg_password"></div>
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
                                <div class="row" id="message_text">
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
        var dato=$('#cmd_searchdata').val();

        //REalizo validacion de que el dato este correcto
		if (patrones[tipo_campo].test(dato)) {
            //$('#message_text').append('sisfen voy 2');
			fun_ejecuta_busqueda();
            return true;

		} else {
            //$('#message_text').append('sisfen voy 3');
		    $("#cmd_searchdata").css({'border' : '1px solid #f73414'});
			$("#message_text").css('color', '#f73414');
			$("#message_text").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
            return false;
        }//else
	}

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda(){
        //limpio los textos
        $('#message_text').empty();
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

        //Ejecuto la busqueda del dato
        $.ajax({
			url: "{{ route('Users.call.view_user_pass') }}",
			type: 'GET',
		 	data: {
		 		'type': tipo_campo,
		 		'value': $('#cmd_searchdata').val()
		 	}
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            //$('#message_text').append('sisfen voy 4');
        })
        .fail(function() {
	        	$('#message_text').empty();
                $('#message_text').append('<label class="help-block mb-30 text-center"><strong>Usuario no encontrado</strong>');
                $( "#previous" ).trigger( "click" );
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
        		$('#value').val('');
				$('#message_text').empty();
				$('#message_text').append('<label class="help-block mb-30 text-center"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}else{
                // coloco los datos en los txt
                $('#cmd_NombreAlta').val(obj.name);
                $("#cmd_Mail_user").val(obj.email);
                $("#cmd_password").val(obj.password);


                // configuro la siguiente pestaña
        		$('#message_text').append('<label class="help-block mb-30 text-center" style="color: red"><strong>Confirme el borrado del usuario</strong> ');
                // $('#previous').show();
                $( "#finish" ).text('Borrar');

                $.unblockUI();

	        }// Else
			$.unblockUI();
        });

    }//fun_ejecuta_busqueda



    // Funcion de Fin de Vista, ejecucion
    function finished(){

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
                    $( "#finish" ).text('Siguiemte');

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
