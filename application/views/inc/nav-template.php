	<div class="iq-sidebar bg-sirese">
		<div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="#"><span>ODENAGED</span></a>
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
                    <li class="<?php echo $this->uri->segment(1) === '' ? 'active main-active': ''; ?>" >
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
						$submenu = $this->session->userdata("submenu");
						
						$idModulo = "";
						foreach($lMod as $row): if($row->url === $this->uri->segment(1)) $idModulo = $row->idmodulo; endforeach;
						
						/*$var = new \stdClass;
						$var->nombre = 'nombre';
						$var->apellido = 'apellido';
						echo var_dump($var);
						echo var_dump($lMenu);
						echo var_dump($submenu);*/
						
						if(!empty($lMenu)){
							foreach($lMenu as $row):
								if($row['idmodulo'] === $idModulo){
						?>
                            <li id="menu<?=$row['idmenu']?>">
                        <?php if($row['nivel'] === '0'){ ?>
								<?php if($row['activo'] === '1'){ ?>
								<a href="#" rel="<?=$row['url']?>" id="linkAjax">
                                    <div class="pull-left">
                                        <i class="<?=$row['icono']?> mr-20"></i>
                                        <span class="right-nav-text"><?=$row['descripcion']?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
								<?php }else{ ?>	
								<span class="disable">
									<div class="pull-left">
                                        <i class="<?=$row['icono']?> mr-20"></i>
                                        <span class="right-nav-text"><?=$row['descripcion']?></span>
                                    </div>
                                    <div class="clearfix"></div>
								</span>
								<?php }							
							}else{ ?>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#sub_<?=$row['idmenu']?>">
                                    <div class="pull-left">
                                        <i class="<?=$row['icono']?>  mr-20"></i>
                                        <span class="right-nav-text"><?=$row['descripcion']?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
								<?if($row['nivel'] === '1'){?>
									<div class="">
										<ul id="sub_<?=$row["idmenu"]?>" class="collapse collapse-level-1 pb-1 pl-1">
										<?php foreach($submenu as $srow): ?>
											<li>
												<a href="<?=base_url()?><?=$srow['url']?>"><i class="<?=$srow['icono']?>  mr-20"></i><?=$srow['descripcion']?></a>
											</li>
										<?php endforeach; ?> 
										</ul>
									</div>
								<?}?>
                            <?php } ?>
							</li>
                        <?php
								}
							endforeach;
						}
					}
				  ?>
				</ul>
			</nav>
            <div class="p-3"></div>
        </div>
    </div>