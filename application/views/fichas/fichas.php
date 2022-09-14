		<div class="col-xl-12 col-md-12">
			<div class="ajaxFichas">
				<div class="card m-b-30 pb-35">
					 <div class="card-body">
						<!--<h4 class="mt-0 m-b-15 header-title">Listado General de Eventos Registrados</h4>-->
						<div class="container-fluid">
							<div class="row">
								<div class="table-responsive" style="overflow-x:scroll">
								<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->
									<table id="tablaFichas" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-2 mx-auto" style="display:none">
										<thead class="text-center"><tr><th>Acciones</th><th>Fichas</th></tr></thead>
									</table>
								</div>
							</div>
						</div>
						</div>
				</div>
			</div>
			<div class="ajaxNuevoFichas" style="display:none"><?php $this->load->view("fichas/form-fichas"); ?></div>
		</div>