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
	
	$('#region').change(function(){
		var id = $(this).val();
        if (id.length > 0) {
    
          $.ajax({
            data: { region: id },
            url: URI + "eventos/main/cargarprov",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $("#provincia").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				console.log(data);
              var $html = '<option value="">--Seleccione--</option>';
              $.each(data.lista, function (i, e) {
    
                $html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>';
    
              });
              $("#provincia").html($html);
    
            }
          });
    
        }
    });
	
	$('#provincia').change(function(){
		var id = $(this).val();
        var departamento = $("#region").val();
        if (id.length > 0) {
    
          $.ajax({
            data: { region: departamento, provincia: id },
            url: URI + "eventos/main/cargardis",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $("#distrito").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				console.log(data);
              var $html = '<option value="">--Seleccione--</option>';
              $.each(data.lista, function (i, e) {
    
                $html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
    
              });
              $("#distrito").html($html);
    
            }
          });
    
        }
    });
}