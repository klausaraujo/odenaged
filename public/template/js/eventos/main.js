function main(map) {
	
	$(document).ready(function () {
		$('#menu1').addClass('active');
		
		$('.iq-menu li #linkAjax').each(function() {
			$(this).on('click',function(evt) {
				var rel= $(this).attr('rel');
				evt.preventDefault();
				if(rel == 'nuevo'){
					/*$(".modal-title").html('Datos Generales de la Emergencia');
					$("#decisionModal").modal("show");
					$("#decisionModal").css("padding-right", "0px");*/
					resetForm();
					$('#tipo').val('registrar');
					ocultarElem(false);
				}else if(rel !== 'nuevo' && rel != null){
					//console.log(rel);
					ocultarElem(true);
					resetForm();
				}
			});
		});
	});
	
	function ocultarElem(on){
		$('html, body').animate({ scrollTop: 0 }, 'fast');
		$('.error').each(function(){ let herm = $(this).prev(); if(herm.attr('name')){ $('#'+$(herm).attr('name')+'-error').remove(); } });
		if(on){
			loadData();
			if(!$('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 1) $('.ajaxForm').hide();
			if($('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 0) $('.ajaxTable').show();
			if($('#menu2').hasClass('active')){
				$('#menu2').removeClass('active');
				$('#menu1').addClass('active');
			}
		}else{
			if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
			if($('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 0) $('.ajaxForm').show();
			/*if($('#menu1').hasClass('active')){
				$('#menu1').removeClass('active');
				$('#menu2').addClass('active');
			}*/
		}
		if(!$('.ajaxMap').css('display') == 'none' || $('.ajaxMap').css('opacity') == 1) $('.ajaxMap').hide();
		if(!$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
		if(!$('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 1) $('.ajaxPreliminar').hide();
		$('#message').switchClass('succes', 'warn');
		$('#cargando').html('');
		$("#message").html('');
	}
	function resetForm(){
		$("#formEvento")[0].reset();$("#formEvento select").prop('selectedIndex',0);//('#blah').attr('src',URI+'public/template/images/camera.png')
	}
	
	$("#btnEditar").on('click', function(evt){
		evt.preventDefault();
		
	});
	
	$("#btnCancelar").on('click', function(evt){
		evt.preventDefault();
		ocultarElem(true);
	});
	
	$("#formEvento").validate({
		rules: {
			tipoevento: { required: function () { if ($("#tipoevento").css("display") != "none") return true; else return false; } },
			evento: { required: function () { if ($("#evento").css("display") != "none") return true; else return false; } },
			nivelevento: { required: function () { if ($("#nivelevento").css("display") != "none") return true; else return false; } },
			fechaevento: { required: function () { if ($("#fechaevento").css("display") != "none") return true; else return false; } },
			horaevento: { required: function () { if ($("#horaevento").css("display") != "none") return true; else return false; } },
			region: { required: function () { if ($("#region").css("display") != "none") return true; else return false; } },
			provincia: { required: function () { if ($("#provincia").css("display") != "none") return true; else return false; } },
			distrito: { required: function () { if ($("#distrito").css("display") != "none") return true; else return false; } },
		},
		messages: {
			tipoevento: { required : "Campo Requerido" },
			evento: { required : "Campo Requerido" },
			nivelevento: { required : "Campo Requerido" },
			fechaevento: { required : "Campo Requerido" },
			horaevento: { required : "Campo Requerido" },
			region: { required : "Campo Requerido" },
			provincia: { required : "Campo Requerido" },
			distrito: { required : "Campo Requerido" }
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "documento_numero") {
				error.insertAfter("#error_numero_documento");
			}
			else if (element.attr("name") == "fecha_nacimiento") {
				error.insertAfter("#error_fecha_nacimiento");
			}
			else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form, event) {
			event.preventDefault();
			var formData = new FormData(document.querySelector('form'));
			//console.log(formData.get('fechaevento'));
			/*for (var [key, value] of formData.entries()) { 
			  console.log(key, value);
			}*/
			formData.set('afecta',$("#afecta").is(':checked')? 1 : 0);
			formData.set('anio',($("#fechaevento").val()).substring(0,4));
			formData.set('ubigeo',$("#region").val() + $("#provincia").val() + $("#distrito").val());
			formData.set('descripcion',$('select[name="evento"] option:selected').text());
			formData.set('zoom', map.getZoom());
			
			/*var formData = new FormData(document.getElementById("formBrigadista"));
			formData.append("file", document.getElementById("file")); */
			$.ajax({
				data: formData,
				url: URI + 'registrarEvento',
				method: "POST",
				dataType: "json",
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#cargando").html("<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i>");/*fa-spinner,fa-circle-o-notch,fa-refresh,fa-cog,fa-spinner fa-pulse*/
					$("#message").hide(); $('#cargando').show();
				},
				success: function (data) {
					console.log(data);
					var $message = "";
					//$('#message').switchClass('succes', 'warn');
					
					if (parseInt(data.status) == 200){ $('#message').switchClass('warn', 'succes'); $message = 'Evento registrado exitosamente'; }
					else { $message = 'No se pudo registrar el Evento'; }
					
					setTimeout(function () { $('#cargando').hide(); $("#message").html($message); $("#message").show() }, 300);
					if (parseInt(data.status) == 200){
						setTimeout(function () {
							ocultarElem(true);
						}, 1000);
					}
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				// Un callback .fail()
				setTimeout(function () { $('#cargando').hide(); $("#message").html(/*jqXHR + ",  " +*/ textStatus.toUpperCase() + ":  " + errorThrown); $("#message").show()}, 500);
			});
		}
	});
	
	
	$('#tipoevento').change(function(){
		var id = $(this).val();
        if (id.length > 0) {
          $.ajax({
            data: { tipo: id },
            url: URI + "cargarEvento",
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
            url: URI + "cargarprov",
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
            url: URI + "cargardis",
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
            url: URI + "cargarLatLng",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              //$("#distrito").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				//console.log(data);
				const {ubigeo} = data;
				var opt = {lat: parseFloat(ubigeo[0].latitud), lng: parseFloat(ubigeo[0].longitud), zoom: 16};
				//console.log(map.getZoom());
				map.setCenter(opt);
				if($('.ajaxMap').css('display') == 'none' || $('.ajaxMap').css('opacity') == 0) $('.ajaxMap').show();
            }
          });
        }
    });
	
	$('#evento').change(function(){
		var id = $(this).val();
		var txt = $(this).find(":selected").text()
		if(txt == 'SISMO'){
			if($('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 0) $('.sismo').show();
		}else{
			if(!$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
		}
    });
	
	function loadData() {
		$.ajax({
		  type: 'POST',
		  url: URI + 'eventosListar',
		  data: {},
		  dataType: 'json',
		  success: function (response) {
			const { data: { lista } } = response;
			//console.log(response);
			//console.log(lista);
			table.clear();
			table.rows.add(lista).draw();
		  }
		});
	}
	
	function editarReg(edita, data){
		$('#tipo').val('editar');
		$.ajax({
		  type: 'POST',
		  url: URI + 'editarEvento',
		  data: {data: data, segmento: edita},
		  dataType: 'json',
		  success: function (response) {
			//if(!$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
			const { status } = response;
			if(status == 200){
				const { data } = response;
				const { eventos } = response;
				const { regiones : { prov } } = response;
				const { regiones : { dtto } } = response;
				//const { form } = response;
				console.log(response);
				//$('.ajaxForm').html(form);
				$("#region option").each(function(){ if( $(this).val() == (data.ubigeo).substr(0,2) ){ $(this).prop("selected",true); } });
				$("#tipoevento option").each(function(){ if( $(this).val() == data.idtipoevento ){ $(this).prop("selected",true); }});
				$("#nivelevento option").each(function(){ if( $(this).val() == data.idnivel ){ $(this).prop("selected",true); }});
				$("#fechaevento").val((data.fecha).substring(0,10));
				$("#horaevento").val((data.fecha).slice(-8));
				if(data.afecta_sector == '1')$("#afecta").attr('checked',true);
				var html = '<option value="">-- Seleccione --</option>';
				prov.forEach(function(row){
					if(row.cod_pro == (data.ubigeo).substr(2,2)){
						html += '<option value="' + row.cod_pro + '" selected>' + row.provincia + '</option>';
					}else
						html += '<option value="' + row.cod_pro + '">' + row.provincia + '</option>';
				});
				$("#provincia").html(html);
				html = '<option value="">-- Seleccione --</option>';
				dtto.forEach(function(row){
					if(row.cod_dis == (data.ubigeo).substr(4,2)){
						html += '<option value="' + row.cod_dis + '" selected>' + row.distrito + '</option>';
					}else
						html += '<option value="' + row.cod_dis + '">' + row.distrito + '</option>';
				});
				$("#distrito").html(html);
				html = '<option value="">-- Seleccione --</option>';
				eventos.forEach(function(row){
					if(row.idevento == data.idevento){
						html += '<option value="' + row.idevento + '" selected>' + row.evento + '</option>';
					}else
						html += '<option value="' + row.idevento + '">' + row.evento + '</option>';
				});
				$("#evento").html(html);
				$('#lat').val(data.latitud);
				$('#lng').val(data.longitud);
				
				var opt = {lat: parseFloat(data.latitud), lng: parseFloat(data.longitud), zoom: 16};
				//console.log(map.getZoom());
				map.setCenter(opt);
				
				ocultarElem(false);
				if($('.ajaxMap').css('display') == 'none' || $('.ajaxMap').css('opacity') == 0) $('.ajaxMap').show();
				if(eventos.evento == 'SISMO')if($('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 0) $('.sismo').show();
			}
			//loadData;
		  }
		});
	}
	
	function informe(id){
		$.ajax({
            data: { idevento: id },
            url: URI + "buscaPreliminar",
            method: "POST",
            dataType: "json",
            beforeSend: function () {},
            success: function (data) {
				console.log(data);
				const { danio } = data;
				const { accion } = data;
				const { fotos } = data;
				tableDanio.clear(); if(!danio.length === 0) tableDanio.rows.add(danio).draw();
				tableAccion.clear(); if(!accion.length === 0) tableAccion.rows.add(accion).draw();
				tableFotos.clear(); if(!fotos.length === 0) tableFotos.rows.add(fotos).draw();
			}
        });
	}
	
	table.on('click', 'button', function(){
		//console.log(table.row($(this).parents("tr")).data());
		//table.row($(this).parents("tr")).deselect();
		if(table.row(this).child.isShown()){
			var data = table.row(this).data();
			//console.log(data);
		}else{
			var data = table.row($(this).parents("tr")).data();
		}
		if($(this).hasClass('actionEdit'))editarReg('editar',data.idevento);
		if($(this).hasClass('actionInforme')){
			informe(data.idevento);
			$('#idregevento').val(data.idevento);
			if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
			if($('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 0) $('.ajaxPreliminar').show();
		}
	});
}