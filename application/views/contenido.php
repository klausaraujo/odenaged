	    <?php 
			$idusuario = $this->session->userdata("idusuario");
			$imagen = $this->session->userdata("avatar");
			$message = $this->session->flashdata('mensajeSuccess');
		?>
	<div class="container-fluid">
        <div id="pageMessages"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
					<div class="iq-card-body p-0">
                        <div class="iq-edit-list">
							<ul class="iq-edit-profile d-flex nav nav-pills">
								<li class="col-md-3 p-0">
									<a class="nav-link active bg-sirese" data-toggle="pill" href="#chang-pwd">Modificar Perfil</a>
								</li>
							</ul>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-md-12 justify-content-center align-items-center text-center"><div class="alert-success col-md-6 text-center"><span></span></div></div>
			<div class="col-md-12 justify-content-center align-items-center text-center"><div class="alert-danger col-md-6"><span></span></div></div>
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
						<div class="tab-pane fade active show" id="chang-pwd" role="tabpanel">

							<div class="iq-card-body">
								<div class="form-group row align-items-center">
									<div class="col-md-12">
										<div class="profile-img-edit">
                                       <?php if(strlen($imagen)>0){ ?>
											<img class="profile-pic" src="<?=base_url()?>public/template/images/perfil/<?=$imagen?>" alt="profile-pic">
                                       <?php }else{ ?>
											<img class="profile-pic" src="<?=base_url()?>public/template/images/perfil/user.jpg" alt="profile-pic">
                                       <?php } ?>

											<div class="p-image bg-sirese">
												<i class="ri-pencil-line upload-button bg-sirese"></i>
												<input class="file-upload" type="file" accept="image/*" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="iq-card">
								<div class="iq-card-header d-flex justify-content-between">
									<div class="iq-header-title"><h4 class="card-title">Cambiar Contraseña</h4></div>
								</div>
								<div class="iq-card-body">
									<form id="formPassword" name="formPassword" action="pass" method="POST">
										<input type="hidden" name="Codigo_Usuario" value="" readonly />
										<div class="form-group">
											<label class="">Contraseña Actual:</label>
											<input type="password" class="form-control" id="old_password" name="old_password" autocomplete="off">
										</div>
										<div class="form-group">
											<label class="">Nueva Contraseña:</label>
											<input type="password" class="form-control" id="password" name="password" autocomplete="off">
										</div>
										<div class="form-group">
											<label class="">Repetir Contraseña:</label>
											<input type="password" class="form-control" id="re_password" name="re_password" autocomplete="off">
										</div>
										<button type="submit" class="btn btn-sirese mr-2">Realizar Cambio</button>
									</form>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>