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
						<h3><span class="head-font capitalize-font">Activación de usuario</span></h3>
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
                                        <!-- Campo 01 -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-12">
                                                    <div><br></div>
                                                    <div class="col-sm-3 mb-20">
												        <label class="help-block text-left">Campo</label>
                                                    </div>
                                                    <div class="col-sm-4 mb-20">
														<input type="text" data-minlength="10" class="form-control" id="cmd_Campo01" placeholder="Ingrese Descripcion" data-error="Valor inválido" maxlength="150">
													    <div class="help-block with-errors" id="err_msg_campo"></div>
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
