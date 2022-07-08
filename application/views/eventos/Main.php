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
				<div class="ajaxForm" style=""><?php $this->load->view("eventos/form-new"); ?></div>
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
   <?php $this->load->view("inc/resource-template"); ?>
   
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?='AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc'?>&libraries=places&v=weekly" async></script>
	<script src="<?=base_url()?>public/template/js/mapa/map.js"></script>
	<script src="<?=base_url()?>public/template/js/eventos/main.js"></script>
	<script>
      const canDelete = "1";
      const canEdit = "1";
      const canIdioma = "1";
      const canTracking = "1";
      const canHistory = "1";
      const URI = "<?=base_url()?>";
	  var lista = [];
	  const table = tablePersonalized('#tablaCanillita',lista,'evento');
	  main(URI);
	  window.onload = function(){
		//var macc = {lat: 42.1382114, lng: -71.5212585};

		/*var map = new google.maps.Map(

        document.getElementById('map'), {zoom: 15, center: macc});

		var marker = new google.maps.Marker({position: macc, map: map});*/
		/*var opt ={
			lat : -12.0147737,
			lng : -76.88504329999999,
			zoom : 15,
		}
		console.log(opt.zoom);
		
		mapa(opt);*/
    }
	  
	  //tablePersonalized(table);
	  //canillitas(URI,table,'canillita');
      /*const lista = <?= $lista ?>;*/
   </script>
   <script>
   </script>
</body>
</html>