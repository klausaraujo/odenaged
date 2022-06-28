<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Caja De Protección Y Asistencia Social Ley 10674</title>
      <link rel="shortcut icon" type="image/png" href="<?=base_url()?>public/images/favicon.jpg"/>
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
   </head>
   <body style="background-color:#244B5A;">
      <!--<div id="loading">
         <div id="loading-center">
		</div>
      </div>-->
        <section class="sign-in-page" style="margin:-50px">
            <div class="container sign-in-page-bg mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-md-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-3" href="#"><img style="width:700px; height:250px" src="<?php echo base_url('public/images/logo-white.png'); ?>" alt="Minsa" class="img-fluid"  ></a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/1.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 01</h4>
                                    <p>Descripcion 01</p>
                                </div>
                                <div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/2.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 02</h4>
                                    <p>Descripcion 02</p>
                                </div>
                                <div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/3.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 03</h4>
                                    <p>Descripcion 03</p>
								</div>
								<div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/4.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 04</h4>
                                    <p>Descripcion 04</p>
								</div>
								<div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/5.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 05</h4>
                                    <p>Descripcion 05</p>
                                </div>
                                <div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/6.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 06</h4>
                                    <p>Descripcion 06</p>
                                </div>
                                <div class="item">
                                    <img src="<?=base_url()?>public/template/images/login/7.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">TITULO 07</h4>
                                    <p>Descripcion 07</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Iniciar Sesión</h1>
                            <p>Ingrese su Usuario y Clave para ingresar al Tablero de Control</p>
                            <form class="mt-4" action="<?=base_url()?>doLogin" method="post" id="login-form">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control mb-0" id="usuario" name="usuario" placeholder="Ingrese su usuario" 
									value="<?=($this->session->userdata('usuarioError')!=null)?$this->session->userdata('usuarioError'):""?>" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <label for="key">Contraseña</label>
                                    <input type="password" class="form-control mb-0" name="key" id="key" placeholder="Ingrese su contraseña" autocomplete="new-password" >
                                </div>
                                <div class="d-inline-block w-100">
                                    <button type="submit" class="btn btn-primary float-right">Iniciar Sesi&oacute;n </button>
									<?php
									if($this->session->userdata('error_session')!=null) echo "<div class='text-center'>".$this->session->userdata('error_session')."</div>";
									?>
                                </div>
                                <div class="sign-info">
								Acceso directo a nuestras Redes Sociales
                                    <ul class="iq-social-media">
									    <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                            </form>
							<?php $message = $this->session->flashdata('loginError'); ?>
							<?php if($message){ ?>
								<p style="color:#dc8b89;margin:auto;text-align:center;"><?= $message ?></p>
							<?php } ?>
							<br/>
							<br/><br/>
							<div class="media" style="width: 100%;">
								<img class="align-self-end  " src="<?=base_url()?>public/images/logo.jpg" 
								style="width: auto;height: 70px;margin: 0 auto;" />
							</div>
 
                        </div>
												
                    </div>
                </div>
            </div>
        </section>
      <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
      <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
      <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
      <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
      <<script src="<?=base_url()?>public/template/js/wow.min.js"></script>
      <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
      <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
      <script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
      <script src="<?=base_url()?>public/template/js/custom.js"></script>
	  <!--<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
	  <script src="<?=base_url()?>public/js/login.js?v=<?=date("is")?>"></script>-->
   </body>
</html>