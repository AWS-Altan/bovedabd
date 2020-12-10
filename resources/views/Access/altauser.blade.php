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
														<input type="text" data-minlength="10" class="form-control" id="ipHost" placeholder="Ingrese la IP del usuario" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="inputIpHostError"></div>
												    </div>

                                                    <!-- Campo de Host -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Host</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="nameHost" placeholder="Ingrese el nombre del host" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="inputNameHostError"></div>
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
                                                        <div class="help-block with-errors" id="inputtipoDispositivoError"></div>
                                                    </div>

                                                    <!-- Campo de Grupo de Usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Grupo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="grupo" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="inputGrupoError"></div> 
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
                                                        <div class="help-block with-errors" id="inputUsuarioDispositivoError"></div>
                                                    </div>
                                                    <!-- Contraseña del usuario del dispositivo-->
                                                    <div class="col-sm-2">
                                                        <label class="help-block text-left">Contrase&ntilde;a</label>
                                                    </div>                                          
                                                    <div class="col-sm-3">
                                                        <input type="password" data-minlength="10" class="form-control" id="password" placeholder="Ingrese la contrase&ntilde;a del usuario" data-error="Valor inválido" maxlength="150">
                                                        <div class="help-block with-errors" id="inputPasswordError"></div>
                                                    </div>  
                                                    <div class="col-sm-1">
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
                                                        <div class="help-block with-errors" id="inputTipoUsuarioError"></div>  
                                                    </div>

                                                    <!-- Vigencia del usuario -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Vigencia:</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <input type='date' id="txtDate" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <!-- Solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left" id="solicitanteLabel">Solicitante</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20 select select-group" >
                                                        <select id="solicitante" class="form-control">
                                                        </select>
                                                        <div class="help-block with-errors" id="inputSolicitanteError"></div>  
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
														<input type="text" data-minlength="10" class="form-control" id="nombreSolicitante" placeholder="Ingrese el nombre del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
													    <div class="help-block with-errors" id="nombreSolicitanteError"></div>
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
                                                        <input type="text" data-minlength="10" class="form-control" id="paternoSolicitante" placeholder="Ingrese el apellido paterno del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
                                                        <div class="help-block with-errors" id="paternoSolicitantError"></div>
                                                    </div>
                                                     <!-- Apellido materno del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Apellido Materno</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="maternoSolicitante" placeholder="Ingrese el apellido materno del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
                                                        <div class="help-block with-errors" id="maternoSolicitanteError"></div>
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
                                                        <input type="text" data-minlength="10" class="form-control" id="movilSolicitante" placeholder="Ingrese el m&oacutevil; del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
                                                        <div class="help-block with-errors" id="movilSolicitanteError"></div>
                                                    </div>
                                                     <!-- mail del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Mail</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="mailSolicitante" placeholder="Ingrese el mail del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
                                                        <div class="help-block with-errors" id="err_msg_mailSolicitante"></div>
                                                    </div>
                                                    <!-- organización del solicitante -->
                                                    <div class="col-sm-2 mb-20">
                                                        <label class="help-block text-left">Organizaci&oacute;n</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
                                                        <input type="text" data-minlength="10" class="form-control" id="organizacionSolicitante" placeholder="Ingrese la organización del solicitante" data-error="Valor inválido" maxlength="150" readonly="true">
                                                        <div class="help-block with-errors" id="err_msg_organizacionSolicitante"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Texto de Menajes -->
                                <div class="row" id="message">
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
        $('#message, #inputIpHostError,#inputNameHostError, #inputUsuarioDispositivoError, #inputPasswordError,#inputTxtDateError' ).empty();
       
        if ( $('#ipHost' ).val()=='' ){
            $('#inputIpHostError' ).empty();
            $('#inputIpHostError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        
        if ( !patrones['ip'].test($('#ipHost').val())) {
            $('#message').empty();
            $('#inputIpHostError').empty();
            $('#inputIpHostError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }

        if ( $('#nameHost' ).val()=='' ){
            $('#inputNameHostError').empty();
            $('#inputNameHostError').append('<label class="alert-danger mb-30 text-left">capturar nombre del host</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        
        if (  $('select#tipoDispositivo').prop('selectedIndex')<=0 ){
            $('#inputtipoDispositivoError').empty();
            $('#inputtipoDispositivoError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('select#grupo').prop('selectedIndex')<=0){
            $('#inputGrupoError').empty();
            $('#inputGrupoError').append('<label class="alert-danger mb-30 text-left">seleccionar un grupo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        
        if ( $('#usuarioDispositivo' ).val()=='' ){
            $('#inputUsuarioDispositivoError').empty();
            $('#inputUsuarioDispositivoError').append('<label class="alert-danger mb-30 text-left">capturar el nuevo usuario del dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('#password' ).val()=='' ){
            $('#inputPasswordError').empty();
            $('#inputPasswordError').append('<label class="alert-danger mb-30 text-left">capturar contrase&ntilde;a del nuevo usuario del dispositivo</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if( $('select#tipoUsuario').prop('selectedIndex')<=0){
            $('#inputTipoUsuarioError').empty();
            $('#inputTipoUsuarioError').append('<label class="alert-danger mb-30 text-left">seleccionar tipo de usuario</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        if ( $('#txtDate' ).val()=='' ){
            $('#inputTxtDateError').empty();
            $('#inputTxtDateError').append('<label class="alert-danger mb-30 text-left">capturar fecha de vigencia del nuevo usuario</label>');
            $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }

        if ( $('select#solicitante option').length >0 ) {

            if ( $('select#solicitante').prop('selectedIndex')<=0 ){
                $('#inputSolicitanteError').empty();
                $('#inputSolicitanteError').append('<label class="alert-danger mb-30 text-left">seleccionar un solicitante</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                return false;
            }

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
        var  solicitanteValue ='';
        if ( $('select#solicitante option').length > 0 ){
            solicitanteValue =$('select#solicitante option:selected').val();

        }else{
            solicitanteValue="{{ app('auth')->user()->id }}";
        }

        var data = {};
        
        data.ipHost             = $('#ipHost').val();
        data.nameHost           = $('#nameHost').val();
        data.tipoDispositivo    = $('select#tipoDispositivo option:selected').val();
        data.grupo              = $('select#grupo option:selected').val();
        data.usuarioDispositivo = $('#usuarioDispositivo').val();
        data.password           = $('#password').val()
        data.tipoUsuario        = $('select#tipoUsuario option:selected').val();
        data.txtDate            = $('#txtDate').val();
        data.solicitante        = solicitanteValue;
        data.idStatus           = '1';


        $.ajax(
        {
			url: "{{ route('access.call.alta-user') }}",
			type: 'GET',
		 	data: JSON.stringify(data)
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
            if ( obj2.status!= null && obj2.status!='ok' )
            {
				$('#message').empty();
				$('#message').append('<label class="alert-danger mb-30 text-left">Alta de usuario <strong>no exitosa</strong><br>'+obj2.error+'</label>');
				$.unblockUI();
            }else
            {
			    $('#finish').hide();
				$('#message').empty();
                $('#message').append('<label class="help-block mb-30 text-left">Alta del usuario fue<strong>&nbsp;&eacutexitosa</strong></label>');
				$.unblockUI();
            }
		})
        /// a aqui

        //$('#message').append('voy finish B ');
        //$.unblockUI();

    } //finished


    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        $( "#mostrarContrasena" ).click(function( event ) {
                    event.preventDefault();
                    var dPassword=atob( $('#password').val() );
                    $('#password').val(dPassword);
                    $('#password').prop('type','text'); 
                    setTimeout( function(){
                    $('#password').prop('type','password');         
                    },5000);
                    var ePassword=btoa( $('#password').val() );  
                    $('#password').val(ePassword);
                    
                      
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

                $('#solicitanteLabel').show();
                $('#solicitante').show();

                $('#solicitante').append(
                    $('<option></option>').val( '' ).html( 'Seleccionar solicitante')
                );
                $.each( obj.solicitante, function(index) {
                    
                    $('#solicitante').append(
                        $('<option></option>').val( obj.solicitante[index].id ).html( obj.solicitante[index].mail  )
                    );

                }); 
            }else{

                $.each( obj.solicitante, function(index) {
                    
                    
                    if ( obj.solicitante[index].mail == "{{app('auth')->user()->email}}"){
                        $('#nombreSolicitante').val( obj.solicitante[index].nombre );
                        $('#paternoSolicitante').val( obj.solicitante[index].paterno );
                        $('#maternoSolicitante').val( obj.solicitante[index].materno );
                        $('#movilSolicitante').val( obj.solicitante[index].movil );
                        $('#mailSolicitante').val( obj.solicitante[index].mail );
                        $('#organizacionSolicitante').val( obj.solicitante[index].organizacion );
                    }

                }); 

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
            else{
                $('#nombreSolicitante, #paternoSolicitante, #maternoSolicitante, #movilSolicitante, #mailSolicitante, #organizacionSolicitante').val( '' );
            }
            
        });

        var initializePlugins2 = function initializePlugins2() {
                
                $("#ipHost").change(function( event ) {
                    if ( !patrones['ip'].test($('#ipHost').val())) {
                            $( '#finish' ).hide();
                            $('#message').empty();
                            $('#inputIpHostError').empty();
                            $('#inputIpHostError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
                    }else{
                        $('#inputIpHostError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $("#nameHost").change(function( event ) {
                    if ( $('#nameHost' ).val()=='' ){
                        $('#inputNameHostError').empty();
                        $('#inputNameHostError').append('<label class="alert-danger mb-30 text-left">capturar nombre del host</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#inputNameHostError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                
                $("#tipoDispositivo").change(function( event ) {
                    if ( $('select#tipoDispositivo' ).prop('selectedIndex')<=0 ){
                        $('#inputtipoDispositivoError').empty();
                        $('#inputtipoDispositivoError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#inputtipoDispositivoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $('#grupo').change( function(event){
                    if ( $('select#grupo').prop('selectedIndex')<=0 ){
                        $('#inputGrupoError').empty();
                        $('#inputGrupoError').append('<label class="alert-danger mb-30 text-left">seleccionar un grupo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#inputGrupoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }
                });


                $("#usuarioDispositivo").change(function( event ) {
                    if ( $('#usuarioDispositivo' ).val()=='' ){
                        $('#inputUsuarioDispositivoError').empty();
                        $('#inputUsuarioDispositivoError').append('<label class="alert-danger mb-30 text-left">capturar el nuevo usuario del dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#inputUsuarioDispositivoError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $("#password").change(function( event ) {

                    if ( $('#password' ).val()=='' ){
                        $('#inputPasswordError').empty();
                        $('#inputPasswordError').append('<label class="alert-danger mb-30 text-left">capturar contrase&ntilde;a del nuevo usuario del dispositivo</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        $('#inputPasswordError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $('#tipoUsuario').change(function( event ){
                    if ( $('select#tipoUsuario').prop('selectedIndex')<=0 ){
                        $('#inputTipoUsuarioError').empty();
                        $('#inputTipoUsuarioError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de usuario</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');

                    }else{
                        $('#inputTipoUsuarioError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }
                });

                $("#txtDate").change(function( event ) {

                    if ( $('#txtDate' ).val()=='' ){
                        $('#inputTxtDateError').empty();
                        $('#inputTxtDateError').append('<label class="alert-danger mb-30 text-left">capturar fecha de vigencia del nuevo usuario</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                    }else{
                        var ePassword=btoa( $('#password').val() );  
                        $('#password').val(ePassword);
                        $('#inputTxtDateError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }

                });

                $('#solicitante').change(function( event ){
                    if ( $('select#solicitante').prop('selectedIndex')<=0 ){
                        $('#inputSolicitanteError').empty();
                        $('#inputSolicitanteError').append('<label class="alert-danger mb-30 text-left">seleccionar un solicitante</label>');
                        $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');

                    }else{
                        $('#inputSolicitanteError').empty();
                        $('#message').empty();
                        $( '#finish' ).show();
                    }
                });


                $('#password').empty();

        };



        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            $('#message').append('voy 1');
            return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Alta');

                    $('#message').empty();
				    
                    initializePlugins2();

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

