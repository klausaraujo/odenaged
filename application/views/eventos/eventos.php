<?
$anio = $this->session->userdata('anio');
$mes = $this->session->userdata('mes');
if(null !== $zonas){
	date_default_timezone_set("America/Lima");
?>
		<div class="col-xl-12 col-md-12">
			<div class="ajaxForm" style="display:none"><?php $this->load->view("eventos/form-new"); ?></div>
			<div class="ajaxTable">
				<div class="card m-b-30 pb-35">
					 <div class="card-body">
						<h4 class="mt-0 m-b-15 header-title">Listado General de Eventos Registrados</h4>
						<br>
						<div class="row ml-1">
							<label for="filtros" class="col-sm-12">Aplicar Filtros por A&ntilde;o y mes del Evento:</label>
							<select class="form-control col-sm-2 mx-2" name="anio" id="anio">
							<?if(!empty($anio)){
								foreach($anio as $row):?>
									<option value="<?=$row->anio?>" <?=($row->anio === strftime('%Y'))? 'selected': ''?> ><?=$row->anio?></option>;
							<? 	endforeach;
							  }else{ echo '<option value="">-- Seleccione --</option>'; }
							?>
							</select>
							<select class="form-control col-sm-2 mx-2" name="mes" id="mes">
							<?if(!empty($mes)){
								foreach($mes as $row):?>
									<option value="<?=$row->mes?>" <?=($row->idmes === date('n'))? 'selected': ''?> ><?=$row->mes?></option>;
							<? 	endforeach;
							  }else{ echo '<option value="">-- Seleccione --</option>'; }
							?>
							</select>
						</div>
						<br>
						<div class="container-fluid">
							<div class="row">
								<div class="table-responsive" style="overflow-x:scroll">
								<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->
									<table id="tablaEvento" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-auto"></table>
								</div>
							</div>
						</div>
						</div>
				</div>
			</div>
			<div class="ajaxPreliminar" style="display:none"><?php $this->load->view('eventos/form-preliminar'); ?></div>
			<div class="ajaxComplementario" style="display:none"><?php $this->load->view('eventos/form-complementario'); ?></div>
			<div class="repòrteConsolidado" style="display:none"><?php $this->load->view('eventos/reporte-consolidado'); ?></div>
		</div>
<? } ?>