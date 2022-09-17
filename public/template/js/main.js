$(document).ready(function () {
	$('.region').change(function(){
		var id = $(this).val();
        if (id.length > 0) {
          $.ajax({
            data: { region: id },
            url: URI + "cargarprov",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
				$(".distrito").html('<option value="">--Seleccione--</option>');
				$(".provincia").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>';
				});
				$(".provincia").html($html);
            }
          });
    
        }
    });
	
	$('.provincia').change(function(){
		var id = $(this).val();
        var departamento = $(".region").val();
        if (id.length > 0) {
          $.ajax({
            data: { region: departamento, provincia: id },
            url: URI + "cargardis",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $(".distrito").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
				});
				$(".distrito").html($html);
            }
          });
    
        }
    });
	
	$('.tipoevento').change(function(){
		var val = $(this).val();
        if (val.length > 0) {
          $.ajax({
            data: { tipo: val },
            url: 'evtbytipo',
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $(".eventotipo").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data, function (i, e) {
					$html += '<option value="' + e.idevento + '">' + e.evento + '</option>';
				});
				$(".eventotipo").html($html);
            }
          });
    
        }
    });
});