let tablaFichas = null, botones = '<"row"<"col-sm-12 mb-2"B><"col-sm-6 float-left"l><"col-sm-6 float-right"f>rt>ip';

$(document).ready(function () {
	if($('#tablaFichas')){ tablaFichas = $('#tablaFichas').DataTable({
		bDestroy: true,
		responsive: true,
		lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
		dom: botones,
		buttons: {
			dom: {
			  container: {
				tag: 'div',
				className: 'flexcontent'
			  },
			  buttonLiner: {
				tag: null,
				className: 'btn-sirese'
			  }
			},
			buttons: [
				{ extend: 'copy', className: 'btn-sirese' },
				{ extend: 'csv', className: 'btn-sirese' },
				{ extend: 'excel', className: 'btn-sirese' },
				{ extend: 'pdf', className: 'btn-sirese' },
				{ extend: 'print', className: 'btn-sirese' },
				/*{ text: 'per', className: 'btn btn-danger' },*/
				/*{'csv'},{'excel'},{'pdf'},{'print'},*/
			]
		},
	});
	$('#tablaFichas').show(); }
});
