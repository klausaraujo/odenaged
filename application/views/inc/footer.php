<script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
<script src="<?=base_url()?>public/template/js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
<script src="<?=base_url()?>public/template/js/wow.min.js"></script>
<script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
<script src="<?=base_url()?>public/template/js/slick.min.js"></script>
<script src="<?=base_url()?>public/template/js/select2.min.js"></script>
<script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
<script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
<script src="<?=base_url()?>public/template/js/custom.js"></script>
<script src="<?=base_url()?>public/template/js/jquery.validate.min.js"></script>

<script>
    var languageDatatable = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copyTitle": 'Informacion copiada',
        "copyKeys": 'Use your keyboard or menu to select the copy command',
        "copySuccess": {
            "_": '%d filas copiadas al portapapeles',
            "1": '1 fila copiada al portapapeles'
        },

        "pageLength": {
        "_": "Mostrar %d filas",
        "-1": "Mostrar Todo"
        }
    }
};
</script>
<!-- JS DataTable -->
<script src="<?=base_url()?>public/template/js/table/datatable/datatables.min.js"></script>
<script src="<?=base_url()?>public/template/js/table/datatable/jszip.min.js"></script>
<script src="<?=base_url()?>public/template/js/table/datatable/pdfmake.min.js"></script>
<script src="<?=base_url()?>public/template/js/table/datatable/vfs_fonts.js"></script>
<script src="<?=base_url()?>public/template/js/table/table.js"></script>

<?	if(isset($eventos)){	?>
		<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?='AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc'?>&libraries=places&v=weekly" async></script>
		<script src="<?=base_url()?>public/template/js/mapa/map.js"></script>
		<script src="<?=base_url()?>public/template/js/eventos/eventos.js"></script>
		<script src="<?=base_url()?>public/template/js/eventos/main.js"></script>
		<script src="<?=base_url()?>public/template/js/table/tableComp.js"></script>
		<script src="<?=base_url()?>public/template/js/table/tableIE.js"></script>
		<!--<script src="<?=base_url()?>public/template/js/dropzone/dropzone.js"></script>
		<script src="<?=base_url()?>public/template/js/dropzone/5x5jqpi.min.js"></script>-->
		<script>
			const lista = JSON.parse('<?=$lista?>');
			const URI = '<?=$url?>';
			const path = '<?=$uri?>';
			const datos = [];
			const headers = [{'anio_evento':'A&ntilde;o','numero_evento':'nro. evento','nivel':'nivel','tipo_evento':'tipo evento','ubigeo_descripcion':'ubigeo','estado':'estado'}];
			const danio = [{'tipo_danio':'tipo da&ntilde;o','cantidad':'cantidad'}];
			const accion = [{'tipo_accion':'tipo accion','descripcion':'descripcion','fecha':'fecha'}];
			const foto = [{'fotografia':'fotografia','descripcion':'descripcion'}];
			const ie = [{'CEN_EDU':'inst. educativa','descripcion':'descripcion','fecha':'fecha'}];
			const ieUB = [{'CEN_EDU':'institucion educativa','COD_MOD':'cod. mod','CODLOCAL':'cod. local','D_NIV_MOD':'nivel'}];
			const table = tablePersonalized('#tablaEvento',headers,lista);
			const tableDanio = tableComp('#tableDanio',danio,datos);
			const tableAccion = tableComp('#tableAccion',accion,datos);
			const tableFotos = tableComp('#tableFotos',foto,datos,'foto');
			const tableIEF = tableComp('#tableIE',ie,datos);
			const tableIEUbigeo = tableIE('#tableIEUbigeo',ieUB,datos);
			
			window.onload = function(){
				var opt = {lat: 42.1382114, lng: -71.5212585,zoom: 16};
				$('.ajaxMap').hide();
				main(mapa(opt));
				eventos();
				//dropzone();
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
			function mayus(e){e.value = e.value.toUpperCase();}
			/*$(function(){
				$("#uploader").initUploader({
                    //selectOpts:{one:'jquery',two:'script',three:'net'},
                    showDescription: true,
                });
            });*/
		</script>
<?	}	?>