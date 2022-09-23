<?
if (!isset($_SESSION['usuario'])) { header("location:" . base_url() . "login"); }
$sombradiv = 'box-shadow: 2px 2px 5px 1px rgba(13, 0, 25,0.5)';
$dtz = new DateTimeZone("America/Lima");
$dt = new DateTime("now", $dtz);
$fechaActual = $dt->format("Y-m-d");
$ubigeo = $this->session->userdata('ubigeo');
?>
<!doctype html>
<html lang="en">
<?	require_once( __DIR__ .'/../inc/header.php' );	?>
<body>
	<div class="container-fluid p-0">
		<div class="row">
			<!--<div class="clearfix"></div>-->
			<div class="col-sm-12">
				<div class="row mapaEvento">
					<div class="col-md-4 formu">
						<div class="card">
							<div class="container-fluid pr-0">
								<div class="card-body py-0">
									<div class="row">
										<div class="col-md-12 mb-2 pb-2" style="border-bottom:1px solid rgba(13, 0, 25,0.5)">
											<label style="font-weight:bold">Reporte de Mapas de Eventos Monitoreados</label>
										</div>
										<div class="col-md-6">
											<div class="row">
												<label for="region" class="col-md-12">Region:</label>
												<select class="form-control col-md-11 region" name="region" id="regionMapa">
													<option value=""> -- TODOS -- </option>
												<?php
													if(!empty($ubigeo->dptos)){
														foreach($ubigeo->dptos as $row):	?>
															<option value="<?=$row->cod_dep;?>" ><?=$row->departamento;?></option>
												<?		endforeach;
													}	?>
												</select>
											</div>
											<div class="row">
												<label for="distrito" class="col-md-12">Distrito:</label>
												<select class="form-control col-md-11 distrito" name="distrito" id="distritoMapa">
													<option value=""> -- TODOS -- </option>
												<?php
													if(!empty($ubigeo->dttos)){
														foreach($ubigeo->dttos as $row):	?>
															<option value="<?=$row->cod_dis;?>" ><?=$row->distrito;?></option>
												<?		endforeach;
													}	?>
												</select>
											</div>
											<div class="row">
												<label for="nivel" class="col-md-12">Nivel:</label>
												<select class="form-control col-md-11" name="nivel" id="nivelMapa">
													<option value=""> -- TODOS -- </option>
												<?php
													if(!empty($nivel)){
														foreach($nivel as $row):	?>
															<option value="<?=$row->idnivel;?>" ><?=$row->nivel;?></option>
												<?		endforeach;
													}	?>
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
												<select class="form-control col-md-11 provincia" name="provincia" id="provinciaMapa">
													<option value=""> -- TODOS -- </option>
												<?php
													if(!empty($ubigeo->prov)){
														foreach($ubigeo->prov as $row):	?>
															<option value="<?=$row->cod_pro;?>" ><?=$row->provincia;?></option>
												<?		endforeach;
													}	?>
												</select>
											</div>
											<div class="row">
												<label for="tipoevento" class="col-md-12">Tipo de Evento::</label>
												<select class="form-control col-md-11 tipoevento" name="tipoevento" id="tipoeventoMapa">
													<option value=""> -- TODOS -- </option>
												<?php
													if(!empty($tipo)){
														foreach($tipo as $row):	?>
															<option value="<?=$row->idtipoevento;?>" ><?=$row->tipo_evento;?></option>
												<?		endforeach;
													}	?>
												</select>
											</div>
											<div class="row">
												<label for="evento" class="col-md-12">Evento:</label>
												<select class="form-control col-md-11 evento" name="evento" id="eventoMapa">
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
												<select class="form-control col-md-12" name="consoevt" id="consoevt">
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
									</div><!--<i class="fa fa-circle-o-notch fa-pulse fa-1x" aria-hidden="true"></i>-->
									<div class="col-sm-12"><h2 id="cargando" class="text-center py-1 text-primary">&nbsp;</h2></div>
									<div class="col-md-12">
										<button class="btn col-sm-11 mx-auto btn-sirese buscaConsolidado" id="buscarMapa" >Mostrar Reporte dentro del Mapa</button>
										
										<div class="col-md-12 py-1" style="display:flex;justify-content:center;align-items:center">
											<a href="<?=base_url()?>" class="btn font-sirese mx-auto" style="font-size:15px;font-family:'Poppins',sans-serif;">
												<i class="fa fa-arrow-circle-left" aria-hidden="true">&nbsp;Retornar</i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="map" class="col-md-8 mapa"></div>
				</div>
			</div>
		</div>
	</div>
<?	require_once( __DIR__ .'/../inc/footer.php' );	?>
</body>