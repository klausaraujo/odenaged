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
					$ubigeo = $this->session->userdata('ubigeo');					
				?>
					<div class="iq-card px-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title tituloUsers"><h4>Gesti&oacute;n de Usuarios</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="row justify-content-center py-2 tablaUsuario">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="tablaUsuarios" class="table table-striped dt-responsive table-bordered display nowrap table-hover px-0 mx-auto" style="100%"></table>
									</div>
								</div>
							</div>
							<div class="row nuevoAjax" style="display:none">
								<form id="formUsuarios" name="formUsuarios" class="col-12" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
									<div >
										<div class="row mx-auto">
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Usuario</label>
													<input type="text" class="form-control text-lowercase" name="Usuario" autocomplete="off"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="">DNI</label>
													<div class="input-group">
														<input type="text" class="form-control" maxlength="8" minlength="8" name="dni" id="dni" autocomplete="off">
														<span class="input-group-btn col-sm-2">
															<button type="button" class="btn btn-info btn_curl"><i class="fa fa-search" aria-hidden="true"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="row mx-auto">
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Apellidos</label>
													<input type="text" class="form-control text-uppercase" name="apellidos" id="apellidos" autocomplete="off"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Nombres</label>
													<input type="text" class="form-control text-uppercase" name="nombres" id="nombres" autocomplete="off"/>
												</div>
											</div>
										</div>
										<div class="row mx-auto">
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Perfil</label>
													<select name="Codigo_Perfil" class="form-control">
														<option value="">--Seleccione--</option>
											<?		foreach($perfil as $row):	?>
														<option value="<?=$row->idperfil;?>" ><?=$row->perfil;?></option>
											<?		endforeach;	?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Regi&oacute;n</label>
													<select name="region" class="form-control region">
											<?php	
												if(!empty($ubigeo->dptos)){
													foreach($ubigeo->dptos as $row):	?>
														<option value="<?=$row->cod_dep;?>" <?=($row->cod_dep === $ubigeo->cod_dep)? 'selected': '';?> ><?=$row->departamento;?></option>
											<?		endforeach;
												}else{	?>
														<option value="">-- Seleccione --</option>
											<? 	}	?>
													</select>
												</div>
											</div>
										</div>
										<div class="row mx-auto">
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Provincia</label>
													<select name="provincia" id="provincia" class="form-control provincia">
											<?php
												if(!empty($ubigeo->prov)){
													foreach($ubigeo->prov as $row):	?>
														<option value="<?=$row->cod_pro;?>" <?=($row->cod_pro === $ubigeo->cod_pro)? 'selected': '';?> ><?=$row->provincia;?></option>
											<?		endforeach;
												}else{	?>
												<option value="">-- Seleccione --</option>
											<? 	}	?>
													</select>
												</div>
											</div>
										</div>
										<div class="row mx-auto py-2">
											<div class="col-md-8">
												<div class="row pull-right">
													<button type="submit" class="btn btn-sirese mx-3" id="btnEnviar">Guardar registro</button>
													<button class="btn btn-sirese" id="btnCancelar" name="btnCancelar">Cancelar</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
            <div class="modal-dialog modal-xl" role="document">
				<input type="hidden" id="hIdUsuario" value="" />
                <div class="modal-content">
                    <div class="modal-header">
						<h5 class="modal-title">Otorgar Permisos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
						<div class="row col-sm-12">
							<div class="container">
								<div class="row permUsuario">
									<div class="col-sm-4 col-xs-12">
										<h3>Permisos Registro de Usuarios</h3>
										<?php /*foreach($permisos->result() as $row):
												if($row->tipo=="1" and $row->idmodulo=="6"){ ?>
										<div class="col-xs-12">
											<div class="checkbox checkbox-primary">
											<input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
												value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
										</div>
										<?php } endforeach; */?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>