<style>
.table th, td{text-align:center;align-items:center;justify-content:center}
.table tr:first-child{width:40px}
</style>
<!---->
		<div class="container-fluid">
			<input type="hidden" id="idregComp" value="" />
			<input type="hidden" id="ubigeoComp" value="" />
			<input type="hidden" id="versionComp" value="" />
			<input type="hidden" id="dptoComp" value="" />
			<input type="hidden" id="provComp" value="" />
			<input type="hidden" id="dttoComp" value="" />
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
							<div class="iq-header-title"><h4>Gesti&oacute;n de Reportes Complementarios</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="row">
								<div class="col-sm-11 mx-auto">
									<div class="row d-flex align-items-center">
										<div class="col-sm-3"><label for="tipoEvtComp" class="col-sm-12">Tipo de Evento:</label></div>
										<div class="col-sm-3"><input type="text" class="form-control col-sm-12" name="tipoEvtComp" id="tipoEvtComp" readonly /></div>
										<div class="col-sm-1"></div>
										<div class="col-sm-2"><label for="evtComp" class="col-sm-12">Evento:</label></div>
										<div class="col-sm-3"><input type="text" class="form-control col-sm-12" name="evtComp" id="evtComp" readonly /></div>
									</div>
									<div class="row py-1"></div>
									<div class="row d-flex align-items-center">
										<div class="col-sm-3"><label for="ubdesComp" class="col-sm-12">Ubigeo:</label></div>
										<div class="col-sm-4"><input type="text" class="form-control col-sm-12" name="ubdesComp" id="ubdesComp" readonly /></div>
										<div class="col-sm-2"><label for="" class="col-sm-12">&nbsp;</label></div>
										<div class="col-sm-3"><button class="btn btn-sirese complementario" id="btnCrearComp">Crear Version</button></div>
									</div>
									<div class="row py-1"></div>
									<div class="row d-flex align-items-center">
										<div class="col-sm-3"><label for="fechaComp" class="col-sm-12">Fecha y Hora:</label></div>
										<div class="col-sm-4"><input type="text" class="form-control col-sm-12" name="fechaComp" id="fechaComp" readonly /></div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center py-2">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="tableComp" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 mx-auto" style="100%"></table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 mx-auto pb-3"><button class="btn btn-sirese" id="btnCancelComp" name="btnCancelComp">Retornar</button></div>
	</div>
	