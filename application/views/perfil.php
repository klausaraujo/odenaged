<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?=TITULO_PRINCIPAL?></title>
   <meta name="author" content="<?=AUTOR?>">

   <!-- Favicon -->
   <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
   <link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
   <!-- Data table CSS -->
   <!-- <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css"> -->

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
   <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" />

   <link rel="stylesheet" href="<?=base_url()?>public/css/dropzone.css" />

   <?php
      // $titulo = "Ingreso de Data al Tablero de Control de Gesti&oacute;n";
      $titulo = "Tablero de Control de Gesti&oacute;n - DIGERD";
      //$botonCrear = "Registro y Carga de Data en el Tablero de Control";
      ?>
   <style>
      #canvas .circle {
         display: inline-block;
         margin: 1em;
      }

      .circles-decimals {
         font-size: .4em;
      }
   </style>
   <style>
      .half-rule {
         margin-left: 0;
         text-align: left;
         width: 50%;
      }

      .statis {
         color: #EEE;
         margin-top: 15px;
      }

      h3 {
         color: #EEE;
         font-size: 20px;
      }

      .statis .box {
         position: relative;
         padding: 15px;
         overflow: hidden;
         border-radius: 3px;
         margin-bottom: 25px;
      }

      .statis .box h3:after {
         content: "";
         height: 2px;
         width: 70%;
         margin: auto;
         background-color: rgba(255, 255, 255, 0.12);
         display: block;
         margin-top: 10px;
      }

      .statis .box i {
         position: absolute;
         height: 70px;
         width: 70px;
         font-size: 22px;
         padding: 15px;
         top: -25px;
         left: -25px;
         background-color: rgba(255, 255, 255, 0.15);
         line-height: 60px;
         text-align: right;
         border-radius: 50%;
      }

      .warning {
         background-color: #f0ad4e
      }

      .danger {
         background-color: #d9534f
      }

      .success {
         background-color: #5cb85c
      }

      .inf {
         background-color: #5bc0de
      }
   </style>
   <link rel="stylesheet" href="<?=base_url()?>public/css/perfil.css" />

</head>

<body>

   <?php
    
    $idusuario = $this->session->userdata("idusuario");
    $imagen = $this->session->userdata("avatar");
    
    ?>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">

      <!-- Sidebar  -->
      <?php $this->load->view("inc/nav-template");?>

      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <!-- TOP Nav Bar -->
         <?php $this->load->view("inc/nav-top-template");?>
         <!-- TOP Nav Bar END -->
         <div class="container-fluid">
         
         <?php $message = $this->session->flashdata('mensajeSuccess'); ?>

         <div id="pageMessages">
            
         </div>
         <!--<div class="hide alert alert-success" style="display: none"><span></span></div>
         <div class="hide alert alert-danger" style="display: none"><span></span></div>-->

            <div class="row">
               <div class="col-lg-12">
                  <?php //echo "<pre>"; echo $lista; echo '<br>'.$pacientes;//echo "<pre>"; echo var_dump($lista); ?>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="iq-card">
                     <div class="iq-card-body p-0">
                        <div class="iq-edit-list">
                           <ul class="iq-edit-profile d-flex nav nav-pills">
                              <li class="col-md-3 p-0">
                                 <a class="nav-link active" data-toggle="pill" href="#chang-pwd">
                                    Modificar Perfil
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="iq-edit-list-data">
                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="chang-pwd" role="tabpanel">

                           <div class="iq-card-body">
                              <div class="form-group row align-items-center">
                                 <div class="col-md-12">
                                    <div class="profile-img-edit">
                                       <?php if(strlen($imagen)>0){ ?>
                                       <img class="profile-pic" src="<?=base_url()?>public/images/perfil/<?=$imagen?>"
                                          alt="profile-pic">
                                       <?php }else{ ?>
                                       <img class="profile-pic" src="<?=base_url()?>public/images/perfil/user.jpg"
                                          alt="profile-pic">
                                       <?php } ?>

                                       <div class="p-image">
                                          <i class="ri-pencil-line upload-button"></i>
                                          <input class="file-upload" type="file" accept="image/*" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Cambiar Contraseña</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form id="formPassword" name="formPassword" action="<?=base_url()?>usuario/password" method="POST">
                                    <input type="hidden" name="Codigo_Usuario" value="" readonly />
                                    <div class="form-group">
                                       <label class="">Contraseña Actual:</label>
                                       <input type="password" class="form-control" id="old_password" name="old_password"
                                          autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                       <label class="">Nueva Contraseña:</label>
                                       <input type="password" class="form-control" id="password" name="password"
                                          autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                       <label class="">Repetir Contraseña:</label>
                                       <input type="password" class="form-control" id="re_password" name="re_password"
                                          autocomplete="off">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Realizar Cambio</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


         </div>


         <!-- Footer -->
         <?php $this->load->view("inc/footer-template");?>
         <!-- Footer END -->
         <script src="<?=base_url()?>public/js/moment.min.js"></script>
         <script src="<?=base_url()?>public/js/locale.es.js"></script>
      </div>
   </div>

   <?php $this->load->view("inc/resource-template");?>
   
   <script>var URI = "<?=base_url()?>";</script>   

   <script src="<?=base_url()?>public/js/perfil.js?v=<?=date(" his")?>"></script>
</body>

</html>