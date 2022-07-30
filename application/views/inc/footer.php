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
		<script src="<?=base_url()?>public/template/js/dropzone/dropzone.js"></script>
		<script>
			/*const canDelete = "1";
			const canEdit = "1";
			const canIdioma = "1";
			const canTracking = "1";
			const canHistory = "1";*/
			//const URI = "<?//=base_url()?>";
			const lista = JSON.parse('<?=$lista?>');
			const URI = '<?=$url?>';
			const table = tablePersonalized('#tablaEvento',lista,'evento');
			//const danios = ;
			//const acciones = ;
			//const galeria = ;
			const datos = [];
			const tableDanio = tableComp('#tableDanio',[{'idtipodanio':'','cantidad':''}],datos);
			const tableAccion = tableComp('#tableAccion',[{'idtipoaccion':'','descripcion':'','fecha':'','hora':''}],datos);
			const tableFotos = tableComp('#tableFotos',[{'fotografia':'','descripcion':''}],datos,'foto');
			const tableIE = tableComp('#tableIE',[{'institucion':'','cod_M':'','cod_L':'','nivel':'','descripcion':'','fecha':''}],datos);
			const tableIEUbigeo = tableComp('#tableIEUbigeo',[{'codigo':'','nombre':'','clasificacion':''}],datos);
			
			window.onload = function(){
				var opt = {lat: 42.1382114, lng: -71.5212585,zoom: 16};
				$('.ajaxMap').hide();
				main(mapa(opt));
				eventos();
				dropzone();
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
		</script>
<?	}	?>