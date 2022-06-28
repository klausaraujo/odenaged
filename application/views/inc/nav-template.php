		<div class="iq-sidebar">
            <div class="#">
              
               <span>CPAS </span>
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
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Panel de navegación  </span></li>
                                
                     <li class="<?php echo $this->uri->segment(1)=="" ? "active main-active": ""; ?>" >
                        <a href="<?=base_url()?>" class="iq-waves-effect "><i class="ri-home-8-fill"></i><span>Inicio</span></a>
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
						$i = 0;
						foreach($lMod as $row):
							if($row->url == $this->uri->segment(1))
								$idModulo = $row->idmodulo;
						endforeach;
						
                        if($idModulo =="6" and $idusuario =='01'){ ?>
                        <li id="menu3">
                        <a href="<?=base_url()?>/usuarios/usuario"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Usuarios</span></div><div class="clearfix"></div></a>
                        </li>
                        <?php } ?>

                    <?php if(!empty($lMenu[$idModulo])){ ?>
                        <?php foreach($lMenu[$idModulo] as $row): ?>
                            <li id="menu<?=$row["idmenu"]?>">
                            <?php if($row["nivel"]==0){ ?>
                                <a href="#" rel="<?=$row['url']?>" id="linkAjax">
                                    <div class="pull-left">
                                        <i class="<?=$row["icono"]?> mr-20"></i>
                                        <span class="right-nav-text"><?=$row["descripcion"]?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            <?php }else{ ?>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#sub_<?=$row["idmenu"]?>">
                                    <div class="pull-left">
                                        <i class="<?=$row["icono"]?>  mr-20"></i>
                                        <span class="right-nav-text"><?=$row["descripcion"]?></span>
                                    </div>
                                    <div class="pull-right">
                                       
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            <?php } ?>

                            <?php if($row["nivel"]==1){ ?>
                                <ul id="sub_<?=$row["idmenu"]?>" class="collapse collapse-level-1">
                                <?php foreach($row["submenu"] as $srow): ?>
                                <li>
                                <a href="<?=base_url()?><?=$srow["url"]?>"><?=$srow["descripcion"]?></a>
                                </li>
                                <?php endforeach; ?> 
                                </ul>
                            <?php } ?>

                            </li>
                        <?php endforeach; ?> 
                     <?php }  ?>
                     <?php }?>

                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>