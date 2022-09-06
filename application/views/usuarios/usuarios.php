<?
$sombrabtn = 'box-shadow: 2px 2px 0px 0px rgba(142, 173, 255,5)';
$btn_permisos = '<button class="border border-primary btn-sm actionPermisos px-1 py-0" title="Asignar Permisos" data-toggle="modal"
				style="'.$sombrabtn.'" data-target="#permisosModal"><i class="fa fa-lock" aria-hidden="true"></i></button>';
?>	

	<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="iq-card px-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title tituloUsers"><h4>Gesti&oacute;n de Usuarios</h4></div>
						</div>
						<div class="iq-card-body pt-1">
							<div class="row justify-content-center py-2 tablaUsuario">
								<?if($this->session->flashdata('claseMsg')){?><div class="col-sm-4 border border-<?=$this->session->flashdata('claseMsg'); ?> rounded alert alert-dismissible fade show py-0 
											text-center msg text-<?=$this->session->flashdata('claseMsg'); ?>" role="alert">
									<strong class="mx-auto text-center"><?=$this->session->flashdata('flashSuccess'); ?></strong>
									<button type="button" class="close py-0" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true" class="text-<?=$this->session->flashdata('claseMsg'); ?>">&times;</span>
									</button>
								</div><?}?>
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="tablaUsuarios" class="table dt-responsive table-bordered display nowrap table-hover px-0 mx-auto" style="100%">
											<thead class="text-center"><tr><th>Acciones</th><th style="visibility:collapse; display:none;">Id</th><th>DNI</th><th>Avatar</th><th>Apellidos</th>
													<th>Nombres</th><th>Usuario</th><th>Perfil</th><th>Estado</th></tr>
											</thead>
											<tbody>
											<? 	foreach($data as $row): ?>
											<tr>
												<td class="text-center"><?=$btn_permisos?></td>
												<td style="visibility:collapse; display:none;"><?=$row->idusuario?></td>
												<td><?=$row->dni?></td>
												<td><img style="display:block;margin:auto" width="36px" src="<?=base_url()?>public/images/perfil_usuarios/<?=$row->avatar?>"></td>
												<td><?=$row->apellidos?></td>
												<td><?=$row->nombres?></td>
												<td><?=$row->usuario?></td>
												<td><?=$row->perfil?></td>
												<td><?=($row->activo === '1')? 'ACTIVO' : 'INACTIVO'?></td>
											</tr>
											<?	endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row nuevoAjax" style="display:none">
								<form id="formUsuarios" name="formUsuarios" class="col-12" method="POST" action="<?=base_url()?>regusuario" autocomplete="off" enctype="multipart/form-data">
									<div >
										<div class="row mx-auto">
											<div class="col-md-4">
												<div class="form-group">
													<label class="">Usuario</label>
													<input type="text" class="form-control text-lowercase" name="usuario" autocomplete="off"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="">DNI</label>
													<div class="input-group group-dni">
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
													<select name="codPerfil" class="form-control">
														<option value="">--Seleccione--</option>
											<?		foreach($perfil as $row):	?>
														<option value="<?=$row->idperfil;?>" ><?=$row->perfil;?></option>
											<?		endforeach;	?>
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
            <div class="modal-dialog modal-lg" role="document">
				<input type="hidden" id="hIdUsuario" value="" />
                <div class="modal-content">
                    <div class="modal-header">
						<h6 class="modal-title">Otorgar Permisos</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
						<input type="hidden" id="idusuarioPermiso" />
						<div class="row col-sm-12">
							<div class="container jtree">
								<div class="row">
									<nav>
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
											<a class="nav-item nav-link active" id="nav-regiones-tab" data-toggle="tab" href="#nav-regiones" role="tab" aria-controls="nav-regiones" aria-selected="true">Asignar Regiones</a>
											<!--<a class="nav-item nav-link font-sirese" id="nav-acciones-tab" data-toggle="tab" href="#nav-acciones" role="tab" aria-controls="nav-acciones" aria-selected="false">Registro de Acciones</a>
											<a class="nav-item nav-link font-sirese" id="nav-ie-tab" data-toggle="tab" href="#nav-ie" role="tab" aria-controls="nav-ie" aria-selected="false">Registro de IE Afectadas</a>
											<a class="nav-item nav-link font-sirese" id="nav-fotos-tab" data-toggle="tab" href="#nav-fotos" role="tab" aria-controls="nav-fotos" aria-selected="false">Galer&iacute;a de fotos</a>-->
										</div>
									</nav>
								</div>
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active py-4" id="nav-regiones" role="tabpanel" aria-labelledby="nav-regiones-tab">
										<div id="jstree" class="jstreecont col-sm-9"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="row col-sm-12">
								<button class="btn btn-sirese mx-3" id="btnPermisos">Guardar</button>
								<button class="btn btn-sirese" id="btnCancelPer" name="btnCancelPer" data-dismiss="modal" aria-label="Close">Retornar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>