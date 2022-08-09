<?
set_time_limit(60);
$uReg = $evento->usuario_registro;
$uAct = $evento->usuario_actualizacion;
?>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** Margenes de la pagina en 0 **/
            @page { margin: 0cm 0cm; }
			/** Márgenes reales de cada página en el PDF **/
			body { width:21.7cm; font-family: Helvetica; font-size: 0.8rem;margin-top:2.3cm;margin-bottom:2.6cm }
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
                height: 2.3cm;
				width: 100%;
            }
			
			/** Reglas del contenido **/
			#contenido{width:18cm;}
			#footer{font-size: 8px;height: 50px;border-top:0.5px solid #AAA;width:20.5cm;line-height:1em}
			table .acciones{border:2px solid burlywood; border-collapse: collapse}
			.acciones td{border:2px solid burlywood; border-collapse: collapse}
			table .fotos{width:16cm;margin-bottom:20px}
			.galeria{margin:auto;width:254px;}
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
			<table id="footer" cellspacing="1" style="">
				<tr>
					<td style="padding: 3px;" rowspan="">
						<img src="<?=base_url()?>public/images/informes/footer.png" width="70px" />
					</td>
					<td>
						jefe del coes<br><br>coordinador coes<br><br>
					</td>
					<td colspan="3">
						<span style="font-weight:bold">rosendo leoncio, serna rom&aacute;n</span><br>ministro de educaci&oacute;n<br>
						<span style="font-weight:bold">carlos alberto, malpica coronado</span><br>jefe de la oficina de defensa nacional y de gestion del riesgo de desastres
					</td>
					<td colspan="2">
						odenaged_informa@minedu.gob.pe<br>av. rep&uacute;blica de colombia nº 710 - san isidro<br>tel&eacute;fono	: 615-5854, 615-5800<br>
						anexo	: 26760/26741<br>celular: 989183571 / 989183584
					</td>
					<td colspan="2">registrado por: <br><span style="font-weight:bold"><?=$uReg?></span><br>
					actualizado por: <br><span style="font-weight:bold"><?=$uAct?></span>
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
            <table id="contenido" cellspacing="0" cellpadding="1" align="center" style="text-align:center;">
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
						$suma = 0;
						foreach($danios as $row):
							if($i === 1){
				?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">iii. </td><td colspan="9">da&ntilde;os:</td><td>&nbsp;</td></tr>
				<tr>
					<td width="30pt">&nbsp;</td>
					<td colspan="11">
						<table cellspacing="0" cellpadding="1" align="center" style="text-align:center;" width="9cm" class="acciones">
							<tr><th bgcolor="#DAF7A6" colspan="2">cuadro resumen de registro de da&ntilde;os</th></tr>
							<tr style="font-weight: bold;"><td bgcolor="#DAF7A6">tipo de afectación</td><td bgcolor="#DAF7A6">cantidad</td></tr>
				<?			}		?>
							<tr><td style="text-align:left;"><?=$row->tipo_danio?></td><td><?=$row->cantidad?></td></tr>
				<?
							$suma += floatval($row->cantidad);
							$i ++;
						endforeach;
					}
				?>
							<tr bgcolor="#DAF7A6" style="font-weight: bold"><td>total afectados</td><td><?=$suma?></td></tr>
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
				<tr>
					<td width="30pt">&nbsp;</td>
					<td colspan="11">
						<table cellpadding="1" align="center" style="text-align:center;margin:-2;padding:0" width="15cm" class="acciones">
							<tr style="text-align:left;font-weight: bold;"><td bgcolor="#DAF7A6">&nbsp;4.
							<?=$i.' '.$row->tipo_accion.' (fecha: '.substr($row->fecha,0,10).' hora: '.$row->hora.')'?></td></tr>
							<tr align="left"><td style="text-align:justify;">&nbsp;<?=$row->descripcion?></td></tr>
						</table>
					</td>
				</tr>
				<?
							$i ++;
						endforeach;
					}
				?>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<?
					if(!empty($ies)){
						$i = 1;
						foreach($ies as $row):
							if($i === 1){
				?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">iv. </td><td colspan="9">instituciones educativas afectadas:</td><td>&nbsp;</td></tr>
				<tr>
					<td colspan="12">
						<table cellspacing="0" cellpadding="1" align="center" style="text-align:center;" width="15cm" class="acciones">
							<tr bgcolor="#DAF7A6"><th>item</th><th>c.modular</th><th>c.local</th><th>nivel</th><th>nombre i.e.</th><th>registro</th></tr>
				<?			}		?>
							<tr><td>4.<?=$i?></td><td><?=$row->COD_MOD?></td><td><?=$row->CODLOCAL?></td>
							<td><?=$row->D_NIV_MOD?></td><td><?=$row->CEN_EDU?></td><td><?=substr($row->fecha,0,10)?></td></tr>
				<?
							$i ++;
						endforeach;
					}
				?>
						</table>
					</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<? if(!empty($fotos)){ ?>
				<tr style="text-align:left;font-weight: bold;"><td width="30pt">v. </td><td colspan="9">galer&iacute;a fotogr&aacute;fica:</td><td>&nbsp;</td></tr>
				<?}?>
				<!--<tr>
					<td colspan="12">
				<?	/*$i = 1; foreach($fotos as $row): ?>
					<table cellspacing="0" cellpadding="1" align="center" style="text-align:center;" class="fotos">
						<tr><td>fotograf&iacute;a <?=$i?></td></tr>
						<tr><td><img src="<?=base_url()?>public/images/galerias_eventos/<?=$row->fotografia?>" width="200px" height="200px"/></td></tr>
						<tr><td><?=$row->descripcion?></td></tr>
					</table>
				<?	$i ++; endforeach;*/ ?>
					</td>
				</tr>-->
			</table>
			<br>
			<?php $n=1; foreach($fotos as $row): ?>
			<div class="row">
				<div class="col-md-12"></div>
				<div class="col-md-12 text-center galeria">
					<p align="center" class="my-2">fotograf&iacute;a <?=$n?></p>
					<img src="<?=base_url()?>public/images/galerias_eventos/<?=$row->fotografia?>" border="0" width="250" />
					<p align="center" class="my-2"><?=$row->descripcion?></p>
				</div>
			</div>
		    <br />
			<?php $n++; endforeach; ?>
        </main>
    </body>
</html>