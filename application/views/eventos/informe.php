<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** Margenes de la pagina en 0 **/
            @page { margin: 0cm 0cm; }
			/** Márgenes reales de cada página en el PDF **/
			body { width:21cm; font-family: Helvetica; font-size: 0.8rem}
			/** Reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
				width: 21cm;
            }

            /** Reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0.5cm; 
                right: 0cm;
                height: 2cm;
				width: 21cm;
            }
			
			/** Reglas del contenido **/
			#contenido{width:18cm;}
			#footer{font-size: 10px;height: 50px;border-top:0.5px solid #AAA;width:20.5cm}
			main{margin-top:2.3cm;margin-bottom:2.3cm}
			* { text-transform: uppercase; }
        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
            <img src="<?=base_url()?>public/images/informes/header.png" width="100%" />
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

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        <main>
            <table id="contenido" cellspacing="2" cellpadding="3" align="center" style="text-align:center;">
				<tr><td colspan="12" >REPORTE DE SITUACIÓN PRELIMINAR N° <?=$evento->numero_evento?>-<?=$evento->anio_evento?>-COES EDUCACIÓN</td></tr>
				<tr><td colspan="12" >FECHA Y HORA: <?=$evento->fecha?> – <?=$evento->hora?> HORAS</td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr><td width="30pt" style="text-align:left">I.</td><td style="text-align:left" colspan="11">HECHOS</td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr>
					<td width="30pt"></td>
					<td style="text-align:justify" colspan="11"><?=$evento->descripcion?></td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr><td width="30pt" style="text-align:left">II.</td><td style="text-align:left" colspan="11">UBICACION DEL EVENTO</td></tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr style="color:white">
					<td width="30pt" colspan="2">
					</td><td bgcolor=blue colspan="3">Region</td>
					<td bgcolor=blue colspan="3">Provincia</td>
					<td bgcolor=blue colspan="3">Distrito</td>
					<td width="30pt"></td>
				</tr>
				<tr style="color:white">
					<td width="30pt" colspan="2"></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->departamento?></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->provincia?></td>
					<td bgcolor=lightblue colspan="3"><?=$evento->distrito?></td>
					<td width="30pt"></td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr>
					<td width="30pt" style="text-align:left"></td>
					<td style="text-align:left" colspan="11">MAPA DE UBICACION SEGUN COORDDENADAS</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr>
					<td width="30pt" colspan="2"></td>
					<td colspan="8"><img src="<?=base_url()?>public/images/mapas_eventos/<?=$evento->mapa_imagen?>" width="600pt" height="250pt" /></td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
				<tr>
					<td width="30pt" style="text-align:left">III.</td>
					<td style="text-align:left" colspan="11">ACCIONES</td>
				</tr>
				<tr><td colspan="12" >&nbsp;</td></tr>
			</table>
        </main>
    </body>
</html>