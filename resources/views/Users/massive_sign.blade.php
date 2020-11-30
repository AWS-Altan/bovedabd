
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
						<h3><span class="head-font capitalize-font">Alta Masiva de Usuarios Boveda</span></h3>
						<section>
                            <!-- Contenedor -->
                            <form id="form_tabs" action="#">
                                <div class="panel panel-default">

                                </div>
                            </form>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group mb-0">
										<div class="row">
											<div class="col-sm-9">
												<div class="form-wrap" style="display: inline-block;">
														<form id="form_identify">
															<div class="row" id="formatLineBatch">
																<div class="col-sm-9 mb-60" style = "width: 100%">

																	<div class="form-group">
                                                                        Seleccione el archivo a procesar:
                                                                        <input type="file" data-minlength="7" class="form-control" id="inputFileData" placeholder="Archivo" data-error="Valor inválido" maxlength="20">
                                                                        <div class="help-block with-errors"></div>

                                                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                                                        <p>Archivos:
                                                                        <input type="file" name="archivos[]" />
                                                                        <input type="submit" value="Enviar" />

                                                                    </div>
																</div>
															</div>
														</form>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Row -->
							<div class="row" id="inputErrors">
								<div class="col-sm-6 mb-40">
									<div class="form-group mt-20 mb-10">
										<label class="control-label mb-10 text-left">Resultado batch</label>
										<label id="result" type="text" class="form-control filled-input"> El procesamiento se visualizará aquí </label>
										<input id="rescorde" type="hidden" name="">
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
