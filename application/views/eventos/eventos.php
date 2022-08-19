		<div class="col-xl-12 col-md-12">
			<div class="ajaxForm" style="display:none"><?php $this->load->view("eventos/form-new"); ?></div>
			<div class="ajaxTable">
				<div class="card m-b-30 pb-35">
					 <div class="card-body">
						<h4 class="mt-0 m-b-15 header-title">Listado General de Eventos Registrados</h4>
						<br>
						<div class="row ml-1">
							<label for="mes" class="col-sm-12">Aplicar Filtros por A&ntilde;o y mes del Evento:</label>
							<select class="form-control col-sm-2 mx-2" name="anio" id="anio">
								<option value="">-- Seleccione --</option>
								<?
								foreach($this->session->userdata("anio") as $row):
									if($row->anio == strftime('%Y'))
										echo '<option value="'.$row->idanio.'" selected >'.$row->anio.'</option>';
									else
										echo '<option value="'.$row->idanio.'">'.$row->anio.'</option>';
								endforeach;
								?>
							</select>
							<select class="form-control col-sm-2 mx-2" name="mes" id="mes">
								<option value="">-- Seleccione --</option>
								<?
									foreach($this->session->userdata("mes") as $row):
										if(intval($row->idmes) == date('n'))
											echo '<option value="'.$row->idmes.'" selected >'.$row->mes.'</option>';
										else
											echo '<option value="'.$row->idmes.'">'.$row->mes.'</option>';
									endforeach;
								?>
							</select>
								
						</div>
						<br>
						<div class="container-fluid">
							<div class="mx-auto"><!--align-items-center text-center-->
								<table id="tablaEvento" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0" style="width:100%"></table>
							</div>
						</div>
						</div>
				</div>
			</div>
			<div class="ajaxPreliminar" style="display:none"><?php $this->load->view("eventos/form-preliminar"); ?></div>
			<div class="ajaxComplementario" style="display:none"><?php $this->load->view("eventos/form-complementario"); ?></div>
		</div>