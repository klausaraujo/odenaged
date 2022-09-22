<?
date_default_timezone_set("America/Lima");
$dt = new DateTime("now");
$fechaActual = $dt->format("Y-m-d");
$ubigeo = $this->session->userdata('ubigeo');
?>
		<div class="card m-b-30 pb-35">
			<div class="card-body">
				<h4 class="mt-0 m-b-15 header-title">Reporte Consolidado de Eventos</h4>
				<br>
				<form id="formReportes">
					<div class="row px-1 py-2">
						<div class="col-md-3">
							<label for="region" class="row pl-3">Region:</label>
							<select class="form-control row region mx-auto" name="region" id="regionMapa">
								<option value=""> -- TODOS -- </option>
								<?php
									if(!empty($ubigeo->dptos)){
										foreach($ubigeo->dptos as $row):	?>
											<option value="<?=$row->cod_dep;?>" ><?=$row->departamento;?></option>
								<?		endforeach;
									}	?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="provincia" class="row pl-3">Provincia:</label>
							<select class="form-control row provincia mx-auto" name="provincia" id="provinciaMapa">
								<option value=""> -- TODOS -- </option>
								<?php
									if(!empty($ubigeo->prov)){
										foreach($ubigeo->prov as $row):	?>
											<option value="<?=$row->cod_pro;?>" ><?=$row->provincia;?></option>
								<?		endforeach;
									}	?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="distrito" class="row pl-3">Distrito:</label>
							<select class="form-control row distrito mx-auto" name="distrito" id="distritoMapa">
								<option value=""> -- TODOS -- </option>
								<?php
									if(!empty($ubigeo->dttos)){
										foreach($ubigeo->dttos as $row):	?>
											<option value="<?=$row->cod_dis;?>" ><?=$row->distrito;?></option>
								<?		endforeach;
									}	?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="nivel" class="row pl-3">Nivel:</label>
							<select class="form-control row nivel mx-auto" name="nivel" id="nivelMapa">
								<option value=""> -- TODOS -- </option>
								<?php
									if(!empty($nivel)){
										foreach($nivel as $row):	?>
											<option value="<?=$row->idnivel;?>" ><?=$row->nivel;?></option>
								<?		endforeach;
									}	?>
							</select>
						</div>
					</div>
					<div class="row px-1 py-2">
						<div class="col-md-3">
							<label for="tipoevento" class="row pl-3">Tipo de Evento:</label>
							<select class="form-control row tipoevento mx-auto" name="tipoevento" id="tipoeventoMapa">
								<option value=""> -- TODOS -- </option>
								<?php
									if(!empty($tipoevento)){
										foreach($tipoevento as $row):	?>
											<option value="<?=$row->idtipoevento;?>" ><?=$row->tipo_evento;?></option>
								<?		endforeach;
									}	?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="evento" class="row pl-3">Evento:</label>
							<select class="form-control row evento mx-auto" name="evento" id="eventoMapa">
								<option value=""> -- TODOS -- </option>
							</select>
						</div>
						<div class="col-md-3">
							<label for="detevento" class="row pl-3">Detalle Evento:</label>
							<select class="form-control row detevt mx-auto" name="detevt" id="detevt">
								<option value=""> -- TODOS -- </option>
							</select>
						</div>
					</div>
					<div class="row px-1 py-2">
						<div class="col-md-3">
							<label for="consoevt" class="row pl-3">Consolidado de Evento:</label>
							<select class="form-control row mx-auto" name="consoevt" id="consoevt">
								<option value=""> -- TODOS -- </option>
							</select>
						</div>
						<div class="col-md-3">
							<label for="fechadesde" class="row pl-3">Desde:</label>
							<input type="date" class="form-control row mx-auto" name="fechadesde" id="fechadesde" value="<?=$fechaActual;?>"/>
						</div>
						<div class="col-md-3">
							<label for="fechahasta" class="row pl-3">Hasta:</label>
							<input type="date" class="form-control row mx-auto" name="fechahasta" id="fechahasta" value="<?=$fechaActual;?>"/>
						</div>
					</div>
				</form>
				<div class="col-sm-12 mx-auto py-3">
					<button type="submit" class="btn btn-sirese mx-3 buscaConsolidado" id="buscaEvtCons">Obtener Reporte</button>
					<!--<button class="btn btn-sirese retornarAjax" id="btnretornar" name="btnretornar">Retornar</button>-->
				</div>
				<div class="container-fluid px-0">
					<div class="row">
						<div class="table-responsive"><!--<div class="table-responsive" style="overflow-x:scroll">-->
							<table id="reporteEventos" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0 mx-auto" style="width:100%">
							<!--<table id="reporteEventos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">-->
							<!--<table id="reporteEventos" class="table display mx-auto" cellspacing="0" style="width:100%">-->
								<thead class="text-center">
									<tr>
										<th>&nbsp;</th>
										<th>Id Registro Evento</th><!--style="visibility:collapse; display:none;"-->
										<th>A&ntilde;o Evento</th>
										<th>N&uacute;mero de Evento</th>
										<th>Nivel</th>
										<th>Tipo Evento</th>
										<th>Evento</th>
										<th>Descripci&oacute;n</th>
										<th>Fuente Inicial</th>
										<th>Descripci&oacute;n Ubigeo</th>
										<th>Departamento</th>
										<th>Provincia</th>
										<th>Distrito</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Fecha Evento</th>
										<th>Hora</th>
										<th>Usuario Registro</th>
										<th>Fecha Registro</th>
										<th>Estado</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>