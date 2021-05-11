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
						<h3><span class="head-font capitalize-font">Alta de usuario Boveda</span></h3>
						<section>
                            <!-- Contenedor -->
                            <form id="form_tabs" action="#">
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos de la cuenta (usuario)
                                    </div>
                                    <!-- despues del header de la seccion -->
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
														<input type="text" data-minlength="10" class="form-control" id="cmd_Mail_user" placeholder="Ingrese el correo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_Mail_user"></div>
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
														<input type="password" data-minlength="10" class="form-control" id="cmd_password" placeholder="Ingrese la contrase&ntilde;a del usuario" data-error="Valor inválido" maxlength="150">
														<div class="help-block with-errors" id="err_msg_password"></div>
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
    								Datos Usuario
                                    </div>
                                    <div class="card-body">
                                        <!-- Campo de Nombre de Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Nombre Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_NombreAlta" placeholder="Ingrese el Nombre Completo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_NombreAlta"></div>
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
														<input type="text" data-minlength="10" class="form-control" id="cmd_Telefono" placeholder="Ingrese el Telefono del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_Telefono"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /panel2 -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos Extras Temporales
                                    </div>
                                        <!-- Campo temporal de ID company -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ID company</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ID_company" placeholder="Ingrese el ID de compañia" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_ID_Company"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Temporal de ID Estado -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ID Estado</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ID_Estado" placeholder="Ingrese el ID de Estado" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_ID_Estado"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Temporal de ID Nivel-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ID Nivel</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ID_Nivel" placeholder="Ingrese el ID nivel" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_ID_Nivel"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Temporal de ID Responsable -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Id Responsable</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ID_Responsable" placeholder="Ingrese el ID responsable" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_ID_Responsable"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Temporal de Id solicitante -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ID Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ID_Solicitante" placeholder="Ingrese el Ide del solicitante" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_ID_Solicitante"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <!-- Texto de Menajes -->
                                <div class="row" id="message_error">
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
        $('#err_msg_Mail_user' ).empty();
        $('#err_msg_password' ).empty();
        $('#err_msg_NombreAlta' ).empty();
        $('#err_msg_ID_Company' ).empty();
        $('#err_msg_ID_Estado' ).empty();
        $('#err_msg_ID_Nivel' ).empty();
        $('#err_msg_ID_Responsable' ).empty();
        $('#err_msg_ID_Solicitante' ).empty();
        $('#err_msg_Telefono' ).empty();


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
        }

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
				 'send_email'			: $('#cmd_Mail_user').val(),
				 'send_password'		: $('#cmd_password').val(),
				 'send_username'	    : $('#cmd_NombreAlta').val(),
				 'send_id_company'		: $('#cmd_ID_company').val(),
				 'send_id_estado'	    : $('#cmd_ID_Estado').val(),
				 'send_id_nivel'		: $('#cmd_ID_Nivel').val(),
                 'send_id_responable'	: $('#cmd_ID_Responsable').val(),
				 'send_id_solicitante' 	: $('#cmd_ID_Solicitante').val(),
                 'send_id_createdby'   	: "{{ app('auth')->user()->id }}",
                 'send_createdby'    	: "{{ app('auth')->user()->email }}",
                 'send_Telefono'        : $('#cmd_Telefono').val()
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
			$('#message_error').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en alta de usuario Boveda </label>');
	        $.unblockUI();
	    })
        .always(function()
        {
            if ( obj2.statusCode!= null && obj2.statusCode!=200 )
            {
				// $('#message').empty();
				$('#message_error').append('<label class="alert-danger mb-30 text-left">Alta de usuario <strong>no exitosa</strong><br>'+obj2.error+'</label>');
				$.unblockUI();
            }else
            {
			    $('#validar').hide();
				$('#finish').hide();
				//$('#message').empty();
                $('#message_error').append('<label class="help-block mb-30 text-left">Alta del usuario fue<strong>&nbsp;&eacutexitosa</strong></label>');
                $('#cmd_Mail_user').val("");
				$('#cmd_password').val("");
				$('#cmd_NombreAlta').val("");
				$('#cmd_ID_company').val("");
				$('#cmd_ID_Estado').val("");
				$('#cmd_ID_Nivel').val("");
                $('#cmd_ID_Responsable').val("");
				$('#cmd_ID_Solicitante').val("");
                $('#cmd_Telefono').val("");
				$.unblockUI();
            }//else
		})
        /// a aqui

        
        //$.unblockUI();

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
                    $( "#finish" ).text('Alta');

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

