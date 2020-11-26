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
						<h3><span class="head-font capitalize-font">Alta de usuario</span></h3>
						<section>
                            <form id="form_tabs" action="#">
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Datos de la cuenta (usuario)
                                    </div>
                                    <!-- despues del header de la seccion -->
                                    <div class="card-body">
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                                <!-- /panel1 -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Header sub sec 2
                                    </div>
                                </div>

                                <!-- /panel2 -->
                                <div class="panel panel-default">
                                    <!-- Header Subseccion -->
                                    <div class="panel-heading">
    								Header sub sec 3
                                    </div>
                                </div>
                            </form>

							<div class="row">
								<div class="col-sm-12">
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-sm-9">
												<div class="form-wrap" style="display: inline-block;">
													    <div class="help-block" style="color:#9E1D22; font-weight: bold;">
													    	texto informativo
													    </div>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>



						</section>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
