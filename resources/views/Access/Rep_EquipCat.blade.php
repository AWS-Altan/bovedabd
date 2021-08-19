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
						<h3><span class="head-font capitalize-font">Reporte de Equipos en Catalogo </span></h3>
						<section>
                            <form id="step_two">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_rep_equipCat')
                                    </div>
                                    <br><br>
                                    Seleccione otros criterios de busqueda:
                                    <br><br>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio5" value="option1" Onclick="TipoDato4('ambiente')">
                                            <label for="radio5" style="margin-bottom: 0px;">
                                                Ambiente
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('nombre')">
                                            <label for="radio6" style="margin-bottom: 0px;">
                                                ID
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio7" value="option3" Onclick="TipoDato4('ip')">
                                            <label for="radio7" style="margin-bottom: 0px;">
                                                IP Prin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio8" value="option4" Onclick="TipoDato4('nombre')">
                                            <label for="radio8" style="margin-bottom: 0px;">
                                                Marca
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio9" value="option5" Onclick="TipoDato4('tipo')">
                                            <label for="radio9" style="margin-bottom: 0px;">
                                                Tipo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio10" value="option5" Onclick="TipoDato4('modelo')">
                                            <label for="radio10" style="margin-bottom: 0px;">
                                                Modelo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio11" value="option5" Onclick="TipoDato4('status')">
                                            <label for="radio11" style="margin-bottom: 0px;">
                                                Tipo App
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio12" value="option5" Onclick="TipoDato4('tipo')">
                                            <label for="radio12" style="margin-bottom: 0px;">
                                                Gerencia
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio13" value="option5" Onclick="TipoDato4('tipo')">
                                            <label for="radio13" style="margin-bottom: 0px;">
                                                Direccion
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!--librerias para los botones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!--librerias para el boton del pdf -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>


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
    } //ValidateNext

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

        /*if(document.getElementById('radio5').checked)
        {
            data.IP = $('#inputData').val();
            console.log('IP:'+data.IP);
        }//if
        if(document.getElementById('radio6').checked)
        {
            data.hostname = $('#inputData').val();
            console.log('Hostname:'+data.hostname);
        }//if
        if(document.getElementById('radio7').checked)
        {
            data.user = $('#inputData').val();
            console.log('usuario:'+data.user);
        }//if
        if(document.getElementById('radio8').checked)
        {
            data.solicitante = $('#inputData').val();
            console.log('solicitante'+data.solicitante);
        }//if
        if(document.getElementById('radio9').checked)
        {
            data.status = $('#inputData').val();
            console.log('status:'+data.status);
        }//if*/

        $popup_visible = false;

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('access.call.report_equip_catalog') }}",
			type: 'GET',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response)
        {
            obj = jQuery.parseJSON(response);
            console.log(obj);

            if (obj.data !== 'undefined')
            {
                console.log('hay datos');
                data = obj.response;

                if (typeof($datatableInstance)!== 'undefined')
                {
                    console.log('borrando');
                    $datatableInstance.destroy();
                } //end

                $datatableInstance = $('table#Tbl_equipCat').DataTable({
                    "data": data,
                    "pageLength": 10,
                    "order": [
                        [0, "desc"]
                    ],
                    "columns": [
                        {
                            //Ambiente
                            "name": "Ambiente",
                            "data": "Ambiente"
                        },
                        {
                            //Campo de HOST
                            "name": "ID",
                            "data": "ID"
                        },
                        {
                            //IP_Prin
                            "name": "IP_Prin",
                            "data": "IP_Prin"
                        },
                        {
                            //Marca
                            "name": "Marca",
                            "data": "Marca"
                        },
                        {
                            //Tipo
                            "name": "Tipo",
                            "data": "Tipo"
                        },
                        {
                            //Modelo
                            "name": "Modelo",
                            "data": "Modelo"
                        },                        
                        {
                            //Tipo APP
                            "name": "Tipo_Aplicativo",
                            "data": "Tipo Aplicativo"
                        },
                        {
                            //Gerencia
                            "name": "Gerencia",
                            "data": "Area.Gerencia"
                        },
                        {
                            //Direccion
                            "name": "Direccion",
                            "data": "Area.Direccion"
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]
                });
            }//if
            else
            {
                    $("#message_error").text("No hay datos para Mostrar, seleccione una fecha");
            } //else

            $.unblockUI();

        })
        .fail(function()
        {
                $('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
	    })
        .always(function()
        {
        	//console.log(obj);

			$.unblockUI();
        });

    }//fun_ejecuta_busqueda

    function filtra_tabla()
    {

        console.log('hago filtro tabla');

        $datatableInstance.draw();


    }//filtra_tabla

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex )
        {


            var bJLFiltro = false;


                console.log('sisfen fecha');
                //reviso los campos del filtro


                    console.log('Fech dentro');
                    if($('#inputData').val()=='')
                    {
                        bJLFiltro = true;
                    }//if
                    else
                    {
                        sJL_dato=$('#inputData').val();
                        //Ambiente
                        if(document.getElementById('radio5').checked)
                        {
                            sJL_search = data[0];
                            console.log('filtro IP:'+sJL_dato);
                        }//if
                        //ID
                        if(document.getElementById('radio6').checked)
                        {
                            sJL_search = data[1];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro Hostname:'+sJL_dato);
                        }//if
                        //ID Prin
                        if(document.getElementById('radio7').checked)
                        {
                            sJL_search = data[2];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro usuario:'+sJL_dato);
                        }//if
                        //Marca
                        if(document.getElementById('radio8').checked)
                        {
                            sJL_search = data[3];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro solicitante:'+sJL_dato);
                        }//if
                        //Tipo
                        if(document.getElementById('radio9').checked)
                        {
                            sJL_search = data[4];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro status:'+sJL_dato);

                        }//if
                        //modelo
                        if(document.getElementById('radio10').checked)
                        {
                            sJL_search = data[5];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro status:'+sJL_dato);

                        }//if
                        //Tipo App
                        if(document.getElementById('radio11').checked)
                        {
                            sJL_search = data[6];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro status:'+sJL_dato);

                        }//if
                        //Gerencia
                        if(document.getElementById('radio12').checked)
                        {
                            sJL_search = data[7];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro status:'+sJL_dato);

                        }//if
                        //Direccion
                        if(document.getElementById('radio13').checked)
                        {
                            sJL_search = data[8];
                            sJL_dato=sJL_dato.toUpperCase()
                            sJL_search=sJL_search.toUpperCase()
                            console.log('filtro status:'+sJL_dato);

                        }//if
                        if (sJL_search.includes(sJL_dato))
                        {
                            bJLFiltro = true;
                        }//if
                    }//else


            return bJLFiltro;
        }
    );

    // Funcion de Fin de Vista, ejecucion
    function finished()
    {

            console.log('limpiando');
            $popup_visible = false;
            $('#message_error').empty();
            //$datatableInstance.clear().draw();
            filtra_tabla();
            //fun_ejecuta_busqueda();

    } //finished

    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {
        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            var $datatableInstance = null;

            //comportamiento del popup
            var $popup_visible = false;

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

                    });

		        }
		    };
        }
        Operations2().init();
    });// fin de inicio de pantall

</script>
@endsection
