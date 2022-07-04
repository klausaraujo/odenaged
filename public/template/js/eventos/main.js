function main(URI) {
	$(document).ready(function () {
		$('.iq-menu li #linkAjax').each(function() {
			$(this).on('click',function(evt) {
				var rel= $(this).attr('rel');
				evt.preventDefault();
				if(rel == 'nuevo'){
					$(".modal-title").html('Datos Generales de la Emergencia');
					$("#decisionModal").modal("show");
					$("#decisionModal").css("padding-right", "0px");
				}else if(rel !== 'nuevo'){
					alert(rel);
				}
			});
		});
	});
}