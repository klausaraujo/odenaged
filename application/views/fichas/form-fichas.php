<?
$dtz = new DateTimeZone("America/Lima");
$dt = new DateTime("now", $dtz);
$fechaActual = $dt->format("Y-m-d");
$hora = $dt->format("H:i:s");
$ubigeo = $this->session->userdata('ubigeo');
//$fechaActual = str_replace("-","/",$fechaActual);
//echo $fechaActual;
?>
	<div class="container-fluid">
		<form id="formFichas" name="formFichas" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
			<div class="row">                 
				<div class="col-sm-12">
					<div class="iq-card px-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Fichas</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="col-sm-12">
								<!--<h4>Ubicacion del Evento</h4>-->
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<label for="fechaevento" class="col-sm-12">Fecha de Ficha:</label>
											<input type="date" class="form-control col-sm-11" name="fechaevento" id="fechaevento" value="<?=$fechaActual?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row">
											<label for="horaevento" class="col-sm-12">Hora de la Ficha:</label>
											<input type="time" class="form-control col-sm-11" name="horaevento" id="horaevento" value="<?=$hora?>"/>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="row justify-content-center">
											<label class="col-sm-12" for="afecta">Fichas:</label>
											<input class="form-control col-sm-11" type="text" id="afecta">
										</div>
									</div>
								</div>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="row">
									<div class="col-sm-11">
										<div class="row">
											<label for="descripcion" class="col-sm-12">Descripci&oacute;n:</label>
											<textarea type="text" class="form-control col-sm-12" name="descripcion" id="descripcion"
											onKeyUp="mayus(this)" placeholder="Descripci&oacute;n del Evento" value="" maxlength="5000"></textarea>
										</div>
									</div>
								</div>
								<div class="row"><hr class="col-sm-11" style="margin:20px 0"></div>
								<div class="row">
									<div class="col-sm-11">
										<div class="row">
											<label for="fuente" class="col-sm-12">Fuente Inicial:</label>
											<textarea type="text" class="form-control col-sm-12" name="fuente" id="fuente"
											onKeyUp="mayus(this)" placeholder="Fuente Inicial" value="" maxlength="1000" ></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
			<div class="col-sm-12"><h5 id="cargando" class="succes"></h5></div>
			<div class="col-sm-12 mx-auto pb-3">
				<button type="submit" class="btn btn-sirese mx-3" id="btnGuardar">Guardar</button>
				<button class="btn btn-sirese" id="btnCancelar" name="btnRetornar">Retornar</button>
			</div>
		</form>
	</div>