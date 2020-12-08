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
    								Informaci&oacute;n del Dispositivo
                                    </div>
                                    <!-- despues del header de la seccion -->
                                    <div class="card-body">
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Campo de IP de Usuario -->
                                                    <div><br></div>
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">IP de Host</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="ipHost" placeholder="Ingrese La IP del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_IP"></div>
												    </div>

                                                    <!-- Campo de Host -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Host</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="nameHost" placeholder="Ingrese el nombre del host" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_host"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Campo de tipo de dispositivo -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Tipo Dispositivo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="tipoDispositivo" class="form-control">
                                                        </select> 
                                                    </div>

                                                    <!-- Campo de Grupo de Usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Grupo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="grupo" class="form-control">
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Campo de usuario del dispositivo-->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="usuarioDispositivo" placeholder="Ingrese el usuario del dispositivo" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_usurioDispositivo"></div>
                                                    </div>
                                                    <!-- Contraseña del usuario del dispositivo-->
                                                    <div class="col-sm-2">
                                                        <label class="help-block text-left">Contrase&ntilde;a</label>
                                                    </div>                                          
                                                    <div class="col-sm-3">
                                                        <input type="password" data-minlength="10" class="form-control" id="password" placeholder="Ingrese la contrase&ntilde;a del usuario" data-error="Valor inválido" maxlength="150">
                                                            <div class="help-block with-errors" id="inputPasswordError"></div>
                                                    </div>  
                                                    <div class="col-sm-1 mb-20">
                                                        <button id="mostrarContrasena" class="btn btn-primary btn-xs">Ver</button>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Campo de tipo de dispositivo -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Tipo Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="tipoUsuario" class="form-control">
                                                        </select> 
                                                    </div>

                                                    <!-- Vigencia del usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Vigencia:</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <input type='date' id="txtDate" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Perfil -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Perfil</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="perfil" class="form-control">
                                                        </select> 
                                                    </div>
                                                    <!-- Solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left" id="solicitanteLabel">Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="solicitante" class="form-control">
                                                        </select> 
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
    								Informaci&oacute;n del Solicitante
                                    </div>
                                    <div class="card-body">
                                        <!-- Nombre del solicitante -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-2 mb-20">
												        <label class="help-block text-left">Nombre</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="nombreSolicitante" placeholder="Ingrese el nombre del solicitante" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_nombreSolicitante"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    
                                                     <!-- Apellido paterno del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Apellido Paterno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="paternoSolicitante" placeholder="Ingrese el apellido paterno del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_paternoSolicitante"></div>
                                                    </div>
                                                     <!-- Apellido materno del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Apellido Materno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="maternoSolicitante" placeholder="Ingrese el apellido materno del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_maternoSolicitante"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    
                                                     <!-- Movil del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">M&oacute;vil</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="movilSolicitante" placeholder="Ingrese el m&oacute; del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_movilSolicitante"></div>
                                                    </div>
                                                     <!-- mail del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Mail</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="mailSolicitante" placeholder="Ingrese el mail del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_mailSolicitante"></div>
                                                    </div>
                                                    <!-- organización del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Organizaci&oacute;n</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="organizacionSolicitante" placeholder="Ingrese la organización del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_organizacionSolicitante"></div>
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
        $('err_msg_nombreSolicitante' ).empty();
        
        $('err_msg_paternoSolicitante').empty();
        $('err_msg_maternoSolicitante').empty();
        $('err_msg_usurioDispositivo' ).empty();
        $('err_msg_movilSolicitante' ).empty();
        $('err_msg_mailSolicitante' ).empty();
        $('err_msg_organizacionSolicitante' ).empty();


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
			url: "{{ route('Users.call.alta_access') }}",
			type: 'GET',
		 	data: {
                 'send_ip'			: $('#ipHost').val(),
                 'send_host'		: $('#nameHost').val(),
				 'send_idtipodisp'	: $('#nombresolicitante').val(),
				 'send_idgrupo'		: $('#cmd_ID_company').val(),
                 'send_usuario'	    : $('#cmd_ID_Estado').val(),
                 'send_idtipo'		: $('#cmd_ID_Nivel').val(),
                 'send_idstatus'	: $('#cmd_ID_Responsable').val(),
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
                $('#ipHost').val("");
                $('#nameHost').val("");
                $('#usuarioDispositivo').val("");
                $('#password').val("");
                $('#nombreSolicitante').val("");
                $('#paternoSolicitante').val("");
                $('#maternoSolicitante').val("");
                $('#movilSolicitante').val("");
                $('#mailSolicitante').val("");
                $('#organizacionSolicitante').val("");

				$.unblockUI();
            }//else
		})
        /// a aqui

        //$('#message_text').append('voy finish B ');
        //$.unblockUI();

    } //finished


    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        $( "#mostrarContrasena" ).click(function( event ) {
                    event.preventDefault();
                    $('#password').prop('type','text');  
                    setTimeout( function(){
                    $('#password').prop('type','password');         
                    },5000);
                      

                    
                      
        });


        bloqueo();
        var data = {};
        
        data.mail= '{{app('auth')->user()->email}}';
        
        $.ajax({
            url: "{{ route('access.call.catalogos') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
        })
        .done(function(response) {
            var obj = jQuery.parseJSON(response);
            glob = obj; 
            //console.log('offertas:');
            console.log(obj);
            $('#grupo').append(
                $('<option></option>').val( '' ).html( 'Seleccionar Grupo')
            );
            $.each( obj.grupo, function(index) {
                
                $('#grupo').append(
                    $('<option></option>').val( obj.grupo[index].id ).html( obj.grupo[index].descripcion + ' - '+ obj.grupo[index].descripcionConjunto )
                );

            }); 


            $('#tipoDispositivo').append(
                $('<option></option>').val( '' ).html( 'Seleccionar tipo de dispositivo')
            );
            $.each( obj.tipoDispositivo, function(index) {
                
                $('#tipoDispositivo').append(
                    $('<option></option>').val( obj.tipoDispositivo[index].id ).html( obj.tipoDispositivo[index].tipo +' ' +obj.tipoDispositivo[index].vendor +' '+obj.tipoDispositivo[index].descripcion )
                );

            }); 


            $('#tipoUsuario').append(
                $('<option></option>').val( '' ).html( 'Seleccionar tipo de usuario')
            );
            $.each( obj.tipoUsuario, function(index) {
                
                $('#tipoUsuario').append(
                    $('<option></option>').val( obj.tipoUsuario[index].id ).html( obj.tipoUsuario[index].descripcion + ' - ' +  obj.tipoUsuario[index].descripcionTecnologia)
                );

            }); 

            if(obj.isManager==='true'){
                $('#solicitante').append(
                    $('<option></option>').val( '' ).html( 'Seleccionar solicitante')
                );
                $.each( obj.solicitante, function(index) {
                    
                    $('#solicitante').append(
                        $('<option></option>').val( obj.solicitante[index].id ).html( obj.solicitante[index].mail  )
                    );

                }); 
            }else{
                $('#solicitante').hide();
                $('#solicitanteLabel').hide();

            }


            $.unblockUI();
            
        })
        .fail(function() {
                $.unblockUI();
            })
        .always(function() {
            //$.unblockUI();
        });


         $('#solicitante').on('change', function() {
            if ( $('#solicitante').val()!=='' ){
                //alert('Entra');
                $.each( glob.solicitante, function(index) {
                    
                    if ( glob.solicitante[index].id==$('#solicitante').val() ){
                        $('#nombreSolicitante').val( glob.solicitante[index].nombre );
                        $('#paternoSolicitante').val( glob.solicitante[index].paterno );
                        $('#maternoSolicitante').val( glob.solicitante[index].materno );
                        $('#movilSolicitante').val( glob.solicitante[index].movil );
                        $('#mailSolicitante').val( glob.solicitante[index].mail );
                        $('#organizacionSolicitante').val( glob.solicitante[index].organizacion );
                    }
                }); 
            }
            //else{
            //    alert('no');
            //    $('#nombreSolicitante').val( '' );
            //}
            
        }); 


        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            $('#message_text').append('voy 1');

        	return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Alta');

                    $('#message_text').empty();
				    
                    //initializePlugins2();

				    $( "#finish" ).click(function() {
                        //Aqui va el codigo de cuando se presiona el boton
                        $('#message_text').append('voy 4');
                    });
                    
		        }
		    };
        }
        Operations2().init();



    });// fin de inicio de pantall

</script>
@endsection

