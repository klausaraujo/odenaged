function main(URI) {
	$(document).ready(function () {
		$('.iq-menu li #linkAjax').each(function() {
			$(this).on('click',function(evt) {
				var rel= $(this).attr('rel');
				evt.preventDefault();
				if(rel == 'nuevo'){
					/*$(".modal-title").html('Datos Generales de la Emergencia');
					$("#decisionModal").modal("show");
					$("#decisionModal").css("padding-right", "0px");*/
					/*if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
					if($('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 0) $('.ajaxForm').show();*/
				}else if(rel !== 'nuevo' && rel != null){
					//console.log(rel);
					//loadData();
					/*if(!$('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 1) $('.ajaxForm').hide();
					if($('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 0) $('.ajaxTable').show();*/
				}
			});
		});
	});
	
	$("#btnEnviar").on('click', function(evt){
		evt.preventDefault();
		var anio = $("#fechaevento").val();
		alert(anio.substring(0,4));
	});
	
	
	$('#tipoevento').change(function(){
		var id = $(this).val();
        if (id.length > 0) {
          $.ajax({
            data: { tipo: id },
            url: URI + "eventos/main/cargarEvento",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
				$("#evento").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.idevento + '">' + e.evento + '</option>';
				});
              $("#evento").html($html);
            }
          });
        }
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
				$("#distrito").html('<option value="">--Seleccione--</option>');
				$("#provincia").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
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
				//console.log(data);
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
				});
				$("#distrito").html($html);
            }
          });
    
        }
    });
	$('#distrito').change(function(){
		var id = $(this).val();
        var dpto = $("#region").val();
		var prov = $("#provincia").val();
        if (id.length > 0) {
          $.ajax({
            data: { dpto: dpto, prov: prov, dtto: id },
            url: URI + "eventos/main/cargarLatLng",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              //$("#distrito").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				const {ubigeo} = data;
				var opt ={
					lat : parseFloat(ubigeo[0].latitud),
					lng : parseFloat(ubigeo[0].longitud),
					zoom : 15,
				}
				//console.log(opt);
				mapa(opt);
              /*var $html = '<option value="">--Seleccione--</option>';
              $.each(data.lista, function (i, e) {
    
                $html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
    
              });
              $("#distrito").html($html);*/
            }
          });
        }
    });
	
	
}