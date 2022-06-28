<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <div class="iq-sidebar-logo">
         <div class="top-logo">
            <a href="index.html" class="logo">
            <img src="<?=base_url()?>public/template/images/logo.png" class="img-fluid" alt="">
            <span>XRay</span>
            </a>
         </div>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light p-0">

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <i class="ri-menu-3-line"></i>
         </button>
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="ri-more-fill"></i></div>
               <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
            </div>
         </div>
         <div class="collapse navbar-collapse" id="navbarSupportedContent" aria-hidden="true">
            <ul class="navbar-nav ml-auto navbar-list">
               <li class="nav-item">
                  
               </li>
               <li class="nav-item iq-full-screen">
                  <a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a>
               </li>
                            
               <li class="nav-item">
                           <a class="search-toggle iq-waves-effect language-title" href="https://www.facebook.com/digerd.minsa/" target="_blank"><img src="<?=base_url()?>public/images/flag-01.png" alt="img-flaf" class="img-fluid mr-1" style="height: 30px; width: 30px;" />  </a>
                         
               </li>
               <li class="nav-item">
                           <a class="search-toggle iq-waves-effect language-title" href="https://twitter.com/digerd_minsa" target="_blank"><img src="<?=base_url()?>public/images/flag-02.png" alt="img-flaf" class="img-fluid mr-1" style="height: 30px; width: 30px;" />  </a>
                         
               </li>

            </ul>
         </div>
         <ul class="navbar-list">
               <?php 

               $imagen = $this->session->userdata("avatar"); ?>
            <li>
               <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                  <img src="<?=base_url()?>public/images/perfil/<?=$imagen?>" class="img-fluid rounded mr-3" alt="user">
                  <div class="caption">
                     <h6 class="mb-0 line-height font-size-14"><?=$this->session->userdata("nombre")?> <?=$this->session->userdata("apellido")?></h6>
                     <span class="font-size-12">Disponible</span>
                  </div>
               </a>
               
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card shadow-none m-0">
                     <div class="iq-card-body p-0 ">
                        <div class="bg-primary p-3">
                           <h5 class="mb-0 text-white line-height">Hola: <?=$this->session->userdata("nombre")?> <?=$this->session->userdata("apellido")?></h5>
                           <span class="text-white font-size-12">Disponible</span>
                        </div>
                        <a href="<?=base_url()?>usuario/perfil" class="iq-sub-card iq-bg-primary-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-primary">
                                 <i class="ri-file-user-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 ">Mi Perfil de Usuario</h6>
                                 <p class="mb-0 font-size-12">Cambiar mi Clave y/o foto del perfil.</p>
                              </div>
                           </div>
                        </a>
                        
                        <div class="d-inline-block w-100 text-center p-3">
                           <a class="bg-primary iq-sign-btn" href="<?=base_url()?>login/logout" role="button">Cerrar sesión<i class="ri-login-box-line ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
   </div>

   <script type="text/javascript">
         
   </script>