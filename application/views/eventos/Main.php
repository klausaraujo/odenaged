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
			<?
			/*	
				año en el servidor  = strftime('%Y')
				$hoy = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
				$hoy = date("m.d.y");                         // 03.10.01
				$hoy = date("j, n, Y");                       // 10, 3, 2001
				$hoy = date("Ymd");                           // 20010310
				$hoy = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
				$hoy = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
				$hoy = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
				$hoy = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
				$hoy = date("H:i:s");                         // 17:16:18
				$hoy = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL)
			*/
			?>
            
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
									foreach($this->session->userdata("anio") as $row):
										if($row->anio == strftime('%Y'))
											echo '<option value="'.$row->idanio.'" selected >'.$row->anio.'</option>';
										else
											echo '<option value="'.$row->idanio.'">'.$row->anio.'</option>';
									endforeach;
									?>
								</select>
								<select class="form-control col-sm-2 mx-2" name="mes" id="mes">
									<option value="">-- Seleccione --</option>
									<?
										foreach($this->session->userdata("mes") as $row):
											if(intval($row->idmes) == date('n'))
												echo '<option value="'.$row->idmes.'" selected >'.$row->mes.'</option>';
											else
												echo '<option value="'.$row->idmes.'">'.$row->mes.'</option>';
										endforeach;
									?>
								</select>
								
							</div>
							<br>

							<div class="table-responsive">
							   <table id="tablaEvento" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0" style="width:100%">
									
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
</body>
</html>