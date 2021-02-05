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
											     @include('layouts.Search_Activity')
										    </div>
									    </div>
								    </div>
							    </div>

                            </form>
						</section>
						<h3><span class="head-font capitalize-font">Calendarización de Actividad</span></h3>
						<section>
                            <form id="step_two">
                                <!-- Contenedor -->
                                <form id="form_tabs" action="#">
                                    <div class="panel panel-default">
                                        <!-- Header Subseccion -->
                                        <div class="panel-heading">
                                        Texto Seccion
                                        </div>
                                        <!-- Contenido Subseccion -->
                                        <div class="card-body">
                                            <div><br></div>
                                            Aqui van los campos
                                        </div>
                                    </div>
                                </form>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Busqueda de Actividad</span></h3>
						<section>
                            <form id="step_three">
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


    // funcion para cambio de pestaña
    function ValidateNext() {
        //Validacion de campo de busqueda Input data del layou te busqueda
        var dato=$('#inputData').val();

        //REalizo validacion de que el dato este correcto
		if (patrones[tipo_campo].test(dato)) {
			fun_ejecuta_busqueda();
            return true;

		} else {
		    $("#inputData").css({'border' : '1px solid #f73414'});
			$("#message_error").css('color', '#f73414');
			$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
            return false;
        }//else
	}

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda(){
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

        //Ejecuto la busqueda del dato
        $.ajax({
			url: "{{ route('Users.call.user_search') }}",
			type: 'GET',
		 	data: {
		 		'type': tipo_campo,
		 		'value': $('#inputData').val()
		 	}
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
        })
        .fail(function() {
	        	$('#message_error').empty();
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
        	}else{
                // inserto los datos y configuro la siguiente pestaña
                $('#message_error').append('Ejecución Correcta ');
        		/*$("#msisdn").text( ' '+changenull(obj.msisdn) );
        		$("#imsi").text( ' '+changenull(obj.imsi) );
        		$("#icc").text( ' '+changenull(obj.iccid) );
        		$('#message_error').empty();
 	        	*/

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
		        	$('#previous').hide();
                    $( "#finish" ).text('Siguiemte');

                    $('#message').empty();
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

