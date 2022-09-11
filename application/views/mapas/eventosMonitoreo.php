<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>
    <?=TITULO_PRINCIPAL?>
  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">
  <?php $this->load->view("inc/resources");?>
  <?php $titulo = "Reporte de Mapa de Eventos Monitoreados";?>
  <link rel="stylesheet" href="<?=base_url()?>public/template/js/mapas/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/template/js/mapas/css/mapas/main.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/template/js/mapas/css/eventos/mapaAcciones.css?v=<?=date("his")?>" />
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue slide-nav-toggle">
    <?php $this->load->view("inc/header");?>
    <div class="content">
      <div class="row row_map">
        <div class="col-sm-4 form__maps">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form__title">
            <h1 class="txt-dark">
              <?=$titulo?>
            </h1>
          </div>
          <form name="formMapaEventos" id="formMapaEventos" method="post">
            <div class="form__content">
              <div class="form-group">
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="">Regi&oacute;n</label>
                    <select class="form-control form-control-sm" name="departamento" required="required" id="departamento">
                      <option value="0">-- TODOS --</option>
                      <?php foreach ($departamentos as $row): ?>
                      <option value="<?=$row->Codigo_Departamento?>">
                        <?=$row->Nombre?>
                      </option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="0">Provincia</label>
                    <select class="form-control form-control-sm" name="provincia" id="provincia">
                      <option value="">-- TODOS --</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="0">Distrito</label>
                    <select class="form-control form-control-sm" name="distrito" id="distrito">
                      <option value="">-- TODOS --</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="0">Tipo de evento
                      <a class="form__icon">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M6 0C2.68555 0 0 2.68555 0 6C0 9.31445 2.68555 12 6 12C9.31445 12 12 9.31445 12 6C12 2.68555 9.31445 0 6 0ZM6 1C8.76172 1 11 3.23828 11 6C11 8.76172 8.76172 11 6 11C3.23828 11 1 8.76172 1 6C1 3.23828 3.23828 1 6 1ZM6 2.90625C5.9082 2.90625 5.83203 2.9043 5.75 2.92188C5.66797 2.93945 5.5918 2.98438 5.53125 3.03125C5.4707 3.07812 5.42578 3.14258 5.39062 3.21875C5.35547 3.29492 5.34375 3.38477 5.34375 3.5C5.34375 3.61328 5.35547 3.70312 5.39062 3.78125C5.42578 3.85938 5.4707 3.92188 5.53125 3.96875C5.5918 4.01562 5.66797 4.04297 5.75 4.0625C5.83203 4.08203 5.9082 4.09375 6 4.09375C6.08984 4.09375 6.18555 4.08203 6.26562 4.0625C6.3457 4.04297 6.4082 4.01562 6.46875 3.96875C6.5293 3.92188 6.57422 3.85938 6.60938 3.78125C6.64453 3.70508 6.67188 3.61328 6.67188 3.5C6.67188 3.38477 6.64453 3.29492 6.60938 3.21875C6.57422 3.14258 6.5293 3.07812 6.46875 3.03125C6.4082 2.98438 6.3457 2.93945 6.26562 2.92188C6.18555 2.9043 6.08984 2.90625 6 2.90625ZM5.39062 4.57812V9.0625H6.60938V4.57812H5.39062Z"
                            fill="black" />
                        </svg>
                      </a>
                    </label>
                    <select class="form-control form-control-sm" name="tipoEvento" required="required" id="tipoEvento">
                      <option value="">-- TODOS --</option>
                      <?php foreach ($tipo as $row): ?>
                      <option value="<?=$row->Evento_Tipo_Codigo?>">
                        <?=$row->Evento_Tipo_Nombre?>
                      </option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="0">Nivel</label>
                    <select class="form-control form-control-sm" name="nivelEmergencia" id="nivelEmergencia">
                      <option value="">-- TODOS --</option>
                      <?php foreach ($nivel as $row): ?>
                      <option value="<?=$row->Evento_Nivel_Codigo?>">
                        <?=$row->Evento_Nivel_Nombre?>
                      </option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="">Evento</label>
                    <select class="form-control form-control-sm" name="evento" id="evento">
                      <option value="0">-- TODOS --</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="">Desde</label>
                    <div class='input-group date datetimepicker'>
                      <input type="text" class="form-control" data-date-format="dd/mm/yyyy" required="required" id="desde"
                        name="desde" value="<?=date('d/m/Y', strtotime('-30 days'));?>" />
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="">Hasta</label>
                    <div class='input-group date datetimepicker'>
                      <input type="text" class="form-control" data-date-format="dd/mm/yyyy" required="required" name="hasta"
                        id="hasta" value="<?=date("d/m/Y")?>" />
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="0">Consolidado de Evento</label>
                    <select class="form-control form-control-sm" name="eventoConsolidado" id="eventoConsolidado">
                      <option value="0">-- TODOS --</option>
                      <option value="1">Temporada de Lluvias</option>
                      <option value="2">Temporada de Bajas Temperaturas</option>
                      <option value="3">Sismos por Niveles de Intensidad</option>
                      <option value="4">Accidentes de Tr&aacute;nsito</option>
                      <option value="5">Incendios Forestales</option>
                      <option value="6">Indendios Urbanos o Industriales</option>
                      <option value="7">Conflictos Sociales</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <div class='form-check'>
                      <input class="form-check-input" type="checkbox" value="1" id="chk_monitoreo" name="tipoOcurrencia[]"
                        checked>
                      <label class="form-check-label" for="chk_monitoreo">
                        Eventos en Monitoreo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <div class='form-check'>
                      <input class="form-check-input" type="checkbox" value="2" id="chk_cerrado" name="tipoOcurrencia[]">
                      <label class="form-check-label" for="chk_cerrado">
                        Eventos Cerrados
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <div class='form-check'>
                      <span id="numeroEvento"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 form__button">
              <div class="col-sm-12">
                <button type="submit" id="btnObtenerReporte" class="btn btn-primary col-md-12">
                  Mostrar Reporte dentro del Mapa
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-8 maps">
          <div id="divMap" class="maps__content"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="leyendaMapa" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Leyenda</h5>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
            <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_natural.png" width="25" /></td>
                <td>Eventos Naturales</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_antropico.png" width="25" /></td>
                <td>Eventos Antr&oacute;pico</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_sanitario.png" width="25" /></td>
                <td>Eventos Sanitarios</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_explosion.png" width="25" /></td>
                <td>Explosiones</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_forestal.png" width="25" /></td>
                <td>Incendios Forestales</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_friaje.png" width="25" /></td>
                <td>Friajes</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_helada.png" width="25" /></td>
                <td>Heladas</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_incendio.png" width="25" /></td>
                <td>Incendios Urbanos</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_sismos.png" width="25" /></td>
                <td>Sismos y Terremotos</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_lluvias.png" width="25" /></td>
                <td>Lluvias Intensas</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_transito.png" width="25" /></td>
                <td>Accidentes de Transito</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_vientos.png" width="25" /></td>
                <td>Vientos Fuertes</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_volcan.png" width="25" /></td>
                <td>Actividades Volc&aacute;nicas</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="dataMapModal" tabindex="-1" role="dialog" aria-labelledby="dataMapModalTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Lista de acciones</h5>
            <input type="hidden" id="departamento" name="departamento" />
          </div>
          <div class="modal-body">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table id="tbDetalleAcciones" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>&nbsp;</th>
                      <th>Tipo de Acci&oacute;n</th>
                      <th>Tipo de Entidad</th>
                      <th>Descripci&oacute;n</th>
                      <th>Fecha</th>
                      <th>Brigadistas</th>
                      <th>EMT</th>
                      <th>PersonalSalud</th>
                      <th>Ambulancias</th>
                      <th>Medicamentos</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col-xs-12"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div>
          </div>
        </div>
      </div>
    </div>
    <?php
$this->load->view("inc/footer");
?>
    <!--<script src="<?=base_url()?>public/js/moment.min.js"></script>
    <script src="<?=base_url()?>public/js/locale.es.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>-->
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?='AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc';?>&libraries=drawing"></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_01.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_02.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_03.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_04.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_05.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_06.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_07.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_08.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_09.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_10.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_11.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_12.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_13.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_14.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_15.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_16.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_17.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_18.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_19.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_20.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_21.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_22.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_23.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_24.js'></script>
  <script type='text/javascript' src='<?=base_url()?>public/template/js/mapas/map/latlng/latlng_25.js'></script>
  <script type="text/javascript" src="<?=base_url()?>public/template/js/mapas/map/djperu_ind.js"></script>
  <script>
    var URI_MAP = "<?=base_url()?>";
    var registros = [];
    var marcadores = [];
  </script>
  <script src="<?=base_url()?>public/template/js/mapas/initMapReporteEventosMonitoreo.js?v=<?=date(" his")?>"></script>
  <script src="<?=base_url()?>public/template/js/mapas/mapa-eventos-monitoreo.js?v=<?=date(" his")?>"></script>
  <script>
    mapaEventosMonitoreo(URI_MAP);
  </script>
</body>
</html>