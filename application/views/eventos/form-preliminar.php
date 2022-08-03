	<div class="container-fluid">
		<form id="formInforme" name="formInforme" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" id="idregevento" value="" />
			<input type="hidden" id="version" value="" />
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
										<!--<a class="nav-item nav-link font-sirese" id="nav-pruebas-tab" data-toggle="tab" href="#nav-pruebas" role="tab" aria-controls="nav-fotos" aria-selected="false">Pruebas</a>-->
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
												<table id="tableDanio" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%">
												</table>
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
										<div class="col-sm-9">
											<div class="table-responsive">
												<table id="tableAccion" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%">
												</table>
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
												<button type="button" data-toggle="modal" class="btn btn-sirese mx-3" id="btnbuscaIE">Buscar IE</button>
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
												<table id="tableIE" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%">
												</table>
											</div>
										</div>
									</div>
								
								</div>
								<div class="tab-pane fade py-4" id="nav-fotos" role="tabpanel" aria-labelledby="nav-fotos-tab">
									<div class="row justify-content-center">
										<div class="col-4 align-self-center" id="drop-files" ondragover="return false">
											Arrastre Im&aacute;genes o click aqu&iacute;
										</div><br>
									</div>
									<div id="uploaded-holder" class="container" >
										<div id="dropped-files" class="row"></div>
										<div id="extra-files">
											<div class="number">0</div>
											<div id="file-list"><ul></ul></div>
										</div>
									</div>
									<input id="file-upload" type="file" accept="image/*" style="display:none" />
									<!--<div class="row"><button type="button" data-toggle="modal" class="btn btn-sirese pull-right" data-target="#addModal">Agregar Imagen</button></div>-->
									<div class="row justify-content-center">
										<div class="col-sm-8">
											<div class="table-responsive">
												<table id="tableFotos" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%"></table>
											</div>
										</div>
									</div>
								</div>
								<!--<div class="tab-pane fade show active py-4" id="nav-pruebas" role="tabpanel" aria-labelledby="nav-pruebas-tab">
									
								
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12"><h5 id="cargando" class="succes"></h5></div>
			<div class="col-sm-12"><h5 id="message" class="succes"></h5></div>
			<div class="col-sm-12 mx-auto pb-3">
				<button type="submit" class="btn btn-sirese mx-3" id="btnInforme">Guardar</button>
				<button class="btn btn-sirese" id="btnCancelPrel" name="btnCancelPrel">Cancelar</button>
			</div>
			
			<div class="modal fade modal-fullscreen" id="modalIE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					<div id="loading" style="diaplay:none"><div id="loading-center"></div></div>
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel"></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="overflow: hidden;">
							<form id="formIE" name="formIE" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
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
								<div class="row justify-content-center mt-2" id="content"></div>
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
			
		</form>
	</div>
	