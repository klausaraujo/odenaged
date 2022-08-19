		<div class="container-fluid">
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
							<div class="iq-header-title"><h4>Gesti&oacute;n de Usuarios</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="row justify-content-center py-2">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="tablaUsuarios" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 mx-auto" style="100%"></table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>