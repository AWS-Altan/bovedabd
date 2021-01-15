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
						<h3><span class="head-font capitalize-font">Reporte de Usuarios dispositivos </span></h3>
						<section>
                            <form id="step_two">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_user_disp_report')
                                    </div>
                                    <br><br>
                                    Seleccione otros criterios de busqueda:
                                    <br><br>
                                    <!-- Vigencia del usuario -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Fecha Inicio:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDateini" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <!-- Vigencia del usuario -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Fecha Final:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDatefin" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <br><br>
                                    Criterios Adicionales:
                                    <br><br>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio5" value="option1" Onclick="TipoDato4('ip')">
                                            <label for="radio5" style="margin-bottom: 0px;">
                                                IP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('hostname')">
                                            <label for="radio6" style="margin-bottom: 0px;">
                                                HOSTNAME
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio7" value="option3" Onclick="TipoDato4('hostname')">
                                            <label for="radio7" style="margin-bottom: 0px;">
                                                USUARIO
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio8" value="option4" Onclick="TipoDato4('hostname')">
                                            <label for="radio8" style="margin-bottom: 0px;">
                                                SOLICITANTE
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio9" value="option5" Onclick="TipoDato4('hostname')">
                                            <label for="radio8" style="margin-bottom: 0px;">
                                                STATUS
                                            </label>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-sm-1">
                                        <div class="form-wrap" style="display: inline-block; width: 320px">
                                                <form id="form_identify">
                                                    <div class="form-group">
                                                        <input type="text" data-minlength="10" class="form-control" id="inputData" placeholder="Ingrese valor a consultar" data-error="Valor inv�lido" maxlength="150">
                                                        <div class="help-block with-errors" id="inputMSISDNError"></div>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Texto de Menajes -->
                            <div class="row" id="message_error">
            				</div>
                        </section>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection


<!-- Inicio la programación del estilo -->
@section('jsfree')
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 45%;
	}
</style>
<script>


    // funcion para cambio de pestaña
    function ValidateNext() {
        fun_ejecuta_busqueda();
        return true;
	}

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda()
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

        //Ejecuto la busqueda del dato, armo la busqueda
        var sJL_mail = '{{app('auth')->user()->email}}';

		var data = {};
        data.type   = "alta";
        data.mail   = sJL_mail;
        if( $('#txtDateini' ).val() != '' && $('#txtDatefin' ).val() != '')
        {
            data.fecha_ini = $('#txtDateini' ).val();
            data.fecha_fin = $('#txtDatefin' ).val()
        }
        if(document.getElementById('radio5').checked)
        {
            data.IP = $('#inputData').val();
        }//if
        if(document.getElementById('radio6').checked)
        {
            data.hostname = $('#inputData').val();
        }//if
        if(document.getElementById('radio7').checked)
        {
            data.user = $('#inputData').val();
        }//if
        if(document.getElementById('radio8').checked)
        {
            data.solicitante = $('#inputData').val();
        }//if
        if(document.getElementById('radio9').checked)
        {
            data.status = $('#inputData').val();
        }//if

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('access.call.report_userdisp') }}",
			type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            if (obj.status = "ok")
            {
                if(obj.data != "No Data Return")
                {

                    data = jQuery.parseJSON(obj.data);
                    if (typeof(datatableInstance)!== 'undefined')
                    {
                        datatableInstance.destroy();
                    } //if

                    datatableInstance = $('table#Tbl_usrdisp').DataTable({
                        "data": data,
                        "pageLength": 10,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [
                            {
                                //Campo de IP
                                "data": "send_ip"
                            },
                            {
                                //Campo de HOST
                                "data": "send_host"
                            },
                            {
                                //Tipo Dispositivo
                                "data": "send_idtipodisp"
                            },
                            {
                                //GRUPO
                                "data": "send_idgrupo"
                            },
                            {
                                //USUARIO
                                "data": "send_usuario"
                            },
                            {
                                //TIPO USUARIO
                                "data": "send_idtipo"
                            },
                            {
                                //STATUS
                                "data": "send_idstatus"
                            },
                            {
                                //PERFIL
                                "data": "send_idperfil"
                            },
                            {
                                //SOLICITANTE
                                "data": "send_idsolicitante"
                            },
                            {
                                //FECHA INGRESO
                                "data": "send_fechaIngreso"
                            },
                            {
                                //FECHA INGRESO
                                "data": "send_fechaTermino"
                            },
                            {
                                data: null,
                                className: "center",
                                defaultContent: '<a href="" class="editor_alta">Alta</a> / <a href="" class="editor_edit">Cambio</a> / <a href="" class="editor_remove">Baja</a>'
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'csv'
                        ]
                    });

                    // Opcion de Borrado
                    var editor;
                    //$('#example').on('click', 'a.editor_remove', function (e) {
                    $('table#Tbl_usrdisp').on('click', 'a.editor_remove', function (e) {
                        e.preventDefault(); //para eviar redirect
                        $('#message_error').append("sisfen DELETE 01 ");
                        //var dataJL = datatableInstance.row($(this).parents('tr')).data();
                        //var dataJL = table.row($(this).parents('tr')).data();
                        $('#message_error').append("sisfen DELETE 02 " + dataJL);
                        //alert(dataJL[0]);
                        //$(this).closest('tr')
                    } );

                    // Edit record
                    $('table#Tbl_usrdisp').on('click', 'a.editor_edit', function (e) {
                        e.preventDefault();
                        $('#message_error').append("sisfen EDIT");
                    } );

                    // Alta record
                    $('table#Tbl_usrdisp').on('click', 'a.editor_alta', function (e) {
                        e.preventDefault();
                        $('#message_error').append("sisfen Alta");
                    } );

                }else {
                    $("#message_error").text("No hay datos para Mostrar, seleccione una fecha");
                } //else
            } else
            {
			    $("#message_error").css('color', '#f73414');
                $("#message_error").text("Por favor ingresa un valor de " + tipo_campo + " válido " + dato);
                $.unblockUI();

            } //else
            $.unblockUI();

        })
        .fail(function() {
                $('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
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
        	}
			$.unblockUI();
        });

    }//fun_ejecuta_busqueda



    // Funcion de Fin de Vista, ejecucion
    function finished(){

        if( $('#txtDateini' ).val()!='' && $('#txtDatefin' ).val()!='')
        {
            fun_ejecuta_busqueda();
        }else if ($('#txtDateini' ).val()!='' || $('#txtDatefin' ).val()!='')
        {
            if ( $('#txtDateini' ).val()=='' ){
                $('#message_error').empty();
                $('#message_error').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha inicio de consulta</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
            }

            if ( $('#txtDatefin' ).val()=='' ){
                $('#message_error').empty();
                $('#message_error').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha fin de consulta</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                return false;
            }
        }
    } //finished
    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            var datatableInstance = null;

        	return {
		        init: function() {
                    tipo_campo="hostname";
		        	$('#previous').hide();
                    $( "#finish" ).text('Buscar');

                    $('#message_error').empty();
                    //initializePlugins2();

                    fun_ejecuta_busqueda();

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
