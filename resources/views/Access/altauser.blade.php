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
						<h3><span class="head-font capitalize-font">Alta de usuario Dispositivo</span></h3>
						<section>
                            <!-- Contenedor -->
                            <form id="form_tabs" action="#">

                                <!-- Informacion dispositivo -->
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
                                                    <div class="col-sm-3 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="ipHost" placeholder="Ingrese la direcci&oacute;n IP del dispositivo" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="ipHostError"></div>
												    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>


                                                    <!-- Campo de Host -->
                                                    <div class="col-sm-2 mb-20">
                                                    </div>
                                                    <div class="col-sm-3 mb-20">
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
                                                    <div class="col-sm-3 mb-20 select select-group" >
                                                        <select id="tipoDispositivo" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="tipoDispositivoError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>


                                                    <!-- Campo de Grupo de Usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Grupo</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20 select select-group" >
                                                        <select id="grupo" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="grupoError"></div>
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
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="usuarioDispositivo" placeholder="Ingrese usuario solicitado para el dispositivo" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="usuarioDispositivoError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                    <!-- Contraseña del usuario del dispositivo-->
                                                    <div class="col-sm-2">
                                                        <label class="help-block text-left">Contrase&ntilde;a</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="password" data-minlength="10" class="form-control" id="password" placeholder="Ingrese password a asignar" data-error="Valor inválido" maxlength="150">
                                                            <div class="help-block with-errors" id="PasswordError"></div>
                                                    </div>
                                                    <div class="col-sm-2 mb-20">
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
                                                    <div class="col-sm-3 mb-20 select select-group" >
                                                        <select id="tipoUsuario" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="tipoUsuarioError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                    <!-- Vigencia del usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Termino de Activación:</label>
                                                    </div>
                                                    <div class="col-sm-2 mb-20 select select-group" >
                                                        <input type='date' id="txtDate" class="inputCal" value="" /> <label id="cleardate" onclick="clearDateTime()"></label>
                                                        <div class="help-block with-errors" id="txtDateError"></div>
                                                    </div>
                                                    <div class='input-group date' id = "dateVigencia" style="width: 195px">
                                                    <input id="txtTime" type='text' class="form-control" placeholder="HH:mm"/>
                                                    <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                    </span>
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
                                                        <label class="help-block text-left" id="perfilLabel">Perfil</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20 select select-group" >
                                                        <select id="perfil" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="perfilError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                    <!-- Solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left" id="solicitanteLabel">Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20 select select-group" >
                                                        <select id="solicitante" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="solicitanteError"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- Informacion solictante -->
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
                                                    <div class="col-sm-3 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="nombreSolicitante" placeholder="Ingrese el nombre del solicitante" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="nombreSolicitanteError"></div>
												    </div>
                                                    <div class="col-sm-1 mb-20">
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
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="paternoSolicitante" placeholder="Ingrese el apellido paterno del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="paternoSolicitanteError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                     <!-- Apellido materno del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Apellido Materno</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="maternoSolicitante" placeholder="Ingrese el apellido materno del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="maternoSolicitanteError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">M&oacute;vil</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="movilSolicitante" placeholder="Ingrese el m&oacute; del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="movilSolicitanteError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                     <!-- mail del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Mail</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="mailSolicitante" placeholder="Ingrese el mail del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="mailSolicitanteError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- organización del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Organizaci&oacute;n</label>
                                                    </div>
                                                    <div class="col-sm-3 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="organizacionSolicitante" placeholder="Ingrese la organización del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="organizacionSolicitanteError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Informacion Responsable -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								    Información de responsable
                                    </div>
                                    <div class="card-body">
                                        <!-- Nombre del solicitante -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>

                                                            <div class="col-sm-3 mb-20">
                                                                <label class="help-block text-left">Id Responsable</label>
                                                            </div>
                                                            <div class="col-sm-4 mb-20">
                                                                <select id="cbo_ID_Responsable" class="form-control" name="cbo_ID_Responsable">
                                                                </select>
                                                                <div class="help-block with-errors" id="err_msg_ID_Responsable"></div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Correo del responsable -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                            <div class="col-sm-3 mb-20">
                                                                <label class="help-block text-left">Correo del Responsable</label>
                                                            </div>
                                                            <div class="col-sm-4 mb-20">
                                                                <input type="text" data-minlength="10" class="form-control" id="cmd_Mail_resp" placeholder="Ingrese el correo del responsable" data-error="Valor inválido" maxlength="150">
                                                                <div class="help-block with-errors" id="mailresponsableError"></div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row" id="message" style="height:80px; width:103%;">
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

    //2021/07/28 - Acrtualización GUI - JLDS
    function fun_llena_catalog(iJL_catalog,iJL_idResp)
    {
        console.log(' Obtengo catalogo '+ iJL_catalog + 'voy por id ' + iJL_idResp);
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

        $.ajax({
            url: "{{ route('Users.call.catalogs_view') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsonchange)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("Ejecución Catalogo " + obj.status);
            console.log(obj);

            $('#cbo_ID_Responsable').append($('<option></option>').val('').html('N/A'));
		    $.each( obj.data, function( value, name )
			{
                /*if (name.send_id==iJL_idResp)
                {
                    console.log('revisando');
                    console.log(value);
				    console.log(name);
                    console.log(iJL_idResp);

                }*/

                $('#cbo_ID_Responsable').append(
				    	$('<option></option>').val(name.send_id).html(name.send_nameresp)
				);
                //$('#cmd_Mail_resp').val(name.send_mail);

			});
            document.getElementById("cbo_ID_Responsable").onchange = function() {fun_cambio__resp_mail(obj.data)};
            return obj.data;
        })
        .fail(function() {
            //algo
            console.log("Error extracción de catalogo ");
        })
        .always(function() {
            //algo
            console.log("Catalogo always ");
            //$.unblockUI();
        });

    }//fun_llena_catalog

    // Funcion de Fin de Vista, ejecucion
    function finished()
    {
        var fechaTermino = '';
        // Limpio los mensajes de Error
        $('#message, #ipHostError, #usuarioDispositivoError, #passwordError' ).empty();
        $('#tipoDispositivoError, #grupoError, #tipoUsuarioError, #perfilError, inputSolicitanteError' ).empty();
        $('#nombreSolicitanteError, #paternoSolicitanteError, #maternoSolicitanteError, #movilSolicitanteError, mailSolicitanteError, #organizacionSolicitanteError' ).empty();

        if ( $('#ipHost' ).val()=='' ){
            $('#ipHostError' ).empty();
            $('#ipHostError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( !patrones['ip'].test($('#ipHost').val())) {
            $('#message').empty();
            $('#ipHostError').empty();
            $('#ipHostError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }


        if (  $('select#tipoDispositivo').prop('selectedIndex')<=0 ){
            $('#tipoDispositivoError').empty();
            $('#tipoDispositivoError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        //trasnformado a mayusculas del usuario en MSS MSS
        if($('select#tipoDispositivo').prop('selectedIndex')==12)
        {
            sJLuser=$('#usuarioDispositivo').val();
            $('#usuarioDispositivo').val(sJLuser.toUpperCase());
        }//if

        if ( $('select#grupo').prop('selectedIndex')<=0){
            $('#grupoError').empty();
            $('#grupoError').append('<label class="alert-danger mb-30 text-left">seleccionar un grupo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('#usuarioDispositivo' ).val()=='' ){
            $('#usuarioDispositivoError').empty();
            $('#usuarioDispositivoError').append('<label class="alert-danger mb-30 text-left">capturar el nuevo usuario del dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('#password' ).val()=='' ){
            $('#passwordError').empty();
            $('#passwordError').append('<label class="alert-danger mb-30 text-left">capturar contrase&ntilde;a del nuevo usuario del dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if( $('select#tipoUsuario').prop('selectedIndex')<=0){
            $('#tipoUsuarioError').empty();
            $('#tipoUsuarioError').append('<label class="alert-danger mb-30 text-left">seleccionar tipo de usuario</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        if ( $('#txtDate' ).val()=='' ){
            $('#txtDateError').empty();
            $('#txtDateError').append('<label class="alert-danger mb-30 text-left">capturar fecha de vigencia del nuevo usuario</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }else{
            fechaTermino = $('#txtDate').val() + ' ' + $('#txtTime').val() + ':59'

        }

        if ( $('select#solicitante option').length >0 ) {

            if ( $('select#solicitante').prop('selectedIndex')<=0 ){
                $('#solicitanteError').empty();
                $('#solicitanteError').append('<label class="alert-danger mb-30 text-left">seleccionar un solicitante</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                return false;
            }

        }

        if ( $('#nombreSolicitante' ).val()=='' ){
            $('#nombreSolicitanteError' ).empty();
            $('#nombreSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar el nombre del solicitante</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }


        if ( $('#paternoSolicitante' ).val()=='' ){
            $('#paternoSolicitanteError' ).empty();
            $('#paternoSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar el apellido paterno del solicitante</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('#maternoSolicitante' ).val()=='' ){
            $('#maternoSolicitanteError' ).empty();
            $('#maternoSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar el apellido materno del solicitante</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( !patrones['msisdn'].test($('#movilSolicitante').val()) ){
            $('#message').empty();
            $('#movilSolicitanteError').empty();
            $('#movilSolicitanteError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }


       if ( !patrones['email'].test($('#mailSolicitante').val()) ){
            $('#message').empty();
            $('#mailSolicitanteError').empty();
            $('#mailSolicitanteError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }


        if ( $('#organizacionSolicitante' ).val()=='' ){
            $('#organizacionSolicitanteError' ).empty();
            $('#organizacionSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar la organización del solicitante</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
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
			url: "{{ route('users.call.alta_access') }}",
			type: 'GET',
		 	data:
                {
                    'ip'                    : $('#ipHost').val(),
                    'usuario'               : $('#usuarioDispositivo').val(),
                    'password'              : $('#password').val(),
                    'idTipoDispositivo'     : $('#tipoDispositivo option:selected').val(),
                    'idGrupo'               : $('#grupo option:selected').val(),
                    'flagRotacionPassword'  : "0",
                    'idSolicitante'         : $('#solicitante option:selected').val(),
                    'idTipoUsuario'         : $('#tipoUsuario option:selected').val(),
                    'idPerfil'              : $('#perfil option:selected').val(),
                    'fechaTermino'          : fechaTermino,
                    'operacion'             : "online"

                }
		})
        .done(function(response)
        {
        	obj2 = jQuery.parseJSON(response);
        	console.log(obj2);
        })
        .fail(function()
        {
	        $('#message').empty();
			$('#message').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> en alta de usuario  </label>');
	        $.unblockUI();
	    })
        .always(function()
        {
            if ( obj2.statusCode!= null && obj2.statusCode!=200 )
            {
				// $('#message').empty();
				$('#message').append('<label class="alert-danger mb-30 text-left">Alta de usuario <strong>no exitosa</strong><br>'+obj2.error+'</label>');
				$.unblockUI();
            }else
            {
			    if (    (obj2.stackTrace!=null && obj2.stackTrace)
                     || (    obj2.status!=null && obj2.status=="no-ok" ) ){

                    var errorInfo = ( obj2.status && obj2.status=="no-ok" )? ( obj2.transationDate + " " + obj2.description):obj2.stackTrace;

                    $('#message').append('<label class="alert-danger mb-30 text-left">Alta de usuario <strong>no exitosa</strong><br>'+ errorInfo +'</label>');
                    $.unblockUI();
                }
                else {
                    $('#validar').hide();
    				$('#finish').hide();
    				$('#message').empty();
                    $('#message').append('<label class="alert-success  mb-30 text-center" style="height:80px; width:103%;">Su petici&oacute;n ha sido enviada<strong>&nbsp;exitosamente</strong></label>');
                }
				$.unblockUI();
            }
		})

        //$.unblockUI();

    }

    function clearDateTime(){
        $('#txtDate').val('');
        $('#txtTime').val('');
    }

    //trasnsforma en mayusculas el usuario si se escoge el valor que se incializa
    function funMayusfield(sJL_disp_mayusc)
    {
        console.log('funcion funMayusfield');
        //tipoDispositivoError
        console.log($('select#tipoDispositivo').prop('selectedIndex'));
        if($('select#tipoDispositivo').prop('selectedIndex')==sJL_disp_mayusc)
        {
            sJLuser=$('#usuarioDispositivo').val();
            console.log('cambio en mayusc ');
            console.log(sJLuser);
            $('#usuarioDispositivo').val(sJLuser.toUpperCase());
        }//if

    }//funMayusfield

    //2021/07/28 - Acrtualización GUI - JLDS
    function fun_valida_password()
    {
        sJL_password = $('#password').val();
        console.log('Entre validación Password:' + sJL_password);
        $iJL_tipodisp = $('select#tipoDispositivo').val();
        console.log('tipo dispositivo:'+ $iJL_tipodisp+':');
        $iJL_username = $('#usuarioDispositivo').val();
        $iJL_passlen = sJL_password.length;
        $iJL_userlen = $iJL_username.length;

        if($iJL_passlen !=0)
        {
            console.log('password no vacio:'+ $iJL_passlen + ':');
            if($iJL_tipodisp!=null && $iJL_tipodisp!="")
            {
                console.log('tipo dispositivo 2:'+ $iJL_tipodisp+':');

                //variables para validar el pass
                bJL_valdate_numner = false;
                bJL_valdate_upper = false;
                bJL_valdate_lower = false;
                bJL_valdate_spech = false;
                bJL_valdate_include = false;
                bJL_valdrev_include = false;
                bJL_valdchar_consec = false;
                var iJLMaxREps=1;

                var i=0;
                var character='';
                var iJLascii=0;

                sJL_password.replaceAll(' ','');

                //valido los caracteres del pass
                while (i < sJL_password.length)
                {
                    character = sJL_password.charAt(i);
                    JLascii = sJL_password.charCodeAt (i);                    
                    //if (!isNaN(character * 1) && !bJL_valdate_numner)
                    iJLisnum=isNaN(character);
                    
                    if (!iJLisnum)
                    {
                        bJL_valdate_numner = true;
                        console.log('trae numero');
                    }//if
                    else
                    {
                        if (JLascii > 96 || JLascii < 122)
                        {
                            if (character == character.toUpperCase())
                            {
                                    bJL_valdate_upper = true;
                                    console.log('trae mayus');
                            }//if
                            //if (character == character.toLowerCase() && !bJL_valdate_lower)
                            if (character == character.toLowerCase())
                            {
                                bJL_valdate_lower = true;
                                console.log('trae minus');
                            }//if
                        }//if
                        
                    }//else
                    //if (character == character.toUpperCase() && !bJL_valdate_upper)

                    i++;
                } //while

                //valido los caracteres especiales
                var sJL_SpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

                if(sJL_SpecialChar.test(sJL_password))
                {
                    bJL_valdate_spech = true;
                }//if

                //voy a avalidar la cadena que no contenga el user
                if ($iJL_userlen != 0)
                {

                    sJL_userLower= $iJL_username.toLowerCase();
                    sJL_passLowe = sJL_password.toLowerCase();

                    bJL_valdate_include = sJL_passLowe.includes(sJL_userLower);
                    console.log('contiene pass: ' + bJL_valdate_include);

                    //giro la cadena
                    sJL_userRever = reverseString(sJL_userLower);
                    
                    console.log(sJL_userRever);
                    bJL_valdrev_include = sJL_passLowe.includes(sJL_userRever);
                    console.log('contiene pass allr:' + bJL_valdrev_include);

                }//if
                

                //carateres repetidos
                var numberOfRepeats;
                
                for(var i = 0; i< sJL_password.length; i++) 
                {
                    numberOfRepeats = CheckForRepeat(i, sJL_password, sJL_password.charAt(i));
                    //do something                    
                    if(numberOfRepeats > iJLMaxREps) 
                    {
                        iJLMaxREps = numberOfRepeats;
                    }
                    
                };
                console.log('caracteres repetidos');
                console.log(iJLMaxREps);

                //caracteres consecutivos
                bJL_valdchar_consec = CheckConsecutive(sJL_password);
                console.log('contiene caracteres conecutivos: ' + bJL_valdchar_consec );
                

                //termina validación de escenarios


                switch($iJL_tipodisp)
                {
                    case '8':
                        // code block
                        console.log('validare el dato');

                        //$('#usuarioDispositivo').val(sJLuser.toUpperCase());
                        // al menos 1 mayuscula, 1 minuscula, 1 digito, 1 caracter

                        if(!bJL_valdate_numner)
                        {
                            console.log('password no pose numeros');
                            alert('El password no pose numeros, favor de agregar por lo menos un numero');
                            $('#password').val('');
                        }//if
                        if(!bJL_valdate_lower)
                        {
                            console.log('password no pose minusculas');
                            alert('El password no pose caracteres en minusculas, favor de agregar por lo menos un caracter en minuscula');
                            $('#password').val('');
                        }//if
                        if(!bJL_valdate_upper)
                        {
                            console.log('password no pose mayusculas');
                            alert('El password no pose caracteres en mayusculas, favor de agregar por lo menos un caracter en mayuscula');
                            $('#password').val('');
                        }//if

                        if(!bJL_valdate_spech)
                        {
                            console.log('password no pose caracteres especiales');
                            alert('El password no pose caracteres especiales, favor de agregar por lo menos un caracter en especial');
                            $('#password').val('');
                        }//if

                        if(bJL_valdate_include)
                        {
                            console.log('password contiene el usuario');
                            alert('El password contiene el nombre del usuario');
                            $('#password').val('');
                        }//if
                        if(bJL_valdrev_include)
                        {
                            console.log('password contiene el usuario alrevez');
                            alert('El password contiene el nombre del usuario escrito alrevez');
                            $('#password').val('');
                        }//if                        
                        if(iJLMaxREps>=2)
                        {
                            console.log('password contiene mas de dos caracteres consecutivos repetidos');
                            alert('El password contiene mas de dos caracteres consecutivos repetidos');
                            $('#password').val('');
                        }                        
                        if(bJL_valdchar_consec)
                        {
                            console.log('password contiene 3 o mas caracteres consecutivos al derecho o al reves');
                            alert('El password contiene 3 o mas caracteres consecutivos al derecho o al reves');
                            $('#password').val('');
                        }
                        

                        break;
                    default:
                        // code block
                        console.log('Sin validación extra de password');


                }


            }//if
            else
            {
                alert('Seleccione el tipo de dispositivo');
                $('#password').val('');
            }//else
        }//if


    }//fun_valida_password

    //2021/07/28 - Acrtualización GUI - JLDS
    function fun_valida_username()
    {
        sJL_uname = $('#usuarioDispositivo').val();
        //console.log('Entre validación Username');
        $iJL_tipodisp = $('select#tipoDispositivo').val();
        if($iJL_tipodisp!=null && $iJL_tipodisp!="")
        {
            //console.log('tipo dispositivo 2:'+ $iJL_tipodisp+':');
            switch($iJL_tipodisp)
            {
                case '14':
                        // code block
                        //console.log('validare el dato');
                        if(sJL_uname.length > 6)
                        {
                            alert('El usuario de este tipo de dispositivo solo permite 6 caracteres en mayusculas ');
                            sJL_uname = sJL_uname.substring(0,6)
                            $('#usuarioDispositivo').val(sJL_uname);
                        }//if
                        $('#usuarioDispositivo').val(sJL_uname.toUpperCase());
                    break;

                default:
                    console.log('Sin validación extra de usuario');

            }//switch

        }//if
        else
        {
            alert('Seleccione el tipo de dispositivo');
            $('#usuarioDispositivo').val('');
        }
    }//fun_valida_username

    //2021/07/28 - Acrtualización GUI - JLDS
    function fun_valida_cambio_disp()
    {
        fun_valida_password();
        fun_valida_username();
    }//fun_valida_cambio_disp


    //2021/07/28 - Acrtualización GUI - JLDS
    function fun_cambio__resp_mail(sJLresp)
    {
        console.log('Funcion de cambio mail');
        //console.log(sJLresp);
        iJL_idResp = $('#cbo_ID_Responsable').val();
        console.log(iJL_idResp);
        $.each( sJLresp, function( value, name )
		{
            //console.log('revisando');
            //console.log(value);
			//console.log(name);
            if (name.send_id==iJL_idResp)
            {

                    //console.log(iJL_idResp);
                    $('#cmd_Mail_resp').val(name.send_mail);
            }//if

		});


    } //fun_cambio__resp_mail

    function reverseString(str) 
    {
        console.log(str);
        var newString = "";
        for (var i = str.length - 1; i >= 0; i--) {
            newString += str[i];
        } //for
        console.log(newString);
        return newString;
    }//reverseString
    
    function probarRegex(regexp, cadena)
    {
        var subcadena;
        var bJL_return = false;

        if (regexp.test(cadena)) 
        {
            subcadena = ' contiene ';
            bJL_return = true;
        } //if
        else 
        {
            subcadena = ' no contiene ';
        }
        console.log(cadena + subcadena + regexp.source);
        return bJL_return;    
    }//probarRegex

    function CheckForRepeat(startIndex, originalString, charToCheck) 
    {
        var repeatCount = 1;
        for(var i = startIndex+1; i< originalString.length; i++) {
            if(originalString.charAt(i) == charToCheck) {
                repeatCount++;
            } else {
            return repeatCount;
            }   
        }
        return repeatCount;
    }//CheckForRepeat

    function CheckConsecutive(s)
    {
  
        // Get the length of the string
        let l = s.length;

        // Iterate for every index and
        // check for the condition
        for (let i = 2; i < l; i++) {
            iJL_eval = (s[i].charCodeAt() - s[i - 1].charCodeAt());            
            if (iJL_eval == 1)
            {                
                iJL_eval = (s[i - 1].charCodeAt()- s[i - 2].charCodeAt());
                if (iJL_eval == 1)
                {
                    return true;
                }//if                
            }//if                
        }//for  


        for (let i = l-1; i > 2; i--) {
            iJL_eval = (s[i-2].charCodeAt() - s[i - 1].charCodeAt());
            console.log(iJL_eval);
            if (iJL_eval == 1)
            {
                iJL_eval = (s[i - 1].charCodeAt()- s[i].charCodeAt());
                if (iJL_eval == 1)
                {
                    return true;
                }//if                
            }//if                
        }//for  
        return false;
    }

    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        bloqueo();

        $( "#mostrarContrasena" ).click(function( event ) {
                    event.preventDefault();
                    var ePassword=$('#password').val();
                    var dPassword=atob( $('#password').val() );
                    $('#password').val(dPassword);
                    $('#password').prop('type','text');
                    $( "#mostrarContrasena").hide();
                    setTimeout( function(){
                    $('#password').prop('type','password');
                    $('#password').val(ePassword);
                    $( "#mostrarContrasena").show();
                    },1000);
        });

        $('#nombreSolicitante, #paternoSolicitante ,#maternoSolicitante').prop('disabled',true);
        $('#movilSolicitante, #mailSolicitante, #organizacionSolicitante').prop('disabled',true);


        //2021/07/28 - Acrtualización GUI - JLDS
        //catalogo de responsables
        //sJLresp = fun_llena_catalog("1",obj.data[0].send_idresp);
        sJLresp = fun_llena_catalog("1","");
        document.getElementById("usuarioDispositivo").onchange = function() {fun_valida_username()};
        document.getElementById("password").onchange = function() {fun_valida_password()};
        document.getElementById("tipoDispositivo").onchange = function() {fun_valida_cambio_disp()};

        //2021/07/28 - Acrtualización GUI - JLDS
        //document.getElementById("cbo_ID_Responsable").onchange = function() {fun_cambio__resp_mail(sJLresp)};




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
            if (   (obj.stackTrace!=null && obj.stackTrace)
                || ( obj.status && obj.status=="no-ok" ) )  {

                var errorInfo = ( obj.status && obj.status=="no-ok" )?obj.description:obj.stackTrace;
                $('#message').empty();
                $('#message').append('<label class="alert-danger mb-30 text-left">Se produjo un error al intentar obtener los datos de los catalogos:<br><strong>'+ errorInfo + '</strong> ');
                $(":text").prop('disabled',true);
                $(":password").prop('disabled',true);
                $("#tipoDispositivo,#grupo,#tipoUsuario,#perfil,#solicitante").prop('disabled',true);
                $( "#finish" ).hide();
                $.unblockUI();
            }
            else {
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

                $('#perfil').append(
                    $('<option></option>').val( '' ).html( 'Seleccionar perfil')
                );
                $.each( obj.perfil, function(index) {

                    $('#perfil').append(
                        $('<option></option>').val( obj.perfil[index].id ).html( obj.perfil[index].descripcion )
                    );

                });

                $('select#perfil option').each(function(index){
                     if( $(this).val() == '7' ) {
                        $('#perfil option').eq(index).prop('selected',true);
                     }
                });

                $('#perfil').prop('disabled',true);



                $('#solicitante').append(
                    $('<option></option>').val( '' ).html( 'Seleccionar solicitante')
                );

                $.each( obj.solicitante, function(index) {
                    $('#solicitante').append(
                        $('<option></option>').val( obj.solicitante[index].id ).html( obj.solicitante[index].mail  )
                    );

                    if( ( obj.solicitante[index].mail ==="{{ app('auth')->user()->email }}") ){
                            $('#solicitante option').eq(index+1).prop('selected',true).trigger('change');

                    }

                });
                //$('#solicitante').prop('disabled',true);
                /*if ( obj.isManager==="false" ) {
                        $('#solicitante').prop('disabled',true);
                }*/


            }
            $.unblockUI();

        })
        .fail(function() {
                $.unblockUI();
            })
        .always(function() {
            //$.unblockUI();
            $('#ipHost').val('');
            $('#password').val('');
            $('#usuarioDispositivo').val('');
        });


         var initializePlugins2 = function initializePlugins2() {

                $(function(){
                        var dtToday = new Date();
                        dtToday.setDate( dtToday.getDate() +  1);

                        var month = dtToday.getMonth() + 1;
                        var day = dtToday.getDate();
                        var year = dtToday.getFullYear();
                        if(month < 10)
                            month = '0' + month.toString();
                        if(day < 10)
                            day = '0' + day.toString();

                        var maxDate = year + '-' + month + '-' + day;
                        $('#txtDate').attr('min', maxDate);
                        $('#txtDate2').attr('min', maxDate);
                        $('#txtDate3').attr('min', maxDate);
                });


                $("#ipHost").change(function( event ) {
                    if ( !patrones['ip'].test($('#ipHost').val())) {
                            $( '#finish' ).hide();
                            $('#message').empty();
                            $('#ipHostError').empty();
                            $('#ipHostError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
                    }else{
                        $('#ipHostError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });


                $("#tipoDispositivo").change(function( event ) {
                    if ( $('select#tipoDispositivo' ).prop('selectedIndex')<=0 ){
                        $('#tipoDispositivoError').empty();
                        $('#tipoDispositivoError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#tipoDispositivoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $('#grupo').change( function(event){
                    if ( $('select#grupo').prop('selectedIndex')<=0 ){
                        $('#grupoError').empty();
                        $('#grupoError').append('<label class="alert-danger mb-30 text-left">seleccionar un grupo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#grupoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }
                });


                $("#usuarioDispositivo").change(function( event ) {
                    if ( $('#usuarioDispositivo' ).val()=='' ){
                        $('#usuarioDispositivoError').empty();
                        $('#usuarioDispositivoError').append('<label class="alert-danger mb-30 text-left">capturar el nuevo usuario del dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#usuarioDispositivoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                        if (     $('#usuarioDispositivo').val()=='boveda'
                              || $('#usuarioDispositivo').val()=='tboveda' ){

                            $('select#perfil option').each(function(index){
                                 if( $(this).val() == '10' ) {
                                    $('#perfil option').eq(index).prop('selected',true);
                                 }
                            });

                        }else{
                            $('select#perfil option').each(function(index){
                                 if( $(this).val() == '7' ) {
                                    $('#perfil option').eq(index).prop('selected',true);
                                 }
                            });

                        }

                    }

                });

                $("#password").change(function( event ) {

                    if ( $('#password' ).val()=='' ){
                        $('#passwordError').empty();
                        $('#passwordError').append('<label class="alert-danger mb-30 text-left">capturar contrase&ntilde;a del nuevo usuario del dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#passwordError').empty();
                        $('#message').empty();
                        var encodePassword=btoa( $('#password').val() );
                        $('#password').val(encodePassword);
                        $( '#finish' ).show();
                    }

                });

                $('#tipoUsuario').change(function( event ){
                    if ( $('select#tipoUsuario').prop('selectedIndex')<=0 ){
                        $('#tipoUsuarioError').empty();
                        $('#tipoUsuarioError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de usuario</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');

                    }else{
                        $('#tipoUsuarioError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }
                });

                $("#txtDate").change(function( event ) {

                    if ( $('#txtDate' ).val()=='' ){
                        $('#txtDateError').empty();
                        $('#txtDateError').append('<label class="alert-danger mb-30 text-left">capturar fecha de vigencia del nuevo usuario</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#txtDateError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $('#solicitante').change(function( event ){
                    if ( $('select#solicitante').prop('selectedIndex')<=0 ){
                        $('#solicitanteError').empty();
                        $('#solicitanteError').append('<label class="alert-danger mb-30 text-left">seleccionar un solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');

                    }else{
                        $('#solicitanteError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();

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
                });

                $("#nombreSolicitante").change(function( event ) {
                    if ( $('#nombreSolicitante' ).val()=='' ){
                        $('#nombreSolicitanteError').empty();
                        $('#nombreSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar nombre del solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#nombreSolicitanteError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }
                });


                $("#paternoSolicitante").change(function( event ) {
                    if ( $('#paternoSolicitante' ).val()=='' ){
                        $('#paternoSolicitanteError').empty();
                        $('#paternoSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar apellido paterno del solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#paternoSolicitanteError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });

                $("#maternoSolicitante").change(function( event ) {
                    if ( $('#maternoSolicitante' ).val()=='' ){
                        $('#maternoSolicitanteError').empty();
                        $('#maternoSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar apellido materno del solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#maternoSolicitanteError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });

                $("#movilSolicitante").change(function( event ) {
                    if ( $('#movilSolicitante' ).val()=='' ){
                        $('#movilSolicitanteError').empty();
                        $('#movilSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar n&uacute;mero m&oacute;vil  del solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#movilSolicitanteError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });

                $("#mailSolicitante").change(function( event ) {
                    if ( !patrones['email'].test($('#mailSolicitante').val()) ){
                        $('#mailSolicitanteError').empty();
                        $('#mailSolicitanteError').append('<label class="alert-danger mb-30 text-left">El formato no es v&aacute;lido</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#mailSolicitanteError').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });


                $("#organizacionSolicitante").change(function( event ) {
                    if ( $('#organizacionSolicitante' ).val()=='' ){
                        $('#organizacionSolicitanteError').empty();
                        $('#organizacionSolicitanteError').append('<label class="alert-danger mb-30 text-left">capturar la organizacion del solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#organizacionSolicitante').empty();
                        $('#message').empty();
                        $('#finish' ).show();
                    }

                });


                $('#password').val('');

        };



        var Operations2 = function ()
        {
            return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Alta');

                    $('#message').empty();

                    initializePlugins2();
                    $('#password').val('');

		        }
		    };
        }
        Operations2().init();



    });

</script>
@endsection
