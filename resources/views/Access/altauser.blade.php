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
														<input type="text" data-minlength="10" class="form-control" id="ipHost" placeholder="Ingrese La IP del usuario" data-error="Valor inválido" maxlength="150">
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
                                                        <input type="text" data-minlength="10" class="form-control" id="usuarioDispositivo" placeholder="Ingrese el usuario del dispositivo" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="usuarioDispositivoError"></div>
                                                    </div>
                                                    <div class="col-sm-1 mb-20">
                                                    </div>

                                                    <!-- Contraseña del usuario del dispositivo-->
                                                    <div class="col-sm-2">
                                                        <label class="help-block text-left">Contrase&ntilde;a</label>
                                                    </div>                                          
                                                    <div class="col-sm-2">
                                                        <input type="password" data-minlength="10" class="form-control" id="password" placeholder="Ingrese la contrase&ntilde;a del usuario" data-error="Valor inválido" maxlength="150">
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
                                                        <label class="help-block text-left">Vigencia:</label>
                                                    </div>
                                                    <div class="col-sm-2 mb-20 select select-group" >
                                                        <input type='date' id="txtDate" class="inputCal" value="" /> <label id="cleardate" onclick="clearDateTime()"> Limpiar fecha </label>
                                                        <div class="help-block with-errors" id="txtDateError"></div>  
                                                    </div>
                                                    <div class="col-sm-2 mb-20 select select-group" >
                                                        <input type='time' id="txtTime" class="inputCal" value="" />
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
    // Funcion de Fin de Vista, ejecucion
    function finished(){
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
                    $('#message').append('<label class="alert-success  mb-30 text-center" style="height:80px; width:103%;">Alta de usuario <strong>&nbsp;&eacutexitosa</strong></label>');
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



    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

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
                if ( obj.isManager==="false" ) {
                        $('#solicitante').prop('disabled',true);
                }


            }
            $.unblockUI();
            
        })
        .fail(function() {
                $.unblockUI();
            })
        .always(function() {
            //$.unblockUI();
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