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
    								Información del HOST
                                    </div>
                                    <!-- despues del header de la seccion -->
                                    <div class="card-body">
                                        <!-- Campo de IP de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">IP de Host</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_IP_Host" placeholder="Ingrese La IP del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_IP"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Host -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Host</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Host" placeholder="Ingrese el nombre del host" data-error="Valor inválido" maxlength="150">
														<div class="help-block with-errors" id="err_msg_host"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de tipo de dispositivo -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Tipo Dispositivo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_tipo_disp" placeholder="Ingrese el tipo de dispositivo" data-error="Valor inválido" maxlength="150">
														<div class="help-block with-errors" id="err_msg_tipo_disp"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /panel1 -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Información Usuario
                                    </div>
                                    <div class="card-body">
                                        <!-- Campo de Grupo de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Grupo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Grupo" placeholder="Ingrese grupo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_grupo"></div>
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
												        <label class="help-block text-left">Nombre de Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_NombreAlta" placeholder="Ingrese el Nombre Completo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_NombreAlta"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Tipo de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Tipo de Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_tipo_user" placeholder="Ingrese el tipo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_tip_user"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Perfil -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Perfil</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Perfil" placeholder="Ingrese el Perfil del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_Perfil"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Rotación -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Rotación de PAsssword</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Rot_Pass" placeholder="Rotación de Pass" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_Rot_Pass"></div>
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
        // $('#message' ).empty();

        $('err_msg_IP' ).empty();
        $('err_msg_host' ).empty();
        $('err_msg_tipo_disp' ).empty();
        $('err_msg_grupo' ).empty();
        $('err_msg_NombreAlta' ).empty();
        $('err_msg_tip_user' ).empty();
        $('err_msg_Perfil' ).empty();
        $('err_msg_Rot_Pass' ).empty();


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
			url: "{{ route('Users.call.alta_user') }}",
			type: 'GET',
		 	data: {
                 'send_ip'			: $('#cmd_IP_Host').val(),
                 'send_host'		: $('#cmd_Host').val(),

				 'send_idtipodisp'	    : $('#cmd_NombreAlta').val(),
				 'send_idgrupo'		: $('#cmd_ID_company').val(),
                 'send_usuario'	    : $('#cmd_ID_Estado').val(),
                 'send_idtipo'		: $('#cmd_ID_Nivel').val(),
                 'send_idstatus'	: $('#cmd_ID_Responsable').val(),
                 'send_idperfil' 	: $('#cmd_ID_Solicitante').val(),
                 'send_idflag'      : $('#cmd_ID_Solicitante').val(),
                 'id_solicitante'   : "{{ app('auth')->user()->id }}",
                 'send_fechaalta'   : "",
                 'send_fecharota'   : "",
                 'send_fechaterm'   : ""

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

