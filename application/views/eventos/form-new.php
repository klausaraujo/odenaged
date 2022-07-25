	<div class="container-fluid">
		<form id="formEvento" name="formEvento" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="tipo" id="tipo" />
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
							<div class="iq-header-title"><h4>Datos Generales de la Emergencia</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<label for="tipoevento" class="col-sm-12">Tipo de Evento:</label>
											<select class="form-control col-sm-11" name="tipoevento" id="tipoevento">
												<option value="">-- Seleccione --</option>
									<?php
											foreach($tipoevento as $row):	?>
												<option value="<?=$row->idtipoevento;?>" ><?=$row->tipo_evento;?></option>
										<?	endforeach;?>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="evento" class="col-sm-12">Nombre del Evento:</label>
											<select class="form-control col-sm-11" name="evento" id="evento">
												<option value="">-- Seleccione --</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="nivelevento" class="col-sm-12">Nivel del Evento:</label>
											<select class="form-control col-sm-11" name="nivelevento" id="nivelevento">
												<option value="">-- Seleccione --</option>
									<?php
											foreach($nivel as $row):	?>
												<option value="<?=$row->idnivel;?>"><?=$row->nivel;?></option>
										<?	endforeach;?>
											</select>
										</div>
									</div>
								</div>
								<div class="row sismo" style="display:none"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="sismo row mr-sm-2" style="display:none">
									<div class="col-sm-12 py-3" style="/*background-color:rgba(255, 0, 0, 0.4);*/background-color:#DAF7A6;border-radius:0.7rem">
										<label class="col-sm-12 col-form-label">Evento Sismo/Terremoto</label>
										<hr class="col-sm-11" style="" />
										<div class="row px-2">
											<div class="col-sm-4">
												<div class="row">
													<label for="latitudsismo" class="col-sm-12">Latitud:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff" name="latitudsismo" id="latitudsismo"
														placeholder="Latitud Sismo" value="" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="row">
													<label for="longitudsismo" class="col-sm-12">Longitud:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff"	name="longitudsismo" id="longitudsismo"
														placeholder="Longitud Sismo" value="" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="row">
													<label for="profundidad" class="col-sm-12">Profundidad:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff" name="profundidad" id="profundidad"
														placeholder="Profundidad" value="" />
												</div>
											</div>
										</div>
										<div class="row px-2">
											<div class="col-sm-4">
												<div class="row">
													<label for="magnitud" class="col-sm-12">Magnitud:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff" name="magnitud" id="magnitud" 
														placeholder="Magnitud" value="" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="row">
													<label for="intensidad" class="col-sm-12">Intensidad:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff" name="intensidad" id="intensidad" 
														placeholder="Intensidad" value="" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="row">
													<label for="referencia" class="col-sm-12">Referencia del Sismo:</label>
													<input type="text" class="form-control col-sm-11" style="background:#fff" name="referencia" id="referencia" 
														placeholder="Referencia" value="" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<!--<h4>Ubicacion del Evento</h4>-->
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<label for="fechaevento" class="col-sm-12">Fecha del Evento:</label>
											<input type="date" class="form-control col-sm-11" name="fechaevento" id="fechaevento" value="<?=$fechaActual?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="horaevento" class="col-sm-12">Hora del Evento:</label>
											<input type="time" class="form-control col-sm-11" name="horaevento" id="horaevento" value="<?=$hora?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label class="col-sm-12">&nbsp;</label>
											<label class="form-check-label col-sm-9" for="afecta">Afecta al Sector Educaci&oacute;n:</label>
											<input class="form-control col-sm-1" type="checkbox" id="afecta">
										</div>
									</div>
								</div>
								<div class="row ajaxMap"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="row ajaxMap">
									<div class="col-sm-12 px-0 pr-sm-5">
										<!--<div class="pac-card" id="pac-card">
										  <div id="pac-container" class="place-map">
											<input id="pac-input" type="text" placeholder="Enter a location" />
										  </div>
										</div>
										<div id="infowindow-content">
										  <div id="place-name" class="title"></div>
										  <div id="place-address"></div>
										</div>-->
										<input type="hidden" name="lat" id="lat" /><input type="hidden" name="lng" id="lng" />
										<div id="map" style="min-height: 350px; width: 100%;margin-left: auto;margin-right: auto"></div>
									</div>
								</div>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<label for="region" class="col-sm-12">Departamento:</label>
											<select class="form-control col-sm-10" name="region" id="region">
												<option value="">-- Seleccione --</option>
									<?php
											foreach($dpto as $row):	?>
												<option value="<?=$row->cod_dep;?>"><?=$row->departamento;?></option>
										<?	endforeach;?>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="provincia" class="col-sm-12">Provincia:</label>
											<select class="form-control col-sm-10" name="provincia" id="provincia">
												<option value="">-- Seleccione --</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="distrito" class="col-sm-12">Distrito:</label>
											<select class="form-control col-sm-10" name="distrito" id="distrito">
												<option value="">-- Seleccione --</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="row">
									<div class="col-sm-11">
										<div class="row">
											<label for="descripcion" class="col-sm-12">Descripci&oacute;n:</label>
											<textarea type="text" class="form-control col-sm-12" name="descripcion" id="descripcion"
											onKeyUp="mayus(this)" placeholder="Descripci&oacute;n del Evento" value="" ></textarea>
										</div>
									</div>
								</div><br>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<br>
							</div>
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
												<script>function mayus(e){e.value = e.value.toUpperCase();}</script>
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
										<div class="col-sm-8">
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
								<br><br>
							</div>
						</div>
					</div>
				</div>			
			</div>
			<div class="col-sm-12"><h5 id="cargando" class="succes"></h5></div>
			<div class="col-sm-12"><h5 id="message" class="succes"></h5></div>
			<div class="col-sm-12 mx-auto pb-3">
				<button type="submit" class="btn btn-sirese mx-3" id="btnEnviar">Guardar registro</button>
				<button class="btn btn-sirese" id="btnCancelar" name="btnCancelar">Cancelar</button>
			</div>
		</form>
	</div>