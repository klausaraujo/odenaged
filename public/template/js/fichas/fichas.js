let tablaFichas = null, botones = '<"row"<"col-sm-12 mb-2"B><"col-sm-6 float-left"l><"col-sm-6 float-right"f>rt>ip';
$('body').on('click','a, button',function(e){
	if($(this).attr('rel') && $(this).attr('rel') === 'fichas'){ resetForm(); ocultar(false); }
	else if($(this).attr('rel') && $(this).attr('rel') === 'nuevaficha'){ resetForm(); ocultar(true); }
});

function ocultar(on){
	$('html, body').animate({ scrollTop: 0 }, 'fast');
	$('.error').each(function(){ let herm = $(this).prev(); if(herm.attr('name')){ $('#'+$(herm).attr('name')+'-error').remove(); } });
	if(on){
		if(!$('.ajaxFichas').css('display') == 'none' || $('.ajaxFichas').css('opacity') == 1) $('.ajaxFichas').hide();
		if($('.ajaxNuevoFichas').css('display') == 'none' || $('.ajaxNuevoFichas').css('opacity') == 0) $('.ajaxNuevoFichas').show();
	}else{
		if(!$('.ajaxNuevoFichas').css('display') == 'none' || $('.ajaxNuevoFichas').css('opacity') == 1) $('.ajaxNuevoFichas').hide();
		if($('.ajaxFichas').css('display') == 'none' || $('.ajaxFichas').css('opacity') == 0) $('.ajaxFichas').show();
		//$('.active').removeClass('active');
	}
}
	
	function resetForm(){ $("#formFichas")[0].reset();$("#formFichas select").prop('selectedIndex',0); }


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
				/*{ text: 'per', className: 'btn btn-danger' },
				{'csv'},{'excel'},{'pdf'},{'print'},*/
			]
		},
	});
	$('#tablaFichas').show(); }
});
