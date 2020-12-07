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
						<h3><span class="head-font capitalize-font">Alta de usuario Plataforma</span></h3>
						<section>
                            <!-- Contenedor -->
                            <form id="form_tabs" action="#">
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos del Usuario
                                    </div>
                                    <!-- despues del header de la seccion -->
                                    <div class="card-body">
                                        <!-- Campo de Nombre de usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Nombre del Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="3" class="form-control" id="cmd_name" placeholder="Ingrese el nombre del usuario" data-error="Valor inválido" maxlength="50">
														<div class="help-block with-errors" id="err_msg_name"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Apellido Paterno -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Apellido Paterno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="3" class="form-control" id="cmd_app_pat" placeholder="Ingrese el Apellido Paterno" data-error="Valor inválido" maxlength="50">
														<div class="help-block with-errors" id="err_msg_app_pat"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Apellido Materno -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Apelldo Materno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="3" class="form-control" id="cmd_app_mat" placeholder="Ingrese el Apellido Materno" data-error="Valor inválido" maxlength="50">
														<div class="help-block with-errors" id="err_msg_app_mat"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Telefono de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Número Telefonico</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="70" class="form-control" id="cmd_Telefono" placeholder="Ingrese el Telefono del usuario" data-error="Valor inválido" maxlength="30">
													    <div class="help-block with-errors" id="err_msg_Telefono"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Correo de usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Correo Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Mail_user" placeholder="Ingrese el correo del usuario" data-error="Valor inválido" maxlength="50">
													    <div class="help-block with-errors" id="err_msg_Mail_user"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Texto de Menajes -->
                                <div class="row" id="message_text">
								</div>
                            </form>
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


        // Limpio los mensajes de Error
        $('#message_text' ).empty();

        $('err_msg_name' ).empty();
        $('err_msg_app_pat' ).empty();
        $('err_msg_app_mat' ).empty();
        $('err_msg_Mail_user' ).empty();
        $('err_msg_Telefono' ).empty();


/*
        // Inicio Validaciones de campos
        // Valido que el campo del correo no este vacio
        if ( $('#cmd_Mail_user' ).val()=='' ){
			$('#err_msg_Mail_user' ).empty();
			$('#err_msg_Mail_user').append('<label class="alert-danger mb-30 text-left">capture el correo del usuario a dar de alta</label>');
			return false;
        }

        // Valido que el formato del correo sea correcto
        if (!patrones['email'].test($('#cmd_Mail_user').val())) {
			$('#err_msg_Mail_user').empty();
			$('#err_msg_Mail_user').append('<label class="alert-danger mb-30 text-left">El formato no es v&aacute;lido</label>');
			return false;
        }

        // Valido que el Password no este Vacio
        if ( $('#cmd_password' ).val()=='' ){
			$('#err_msg_password').empty();
			$('#err_msg_password').append('<label class="alert-danger mb-30 text-left">Capture la contrase&ntilde;a del nuevo usuario para acceder a Boveda</label>');
			return false;
        }*/

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

        ///de aqui
        //Mando los datos para ejecutar, construllo el Json
        $.ajax(
        {
			url: "{{ route('Access.call.alta_userman') }}",
			type: 'GET',
		 	data: {
                 'send_name'		: $('#cmd_name').val(),
                 'send_apppat'		: $('#cmd_app_pat').val(),
				 'send_appmat'	    : $('#cmd_app_mat').val(),
				 'send_phone'		: $('#cmd_Telefono').val(),
                 'send_mail'	    : $('#cmd_Mail_user').val(),
			}
		})
        .done(function(response)
        {
        	obj2 = jQuery.parseJSON(response);
        	console.log(obj2);
        })
        .fail(function()
        {
	        // $('#message').empty();
			$('#message_text').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en alta de usuario  </label>');
	        $.unblockUI();
	    })
        .always(function()
        {
            if ( obj2.statusCode!= null && obj2.statusCode!=200 )
            {
				// $('#message').empty();
				$('#message_text').append('<label class="alert-danger mb-30 text-left">Alta de usuario <strong>no exitosa</strong><br>'+obj2.error+'</label>');
				$.unblockUI();
            }else
            {
			    $('#validar').hide();
				$('#finish').hide();
				//$('#message').empty();
                $('#message_text').append('<label class="help-block mb-30 text-left">Alta del usuario fue<strong>&nbsp;&eacutexitosa</strong></label>');
                $('#cmd_IP_Host').val("");
                $('#cmd_Host').val("");
                $('#cmd_tipo_disp').val("");
                $('#cmd_Grupo').val("");
                $('#cmd_NombreAlta').val("");
                $('#cmd_tipo_user').val("");
                $('#cmd_Perfil').val("");
                $('#cmd_Rot_Pass').val("");

				$.unblockUI();
            }//else
		})
        /// a aqui

        $('#message_text').append('voy finish B ');
        //$.unblockUI();

    } //finished


    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            $('#message_text').append('voy 1');

        	return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Alta');

                    $('#message_text').empty();
				    $('#message_text').append('voy 2');
				    //initializePlugins2();

				    $( "#finish" ).click(function() {
                        //Aqui va el codigo de cuando se presiona el boton
                        $('#message_text').append('voy 4');
                    });
                    $('#message_text').append('voy 3');
		        }
		    };
        }
        Operations2().init();



    });// fin de inicio de pantall

</script>
@endsection

