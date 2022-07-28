		<div class="iq-sidebar bg-sirese">
		<div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="#">
              
               <span>ODENAGED</span>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-more-fill"></i></div>
                           <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Panel de Navegación</span></li>
                                
                     <li class="<?php echo $this->uri->segment(1)=="" ? "active main-active": ""; ?>" >
                        <a href="<?=base_url()?>" class="iq-waves-effect"><i class="ri-home-8-fill"></i><span>Inicio</span></a>
                     </li>

                    <?php 
                        if($this->uri->segment(1)=="") {
									$listaModulos = $this->session->userdata("modulos");
									foreach($listaModulos as $row): ?>
                           <li class="<?php echo $this->uri->segment(1)==$row->url ? "active main-active": ""; ?>">
                           <?php  if($row->activo>0){ ?>
                             
                              <a href="<?=base_url()?><?=$row->url?>" class="iq-waves-effect">
                                 <i class="<?=$row->mini?>"></i>
                                 <span><?=$row->menu?></span>
                              </a>
                           <?php 
                           }else{
                           ?>
                              <a href="javascript:;" class="disabled" style="color: #CCC!important">
                              <div class="pull-left disabled"><i class="<?=$row->mini?> mr-20"></i>
                              <span class="right-nav-text"></span></div><?=$row->menu?></a>
                           <?php 
                           }
                           ?>
                           </li>
                     <?php endforeach;
					 
					 } else {
						
						$lMenu = $this->session->userdata("menu");
						$lMod = $this->session->userdata("modulos");
						$idusuario = $this->session->userdata("idusuario");
						$idModulo = "";
						/*foreach($lMod as $fil):
							echo $fil->url.'<br>'.$this->uri->segment(1);
						endforeach;*/
						$i = 0;
						/*foreach($lMod as $row):
							if($row->url == $this->uri->segment(1))
								$idModulo = $row->idmodulo;
						endforeach;
						foreach($lMenu as $row=>$value):
							echo var_dump($value[$i]);
							$i++;
						endforeach;
						$i=0;*/
						
                        if($idModulo =="3" and $idusuario =='1'){ ?>
                        <li id="menu3">
                        <a href="<?=base_url()?>/usuarios/usuario"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Usuarios</span></div><div class="clearfix"></div></a>
                        </li>
                        <?php } ?>
						
                    <?php if(!empty($lMenu)){ ?>
                        <?php foreach($lMenu as $key=>$value): ?>
                            <li id="menu<?=$value[$i]->idmenu?>">
                            <?php if($value[$i]->nivel == 0){ ?>
                                <a href="#" rel="<?=$value[$i]->url?>" id="linkAjax">
                                    <div class="pull-left">
                                        <i class="<?=$value[$i]->icono?> mr-20"></i>
                                        <span class="right-nav-text"><?=$value[$i]->descripcion?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            <?php
							
								}else{ ?>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#sub_<?=$value[$i]->idmenu?>">
                                    <div class="pull-left">
                                        <i class="<?=$value[$i]->icono?>  mr-20"></i>
                                        <span class="right-nav-text"><?=$value[$i]->descripcion?></span>
                                    </div>
                                    <div class="pull-right">
                                       
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            <?php } ?>

                            <?php if($value[$i]->nivel == 1){ }?>
							</li>
                        <?php
							$i++;						
						endforeach; ?> 
                     <?php }
					 
						}
					?>

                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>