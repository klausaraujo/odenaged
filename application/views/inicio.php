			<?	if(isset($inicio)){	?>
					<div class="col-sm-12 "><br>                    
						<div class="iq-card">
							<div class="iq-card-header d-flex justify-content-between">
							   <div class="iq-header-title card-body ">
							<h3 style="font-size:22px;" class="text-center">
							   <b>SISTEMA INTEGRADO DE REGISTRO DE EVENTOS DEL SECTOR EDUCACIÓN - SIRESE</b>
							</h3>
								</div>
							</div>
						</div>
					</div>
			<?php
					$listaModulos = $this->session->userdata("modulos");
					foreach($listaModulos as $row): ?>
					<div class="col-sm-6 col-md-3 dashboard__card">
						<a href="<?=base_url()?><?=$row->url?>" class="card_button">
							<div class="iq-card">
							<div class="iq-card-body-elements">
								<div style="margin-top: 15px;" class="doc-profile">
									<img class="img-fluid avatar-80" src="<?=base_url()?>public/template/images/principal/<?=$row->icono?>" alt="<?=$row->url?>">
								</div>
								<div class="dashboard__title">
									<h6 style="color: white;"> <?=$row->descripcion?></h6>
								</div>
							</div>
							</div>
						</a>
					</div>
			<?php 
					endforeach;
				}elseif(isset($eventos)){
			?>
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

								<div class="table-responsive">
								   <table id="tablaEvento" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0" style="width:100%">
								   </table>
								</div>

							</div>
						</div>
					</div>
				</div>
				<? } ?>