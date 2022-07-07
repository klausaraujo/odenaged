	<div class="container-fluid">
		<form id="formCanillita" name="formCanillita" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
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
												<option value="<?=$row->idtipoevento;?>"><?=$row->tipo_evento;?></option>
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
											<input class="form-control col-sm-1" type="checkbox" value="" id="afecta">
										</div>
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
									<div class="col-sm-4">
										<div class="row">
											<label for="fechaaccion" class="col-sm-12">Fecha:</label>
											<input type="date" class="form-control col-sm-10" name="fechaaccion" id="fechaaccion" value="<?=$fechaActual?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="cargo" class="col-sm-12">Cargo:</label>
											<input type="text" class="form-control col-sm-10" id="cargo" name="cargo" placeholder="Ejemplo: Director de la Instituci&oacute;n Educativa">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="distrito" class="col-sm-12">Instituci&oacute;n:</label>
											<select class="form-control col-sm-10" name="distrito" id="distrito">
												<option value="">-- Seleccione --</option>
											</select>
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
			<div class="col-sm-4 ml-auto mr-auto pb-3">
				<button type="submit" class="btn btn-primary mx-3" id="btnEnviar">Guardar registro</button>
				<button class="btn btn-primary" id="btnCancelar" name="btnCancelar" role="button" data-dismiss="modal" aria-pressed="true">Cancelar</button>
			</div>
		</form>
	</div>