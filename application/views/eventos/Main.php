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
   <link rel="stylesheet" href="<?=base_url()?>public/template/js/table/datatable/datatables.min.css" type="text/css">
   <!--<link rel="stylesheet" href="<?=base_url()?>public/template/js/table/datatable/buttons.datatables.min.css" type="text/css">-->
   <!--<link rel="stylesheet" href="<?=base_url()?>public/css/datatables.min.css" type="text/css"> 
   <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">-->
   <style>                        
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none; 
			margin: 0; 
	    }
	    input[type=number] { -moz-appearance:textfield; }
		table.dataTable td {font-size: 0.8rem;}
		#message, #cargando{text-align:center}
		.succes{color:#008F39;font-size:1.1rem}
		.warn{color:#FF0000;font-size:1.1rem}
	    //.form-group {display: flex;align-items: center;}
		//.modal-lg {max-width: 100% !important;margin:0 !important;max-height:100% !important;}
		//.modal-body {font-size:13px;}
		//.actionEdit{background:green}
		//.actionCargas{}
		//.actionEstud{}
		//.actionReport{background:red}
		//.modal-footer{display:block}
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
            <div class="row">
               <div class="col-lg-12">
                  <?php //echo "<pre>"; echo $lista; echo '<br>'.$pacientes;//echo "<pre>"; echo var_dump($lista); ?>
               </div>
            </div>
            
            <div class="row">
               <div class="col-xl-12 col-md-12">
				<div class="ajaxForm" style="display:none"><?php $this->load->view("eventos/form-new"); ?></div>
				<div class="ajaxTable">
					  <div class="card m-b-30 pb-35">
						 <div class="card-body">
							<h4 class="mt-0 m-b-15 header-title">Listado General de Eventos Registrados</h4>
							<br>
							<div class="row ml-1">
								<label for="mes" class="col-sm-12">Aplicar Filtros por A&ntilde;o y mes del Evento:</label>
								<select class="form-control col-sm-2 mx-2" name="anio" id="anio">
									<option value="">-- Seleccione --</option>
									<?
									  $anio = $this->session->userdata("anio");
									  foreach($anio as $row):
										echo '<option value="'.$row->idanio.'">'.$row->anio.'</option>';
									  endforeach;
									?>
								</select>
								<select class="form-control col-sm-2 mx-2" name="mes" id="mes">
									<option value="">-- Seleccione --</option>
									<?
									  $mes = $this->session->userdata("mes");
									  foreach($mes as $row):
										echo '<option value="'.$row->idmes.'">'.$row->mes.'</option>';
									  endforeach;
									?>
								</select>
								
							</div>
							<br>

							<div class="table-responsive">
							   <table id="tablaCanillita" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0" style="width:100%">
									
							   </table>
							</div>

						 </div>
					  </div>
				</div>
               </div>
            </div>
         </div>
         <?php $this->load->view("inc/footer-template"); ?>
      </div>
   </div>
   <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
   <script src="<?=base_url()?>public/template/js/jquery-ui.min.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/popper.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
   <script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
   <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
   <script src="<?=base_url()?>public/template/js/wow.min.js"></script>
   <script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
   <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
   <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
   <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/lottie.js"></script>-->
   <script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
   <script src="<?=base_url()?>public/template/js/custom.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/chart.min.js"></script>
   <script src="<?=base_url()?>public/template/js/datatables.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/jquery.validate.min.js"></script>
   
   <!-- JS DataTable -->
   <script src="<?=base_url()?>public/template/js/table/datatable/datatables.min.js"></script>
   <!--<script src="<?=base_url()?>public/template/js/table/datatable/dataTables.buttons.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/table/datatable/jszip.min.js"></script>
   <script src="<?=base_url()?>public/template/js/table/datatable/pdfmake.min.js"></script>
   <script src="<?=base_url()?>public/template/js/table/datatable/vfs_fonts.js"></script>
   <!--script src="<?=base_url()?>public/template/js/table/datatable/buttons.html5.min.js"></script>-->
   <!--<script src="<?=base_url()?>public/template/js/table/datatable/buttons.print.min.js"></script>-->
   <script src="<?=base_url()?>public/template/js/table/table.js"></script>
	<script src="<?=base_url()?>public/template/js/eventos/main.js"></script>
	<script>
      //const URI_MAP = "<?=base_url()?>";
      const canDelete = "1";
      const canEdit = "1";
      const canIdioma = "1";
      const canTracking = "1";
      const canHistory = "1";
      const URI = "<?=base_url()?>";
	  var lista = [];
	  //const lista = JSON.parse('<?=$listarCanillita?>');
	  const table = tablePersonalized('#tablaCanillita',lista,'evento');
	  main(URI);
	  
	  //tablePersonalized(table);
	  //canillitas(URI,table,'canillita');
      /*const lista = <?= $lista ?>;*/
   </script>
   <script>
   </script>
</body>
</html>