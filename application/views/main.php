<?php
if (!isset($_SESSION['usuario'])) {
	header("location:" . base_url() . "login");
}
?>
<!doctype html>
<html lang="en">
<?	require_once('inc/header.php');	?>
	<body class="" >
	   <!--<div id="loading">
		  <div id="loading-center">
		  </div>
	   </div>-->
		<div class="wrapper bg-sirese">
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
					<?	
						if($this->uri->segment(1) == '') $this->load->view("modulos");
						if($this->uri->segment(1) == 'eventos') $this->load->view("eventos/eventos");
						if($this->uri->segment(1) == 'usuarios') $this->load->view("usuarios/usuarios");
						if($this->uri->segment(2) == 'perfil')$this->load->view('usuarios/perfil');
					?>
				</div>
			</div>
			<?php $this->load->view("inc/footer-template"); ?>
			</div>
		</div>
		<?	require_once('inc/footer.php');?>
	</body>
</html>