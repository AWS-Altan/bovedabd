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
						<h3><span class="head-font capitalize-font">Busqueda de Usuario</span></h3>
						<section>
                            <form id="step_one">
                                <!-- Template busqueda Usuario -->
                                <div class="row">
								    <div class="col-sm-12">
									    <div class="form-group mb-0">
										    <div class="row">
											     @include('layouts.Search_Users')
										    </div>
									    </div>
								    </div>
							    </div>

                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Confirmación Activación</span></h3>
						<section>
                            <form id="step_two">

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

        //REalizo validacion de que el dato este correcto
		if (patrones[tipo_campo].test(dato)) {
            //$('#message_text').append('sisfen voy 2');
			fun_ejecuta_busqueda();
            return true;

		} else {
            //$('#message_text').append('sisfen voy 3');
		    $("#cmd_searchdata").css({'border' : '1px solid #f73414'});
			$("#message_text").css('color', '#f73414');
			$("#message_text").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
            return false;
        }//else
	}

    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda(){
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
			url: "{{ route('Users.call.user_search') }}",
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
				$('#message_text').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
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
                $('#message_text').append('sisfen voy ').append(obj.name);
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
