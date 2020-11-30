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
						<h3><span class="head-font capitalize-font">Calendarización de Actividad</span></h3>
						<section>
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
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
