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
                                <!-- Texto de Menajes -->
                                <div class="row" id="message">
								</div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Cambio Contraseña</span></h3>
						<section>
                            <form id="step_two">
                                <!-- Texto de Menajes -->
                                <div class="row" id="message">
								</div>
                            </form>
                        </section>
                        <h3><span class="head-font capitalize-font">Confirmación Cambio</span></h3>
						<section>
                            <form id="step_tree">
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
