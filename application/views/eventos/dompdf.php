<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** 
                Márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Márgenes reales de cada página en el PDF **/
			body {
				margin: 50pt 15pt;
			}
            /*body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }*/

            /** Reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
        </style>
    </head>
    <body>
        <!-- Bloques de encabezado y pie de página -->
        <header>
            <img src="<?=base_url()?>public/encabezado.jpg" width="60%" style="margin:5pt" />
        </header>

        <footer>
            <img src="<?=base_url()?>public/encabezado.jpg" width="60%" style="margin-left:5pt" />
        </footer>

        <!-- Contenido -->
        <main>
			<br><br>
			<table>
				<tr bgcolor=red ><td rowspan=2 >Hello</td><td colspan=2 >Hello</td><td>Hello</td>
				<td rowspan=2 >Hello</td><td colspan=2 >Hello</td><td>Hello</td>
					<td rowspan=2 >Hello</td><td colspan=2 >Hello</td><td>Hello</td>
				<td rowspan=2 >Hello</td><td colspan=2 >Hello</td><td>Hello</td></tr>
				<tr><td>Hello</td><td>Hello</td><td>Hello</td></tr>
			</table>
        </main>
    </body>
</html>