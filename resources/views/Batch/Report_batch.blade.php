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
						<h3><span class="head-font capitalize-font">Busqueda de Host</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Template busqueda Usuario -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_Dispositive')
										    </div>
									    </div>
								    </div>
							    </div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">información</span></h3>
						<section>
                            <form id="step_two">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_user_dispositivos')
                                    </div>
                                </div>
                            </form>
                        </section>
                        <!-- Texto de Menajes -->
                        <div class="row" id="message_text">
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
<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 45%;
	}
</style>
<script>


    // funcion para cambio de pestaña
    function ValidateNext() {
        //Validacion de campo de busqueda Input data del layou te busqueda
        var dato=$('#cmd_searchdata').val();

        fun_ejecuta_busqueda();


        //sisfen - falta la valdiación del tipo de dato
        //REalizo validacion de que el dato este correcto
		/*if (patrones[tipo_campo].test(dato)) {
            //$('#message_text').append('sisfen voy 2');
			fun_ejecuta_busqueda();
            return true;

		} else {
            //$('#message_text').append('sisfen voy 3');
		    $("#cmd_searchdata").css({'border' : '1px solid #f73414'});
			$("#message_text").css('color', '#f73414');
			$("#message_text").text("Por favor ingresa un valor de " + tipo_campo + " válido " + dato);
            return false;
        }//else*/
        return true;
	}

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

        //Ejecuto la busqueda del dato
        $.ajax({
			url: "{{ route('batch.call.userdisp_search') }}",
			type: 'GET',
		 	data: {
		 		'type': tipo_campo,
		 		'value': $('#cmd_searchdata').val()
		 	}
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            //$('#message_text').append('sisfen voy 4');
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
        	}else{
                // inserto los datos y configuro la siguiente pestaña
                $('#message_text').append('sisfen voy ').append(obj.send_host);
                //Hago el manejo de la tabla
                    $('table#Tbl_usrdisp').DataTable({
                        "data": obj,
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
                                //PERFIL
                                "data": "send_idperfil"
                            },
                            {
                                //SOLICITANTE
                                "data": "send_idsolicitante"
                            },
                            {
                                //STATUS
                                "data": "send_idstatus"
                            },
                            {
                                //FECHA INGRESO
                                "data": "send_fechaIngreso"
                            },
                            {
                                //FECHA ACTUALIZACIÓN
                                "data": "send_fechaupdate"
                            },
                            {
                                //ARCHIVO
                                "data": "send_file"
                            },
                            {
                                //NO REINTENTO
                                "data": "send_reintento"
                            },
                            {
                                //MSG ERROR
                                "data": "send_errorplat"
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'csv'
                        ]
                    });

                $('#message_text').append('sisfen pase ').append(obj.send_host);
                $.unblockUI();
	        }// Else
			$.unblockUI();
        });

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
                    tipo_campo="hostname";
		        	$('#previous').hide();
                    $( "#finish" ).text('Buscar');

                    $('#message_text').empty();
				    //initializePlugins2();

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
