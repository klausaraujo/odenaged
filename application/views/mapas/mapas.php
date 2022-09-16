<?
$sombradiv = 'box-shadow: 2px 2px 5px 1px rgba(13, 0, 25,0.5)';
$dtz = new DateTimeZone("America/Lima");
$dt = new DateTime("now", $dtz);
$fechaActual = $dt->format("Y-m-d");
?>
<style>
	.formu, .mapa{ margin:0;padding:0 }
	.formu{<?=$sombradiv?>;z-index:10}
	label{margin-top:5px; margin-bottom:2px}
	.card-body{min-height:600px}
</style>
<div class="clearfix"></div>
<div class="col-sm-12">
	<div class="row mapaEvento">
		<div class="col-md-5 formu">
			<div class="card m-b-30 pb-35">
				<div class="container-fluid m-0 pr-0">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 mb-2 pb-2" style="border-bottom:1px solid rgba(13, 0, 25,0.5)"><label>Reporte de Mapas de Eventos Monitoreados</label></div>
							<div class="col-md-6">
								<div class="row">
									<label for="region" class="col-md-12">Region:</label>
									<select class="form-control col-md-11" name="region" id="region">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="distrito" class="col-md-12">Distrito:</label>
									<select class="form-control col-md-11" name="distrito" id="distrito">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="nivel" class="col-md-12">Nivel:</label>
									<select class="form-control col-md-11" name="nivel" id="nivel">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="fechadesde" class="col-md-12">Desde:</label>
									<input type="date" class="form-control col-md-11" name="fechadesde" id="fechadesde" value="<?=$fechaActual;?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<label for="provincia" class="col-md-12">Provincia:</label>
									<select class="form-control col-md-11" name="provincia" id="provincia">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="tipoevento" class="col-md-12">TIpo de Evento::</label>
									<select class="form-control col-md-11" name="tipoevento" id="tipoevento">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="evento" class="col-md-12">Evento:</label>
									<select class="form-control col-md-11" name="evento" id="evento">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
								<div class="row">
									<label for="fechahasta" class="col-md-12">Hasta:</label>
									<input type="date" class="form-control col-md-11" name="fechahasta" id="fechahasta" value="<?=$fechaActual;?>"/>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row pr-2">
									<label for="consolidado" class="col-md-12">Consolidado de Evento:</label>
									<select class="form-control col-md-12" name="consolidado" id="consolidado">
										<option value=""> -- TODOS -- </option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<label for="evtmonit" class="col-md-12">
										<input type="checkbox" class="" name="evtmonit" id="evtmonit" />&nbsp;Eventos en Monitoreo
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<label for="evtcerr" class="col-md-12">
										<input type="checkbox" class="" name="evtcerr" id="evtcerr" />&nbsp;Eventos Cerrados
									</label>
								</div>
							</div>
						</div>
						<div class="row"><button class="btn col-sm-11 mx-auto btn-sirese" style="position:absolute;bottom:10px">Mostrar Reporte dentro del Mapa</button></div>
					</div>
				</div>
			</div>
		</div>
		<div id="map" style="min-height:600px" class="col-md-7 mapa"></div>
	</div>
</div>