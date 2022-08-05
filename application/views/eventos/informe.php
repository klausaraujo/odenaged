<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** Margenes de la pagina en 0 **/
            @page { margin: 0cm 0cm; }
			/** Márgenes reales de cada página en el PDF **/
			body { width:21.7cm; font-family: Helvetica; font-size: 0.8rem}
			/** Reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
				width: 100%;
            }

            /** Reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0.5cm; 
                right: 0cm;
                height: 2cm;
				width: 100%;
            }
			
			/** Reglas del contenido **/
			#contenido{width:18cm;}
			#footer{font-size: 9px;height: 50px;border-top:0.5px solid #AAA;width:20.5cm}
			table .acciones{border:2px solid burlywood; border-collapse: collapse}
			.acciones td{border:2px solid burlywood; border-collapse: collapse}
			main{margin-top:2.3cm;margin-bottom:2cm}
			* { text-transform: uppercase; }
        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
            <img src="<?=base_url()?>public/images/informes/header.png" width="100%" />
			<hr style="border:2px burlywood;border-style:double;width:100%;">
        </header>

        <footer>
            <!--<img src="<?=base_url()?>public/images/informes/header.png" width="100%" />-->
			<table id="footer" cellspacing="0" style="">
				<tr>
					<td style="padding-top: 5px;">
					creado por: <?=$evento->usuario_registro?><br /> <?if($evento->usuario_actualizacion){?>actualizado por: <?=$evento->usuario_actualizacion;}?>
					</td>
											
					<!--<td style="padding-top: 5px;">
					<a href="http://sireed.minsa.gob.pe/" target="_blank" style="margin-top:0px;">http://sireed.minsa.gob.pe</a>
					<p class="footer-margin">coesalud@minsa.gob.pe</p>
					</td>
					<td style="vertical-align: top;margin-top:0;padding-top: 5px;">
						<div class="vertical"></div>
					</td>
					<td style="padding-left: 10px;padding-top: 5px;">
					 <p class="footer-margin" style="margin-top:0px;">Av. San Felipe N&deg; 1116</p>
					 <p class="footer-margin">Jesús María - Lima 11, Per&uacute;</p>
					 <p class="footer-margin">Telf. (511) 611 9930</p>
					 <p class="footer-margin">COE Salud: 611 9933</p>
					</td>-->
				</tr>
			</table>
        </footer>

        <!-- Etiqueta principal del pdf -->
        <main>
            <table id="contenido" cellspacing="1" cellpadding="1" align="center" style="text-align:center;">
				<tr><td colspan="12" ><b>REPORTE DE SITUACIÓN PRELIMINAR N° <?=$evento->numero_evento?>-<?=$evento->anio_evento?>-COES EDUCACIÓN</b></td></tr>
				<tr><td colspan="12" ><b>FECHA Y HORA: <?=$evento->fecha?> – <?=$evento->hora?> HORAS</b></td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr><td width="30pt" style="text-align:left">I.</td><td style="text-align:left" colspan="11"><b>HECHOS</b></td></tr>
				<tr>
					<td width="30pt"></td>
					<td style="text-align:justify" colspan="11"><?=$evento->descripcion?></td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr><td width="30pt" style="text-align:left">II.</td><td style="text-align:left" colspan="11"><b>UBICACION DEL EVENTO</b></td></tr>
				<tr style="color:black">
					<td width="30pt" colspan="2">
					</td><td bgcolor="#DAF7A6" colspan="3"><b>Región</b></td>
					<td bgcolor="#DAF7A6" colspan="3"><b>Provincia</b></td>
					<td bgcolor="#DAF7A6" colspan="3"><b>Distrito</b></td>
					<td width="30pt"></td>
				</tr>
				<tr style="color:black">
					<td width="30pt" colspan="2"></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->departamento?></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->provincia?></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->distrito?></td>
					<td width="30pt"></td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr>
					<td width="30pt" style="text-align:center"></td>
					<td style="text-align:center;font-weight: bold;" colspan="11">MAPA DE UBICACIÓN DEL EVENTO SEGUN COORDENADAS GEOREFERENCIALES</td>
				</tr>
				
				<tr>
					<td width="30pt" colspan="2"></td>
					<td colspan="8" style="text-align:center;">
						<img src="<?=base_url()?>public/images/mapas_eventos/<?=$evento->mapa_imagen?>" style="width:600px;height:250px;border:3px burlywood;border-style:solid;border-radius:15px" />
					</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<?
					if(!empty($danios)){
						$i = 1;
						foreach($danios as $row):
							if($i === 1){
				?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">iii. </td><td colspan="9">da&ntilde;os:</td><td>&nbsp;</td></tr>
				<tr>
					<td width="30pt">&nbsp;</td>
					<td colspan="11">
						<table cellspacing="0" cellpadding="1" align="center" style="text-align:center;" width="10cm" class="acciones">
							<tr><th bgcolor="#DAF7A6" colspan="2">resumen de registro de da&ntilde;os</th></tr>
							<tr style="font-weight: bold;"><td>item</td><td>cantidad</td></tr>
				<?			}		?>
							<tr><td><?=$row->tipo_danio?></td><td><?=floatval($row->cantidad)?></td></tr>
				<?
							$i ++;
						endforeach;
					}
				?>
						</table>
					</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<?
					if(!empty($acciones)){
						$i = 1;
						foreach($acciones as $row):
							if($i === 1){
				?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">iv. </td><td colspan="9">registro de acciones:</td><td>&nbsp;</td></tr>
				<?			}		?>
				<?
							$i ++;
						endforeach;
					}
				?>
				<tr>
					<td width="30pt">&nbsp;</td>
					<td colspan="11">
						<table cellspacing="0" cellpadding="1" align="center" style="text-align:center;" width="15cm" class="acciones">
							<tr style="text-align:left;font-weight: bold;"><td bgcolor="#DAF7A6">&nbsp;4.
							<?=$i.' '.$row->tipo_accion.' (fecha: '.substr($row->fecha,0,10).' hora: '.$row->hora.')'?></td></tr>
							<tr align="left"><td style="text-align:justify;">&nbsp;<?=$row->descripcion?></td></tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<?
					if(!empty($ies)){
						$i = 1;
						foreach($ies as $row):
							if($i === 1){
				?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">iv. </td><td colspan="9">instituciones educativas afectadas:</td><td>&nbsp;</td></tr>
				<?			}		?>
				<tr>
					<td width="30pt" style="text-align:left">&nbsp;</td>
					<td style="text-align:left" colspan="9">
						5.<?=$i.'  '.$row->CEN_EDU.' (fecha: '.$row->fecha.')'?>
					</td>
				</tr>
				<?
							$i ++;
						endforeach;
					}
				?>
			</table>
        </main>
    </body>
</html>