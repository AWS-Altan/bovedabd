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
						<h3><span class="head-font capitalize-font">Busqueda de Actividades Vigentes </span></h3>
						<section>
                            <form id="step_two">
                                <!--   -->
                                    <br><br>
                                    Seleccione otros criterios de busqueda basados en Fecha Inicio:
                                    <br><br>
                                    <!-- fecha de inicio -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Desde:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDateini" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <!-- Fecha Final -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Hasta:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDatefin" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()">  </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <br><br>
                                    
                                    <div class="col-sm-3">
                                        <a id="consult_remedy" type="button" class="btn btn-primary">Buscar</a>
                                    </div>
                                <!--   -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_inc_cr')
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

    <div id="dialog-form" title="Datos de CR">

        <form>
            <fieldset>
            <div class="col-sm-12">
                @include('layouts.Remedy_cr')
            </div>

            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>
    <div id="diaINC-form" title="Datos de INC">

        <form>
            <fieldset>
            <div class="col-sm-12">
                @include('layouts.Remedy_inc')
            </div>

            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
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
    <!--libreria para popup -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--librerias para el boton del pdf -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 100%;
    }

    fieldset { padding:0; border:10; margin-top:25px; }

    .ui-dialog .ui-dialog-content {
        border: 3;
        padding: .5em 1em;
        background: #f0eaea;
        overflow: auto;
        zoom: 1;
    }

</style>
<script>

    $( function()
    {
        var dialog_CR, form, dialog_IN;

        $("#consult_remedy").click(function (e) {
			console.log("inicializando boton busqueda con filtro")
			fun_ejecuta_busqueda();
		});

        fu_display_CR = function (sjl_crtext)
        {
            console.log("display CR: " + sjl_crtext);
            dialog_CR.data('param',sjl_crtext.toString()).dialog( "open" );
        }

        fu_display_IN = function (sjl_crtext)
        {
            console.log("display CR: " + sjl_crtext);
            dialog_IN.data('param',sjl_crtext.toString()).dialog( "open" );
        }

        dialog_CR = $( "#dialog-form" ).dialog(
        {
            autoOpen: false,
            height: 600,
            width: 1000,
            modal: false,
            open: function()
            {
                // do something on load
                var sJL_crExec = dialog_CR.data('param');
                console.log(sJL_crExec);
                console.log("aqui voy a revisar el CR " + sJL_crExec) ;

                fun_busca_ticket_CR(sJL_crExec)
            },
            buttons:
            {
                Cancel: function()
                {
                    dialog_CR.dialog( "close" );
                }
            }
        });

        dialog_IN = $( "#diaINC-form" ).dialog(
        {
            autoOpen: false,
            height: 600,
            width: 1000,
            modal: false,
            open: function()
            {
                // do something on load
                var sJL_crExec = dialog_IN.data('param');
                console.log(sJL_crExec);
                console.log("aqui voy a revisar el INC " + sJL_crExec) ;

                fun_busca_ticket_INC(sJL_crExec)
            },
            buttons:
            {
                Cancel: function()
                {
                    dialog_IN.dialog( "close" );
                }
            }
        });

    } );


    // funcion para cambio de pestaña
    function ValidateNext() {
        return true;
    }

    //funcion que mando a llamar para poder ver los detalles del ticket
    function fun_busca_ticket_CR(sJLTicket_value)
    {


        $.blockUI({ message: 'Revisando CRs ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            async: true,
            timeout: 3000,
            color: '#fff'
        } });


        console.log('inicio busqueda CR');
        var data = {};
        data.type   = "crq";
        data.value  =  sJLTicket_value;

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('actividades.call.view_remedy') }}",
			type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response)
        {
            console.log(".done");
            console.log(response);
            obj = jQuery.parseJSON(response);
            console.log(obj);
            if (obj.status == "ok")
            {
                if(obj.data != "No Data Return")
                {
                    console.log("OK a interpretacion");
                    data = jQuery.parseJSON(obj.data.data);

                    if (typeof($datatableCR)!== 'undefined')
                    {
                        $datatableCR.destroy();
                    } //if

                    // var $datatableInstance
                    $datatableCR = $('table#Tbl_usrCR').DataTable({
                        "data": data,
                        "pageLength": 10,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [
                            {
                                //CRQ
                                "name": "send_id_ticket",
                                "data": "send_id_ticket",
                            },
                            {
                                //REQ
                                "name": "send_id_req",
                                "data": "send_id_req"
                            },
                            {
                                //IP
                                "name": "send_ip",
                                "data": "send_ip"
                            },
                            {
                                //Usuario
                                "name": "send_user",
                                "data": "send_user"

                            },
                            {
                                //Solicitante
                                "name": "send_id_solicitante",
                                "data": "send_id_solicitante"
                            },
                            {
                                //Fecha Inicio
                                "name": "send_fecha_inicio",
                                "data": "send_fecha_inicio"
                            },
                            {
                                //Fecha Termino
                                "name": "send_fecha_termino",
                                "data": "send_fecha_termino"
                            },
                            {
                                //Fecha notificacion
                                "name": "send_fecha_notifica",
                                "data": "send_fecha_notifica"
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ]
                    });

                }//iff
            }//if
            else
            {
                $("#message_error_CR").css('color', '#f73414');
                $('#message_error_CR').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
            }//else
        })
        .fail(function() {
            $("#message_error_CR").css('color', '#f73414');
            $('#message_error_CR').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
        })
        .always(function () {
            console.log('CR always');
            $.unblockUI();
        })
    }//fun_busca_ticket_CR

//funcion que mando a llamar para poder ver los detalles del ticket
    function fun_busca_ticket_INC(sJLTicket_value)
    {
        $.blockUI({ message: 'Revisando INC ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            async: true,
            timeout: 3000,
            color: '#fff'
        } });


        console.log('inicio busqueda INC');
        var data = {};
        data.type   = "inc";
        data.value  =  sJLTicket_value;

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('actividades.call.view_remedy') }}",
			type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response)
        {
            console.log(".done");
            console.log(response);
            obj = jQuery.parseJSON(response);
            console.log(obj);
            if (obj.status == "ok")
            {
                if(obj.data != "No Data Return")
                {
                    console.log("OK a interpretacion");
                    data = jQuery.parseJSON(obj.data.data);

                    if (typeof($datatableCR)!== 'undefined')
                    {
                        $datatableCR.destroy();
                    } //if

                    // var $datatableInstance
                    $datatableCR = $('table#Tbl_usrIN').DataTable({
                        "data": data,
                        "pageLength": 10,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [
                            {
                                //CRQ
                                "name": "send_id_ticket",
                                "data": "send_id_ticket",
                            },
                            {
                                //REQ
                                "name": "send_id_task",
                                "data": "send_id_task"
                            },
                            {
                                //IP
                                "name": "send_ip",
                                "data": "send_ip"
                            },
                            {
                                //Usuario
                                "name": "send_user",
                                "data": "send_user"

                            },
                            {
                                //Solicitante
                                "name": "send_id_solicitante",
                                "data": "send_id_solicitante"
                            },
                            {
                                //Fecha Inicio
                                "name": "send_fecha_inicio",
                                "data": "send_fecha_inicio"
                            },
                            {
                                //Fecha notificacion
                                "name": "send_fecha_notifica",
                                "data": "send_fecha_notifica"
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ]
                    });

                }//iff
            }//if
            else
            {
                $("#message_error_INC").css('color', '#f73414');
                $('#message_error_INC').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
            }//else
        })
        .fail(function()
        {
            $("#message_error_INC").css('color', '#f73414');
            $('#message_error_INC').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
        })
        .always(function () {
            console.log('CR always');
            $.unblockUI();
        })
    }//fun_busca_ticket_INC

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
            timeout: 3000,
            color: '#fff'
        } });

        //Ejecuto la busqueda del dato, armo la busqueda
        //var sJL_mail = '{{app('auth')->user()->email}}';

		var data = {};
        data.type   = "gral";
        //data.mail   = sJL_mail;

        if( $('#txtDateini' ).val() != '')
        {
            data.fecha_ini = $('#txtDateini' ).val();
        }
        if($('#txtDatefin' ).val() != '')
        {
            data.fecha_fin = $('#txtDatefin' ).val()
        }
        /*if(document.getElementById('radio5').checked)
        {
            data.nombre = $('#inputData').val();
        }//if
        if(document.getElementById('radio6').checked)
        {
            data.apellido = $('#inputData').val();
        }//if
        if(document.getElementById('radio7').checked)
        {
            data.usuario = $('#inputData').val();
        }//if
        if(document.getElementById('radio8').checked)
        {
            data.ip = $('#inputData').val();
        }//if*/

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('actividades.call.view_remedy') }}",
			type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response) {
            console.log(".done");
            console.log(response);
            obj = jQuery.parseJSON(response);

            if (obj.status == "ok")
            {
                if(obj.data != "No Data Return")
                {

                    data = jQuery.parseJSON(obj.data.data);
                    if (typeof($datatableInstance)!== 'undefined')
                    {
                        $datatableInstance.destroy();
                    } //if

                    // var $datatableInstance
                    $datatableInstance = $('table#Tbl_usrdisp').DataTable({
                        "data": data,
                        "pageLength": 10,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [
                            {
                                //Ticket
                                "name": "send_ticket",
                                "data": "send_ticket",
                                "render" : function(data){
                                    if(data !== null && data != ""){
                                        data = '<a href=""  class="editor_ticket">' + data + '</a>';
                                    }
                                    return data;
                                }
                            },
                            {
                                //Fecha Inicio
                                "name": "send_fecha_inicio",
                                "data": "send_fecha_inicio"
                            },
                            {
                                //Fecha termino
                                "name": "send_fecha_termino",
                                "data": "send_fecha_termino"
                            },
                            {
                                //Fecha Pausa
                                "name": "send_fecha_pausa",
                                "data": "send_fecha_pausa"
                            },
                            {
                                //Fecha Reanudación
                                "name": "send_fecha_reanuda",
                                "data": "send_fecha_reanuda"
                            },
                            {
                                //Descripción
                                "name": "send_descripcion",
                                "data": "send_descripcion"
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ]
                    });

                    //$datatableInstance.DefaultView.ToTable(true, "send_ticket", "send_fecha_inicio", "send_fecha_termino", "send_fecha_pausa", "send_fecha_reanuda", "send_descripcion"); 
                    

                    // Opcion de Borrado
                    $('table#Tbl_usrdisp').on('click', 'a.editor_ticket', function (e)
                    {
                        e.preventDefault(); //para eviar redirect
                        var row = $datatableInstance.row($(this).closest('tr'));
                        //Obtengo los datos para el borrado
                        var sJLTicket_value = row.data()['send_ticket'];
                        //sJLTicket_value = "CRQ000000047121";
                        console.log('ticket '+ sJLTicket_value );
                        sJLTicket_value = sJLTicket_value.toUpperCase();
                        sJL_Type_ticket = sJLTicket_value.substring(0,3);
                        console.log(sJL_Type_ticket);

                                    switch(sJL_Type_ticket) {
                                        case "CRQ":
                                            // code block
                                            console.log("ejecucion CRQ");
                                            //dialog.dialog( "open" );
                                            fu_display_CR(sJLTicket_value);

                                            break;
                                        case "INC":
                                            // code block
                                            console.log("ejecucion INC");
                                            fu_display_IN(sJLTicket_value);
                                            break;
                                        default:
                                            // code block
                                            console.log("ejecucion Otro");
                                            break;
                                    }

                    } );


                }else {
                    $("#message_error").text("No hay datos para Mostrar, seleccione una fecha");
                } //else
            } else
            {
			    $("#message_error").css('color', '#f73414');
                $("#message_error").text("La busqueda no regreso ningun registro con ese filtro");

                if (typeof($datatableInstance)!== 'undefined')
                    {
                        console.log("Borro la tabla");
                        $('table#Tbl_usrdisp').DataTable().clear().draw();

                    } //if

            } //else


        })
        .fail(function() {
                $('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');

	        })
        .always(function() {
        	//console.log(obj);
			$.unblockUI();
            //document.getElementById('radio5').checked = true;
            $('#inputData').val('');

        });

    }//fun_ejecuta_busqueda




    // Funcion de Fin de Vista, ejecucion
    function finished(){


    } //finished
    //Cargo comportmiento de inicio de pantalla

    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla
        var $datatableInstance = null;

        var txJL_input = document.getElementById("inputData");

        /*txJL_input.onchange = function()
        {
            fun_ejecuta_busqueda();
        };*/




        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana


        	return {
		        init: function() {
                    tipo_campo="hostname";
		        	$('#previous').hide();
                    $( "#finish" ).hide();

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

