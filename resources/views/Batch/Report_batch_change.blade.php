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
						<h3><span class="head-font capitalize-font">Reporte Batch de Cambios</span></h3>
						<section>
                            <form id="step_two">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_user_disp_baja_change')
                                    </div>
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
                                </div>
                            </form>
                            <!-- Texto de Menajes -->
                            <div class="row" id="message_text">
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
    function ValidateNext()
    {
        fun_ejecuta_busqueda();
        return true;
	}//ValidateNext

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda()
    {
        //limpio los textos
        $('#message_text').empty();
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
        data.type   = "cambio";
        data.mail   = sJL_mail;
        if( $('#txtDateini' ).val() != '' && $('#txtDatefin' ).val() != '')
        {
            data.fecha_ini = $('#txtDateini' ).val();
            data.fecha_fin = $('#txtDatefin' ).val()
        }

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('batch.call.user_report_change') }}",
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
                                //Campo de tipo dispositivo
                                "data": "send_idtipodisp"
                            },
                            {
                                //Tipo Dispositivo
                                "data": "send_usuario"
                            },
                            {
                                //GRUPO
                                "data": "send_idstatus"
                            },
                            {
                                //USUARIO
                                "data": "send_fechaIngreso"
                            },
                            {
                                //TIPO USUARIO
                                "data": "send_fechaupdate"
                            },
                            {
                                //PERFIL
                                "data": "send_reintento"
                            },
                            {
                                //PERFIL
                                "data": "send_estatus"
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'csv'
                        ]
                    });
                }else
                {
                    $("#message_text").text("No hay datos para Mostrar, seleccione una fecha");
                } //else
            } else
            {
			    $("#message_text").css('color', '#f73414');
			    $("#message_text").text("Por favor ingresa un valor de " + tipo_campo + " válido " + dato);
                $.unblockUI();
            } //else
            $.unblockUI();

        })
        .fail(function() {
	        	$('#message_text').empty();
				$('#message_text').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
        		$('#value').val('');
				$('#message_text').empty();
				$('#message_text').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}//if
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
            if ( $('#txtDateini' ).val()=='' )
            {
                $('#message_text').empty();
                $('#message_text').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha inicio de consulta</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                return false;
            }

            if ( $('#txtDatefin' ).val()=='' )
            {
                $('#message_text').empty();
                $('#message_text').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha fin de consulta</label>');
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

                    $('#message_text').empty();
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
