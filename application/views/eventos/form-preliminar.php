	<div class="container-fluid">
		<form id="formPreliminar" name="formPreliminar" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" id="idregevento" value="" />
			<input type="hidden" id="tipo" value="" />
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
												<label for="horaaccion" class="col-sm-12">Fecha de la Acci&oacute;n:</label>
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
								<div class="tab-pane fade py-4" id="nav-ie" role="tabpanel" aria-labelledby="nav-ie-tab"></div>
								<div class="tab-pane fade py-4" id="nav-fotos" role="tabpanel" aria-labelledby="nav-fotos-tab">
									<div class="row justify-content-center">
										<div class="col-sm-8">
											<input id="file-upload" type="file" accept="image/*" />
											<div class="table-responsive">
												<table id="tableFotos" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0" style="width:100%"></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12"><h5 id="cargando" class="succes"></h5></div>
			<div class="col-sm-12"><h5 id="message" class="succes"></h5></div>
			<div class="col-sm-12 mx-auto pb-3">
				<button type="submit" class="btn btn-sirese mx-3" id="btnPreliminar">Guardar</button>
				<button class="btn btn-sirese" id="btnCancelPrel" name="btnCancelPrel">Cancelar</button>
			</div>
		</form>
	</div>