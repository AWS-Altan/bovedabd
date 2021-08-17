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
                        <h3><span class="head-font capitalize-font">Cambio de información de solicitantes</span></h3>
						<section>
                         <section>
                            <form id="step_two">

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
														<input type="text" data-minlength="10" class="form-control" id="cmd_NombreAlta" placeholder="Ingrese el Nombre del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_NombreAlta"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Apellido Paterno -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Apellido Paterno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ApPaterno" placeholder="Ingrese el Apellido Paterno del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_txtApPaterno"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de apellido Materno -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Apellido Materno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_ApMaterno" placeholder="Ingrese el Nombre Completo del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_txtApMaterno"></div>
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
														<input type="text" data-minlength="10" class="form-control" id="data360" placeholder="Ingrese el Telefono del usuario" data-error="Valor inválido" maxlength="45">
													    <div class="help-block with-errors" id="err_msg_Telefono"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fecha Alta -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
                                                        <label class="help-block text-left">Fecha Alta:</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type='date' id="txtDateini" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                                        <div class="help-block with-errors" id="inputTxtDateiniError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fecha Termino -->
                                        <div class="row">
                                            <div class="form-group mt-12">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-3 mb-20">
                                                        <label class="help-block text-left">Fecha Termino:</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <input type='date' id="txtDatefin" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                                        <div class="help-block with-errors" id="inputTxtDatefinError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de ID Nivel-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ID Nivel</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <select id="cbo_ID_Nivel" class="form-control" name="cbo_ID_Nivel">
                                                        </select>
													    <div class="help-block with-errors" id="err_msg_ID_Nivel"></div>
												    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo Mail del Usuario -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <!-- mail del solicitante -->
                                                    <div class="col-sm-3 mb-20">
                                                        <label class="help-block text-left">Correo del Usuario</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="cmd_Mail_user" placeholder="Ingrese el correo del solicitante" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="err_msg_Mail_user"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo de Ultima Rotación -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">ultima Rotación</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="cmd_last_totate" placeholder="Ultima Rotación del Usuario" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="cmd_last_totateError"></div>
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
    								    Datos adicionales de consulta
                                    </div>

                                        <!-- Campo Temporal de ID Responsable -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div><br></div>
                                                <div class="form-group mt-12">
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
                                                    <!-- mail del solicitante -->
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


                                <!-- Contenedor -->

                                @if(Session::has('user_no_disp'))
                                    @if(Session::get('user_no_disp')== 'A')
                                        <form id="sis_form_tabs" action="#">
                                            <div class="panel panel-default">
                                                <!-- Header Subseccion -->
                                                <div class="panel-heading">
                                                Datos de la cuenta (usuario)
                                                </div>
                                                <!-- despues del header de la seccion -->
                                                <div class="card-body">
                                                    <!-- Campo de contraseña del usuario anterior-->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group mt-12">
                                                                <div><br></div>

                                                                <div><br></div>
                                                                <!-- Contraseña actual-->
                                                                <div class="col-sm-3 mb-20">
                                                                    <label class="help-block text-left">Contrase&ntilde;a Actual</label>
                                                                </div>
                                                                <div class="col-sm-4 mb-20">
                                                                    <input type="password" data-minlength="10" class="form-control" id="passwordActual" placeholder="Ingrese password actual" data-error="Valor inválido" maxlength="150">
                                                                        <div class="help-block with-errors" id="PasswordErrorAct"></div>
                                                                </div>
                                                                <div class="col-sm-2 mb-20">
                                                                    <button id="mostrarContrasenaActual" class="btn btn-primary btn-xs">Ver</button>
                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Campo de contraseña del usuario nueva-->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group mt-12">
                                                                <div><br></div>

                                                                <div><br></div>
                                                                <!-- Contraseña del usuario del dispositivo-->
                                                                <div class="col-sm-3 mb-20">
                                                                    <label class="help-block text-left">Contrase&ntilde;a Nueva</label>
                                                                </div>
                                                                <div class="col-sm-4 mb-20">
                                                                    <input type="password" data-minlength="10" class="form-control" id="passwordNew" placeholder="Ingrese password a asignar" data-error="Valor inválido" maxlength="150">
                                                                        <div class="help-block with-errors" id="PasswordErrorCur"></div>
                                                                </div>
                                                                <div class="col-sm-2 mb-20">
                                                                    <button id="mostrarContrasenaNew" class="btn btn-primary btn-xs">Ver</button>
                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Campo de contraseña del usuario nuevo-->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group mt-12">
                                                                <div><br></div>

                                                                <div><br></div>
                                                                <!-- Contraseña del usuario del dispositivo-->
                                                                <div class="col-sm-3 mb-20">
                                                                    <label class="help-block text-left">Repita Contrase&ntilde;a</label>
                                                                </div>
                                                                <div class="col-sm-4 mb-20">
                                                                    <input type="password" data-minlength="10" class="form-control" id="passwordAgain" placeholder="Ingrese password a asignar" data-error="Valor inválido" maxlength="150">
                                                                        <div class="help-block with-errors" id="PasswordErrorAga"></div>
                                                                </div>
                                                                <div class="col-sm-2 mb-20">
                                                                    <button id="mostrarContrasenaAga" class="btn btn-primary btn-xs">Ver</button>
                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button id="send_reset" class="btn btn-primary" style="position:center;"> Cambiar password de usuario </button>


                                                </div>
                                            </div>
                                            <!-- Texto de Menajes -->
                                            <div class="row" id="message_error">
                                        </div>
                                    </form>
                                    @endif

                                @endif
                            </form>
                        </section>

                        <!-- Texto de Menajes -->
                        <div class="row" id="message_error">
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
    function ValidateNext()
    {

	}


    function fun_ejecuta_busqueda(iJL_catalog,sJLMail)
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
            url: "{{ route('Users.call.catalogs_view') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsonchange)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("Ejecución Catalogo " + obj.status);
            console.log(obj);
            //$('#cbo_ID_Responsable').append($('<option></option>').val('').html('N/A'));

            if ( obj.status=="ok" )
            {
                $('#cmd_Mail_user').val(obj.data[0].send_mail);
                $('#cmd_NombreAlta').val(obj.data[0].send_nombre);
                $('#cmd_ApPaterno').val(obj.data[0].send_paterno);
                $('#cmd_ApMaterno').val(obj.data[0].send_materno);
                $('#data360').val(obj.data[0].send_msisdn);
                $('#cbo_ID_Nivel').selectedIndex = obj.data[0].send_nivel;
				//$('#cbo_ID_Responsable').selectedIndex = obj.data[0].send_idresp;
				$('#txtDateini').val(obj.data[0].send_fecha_alta);
				$('#txtDatefin').val(obj.data[0].send_fecha_termino);

                //catalogo de responsables
                sJLresp = fun_llena_catalog("1",obj.data[0].send_idresp);



                //$('#message_error').append('<label class="help-block mb-30 text-center" style="color: red"><strong>Realice la modificación de datos del usuario</strong> ');
                $('#txtDateini, #txtDatefin ,#cbo_ID_Nivel,#cbo_ID_Responsable,#cmd_Mail_user,#cmd_Mail_resp').prop('disabled',true);
            }
            else
            {
                $('#message_error').empty();
                $('#message_error').append('<label class="help-block mb-30 text-center" style="color: red"><strong>Usuario No encontrado</strong> ');
                $( "#finish" ).hide();
            }
            return obj;
        })
        .fail(function() {
            //algo
            console.log("Error extracción de catalogo ");
            $( "#finish" ).hide();
            $('#message_error').empty();
            $('#message_error').append('<label class="help-block mb-30 text-center"><strong>Usuario no encontrado</strong>');
        })
        .always(function() {
            //algo
            console.log("Catalogo always ");
            $.unblockUI();
        });

    }//fun_ejecuta_busqueda


    function fun_ejecuta_cambio()
    {
        // Limpio los mensajes de Error
        // $('#message' ).empty();
        $('#err_msg_Mail_user').empty();
        $('err_msg_NombreAlta').empty();
        $('err_txtApPaterno').empty();
        $('err_txtApMaterno').empty();
        $('err_msg_Telefono').empty();

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

        // Valido que el Nombre no este Vacio
        if ( $('#cmd_NombreAlta' ).val()=='' ){
			$('#err_msg_NombreAlta').empty();
			$('#err_msg_NombreAlta').append('<label class="alert-danger mb-30 text-left">Capture el nombre del Usuario</label>');
			return false;
        }

        // Valido que el Apellido Paterno no este Vacio
        if ( $('#cmd_ApPaterno' ).val()=='' ){
			$('#err_txtApPaterno').empty();
			$('#err_txtApPaterno').append('<label class="alert-danger mb-30 text-left">Capture el nombre del Usuario</label>');
			return false;
        }

        // Valido que el Apellido Materno no este Vacio
        if ( $('#cmd_ApMaterno' ).val()=='' ){
			$('#err_txtApMaterno').empty();
			$('#err_txtApMaterno').append('<label class="alert-danger mb-30 text-left">Capture el apellido paterno del Usuario</label>');
			return false;
        }

        // Valido que el Telefono no este Vacio
        if ( $('#data360' ).val()=='' ){
			$('#err_msg_Telefono').empty();
			$('#err_msg_Telefono').append('<label class="alert-danger mb-30 text-left">Capture el apellido materno del Usuario</label>');
			return false;
        }


        //Realizo el bloqueo de la pantalla
		$.blockUI({ message: 'Realizando actualización ...',css: {
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
        var jsoninsert = {};

        jsoninsert.mail = $('#cmd_Mail_user').val();
        jsoninsert.nombre = $('#cmd_NombreAlta').val();
        jsoninsert.paterno = $('#cmd_ApPaterno').val();
        jsoninsert.materno = $('#cmd_ApMaterno').val();
        jsoninsert.msisdn = $('#data360').val();

        $.ajax({
            url: "{{ route('Users.call.modif_solicit') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsoninsert)
        })
        .done(function(response)
        {
            console.log('Ejecución API Correcta');
        	//obj2 = jQuery.parseJSON(response);
        	console.log(response);
            $('#validar').hide();
			$('#finish').hide();
			//$('#message').empty();
            $('#message_error').append('<label class="help-block mb-30 text-left">Alta del usuario fue<strong>&nbsp;&eacutexitosa</strong></label>');

            $('#cmd_Mail_user').val("");
            $('#cmd_NombreAlta').val("");
            $('#cmd_ApPaterno').val("");
            $('#cmd_ApMaterno').val("");
            $('#data360').val("");


        })
        .fail(function()
        {
            console.log('Ejecución API incorrecta');
			$('#message_error').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> modificacion de solicitante incorrecta </label>');
	        $.unblockUI();
	    })
        .always(function()
        {
            //if ( obj2.statusCode!= null && obj2.statusCode!=200 )
			$.unblockUI();

		})

    }//fun_ejecuta_cambio

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
            //$('#cbo_ID_Responsable').append($('<option></option>').val('').html('N/A'));
		    $.each( obj.data, function( value, name )
			{
                if (name.send_id==iJL_idResp)
                {
                    console.log('revisando');
                    console.log(value);
				    console.log(name);
                    console.log(iJL_idResp);
                    $('#cbo_ID_Responsable').append(
				    	$('<option></option>').val(name.send_id).html(name.send_nameresp)
				    );
                    $('#cmd_Mail_resp').val(name.send_mail);
                }//if

			});
            return obj;
        })
        .fail(function() {
            //algo
            console.log("Error extracción de catalogo ");
        })
        .always(function() {
            //algo
            console.log("Catalogo always ");
            $.unblockUI();
        });

    }//fun_llena_catalog


    // Funcion de Fin de Vista, ejecucion
    function finished(){
        //Ejecuta la actualización
        fun_ejecuta_cambio();
    } //finished
    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        //Nivel
        $('#cbo_ID_Nivel').append($('<option></option>').val('1').html('Manager'));
        $('#cbo_ID_Nivel').append($('<option></option>').val('2').html('Solicitante'));
        $('#cbo_ID_Nivel').append($('<option></option>').val('3').html('Manager SOC'));
        //campo de numero
        TipoDato360('msisdn');



       $( "#mostrarContrasenaActual" ).click(function( event ) {
                    event.preventDefault();
                    var ePasswordcur=$('#passwordActual').val();
                    //var dPasswordcur=atob( $('#passwordActual').val() );
                    $('#passwordActual').val(ePasswordcur);
                    $('#passwordActual').prop('type','text');
                    $( "#mostrarContrasenaActual").hide();
                    setTimeout( function(){
                    $('#passwordActual').prop('type','password');
                    $('#passwordActual').val(ePasswordcur);
                    $( "#mostrarContrasenaActual").show();
                    },1000);
        });

        $( "#mostrarContrasenaNew" ).click(function( event ) {
                    event.preventDefault();
                    var ePasswordNew=$('#passwordNew').val();
                    //var dPasswordNew=atob( $('#passwordNew').val() );
                    $('#passwordNew').val(ePasswordNew);
                    $('#passwordNew').prop('type','text');
                    $( "#mostrarContrasenaNew").hide();
                    setTimeout( function(){
                    $('#passwordNew').prop('type','password');
                    $('#passwordNew').val(ePasswordNew);
                    $( "#mostrarContrasenaNew").show();
                    },1000);
        });

        $( "#mostrarContrasenaAga" ).click(function( event ) {
                    event.preventDefault();
                    var ePassword=$('#passwordAgain').val();
                    //var dPassword=atob( $('#passwordAgain').val() );
                    $('#passwordAgain').val(ePassword);
                    $('#passwordAgain').prop('type','text');
                    $( "#mostrarContrasenaAga").hide();
                    setTimeout( function(){
                    $('#passwordAgain').prop('type','password');
                    $('#passwordAgain').val(ePassword);
                    $( "#mostrarContrasenaAga").show();
                    },1000);
        });

        $( "#send_reset" ).click(function( event )
        {
            event.preventDefault();
        });




        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana


        	return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Actualizar');
                    sJLmail= '{{app('auth')->user()->email}}';
                    fun_ejecuta_busqueda("3",sJLmail);
                    $('#sis_form_tabs').css("display","none");
                    //$('#sis_form_tabs').visible = false;
                    //var sisfram = document.getElementById('sis_form_tabs');
                    //$('#sis_form_tabs').hide();
                    //sis_form_tabs


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
