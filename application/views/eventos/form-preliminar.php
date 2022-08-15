<style>
.table th, td{text-align:center;align-items:center;justify-content:center}
.table tr:first-child{width:40px}
</style>

	<div class="container-fluid"><!---->
		<form id="formInforme" name="formInforme" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" id="idregevento" value="" />
			<input type="hidden" id="version" value="" />
			<input type="hidden" id="informe" value="" />
			<div class="row">
				<div class="col-sm-12">
				<? 
					$dtz = new DateTimeZone("America/Lima");
					$dt = new DateTime("now", $dtz);
					$fechaActual = $dt->format("Y-m-d");
					$hora = $dt->format("H:i:s");
					//$fechaActual = str_replace("-","/",$fechaActual);
					//echo $fechaActual;
				?>
					<div class="iq-card px-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Datos Preliminares de la Emergencia</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="row">
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link font-sirese active" id="nav-danios-tab" data-toggle="tab" href="#nav-danios" role="tab" aria-controls="nav-danios" aria-selected="true">Registro de Da&ntilde;os</a>
										<a class="nav-item nav-link font-sirese" id="nav-acciones-tab" data-toggle="tab" href="#nav-acciones" role="tab" aria-controls="nav-acciones" aria-selected="false">Registro de Acciones</a>
										<a class="nav-item nav-link font-sirese" id="nav-ie-tab" data-toggle="tab" href="#nav-ie" role="tab" aria-controls="nav-ie" aria-selected="false">Registro de IE Afectadas</a>
										<a class="nav-item nav-link font-sirese" id="nav-fotos-tab" data-toggle="tab" href="#nav-fotos" role="tab" aria-controls="nav-fotos" aria-selected="false">Galer&iacute;a de fotos</a>
									</div>
								</nav>
							</div>
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active py-4" id="nav-danios" role="tabpanel" aria-labelledby="nav-danios-tab">
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-4">
											<div class="row">
												<label for="tipodanio" class="col-sm-12">Tipo de Da&ntilde;o:</label>
												<select class="form-control col-sm-11" name="tipodanio" id="tipodanio">
													<option value="">-- Seleccione --</option>
										<?php
											foreach($danio as $row):	?>
												<option value="<?=$row->idtipodanio;?>" ><?=$row->tipo_danio;?></option>
										<?	endforeach;?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="row">
												<label for="cantidad" class="col-sm-12">Cantidad:</label>
												<input type="text" class="form-control col-sm-11" name="cantidad" id="cantidad"
													onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
													placeholder="Cantidad" value="" />
											</div>
										</div>
										<div class="col-sm-3">
											<div class="row">
												<label for="btnDanio" class="col-sm-12">&nbsp;</label>
												<button type="button" class="btn btn-sirese mx-3" id="btnDanio">Agregar</button>
											</div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-sm-8">
											<div class="table-responsive">
												<table id="tableDanio" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 col-sm-10 mx-auto"></table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade py-4" id="nav-acciones" role="tabpanel" aria-labelledby="nav-acciones-tab">
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-4">
											<div class="row">
												<label for="tipoaccion" class="col-sm-12">Tipo de Acci&oacute;n:</label>
												<select class="form-control col-sm-11" name="tipoaccion" id="tipoaccion">
													<option value="">-- Seleccione --</option>
										<?php
											foreach($accion as $row):	?>
												<option value="<?=$row->idtipoaccion;?>" ><?=$row->tipo_accion;?></option>
										<?	endforeach;?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="descripaccion" class="col-sm-12">Descripci&oacute;n:</label>
												<input type="text" class="form-control col-sm-11" name="descripaccion" id="descripaccion"
													onKeyUp="mayus(this)" placeholder="Descripci&oacute;n de la Acci&oacute;n" value="" />
											</div>
										</div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row justify-content-center"><hr class="col-sm-10" style="margin:20px 0"></div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-4">
											<div class="row">
												<label for="fechaaccion" class="col-sm-12">Fecha de la Acci&oacute;n:</label>
												<input type="date" class="form-control col-sm-11" name="fechaaccion" id="fechaaccion" value="<?=$fechaActual?>"/>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="row">
												<label for="horaaccion" class="col-sm-12">Hora de la Acci&oacute;n:</label>
												<input type="time" class="form-control col-sm-11" name="horaaccion" id="horaaccion" value="<?=$hora?>"/>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="row">
												<label for="btnAccion" class="col-sm-12">&nbsp;</label>
												<button type="button" class="btn btn-sirese mx-3" id="btnAccion">Agregar</button>
											</div>
										</div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row justify-content-center">
										<div class="col-sm-10">
											<div class="table-responsive">
												<table id="tableAccion" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 col-sm-9 mx-auto"></table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade py-4" id="nav-ie" role="tabpanel" aria-labelledby="nav-ie-tab">
									<input type="hidden" value="" id="idiest">
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-5">
											<div class="row">
												<label for="institucion" class="col-sm-12">Instituci&oacute;n:</label>
												<input type="text" class="form-control col-sm-11" name="institucion" id="institucion"
													onKeyUp="mayus(this)" value="" readonly />
											</div>
										</div>
										<div class="col-sm-5">
											<div class="row">
												<label for="descripie" class="col-sm-12">Descripci&oacute;n:</label>
												<input type="text" class="form-control col-sm-11" name="descripie" id="descripie"
													onKeyUp="mayus(this)" placeholder="Descripci&oacute;n de la Instituci&oacute;n" value="" />
											</div>
										</div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row justify-content-center"><hr class="col-sm-10" style="margin:20px 0"></div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-4">
											<div class="row">
												<label for="fechaie" class="col-sm-12">Fecha Acci&oacute;n:</label>
												<input type="date" class="form-control col-sm-11" name="fechaie" id="fechaie" value="<?=$fechaActual?>"/>
											</div>
										</div>
										<div class="col-sm-2"></div>
										<div class="col-sm-2">
											<div class="row">
												<label for="btnbuscaIE" class="col-sm-12">&nbsp;</label>
												<button type="button" data-toggle="modal" class="btn btn-sirese mx-3" id="btnbuscaIE" data-target="#modalIE">Busca IE</button>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="row">
												<label for="btnIE" class="col-sm-12">&nbsp;</label>
												<button type="button" class="btn btn-sirese mx-3" id="btnIE">Agregar</button>
											</div>
										</div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row justify-content-center">
										<div class="col-sm-9">
											<div class="table-responsive">
												<table id="tableIE" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 col-sm-9 mx-auto"></table>
											</div>
										</div>
									</div>
								
								</div>
								<div class="tab-pane fade py-4" id="nav-fotos" role="tabpanel" aria-labelledby="nav-fotos-tab">
									<div class="row">
										<div class="col-sm-4">
											<button type="button" data-toggle="modal" class="btn btn-sirese mx-3 pull-right" data-target="#addModal">Agregar Imagen</button>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-sm-8">
											<div class="table-responsive">
												<table id="tableFotos" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 col-sm-10 mx-auto"></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center mt-2" id="contentPrel"></div>
			<div class="row justify-content-center mt-2"><h5 id="cargandoPrel" class="succes"></h5></div>
			<div class="row justify-content-center mt-2"><h5 id="messagePrel" class="succes"></h5></div>
			<div class="col-sm-12 mx-auto pb-3">
				<button type="submit" class="btn btn-sirese mx-3" id="btnInforme">Guardar</button>
				<button class="btn btn-sirese" id="btnCancelPrel" name="btnCancelPrel">Retornar</button>
			</div>
			
			<div class="modal fade" id="modalIE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Buscar Instituciones</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body" style="overflow: hidden;">
							<form id="formIE" name="formIE" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
								<div id="content"></div>
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<label for="dpto" class="col-sm-12">Departamento:</label>
												<select class="form-control col-sm-11 ml-2" name="dpto" id="dpto">
												</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row ml-3">
											<label for="prov" class="col-sm-12">Provincia:</label>
											<select class="form-control col-sm-11" name="prov" id="prov">
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="dist" class="col-sm-12">Distrito:</label>
											<select class="form-control col-sm-11" name="dist" id="dist">
											</select>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table id="tableIEUbigeo" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%"></table>
										</div>
									</div>
								</div>
							</form>
						</div>
							
						<!--<div class="clearfix"></div>-->
						<div class="modal-footer"></div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Cargar Imagen</h4>
							<button type="button" id="cierra" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="overflow: hidden;">
							<div class="container my-2">
								<div id="uploader">
									<div class="container-fluid" id="uploaderCont">
										<div class="row ddHandler">
											<!--<div class="col-12 vista"><img /></div>
											<div class="col-12 vista"><label>Seleccione Archivos<input id="buscar" type="file" style ="display:none" multiple /></label></div>-->
											<div class="col-12" id="dragandrophandler" ondragover="return false">
												<svg class="bi bi-upload" width="1em" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M.5 8a.5.5 0 01.5.5V12a1 1 0 001 1h12a1 1 0 001-1V8.5a.5.5 0 011 0V12a2 2 0 01-2 2H2a2 2 0 01-2-2V8.5A.5.5 0 01.5 8zM5 4.854a.5.5 0 00.707 0L8 2.56l2.293 2.293A.5.5 0 1011 4.146L8.354 1.5a.5.5 0 00-.708 0L5 4.146a.5.5 0 000 .708z" clip-rule="evenodd"></path>
													<path fill-rule="evenodd" d="M8 2a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 018 2z" clip-rule="evenodd"></path>
												</svg>
												<span>Arrastre archivos Aqu&iacute; o 
													<label>Seleccione Archivos<input id="buscar" type="file" style ="display:none" multiple /></label>
												</span>
											</div>
										</div>
									</div>
									<div class="row agregar my-3"></div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>

						<div class="modal-footer"></div>
					</div>
				</div>
			</div>
			
		</form>
	</div>
	