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
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"/>

      <link rel="stylesheet" href="<?=base_url()?>public/css/usuarios/main.css?v=<?=date("s")?>" />

	    <?php $titulo = "Gesti&oacute;n de Usuarios";
      $botonCrear = "Registrar Usuario"; ?>

      <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
   </head>
   <body>
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <div class="wrapper">
        <?php $this->load->view("inc/nav-template");?>
         <div id="content-page" class="content-page">
            <?php $this->load->view("inc/nav-top-template");?>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title"><?=$titulo?></h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="row">
                              <div class="col-sm-12">
                                <?php if(validarPermisosOpciones(40,$opciones)){?>
                                  <button type="button" class="btn btn-primary pull-right" id="btnRegistrarModal">
                                    <?=$botonCrear?>
                                  </button>
                                <?php } ?>
                              </div>
                           </div>
                           <div class="table-responsive">
                              <table id="tbListar" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>C&oacute;digo</th>
                                    <th>DNI</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Usuario</th>
                                    <th>Perfil</th>
                                    <th>Regi&oacute;n</th>
                                    <th>Áreas</th>
                                    <th>Clave</th>
                                    <th>A/D</th>
                                    <th>Editar</th>
                                    <th>Permisos</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $numero = 1;
                                    if ($lista->num_rows() > 0) {
                                        foreach ($lista->result() as $row) :
                                            ?>
                                    <tr>
                                    <td align="center"><?=$numero?></td>
                                    <td align="center"><?=$row->Codigo_Usuario?></td>
                                    <td align="center"><?=$row->DNI?></td>
                                    <td align="center"><?=$row->Apellidos?></td>
                                    <td align="center"><?=$row->Nombres?></td>
                                    <td align="center"><?=strtolower($row->Usuario)?></td>
                                    <td align="center"><?=strtoupper($row->Descripcion_Perfil)?></td>
                                    <td align="center"><?=$row->Nombre_Region?></td>
                                    <td align="center">
                                      <?php if(validarPermisosOpciones(41,$opciones)){?>
                                      <?php if($row->Codigo_Perfil=='02' or $row->Codigo_Perfil=='01'){ ?>
                                      <button class="btn btn-info btn-circle areasEdit" title="AREAS" type="button"> <i
                                          class="fa fa-list-ul"></i> </button>
                                      <?php } ?>
                                      <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if(validarPermisosOpciones(42,$opciones)){?>
                                      <button class="btn btn-warning btn-circle passwordEdit" title="PASSWORD"
                                        type="button">
                                        <i class="fa fa-lock"></i>
                                      </button>
                                      <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if(validarPermisosOpciones(43,$opciones)){?>
                                      <?php if($row->Activo=="1"){ ?>
                                      <button class="btn btn-primary btn-circle actionDisable" title="ANULAR"
                                        type="button">
                                        <i class="fa fa-times"></i>
                                      </button>
                                      <?php }else{ ?>
                                      <button class="btn btn-success btn-circle actionEnable" title="ACTIVAR"
                                        type="button">
                                        <i class="fa fa-check"></i>
                                      </button>
                                      <?php } ?>
                                      <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if(validarPermisosOpciones(44,$opciones)){?>
                                      <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                        <i class="fa fa-pencil-square-o"></i>
                                      </button>
                                      <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if(validarPermisosOpciones(45,$opciones)){?>
                                      <button class="btn btn-success btn-circle actionPermisos" title="PERMISOS"
                                        type="button">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                      </button>
                                      <?php } ?>
                                    </td>
                                    <td><?=$row->Codigo_Perfil?></td>
                                    <td><?=$row->Codigo_Region?></td>
                                    <td><?=$row->Anio_Ejecucion?></td>
                                    <td><?=$row->Codigo_Sector?></td>
                                    <td><?=$row->Codigo_Pliego?></td>
                                    <td><?=$row->Codigo_Ejecutora?></td>
                                    <td><?=$row->Codigo_Centro_Costos?></td>
                                    <td><?=$row->Codigo_Sub_Centro_Costos?></td>
                                  </tr>
                                  <?php
                                    $numero ++;
                                    endforeach
                                    ; } ?>
                                </tbody>
                              </table>
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
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row col-sm-12">
                      <div class="container">
                          <div class="row">
                              <div class="col-sm-12">
                                <ul class="nav nav-tabs" role="tablist">
                                  <li class="nav-item"><a aria-selected="true" class="nav-link active" role="tab" data-toggle="tab" href="#home">SIREED</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu1">RENARHED</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu2">Tablero de Control</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu6">Ejecuci&oacute;n de Planes</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu4">Oferta Movil</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu5">Emergencias Sanitarias</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu7">Sobredemanda</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu8">Usuarios</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu9">Contingencias</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu10">Inventarios</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu11">COVID-19</a></li>
                                  <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#menu12">Farmacia</a></li>
                                </ul>

                                <div class="tab-content mt-3">
                                  <div id="home" class="tab-pane fade in active show">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="row">

                                      <div class="col-sm-4 col-xs-12">
                                        <h3>Men&uacute; Principal</h3>
                                        <?php foreach($eventos as $row): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                            <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                              value="<?=$row->idmenu?>" />
                                            <label for="chkMenu<?=$row->idmenu?>">
                                              <?=$row->descripcion?>
                                            </label>
                                          </div>
                                          <?php if($row->nivel==1){
                                                         foreach($row->subMenu as $rowS): ?>
                                          <div class="col-xs-12">
                                            <div class="checkbox checkbox-primary">
                                              <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                                rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" />
                                              <label for="chkSubMenu<?=$rowS->idmenudetalle?>">
                                                <?=$rowS->descripcion?>
                                              </label>
                                            </div>
                                          </div>
                                          <?php endforeach;
                                                       } ?>
                                        </div>
                                        <?php endforeach; ?>
                                      </div>
                                      <div class="col-sm-4 col-xs-12">

                                        <h3>Permisos Registro de Eventos</h3>
                                        <?php foreach($permisos->result() as $row):
                                                		if($row->tipo=="1" and $row->idmodulo=="1"){ ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                              value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                        </div>
                                        <?php
                                                      }
                                                    endforeach; ?>
                                      </div>

                                      <div class="col-sm-4 col-xs-12">

                                        <h3>Permisos Acciones de Eventos</h3>
                                        <?php foreach($permisos->result() as $row):
                                                		if($row->tipo=="2" and $row->idmodulo=="1"){ ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                              value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                        </div>
                                        <?php
                                                      }
                                                    endforeach; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="menu1" class="tab-pane fade in">
                                  <div class="row">

                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($brigadistas as $row): ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                       foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                                     } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Brigadista</h3>
                                      <?php foreach($permisos->result() as $row):
                                              		if($row->tipo=="1" and $row->idmodulo=="2"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                    }
                                                  endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Acciones de Brigadista</h3>
                                      <?php foreach($permisos->result() as $row):
                                              		if($row->tipo=="2" and $row->idmodulo=="2"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                    }
                                                  endforeach; ?>
                                    </div>
                                  </div>
                                  </div>
                                  <div id="menu2" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                      <div class="col-xs-12">
                                        <h3>Men&uacute; Principal</h3>
                                        <?php foreach($tablero as $row): ?>
                                        <div class="col-xs-12 col-sm-4">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                              value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                          <?php if($row->nivel==1){
                                                   foreach($row->subMenu as $rowS): ?>
                                          <div class="col-xs-12">
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                                rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$rowS->descripcion?></label></div>
                                          </div>
                                          <?php endforeach;
                                                 } ?>
                                        </div>
                                        <?php endforeach; ?>
                                      </div>
                                  </div>
                                  <div id="menu6" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <h3>Men&uacute; Principal</h3>
                                        <?php foreach($planes as $row): ?>
                                        <div class="col-xs-12 col-sm-4">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                              value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                          <?php if($row->nivel==1){
                                                   foreach($row->subMenu as $rowS): ?>
                                          <div class="col-xs-12">
                                            <div class="checkbox checkbox-primary">
                                            <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                                rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                          </div>
                                          <?php endforeach;
                                                 } ?>
                                        </div>
                                        <?php endforeach; ?>
                                      </div>
                                      <br />
                                      <div class="col-sm-4 col-xs-12">
                                        <h3>Permisos Acciones de Planes</h3>
                                        <?php foreach($permisos->result() as $row):
                                            		if($row->tipo=="1" and $row->idmodulo=="4"){ ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                              value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                        </div>
                                        <?php
                                                  }
                                                endforeach; ?>

                                      </div>
                                    </div>
                                  </div>
                                  <div id="menu4" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($ofertamovil as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Oferta Movil</h3>
                                      <?php foreach($permisos->result() as $row):
                                            if($row->tipo=="1" and $row->idmodulo=="10"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                              }
                                            endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu5" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">

                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($emergenciasSanitarias as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Emergencias</h3>
                                      <?php foreach($permisos->result() as $row):
                                            if($row->tipo=="1" and $row->idmodulo=="8"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                              }
                                            endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu7" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($hospitalesSeguros as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Hospitales</h3>
                                      <?php foreach($permisos->result() as $row):
                                              if($row->tipo=="1" and $row->idmodulo=="9"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                }
                                              endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu8" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($usuarios as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Usuarios</h3>
                                      <?php foreach($permisos->result() as $row):
                                              		if($row->tipo=="1" and $row->idmodulo=="6"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                    }
                                                  endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu9" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($contingencias as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Registro de Planes de Contingencia</h3>
                                      <?php foreach($permisos->result() as $row):
                                              		if($row->tipo=="1" and $row->idmodulo=="15"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                    }
                                                  endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu10" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($inventarios as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu11" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($coronavirus as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                      <h3>Permisos Especiales COVID-19</h3>
                                      <?php foreach($permisos->result() as $row):
                                              		if($row->tipo=="1" and $row->idmodulo=="18"){ ?>
                                      <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                            value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                                      </div>
                                      <?php
                                                    }
                                                  endforeach; ?>
                                    </div>
                                  </div>
                                  <div id="menu12" class="tab-pane fade in">
                                    <br />
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                      <h3>Men&uacute; Principal</h3>
                                      <?php foreach($farmacia as $row): ?>
                                      <div class="col-xs-12 col-sm-4">
                                        <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                            value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                        <?php if($row->nivel==1){
                                                 foreach($row->subMenu as $rowS): ?>
                                        <div class="col-xs-12">
                                          <div class="checkbox checkbox-primary">
                                          <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                              rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                        </div>
                                        <?php endforeach;
                                               } ?>
                                      </div>
                                      <?php endforeach; ?>
                                    </div>
                                  </div>
                                </div>

                              </div>
                          </div>
                        </div>
                        <!-- <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#home">SIREED</a></li>
                          <li><a data-toggle="tab" href="#menu1">RENARHED</a></li>
                          <li><a data-toggle="tab" href="#menu2">Tablero de Control</a></li>
                          <li><a data-toggle="tab" href="#menu6">Ejecuci&oacute;n de Planes</a></li>
                          <li><a data-toggle="tab" href="#menu4">Oferta Movil</a></li>
                          <li><a data-toggle="tab" href="#menu5">Emergencias Sanitarias</a></li>
                          <li><a data-toggle="tab" href="#menu7">Sobredemanda</a></li>
                          <li><a data-toggle="tab" href="#menu8">Usuarios</a></li>
                          <li><a data-toggle="tab" href="#menu9">Contingencias</a></li>
                          <li><a data-toggle="tab" href="#menu10">Inventarios</a></li>
                          <li><a data-toggle="tab" href="#menu11">COVID-19</a></li>
                          <li><a data-toggle="tab" href="#menu12">Farmacia</a></li>
                        </ul>
                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($eventos as $row): ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" />
                                  <label for="chkMenu<?=$row->idmenu?>">
                                    <?=$row->descripcion?>
                                  </label>
                                </div>
                                <?php if($row->nivel==1){
                                               foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                    <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" />
                                    <label for="chkSubMenu<?=$rowS->idmenudetalle?>">
                                      <?=$rowS->descripcion?>
                                    </label>
                                  </div>
                                </div>
                                <?php endforeach;
                                             } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">

                              <h3>Permisos Registro de Eventos</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="1" and $row->idmodulo=="1"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>

                            <div class="col-sm-4 col-xs-12">

                              <h3>Permisos Acciones de Eventos</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="2" and $row->idmodulo=="1"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                          </div>
                          <div id="menu1" class="tab-pane fade in">
                            <div class="col-sm-4 col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($brigadistas as $row): ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                               foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                             } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Brigadista</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="1" and $row->idmodulo=="2"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Acciones de Brigadista</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="2" and $row->idmodulo=="2"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                          </div>
                          <div id="menu2" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($tablero as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                          <div id="menu6" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($planes as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <br />
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Acciones de Planes</h3>
                              <?php foreach($permisos->result() as $row):
                                  		if($row->tipo=="1" and $row->idmodulo=="4"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                        }
                                      endforeach; ?>

                            </div>
                          </div>
                          <div id="menu4" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($ofertamovil as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Oferta Movil</h3>
                              <?php foreach($permisos->result() as $row):
                                    if($row->tipo=="1" and $row->idmodulo=="10"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                      }
                                    endforeach; ?>
                            </div>
                          </div>
                          <div id="menu5" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">

                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($emergenciasSanitarias as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Emergencias</h3>
                              <?php foreach($permisos->result() as $row):
                                    if($row->tipo=="1" and $row->idmodulo=="8"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                      }
                                    endforeach; ?>
                            </div>
                          </div>
                          <div id="menu7" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($hospitalesSeguros as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Hospitales</h3>
                              <?php foreach($permisos->result() as $row):
                                      if($row->tipo=="1" and $row->idmodulo=="9"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                        }
                                      endforeach; ?>
                            </div>
                          </div>
                          <div id="menu8" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($usuarios as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Usuarios</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="1" and $row->idmodulo=="6"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                          </div>
                          <div id="menu9" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($contingencias as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Registro de Planes de Contingencia</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="1" and $row->idmodulo=="15"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                          </div>
                          <div id="menu10" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($inventarios as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                          <div id="menu11" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($coronavirus as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                              <h3>Permisos Especiales COVID-19</h3>
                              <?php foreach($permisos->result() as $row):
                                      		if($row->tipo=="1" and $row->idmodulo=="18"){ ?>
                              <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                                    value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                              </div>
                              <?php
                                            }
                                          endforeach; ?>
                            </div>
                          </div>
                          <div id="menu12" class="tab-pane fade in">
                            <br />
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                              <h3>Men&uacute; Principal</h3>
                              <?php foreach($farmacia as $row): ?>
                              <div class="col-xs-12 col-sm-4">
                                <div class="checkbox checkbox-primary">
                                <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                                    value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                                <?php if($row->nivel==1){
                                         foreach($row->subMenu as $rowS): ?>
                                <div class="col-xs-12">
                                  <div class="checkbox checkbox-primary">
                                  <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                                      rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                                </div>
                                <?php endforeach;
                                       } ?>
                              </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div> -->
                        <div class="clearfix"></div>
                        <br />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                      <button id="btnPermisos" class="btn btn-primary">Otorgar Permisos</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
                <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>usuarios/main/desactivar" method="POST">
                    <input type="hidden" name="Codigo_Usuario" value="" readonly />
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Desactivar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        &iquest;Seguro(a) desea Desactivar al usuario <strong id="usuario"></strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Desactivar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
                <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>usuarios/main/activar" method="POST">
                    <input type="hidden" name="Codigo_Usuario" value="" readonly />
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Activar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        &iquest;Seguro(a) desea Activar al usuario <strong id="usuario"></strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Activar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
                <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>usuarios/main/eliminar" method="POST">
                    <input type="hidden" name="Codigo_Usuario" value="" readonly />
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Eliminar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        &iquest;Seguro(a) desea Borrar al usuario <strong id="eliminar_usuario"></strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Borrar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
                <div class="modal-dialog" role="document">
                  <form id="formPassword" action="<?=base_url()?>usuarios/main/password" method="POST">
                    <input type="hidden" name="Codigo_Usuario" value="" readonly />
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Contrase&ntilde;a Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <input type="hidden" name="Codigo_Usuario" />
                          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                            <div class="form-group">
                              <label class="">Contrase&ntilde;a</label> <input type="password" class="form-control" name="password"
                                id="password" />
                            </div>
                          </div>
                          <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                            <div class="form-group">
                              <label class="">Repetir</label> <input type="password" class="form-control" name="re_password" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Cambiar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>usuarios/main/registrar" method="POST">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">Usuario</label>
                              <input type="text" class="form-control text-lowercase" name="Usuario" autocomplete="off"/>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">DNI</label>
                              <div class="input-group">
                                <input type="text" class="form-control" maxlength="8" minlength="8" name="DNI" autocomplete="off">
                                <span class="input-group-btn">
                                  <button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search"
                                      aria-hidden="true"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">Apellidos</label>
                              <input type="text" class="form-control text-uppercase" name="Apellidos" autocomplete="off"/>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">Nombres</label>
                              <input type="text" class="form-control text-uppercase" name="Nombres" autocomplete="off"/>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">Perfil</label> <select name="Codigo_Perfil" class="form-control">
                                <option value="">[Seleccione...]</option>
                                <?php foreach($listaPerfil->result() as $row): ?>
                                <option value="<?=$row->Codigo_Perfil?>"><?=$row->Descripcion_Perfil?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label class="">Regi&oacute;n</label> <select name="Codigo_Region" class="form-control">
                                <option value="">[Seleccione...]</option>
                                <?php foreach($listaRegion->result() as $row): ?>
                                <option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Editar Usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formActualizar" action="<?=base_url()?>usuarios/main/actualizar" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="Codigo_Usuario" id="Codigo_Usuario" />
                        <div class="row">

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="">Usuario</label> <input type="text" class="form-control text-lowercase" name="Usuario"
                                id="Usuario" />
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="">DNI</label>
                              <div class="input-group">
                                <input type="text" class="form-control" name="DNI" id="DNI" autocomplete="off">
                                <span class="input-group-btn">
                                  <button type="button" id="btn-buscar2" class="btn btn-primary btn-search"><i class="fa fa-search"
                                      aria-hidden="true"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="">Apellidos</label>
                              <input type="text" class="form-control text-uppercase" name="Apellidos" id="Apellidos" readonly />
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="">Nombres</label>
                              <input type="text" class="form-control text-uppercase" name="Nombres" id="Nombres" readonly />
                            </div>
                          </div>
                          <div class="col-sm-12" id="ocultar">
                            <div class="form-group">
                              <label class="">Perfil</label> <select name="Codigo_Perfil" id="Codigo_Perfil" class="form-control">
                                <option value="">[Seleccione...]</option>
                                <?php foreach($listaPerfil->result() as $row): ?>
                                <option value="<?=$row->Codigo_Perfil?>"><?=$row->Descripcion_Perfil?></option>
                                <?php endforeach; ?>
                              </select>
                              <small><i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Cambiar de perfil
                                eliminar&aacute; los permisos actuales</small>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="">Regi&oacute;n</label> <select name="Codigo_Region" id="Codigo_Region"
                                class="form-control">
                                <option value="">[Seleccione...]</option>
                                <?php foreach($listaRegion->result() as $row): ?>
                                <option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="areasModal" tabindex="-1" role="dialog" aria-labelledby="areasModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Lista de &Aacute;reas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formInsertarAreas" action="<?=base_url()?>usuarios/main/areas" method="POST">
                      <div class="modal-body">
                        <div class="row">
                          <!-- <div class="col-sm-12"> -->
                            <div class="form-group col-sm-4">
                              <label for="Anio_Ejecucion">A&ntilde;o</label> <select name="Anio_Ejecucion" id="Anio_Ejecucion"
                                class="form-control">
                                <option value="">[Seleccione...]</option>
                                <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                <option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="Codigo_Sector">Sector</label> <select name="Codigo_Sector" id="Codigo_Sector"
                                class="form-control">
                                <option value="">[Seleccione A&ntilde;o...]</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="Codigo_Pliego">Pliego</label> <select name="Codigo_Pliego" id="Codigo_Pliego"
                                class="form-control">
                                <option value="">[Seleccione Sector...]</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="Codigo_Ejecutora">Ejecutora</label> <select name="Codigo_Ejecutora" id="Codigo_Ejecutora"
                                class="form-control">
                                <option value="">[Seleccione Pliego...]</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="Codigo_Centro_Costos">Centro de Costos</label> <select name="Codigo_Centro_Costos"
                                id="Codigo_Centro_Costos" class="form-control detalle-size">
                                <option value="">[Seleccione Ejecutora...]</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="Codigo_Sub_Centro_Costos">Sub Centro de Costos</label>
                              <select name="Codigo_Sub_Centro_Costos" id="Codigo_Sub_Centro_Costos"
                                class="form-control detalle-size">
                                <option value="">[Seleccione Centro de Costos...]</option>
                              </select>
                            </div>
                          <!-- </div> -->
                          <input type="hidden" name="Codigo_Usuario" />
                          <div class="col-sm-12">
                            <div class="table-responsive">
                              <table id="tbAreas" class="table table-striped table-bordered" style="width: 100%;">
                              <thead>
                                <tr>
                                  <th>C&oacute;digo</th>
                                  <th>Nombre</th>
                                  <th>Opción</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php $this->load->view("inc/footer-template");?>
              <script src="<?=base_url()?>public/js/moment.min.js"></script>
              <script src="<?=base_url()?>public/js/locale.es.js"></script>
         </div>
      </div>
      <?php $this->load->view("inc/resource-template");?>
      <script src="<?=base_url()?>public/js/usuarios/usuarios.js?v=<?=date("s")?>"></script>
      <script>
        usuarios("<?=base_url()?>", "<?=$this->session->userdata("Anio_Ejecucion")?>");
      </script>
   </body>
</html>
