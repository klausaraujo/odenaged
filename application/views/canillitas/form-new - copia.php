<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=TITULO_PRINCIPAL?></title>
      <meta name="author" content="<?=AUTOR?>">
      <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
      <link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
	  <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">
	  <style>                        
			 input[type=number]::-webkit-inner-spin-button, 
			 input[type=number]::-webkit-outer-spin-button { 
				   -webkit-appearance: none; 
				   margin: 0; 
	         }
	        input[type=number] { -moz-appearance:textfield; }
	    .form-group {display: flex;align-items: center;}
		.modal-lg {max-width: 87% !important;}
		.modal-body {font-size:13px;}
	  </style>
	  <style>
	
   </style>
   </head>
   <body>
      <!--<div id="loading">
         <div id="loading-center">
         </div>
      </div>-->
      <div class="wrapper">
      <?php $this->load->view("inc/nav-template"); ?>
         <div id="content-page" class="content-page">
            <?php $this->load->view("inc/nav-top-template"); ?>
            <div class="container-fluid">
				<form id="formCanillita" name="formCanillita" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
					<div id="message" class="col-xs-12"></div>
					<div class="row">                 
						<div class="col-sm-12">
							<div class="iq-card">
								<div class="iq-card-header d-flex justify-content-between">
									<div class="iq-header-title">
										<h4 class="card-title">Datos Personales</h4>
									</div>
								</div>
								<div class="iq-card-body">
									  <div class="form-group row mt-0">
										 <div class="add-img-user profile-img-edit col-sm-2">
										 <input type="hidden" name="foto_dni_str" id="foto_dni_str" value="">
										 <img class="profile-pic img-fluid" id="blah" src="<?=base_url()?>public/images/camera.png" alt="profile-pic">
											<div class="p-image mt-0">
											   <input class="file-upload" type="file" accept="image/*">
											</div>
											<div class="custom-file">
												<input type="file" id="file" name="file" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
												<label class="custom-file-label" for="file">Escoger Imagen</label>
											</div>
										 </div>
										 <!--<div class="img-extension mt-3">
										 </div>-->
									  </div>
									  <!--<div class="form-group">
									  <label for="Tipo_Documento_Codigo">Tipo Documento Identidad:</label>
									  <select class="form-control" name="Tipo_Documento_Codigo" id="Tipo_Documento_Codigo">
														<option value="1">DNI</option>
											<option value="3">CARNET EXTRANJERIA</option>
										 </select>
									  </div>-->
									  <? 
										$dtz = new DateTimeZone("America/Lima");
										$dt = new DateTime("now", $dtz);
										$fechaActual = $dt->format("Y-m-d");
										//$fechaActual = str_replace("-","/",$fechaActual);
										//echo $fechaActual;
									?>
										<br><hr class="mt-0">
									  <div class="form-group row">
											<label for="documento_numero" class="col-sm-3">Documento Identidad:</label>
											<input type="number" class="form-control col-sm-5" id="documento_numero" name="documento_numero" placeholder="Numero de identidad">
											<span class="input-group-btn col-sm-2">
												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
											</span>
									  </div>
									  <div class="form-group row">
											<label for="nombres" class="col-sm-3">Nombres:</label>
											<input type="text" class="form-control col-sm-7" id="nombres" name="nombres" placeholder="Nombres">
									  </div>
									  <div class="form-group row">
											<label for="apellidos" class="col-sm-3">Apellidos:</label>
											<input type="text" class="form-control col-sm-7" id="apellidos" name="apellidos" placeholder="Apellidos">
									  </div>
									  <div class="form-group row">
											<label for="FechaNac" class="col-sm-3">Fecha Nac.:</label>
											<input type="date" class="form-control col-sm-2" name="FechaNac" id="FechaNac" value="<?=$fechaActual?>"/>
											<span class="col-sm-1"></span>
											<label for="genero" class="col-sm-2">G&eacute;nero:</label>
											<select class="form-control col-sm-2" name="genero" id="genero">
												<option value="">-- Seleccione --</option>
												<option value="1">Masculino</option>
												<option value="2">Femenino</option>
												<option value="3">Otros</option>
											</select>
									  </div>
									  <div class="form-group row">
											<label for="edoCivil" class="col-sm-3">Edo. Civil:</label>
											<select class="form-control col-sm-2" name="edoCivil" id="edoCivil">
												<option value="">-- Seleccione --</option>
												<option value="1">Soltero</option>
												<option value="2">Casado</option>
												<option value="3">Viudo</option>
												<option value="4">Concubino</option>
												<option value="5">Otros</option>
											</select>
											<span class="col-sm-1"></span>
											<label for="condic" class="col-sm-2">Condici&oacute;n:</label>
											<select class="form-control col-sm-2" name="condic" id="condic">
												<option value="">-- Seleccione --</option>
											</select>
									  </div>
									  <div class="form-group row">
											<label for="domicilio" class="col-sm-3">Direcci&oacute;n:</label>
											<textarea type="text" class="form-control col-sm-7" id="domicilio" name="domicilio" placeholder="Direcci&oacute;n"></textarea>
									  </div>
									  <div class="form-group row">
											<label for="tlf1" class="col-sm-3">Tlfno. 01:</label>
											<input type="number" class="form-control col-sm-2" id="tlf1" name="tlf1" placeholder="Tel&eacute;fono 01">
											<span class="col-sm-1"></span>
											<label for="tlf2" class="col-sm-2">Tlfno. 02:</label>
											<input type="number" class="form-control col-sm-2" id="tlf2" name="tlf2" placeholder="Tel&eacute;fono 02">
									  </div>
									  <div class="form-group row">
											<label for="correo" class="col-sm-3">Correo:</label>
											<input type="text" class="form-control col-sm-7" id="correo" name="correo" placeholder="Correo">
									  </div>
									  <div class="form-group row">
											<label for="observacion" class="col-sm-3">Observaciones:</label>
											<input type="text" class="form-control col-sm-7" id="observacion" name="observacion" placeholder="Observaciones">
									  </div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-2 ml-sm-auto">
							<button type="submit" class="btn btn-primary" id="enviarCanillita">Guardar registro</button>
						</div>
						<div class="col-sm-2 mr-sm-auto">
							<a href="#" class="btn btn-primary col-sm-10" id="btnCancelar" name="btnCancelar" role="button" aria-pressed="true">Cancelar</a>
						</div>    
					</div>
					<div class="col-md-12 text-center" id="cargando"></div>
				</form>
			</div>
			<?php $this->load->view("inc/footer-template"); ?>
		</div>
      </div>
      <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
      <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
      <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
      <script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
      <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/wow.min.js"></script>
      <script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
      <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
      <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
      <script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
      <script src="<?=base_url()?>public/template/js/lottie.js"></script>
      <script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
      <script src="<?=base_url()?>public/template/js/custom.js"></script>
	  <script src="<?=base_url()?>public/template/js/jquery.validate.min.js"></script>
	  <script src="<?=base_url()?>public/template/js/canillitas/main.js"></script>
      <script>
		//const URI_MAP = "<?=base_url()?>";
		const canDelete = "1";
		const canEdit = "1";
		const canTracking = "1";
		const canHistory = "1";
		var URI = "<?=base_url()?>"; 
		canillitas(URI);
	  </script>
   </body>
</html>