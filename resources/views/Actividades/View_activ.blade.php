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
						<h3><span class="head-font capitalize-font">Busqueda de Actividad</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Template busqueda Actividad -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_Cr')
										    </div>
									    </div>
								    </div>
							    </div>

                            </form>
						</section>
						<h3><span class="head-font capitalize-font">Consulta de Actividad</span></h3>
						<section>
                            <form id="step_two">
                                <!-- Contenedor -->
                                <form id="form_tabs" action="#">
                                    <div class="panel panel-default">
                                        <!-- Header Subseccion -->
                                        <div class="panel-heading">
    		    						    Información del CRQ
                                        </div>
                                            <div class="card-body">
                                            <!--renglon-->
                                            <div class="row">
                                                <!-- columnas Fecha inicio - Fecha Termino -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mt-12">
                                                        <div><br></div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">Fecha de Inicio CR</label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20 select select-group" >
                                                            <input type="text" data-minlength="10" class="form-control" id="id_fechaIni" placeholder="Ingrese la Fecha de inicio " data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtfechaIniError"></div>
                                                        </div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">Fecha Termino CR</label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20">
                                                            <input type="text" data-minlength="10" class="form-control" id="id_fechaFin" placeholder="Ingrese la Fecha de finalización" data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtfechaFinError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- columna Descripción -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mt-12">
                                                        <div><br></div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">Descripción</label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20 select select-group" >
                                                            <input type="text" data-minlength="10" class="form-control" id="id_DescripcionCR" placeholder="Ingrese la descripción del CR" data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtDescripcionError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- columnas Id Ticket - ID Req -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mt-12">
                                                        <div><br></div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">Ticket </label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20 select select-group" >
                                                            <input type="text" data-minlength="10" class="form-control" id="id_Ticket" placeholder="Ingrese el número de ticket" data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtidTicketError"></div>
                                                        </div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">numero de Req</label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20">
                                                            <input type="text" data-minlength="10" class="form-control" id="id_Requer" placeholder="Ingrese el numero de Requerimiento" data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtidreqError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- columna ID Acceso -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mt-12">
                                                        <div><br></div>
                                                        <!--campo-->
                                                        <div class="col-sm-2 mb-20">
                                                            <label class="help-block text-left">ID Acceso </label>
                                                        </div>
                                                        <div class="col-sm-4 mb-20 select select-group" >
                                                            <input type="text" data-minlength="10" class="form-control" id="id_Acceso" placeholder="Ingrese el identificador de Acceso" data-error="Valor inválido" maxlength="150" readonly="false" disabled="true">
                                                            <div class="help-block with-errors" id="txtAccesoError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Contenedor -->
                                <form id="form_tabs" action="#">
                                    <div class="panel panel-default">
                                        <!-- Header Subseccion -->
                                        <div class="panel-heading">
    		    						    Detalles equipos
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mt-12">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                            <div class="table-wrap">
                                                                <div class="table-responsive">
                                                                    <table id="Tbl_usrdisp" class="table table-hover display">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Site</th>
                                                                                <th>IP</th>
                                                                                <th>Usuario</th>
                                                                                <th>Solicitante</th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    function ValidateNext() {
        //Validacion de campo de busqueda Input data del layou te busqueda
        var dato=$('#inputData').val();
        console.log('voy a evaluar el dato');
        console.log(tipo_campo);
        console.log(dato);
        //REalizo validacion de que el dato este correcto
		if (patrones[tipo_campo].test(dato)) {
            console.log('voy a buscar el dato');
			bJL_return = fun_ejecuta_busqueda(dato);
            return true;
		} else {
		    $("#inputData").css({'border' : '1px solid #f73414'});
			$("#message_error").css('color', '#f73414');
			$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
            return false;
        }//else
	}

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda(sJL_crSearch){
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

        sJL_nextstep = false;

        var jsonrota = {
                    "crq"                     :sJL_crSearch
                };

        console.log(jsonrota);

        //Ejecuto la busqueda del dato
        $.ajax({
			url: "{{ route('actividades.call.view_activ') }}",
			type: 'POST',
            data:JSON.stringify(jsonrota),
            contentType: "application/json",
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log(obj);
            if(obj.status=="ok")
            {
                console.log("voy a hacer algo");


                $('#id_fechaIni').val(obj.details.info.fecha_inicio);
                //$('#id_fechaIni').prop("readonly",false);

                $('#id_fechaFin').val(obj.details.info.fecha_termino);
                //$('#id_fechaFin').prop("readonly",false);

                $('#id_DescripcionCR').val(obj.details.info.descripcion);
                //$('#id_DescripcionCR').prop("readonly",false);

                $('#id_Ticket').val(obj.details.info.id_ticket);
                //$('#id_Ticket').prop("readonly",false);

                $('#id_Requer').val(obj.details.info.id_req);
                //$('#id_nombre').prop("readonly",false);

                $('#id_Acceso').val(obj.details.id_acceso);
                //$('#id_nombre').prop("readonly",false);

                data = obj.details.info.acc_sol;
                if (typeof(datatableInstance)!== 'undefined')
                {
                    datatableInstance.destroy();
                } //if

                var datatableInstance
                datatableInstance = $('table#Tbl_usrdisp').DataTable({
                    "data": data,
                    "pageLength": 10,
                    "order": [
                            [0, "desc"]
                    ],
                    "columns": [
                            {
                                //id_site
                                "name": "id_site",
                                "data": "id_site"
                            },
                            {
                                //ip
                                "name": "ip",
                                "data": "ip"
                            },
                            {
                                //usuario
                                "name": "user",
                                "data": "user"
                            },
                            {
                                //id_solicitante
                                "name": "id_solicitante",
                                "data": "id_solicitante"
                            }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                    ]
                });


                $('#previous').hide();
                $.unblockUI();
                sJL_nextstep = true;
            }//if
            else
            {
                console.log("dato incorecto");
                $('#value').val('');
				$('#message_error').empty();
                $("#message_error").css('color', 'red');
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar: </strong> ' + obj.details);
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
                sJL_nextstep = false;
            }

        })
        .fail(function() {
	        	$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
	        	$.unblockUI();
	        })
        .always(function() {
            console.log("CR always:" + sJL_nextstep);
            $.unblockUI();
            return sJL_nextstep;
        });
        return sJL_nextstep;

    }//fun_ejecuta_busqueda



    // Funcion de Fin de Vista, ejecucion
    function finished(){

    } //finished
    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana


        	return {
		        init: function() {
		        	$('#previous').hide();
                    TipoDato4('cr');
                    $( "#finish" ).text('Siguiemte');

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
