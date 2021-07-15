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
                        <h3><span class="head-font capitalize-font">Actualización Equipo</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Template busqueda Usuario -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_dispcatalog')
										    </div>
									    </div>
								    </div>
							    </div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Actualización Equipo</span></h3>
						<section>
                            <form id="step_two">
                                @include('layouts.table_dispcatalog')
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
    function ValidateNext() {
        //Validacion de campo de busqueda Input data del layou te busqueda
        var dato=$('#inputData').val();
        var valid=patrones[tipo_campo].test(dato);
        console.log(dato);
        console.log(valid);

        //REalizo validacion de que el dato este correcto

        if(document.getElementById('radio5').checked )
        {        
            if (valid)
            {
                fun_ejecuta_busqueda();
                return true;
            } //if
            else {
		        //$("#inputData").css({'border' : '1px solid #f73414'});
			    //$("#message_error").css('color', '#f73414');
			    $("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
                return false;
            }//else
		} //if

        if(document.getElementById('radio6').checked)
        {
            fun_ejecuta_busqueda();
            return true;
        }//if


	}


    function validaCampos()
    {

        // Limpio los mensajes de Error
        $('#txtDireccioneError, #txtGerenciaError, #txtDescripcionError, #txtIDEquipoError, #txtMarcaerror, #txtModeloError, #txtSerieError' ).empty();
        $('#txtSisOPError, #txtTipoerror, #txtTipoApperror, #txtTableroerror #txtVoltajeError, #txtCoord1Error, #txtCoord2Error' ).empty();
        $('#txtFilaError, #txtRackError, #txtSalaError, #txtSiteError, #txtUnidadError, #txtIPError, #txtIPAppError, #txtIPOPError, #txtIPSopError' ).empty();

        //id_direccion
        if ( $('#id_direccion' ).val()=='' ){
            $('#txtDireccioneError' ).empty();
            $('#txtDireccioneError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_gerencia
        if ( $('#id_gerencia' ).val()=='' ){
            $('#txtGerenciaError' ).empty();
            $('#txtGerenciaError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_descripcion
        if ( $('#id_descripcion' ).val()=='' ){
            $('#txtDescripcionError' ).empty();
            $('#txtDescripcionError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_idEquipo
        if ( $('#id_idEquipo' ).val()=='' ){
            $('#txtIDEquipoError' ).empty();
            $('#txtIDEquipoError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_Marca
        if ( $('#id_Marca' ).val()=='' ){
            $('#txtMarcaerror' ).empty();
            $('#txtMarcaerror').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_Modelo
        if ( $('#id_Modelo' ).val()=='' ){
            $('#txtModeloError' ).empty();
            $('#txtModeloError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        //id_Serie
        if ( $('#id_Serie' ).val()=='' ){
            $('#txtSerieError' ).empty();
            $('#txtSerieError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }
        //Id_sistemaOp
        if ( $('#Id_sistemaOp' ).val()=='' ){
            $('#txtSisOPError' ).empty();
            $('#txtSisOPError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_tipoEquipo
        if ( $('#id_tipoEquipo' ).val()=='' ){
            $('#txtTipoerror' ).empty();
            $('#txtTipoerror').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_tipoApp
        if ( $('#id_tipoApp' ).val()=='' ){
            $('#txtTipoApperror' ).empty();
            $('#txtTipoApperror').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_tablero
        if ( $('#id_tablero' ).val()=='' ){
            $('#txtTableroerror' ).empty();
            $('#txtTableroerror').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_voltaje
        if ( $('#id_voltaje' ).val()=='' ){
            $('#txtVoltajeError' ).empty();
            $('#txtVoltajeError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_coodenadas1
        if ( $('#id_coodenadas1' ).val()=='' ){
            $('#txtCoord1Error' ).empty();
            $('#txtCoord1Error').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_coodenadas2
        if ( $('#id_coodenadas2' ).val()=='' ){
            $('#txtCoord2Error' ).empty();
            $('#txtCoord2Error').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_fila
        if ( $('#id_fila' ).val()=='' ){
            $('#txtFilaError' ).empty();
            $('#txtFilaError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_rack
        if ( $('#id_rack' ).val()=='' ){
            $('#txtRackError' ).empty();
            $('#txtRackError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_Sala
        if ( $('#id_Sala' ).val()=='' ){
            $('#txtSalaError' ).empty();
            $('#txtSalaError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_Site
        if ( $('#id_Site' ).val()=='' ){
            $('#txtSiteError' ).empty();
            $('#txtSiteError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_Unidad
        if ( $('#id_Unidad' ).val()=='' ){
            $('#txtUnidadError' ).empty();
            $('#txtUnidadError').append('<label class="alert-danger mb-30 text-left">capturar la ip del host</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_IP
        if ( !patrones['ip'].test($('#id_IP').val())) {
            $('#message').empty();
            $('#txtIPError').empty();
            $('#txtIPError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }//if
        //id_IPApp
        if ( !patrones['ip'].test($('#id_IPApp').val())) {
            $('#message').empty();
            $('#txtIPAppError').empty();
            $('#txtIPAppError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }//if

        //id_IPOper
        if ( !patrones['ip'].test($('#id_IPOper').val())) {
            $('#message').empty();
            $('#txtIPOPError').empty();
            $('#txtIPOPError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }//if
        //id_IPSop
        if ( !patrones['ip'].test($('#id_IPSop').val())) {
            $('#message').empty();
            $('#txtIPSopError').empty();
            $('#txtIPSopError').append('<label class="alert-danger mb-30 text-left">formato no v&aacute;lido</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
             return false;
        }//if
        //id_selAmbiente
        if (  $('select#id_selAmbiente').prop('selectedIndex')<=0 ){
            $('#selectAmbienteError').empty();
            $('#selectAmbienteError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
        //id_selEstado
        if (  $('select#id_selEstado').prop('selectedIndex')<=0 ){
            $('#selectEstadoError').empty();
            $('#selectEstadoError').append('<label class="alert-danger mb-30 text-left">seleccionar un tipo de dispositivo</label>');
            $('#message_error').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
        }//if
    } // validaCampos


    // funcion para ejecutar busqueda
    function fun_ejecuta_busqueda(){

        var sJL_header ="";

        if(document.getElementById('radio5').checked)
        {
            sJL_header = "ip";
            tipo_campo = "ip";
        }//if
        if(document.getElementById('radio6').checked)
        {
            sJL_header = "ID";
            tipo_campo = "hostname";
        }//if


        //limpio los textos
        $('#message_error').empty();
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

        //coloco el tipo de campo
        var data = {};
        data.header = sJL_header;
        data.data  = $('#inputData').val();

        //Ejecuto la busqueda del dato

        $.ajax({
			url: "{{ route('access.call.search_dispcatalog') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response) {

            obj = jQuery.parseJSON(response);
            console.log(obj);

            //id_selAmbiente
            switch(obj[0].Ambiente) {
                case "Productivo":
                        $('select#id_selAmbiente').prop('selectedIndex',1);
                        break;
                case "Desarrollo":
                        $('select#id_selAmbiente').prop('selectedIndex',2);
                        break;
                case "QA":
                        $('select#id_selAmbiente').prop('selectedIndex',3);
                        break;
                case "Test":
                        $('select#id_selAmbiente').prop('selectedIndex',4);
                        break;
                default:
                        $('select#id_selAmbiente').prop('selectedIndex',0);
            } //switch

            //id_direccion
            $('#id_direccion').val(obj[0].Area.Direccion);
            $('#id_direccion').prop("readonly",false);
            //id_gerencia
            $('#id_gerencia').val(obj[0].Area.Gerencia);
            $('#id_gerencia').prop("readonly",false);
            //id_descripcion
            $('#id_descripcion').val(obj[0].Descripcion);
            $('#id_descripcion').prop("readonly",false);
            //id_idEquipo
            $('#id_idEquipo').val(obj[0].ID);
            $('#id_idEquipo').prop("readonly",false);
            //id_selEstado
            switch(obj[0].Estado) {
                case "Activo":
                        $('select#id_selEstado').prop('selectedIndex',1);
                        break;
                case "Desactivado":
                        $('select#id_selEstado').prop('selectedIndex',2);
                        break;
                case "Desarrollo":
                        $('select#id_selEstado').prop('selectedIndex',3);
                        break;
                case "Preproduccion":
                        $('select#id_selEstado').prop('selectedIndex',4);
                        break;
                default:
                        $('select#id_selAmbiente').prop('selectedIndex',0);
            } //switch
            //id_Marca
            $('#id_Marca').val(obj[0].Marca);
            $('#id_Marca').prop("readonly",false);
            //id_Modelo
            $('#id_Modelo').val(obj[0].Modelo);
            $('#id_Modelo').prop("readonly",false);
            //id_Serie
            $('#id_Serie').val(obj[0].Serie);
            $('#id_Serie').prop("readonly",false);
            //Id_sistemaOp
            $('#Id_sistemaOp').val(obj[0]["Sistema Operativa"]);
            $('#Id_sistemaOp').prop("readonly",false);
            //id_tipoEquipo
            $('#id_tipoEquipo').val(obj[0].Tipo);
            $('#id_tipoEquipo').prop("readonly",false);
            //id_tipoApp
            $('#id_tipoApp').val(obj[0]["Tipo Aplicativo"]);
            $('#id_tipoApp').prop("readonly",false);
            //id_tablero
            $('#id_tablero').val(obj[0].Alimentacion.Tablero);
            $('#id_tablero').prop("readonly",false);
            //id_voltaje
            $('#id_voltaje').val(obj[0].Alimentacion.Voltaje);
            $('#id_voltaje').prop("readonly",false);
            //id_coodenadas1
            var sJL_tmp = obj[0].Ubicacion.coordenadas;
            var sJL_coordenadas = sJL_tmp.split(",")
            $('#id_coodenadas1').val(sJL_coordenadas[0]);
            $('#id_coodenadas1').prop("readonly",false);
            //id_coodenadas2
            $('#id_coodenadas2').val(sJL_coordenadas[1]);
            $('#id_coodenadas2').prop("readonly",false);
            //id_fila
            $('#id_fila').val(obj[0].Ubicacion.Fila);
            $('#id_fila').prop("readonly",false);
            //id_rack
            $('#id_rack').val(obj[0].Ubicacion.Rack);
            $('#id_rack').prop("readonly",false);
            //id_Sala
            $('#id_Sala').val(obj[0].Ubicacion.Sala);
            $('#id_Sala').prop("readonly",false);
            //id_Site
            $('#id_Site').val(obj[0].Ubicacion.Site);
            $('#id_Site').prop("readonly",false);
            //id_Unidad
            $('#id_Unidad').val(obj[0].Ubicacion.Unidad);
            $('#id_Unidad').prop("readonly",false);
            //id_IP
            $('#id_IP').val(obj[0].IP_Prin);
            $('#id_IP').prop("readonly",false);
            //id_IPApp
            $('#id_IPApp').val(obj[0].IP_Alternas.IP_Aplicativa);
            $('#id_IPApp').prop("readonly",false);
            //id_IPOper
            $('#id_IPOper').val(obj[0].IP_Alternas.IP_Operativa);
            $('#id_IPOper').prop("readonly",false);
            //id_IPSop
            $('#id_IPSop').val(obj[0].IP_Alternas.IP_Soporte);
            $('#id_IPSop').prop("readonly",false);

            $("#finish").text('Actualizar');

            $.unblockUI();

        })
        .fail(function() {
	        	//$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
        		$('#value').val('');
				$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}//if
			$.unblockUI();
        });

    }//fun_ejecuta_busqueda

    // funcion para ejecutar la actualización
    function fun_ejecuta_update()
    {
        //limpio los textos
        $('#message_error').empty();

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

        var data = {};
        //data.header = sJL_header;
        //data.data  = $('#inputData').val();
        //Acomodo de datos y construcción de Json
        var sJL_coordX = $('#id_coodenadas1').val() + "," + $('#id_coodenadas2').val();

        var jsonObject = {
            "Tablero": $('#id_tablero').val(),
            "Voltaje": $('#id_voltaje').val(),
            "Ambiente": $('select#id_selAmbiente option:selected').html(),
            "Direccion": $('#id_direccion').val(),
            "Gerencia": $('#id_gerencia').val(),
            "Descripcion": $('#id_descripcion').val(),
            "ID": $('#id_idEquipo').val(),
            "IP": $('#id_IP').val(),
            "IP_Aplicativa": $('#id_IPApp').val(),
            "IP_Operativa": $('#id_IPOper').val(),
            "IP_Soporte": $('#id_IPSop').val(),
            "Marca": $('#id_Marca').val(),
            "Modelo": $('#id_Modelo').val(),
            "Serie": $('#id_Serie').val(),
            "Sistema Operativo": $('#Id_sistemaOp').val(),
            "Tipo": "Switch",
            "Tipo Aplicativo": $('#id_tipoApp').val(),
            "Coordenadas": sJL_coordX,
            "Fila": $('#id_fila').val(),
            "Rack": $('#id_rack').val(),
            "Sala": $('#id_Sala').val(),
            "Site": $('#id_Site').val(),
            "Unidad": $('#id_Unidad').val(),
            "Estado": $('select#id_selEstado option:selected').html()
        };


        //Ejecuto la actualización del dato
        $.ajax({
			url: "{{ route('access.call.update_dispcatalog') }}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(jsonObject)
		})
        .done(function(response) {

            obj = jQuery.parseJSON(response);
            $('#message_error').append(' Resultado de Operación' + obj.description + 'Resultado:' +  obj.result);
            $.unblockUI();
        })
        .fail(function() {
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
        		$('#value').val('');
				$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}//if
			$.unblockUI();
        });
    }//fun_ejecuta_update

    // Funcion de Fin de Vista, ejecucion
    function finished(){

        $('#message_error').empty();
        fun_ejecuta_update();
        //validación de campos
        /*if(validaCampos())
        {
            $('#message_error').empty();
            fun_ejecuta_update();
        }//if
        else
        {
            $('#message_error').empty();
            $('#message_error').append('Error de Validación de Datos, favor de validar').append(obj.name);
        }//else
        */
    } //finished

    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla
        document.getElementById('radio5').checked=true;
        tipo_campo = "ip";

        // Seteado de campos seleccionables
        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana

            //Combo de Tipo dispositivo
            $('#id_selAmbiente').append(
                $('<option></option>').val('').html( 'Seleccionar tipo de dispositivo')
            );
            $('#id_selAmbiente').append(
                $('<option></option>').val('1').html( 'Productivo')
            );
            $('#id_selAmbiente').append(
                $('<option></option>').val('2').html( 'Desarrollo')
            );
            $('#id_selAmbiente').append(
                $('<option></option>').val('3').html( 'QA')
            );
            $('#id_selAmbiente').append(
                $('<option></option>').val('4').html( 'Test')
            );

            //Combo de Tipo dispositivo
            $('#id_selEstado').append(
                $('<option></option>').val('').html( 'Seleccionar Estado Dispositivo')
            );
            $('#id_selEstado').append(
                $('<option></option>').val('1').html( 'Activo')
            );
            $('#id_selEstado').append(
                $('<option></option>').val('2').html( 'Desactivado')
            );
            $('#id_selEstado').append(
                $('<option></option>').val('3').html( 'Desarrollo')
            );
            $('#id_selEstado').append(
                $('<option></option>').val('4').html( 'Preproduccion')
            );


        	return {
		        init: function() {
		        	$('#previous').hide();
                    $( "#finish" ).text('Siguiente');

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
