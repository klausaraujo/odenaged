function main(map) {
	
	$('#anio').on('change', function(){ table.search($(this).val()).draw(); });
	$('#mes').on('change', function(){ table.search($(this).val()).draw(); });
	//if(comp === 'undefined'){ this.api().search($("#anio").val()).draw(); this.api().search($("#mes").val()).draw(); }
	
	function ocultarElem(on){
		$('html, body').animate({ scrollTop: 0 }, 'fast');
		$('.error').each(function(){ let herm = $(this).prev(); if(herm.attr('name')){ $('#'+$(herm).attr('name')+'-error').remove(); } });
		if(on){
			loadData();
			if(!$('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 1) $('.ajaxForm').hide();
			if($('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 0) $('.ajaxTable').show();
			/*if($('#menu2').hasClass('active')){
				$('#menu2').removeClass('active');
				$('#menu1').addClass('active');
			}*/
		}else{
			if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
			if($('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 0) $('.ajaxForm').show();
		}
		if(!$('.ajaxMap').css('display') == 'none' || $('.ajaxMap').css('opacity') == 1) $('.ajaxMap').hide();
		if(!$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
		if(!$('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 1) $('.ajaxPreliminar').hide();
		if(!$('.ajaxComplementario').css('display') == 'none' || $('.ajaxComplementario').css('opacity') == 1) $('.ajaxComplementario').hide();
		$('#message').switchClass('succes', 'warn');
		$('#cargando').html('');
		$("#message").html('');
		//resetForm();
		resetPreliminar();
	}
	function resetForm(){ $("#formEvento")[0].reset();$("#formEvento select").prop('selectedIndex',0);$("#afecta").prop('checked',false); }
	
	function resetPreliminar(){
		$('#formInforme')[0].reset(); $('#formInforme select').each(function(){ $(this).prop('selectedIndex',0); });
		tableDanio.clear(); tableDanio.draw();
		tableAccion.clear(); tableAccion.draw();
		tableFotos.clear(); tableFotos.draw();
		tableIEF.clear(); tableIEF.draw();
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
			latitudsismo: { required: function () { if ($("#latitudsismo").css("display") != "none") return true; else return false; } },
			longitudsismo: { required: function () { if ($("#longitudsismo").css("display") != "none") return true; else return false; } },
			profundidad: { required: function () { if ($("#profundidad").css("display") != "none") return true; else return false; } },
			magnitud: { required: function () { if ($("#magnitud").css("display") != "none") return true; else return false; } },
			intensidad: { required: function () { if ($("#intensidad").css("display") != "none") return true; else return false; } },
			referencia: { required: function () { if ($("#referencia").css("display") != "none") return true; else return false; } },
			region: { required: function () { if ($("#region").css("display") != "none") return true; else return false; } },
			provincia: { required: function () { if ($("#provincia").css("display") != "none") return true; else return false; } },
			distrito: { required: function () { if ($("#distrito").css("display") != "none") return true; else return false; } },
			descripcion: { required: function () { if ($("#descripcion").css("display") != "none") return true; else return false; } },
			fuente: { required: function () { if ($("#fuente").css("display") != "none") return true; else return false; } },
		},
		messages: {
			tipoevento: { required : "Campo Requerido" },
			evento: { required : "Campo Requerido" },
			nivelevento: { required : "Campo Requerido" },
			fechaevento: { required : "Campo Requerido" },
			horaevento: { required : "Campo Requerido" },
			latitudsismo: { required : "Campo Requerido" },
			longitudsismo: { required : "Campo Requerido" },
			profundidad: { required : "Campo Requerido" },
			magnitud: { required : "Campo Requerido" },
			intensidad: { required : "Campo Requerido" },
			referencia: { required : "Campo Requerido" },
			region: { required : "Campo Requerido" },
			provincia: { required : "Campo Requerido" },
			distrito: { required : "Campo Requerido" },
			descripcion: { required : "Campo Requerido" },
			fuente: { required : "Campo Requerido" }
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
			//formData.set('descripcion',$('select[name="evento"] option:selected').text());
			formData.set('zoom', map.getZoom());
			
			/*var formData = new FormData(document.getElementById("formBrigadista"));
			formData.append("file", document.getElementById("file")); */
			$.ajax({
				data: formData,
				url: path + 'registrarEvento',
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
					//console.log(data);
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
            url: path + "cargarEvento",
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
	
	$('#distrito').change(function(){
		var id = $(this).val();
        var dpto = $("#region").val();
		var prov = $("#provincia").val();
        if (id.length > 0) {
          $.ajax({
            data: { dpto: dpto, prov: prov, dtto: id },
            url: path + "cargarLatLng",
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
		  url: path + 'eventosListar',
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
	
	function editarReg(edita, id){
		$.ajax({
		  type: 'POST',
		  url: path + 'editarEvento',
		  data: { id: id },
		  dataType: 'json',
		  success: function (response) {
			//if(!$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
			const { status } = response;
			if(status == 200){
				const { data } = response;
				const { eventos } = response;
				const { regiones : { prov } } = response;
				const { regiones : { dtto } } = response;
				resetForm();
				$('#tipo').val(edita);
				$('#idregistro').val(id);
				//const { form } = response;
				//console.log(response);
				$('#ctaevento').val(data.numero_evento);
				//$('.ajaxForm').html(form);
				$("#region option").each(function(){ if( $(this).val() == (data.ubigeo).substr(0,2) ){ $(this).prop("selected",true); } });
				$("#tipoevento option").each(function(){ if( $(this).val() == data.idtipoevento ){ $(this).prop("selected",true); }});
				$("#nivelevento option").each(function(){ if( $(this).val() == data.idnivel ){ $(this).prop("selected",true); }});
				$("#fechaevento").val((data.fecha).substring(0,10));
				$("#horaevento").val((data.fecha).slice(-8));
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
				$('#latitudsismo').val(data.latitud_sismo);
				$('#longitudsismo').val(data.longitud_sismo);
				$('#profundidad').val(data.profundidad_sismo);
				$('#magnitud').val(data.magnitud_sismo);
				$('#intensidad').val(data.intensidad_sismo);
				$('#referencia').val(data.referencia_sismo);
				$('#descripcion').val(data.descripcion);
				$('#fuente').val(data.referencia_sismo);
				$('#lat').val(data.latitud);
				$('#lng').val(data.longitud);
				$('#fuente').val(data.fuente_inicial);
				if(data.afecta_sector == '1')$("#afecta").prop('checked',true);
				
				var opt = {lat: parseFloat(data.latitud), lng: parseFloat(data.longitud), zoom: parseInt(data.zoom)};
				map.setCenter(opt);
				//console.log(map.getZoom());
				
				ocultarElem(false);
				if($('.ajaxMap').css('display') == 'none' || $('.ajaxMap').css('opacity') == 0) $('.ajaxMap').show();
				if(data.evento == 'SISMO')if($('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 0) $('.sismo').show();
			}
			//loadData;
		  }
		});
	}
	
	function informe(id,ub,dpto,pro,dis,v){
		$.ajax({
            data: { idevento: id, ubigeo: ub, version: v },
            url: path + "buscaPreliminar",
            method: "POST",
            dataType: "json",
            beforeSend: function () {},
            success: function (data) {
				//console.log(data);
				const { danio } = data;
				const { accion } = data;
				const { fotos } = data;
				const { ies } = data;
				const { url } = data;
				const { iesUB } = data;
				const { activo } = data;
				console.log(activo.activo);
				$('#formInforme button').each(function(i,e){
					//if($(this).prop('id') !== 'btnCancelPrel') $(this).text('Retornar');
					if(activo.activo == '0'){
						var el = $(this).prop('nodeName');
						if(el == 'BUTTON'){ if($(this).prop('id') !== 'btnCancelPrel') $(this).prop('disabled',true); }
						//console.log($(this).prop('disabled'));
					
					}else{ if($(this).prop('disabled')) $(this).prop('disabled',false); }
				});
				
				tableDanio.clear(); if(danio.length > 0) tableDanio.rows.add(JSON.parse(danio)).draw();
				tableAccion.clear(); if(accion.length > 0) tableAccion.rows.add(JSON.parse(accion)).draw();
				tableIEF.clear(); if(ies.length > 0) tableIEF.rows.add(JSON.parse(ies)).draw();
				tableFotos.clear();
				if(fotos.length > 0){
					let json = [];
					let row = JSON.parse(fotos);
					row.forEach(function(col){
						json.push({ 'version':col.version,'fotografia':col.fotografia,'descripcion':col.descripcion,'foto':URI+url+col.fotografia,
							'idusuario_apertura':col.idusuario_apertura,'fecha_apertura':col.fecha_apertura });
					});
					tableFotos.rows.add(json).draw();
				}
				tableIEUbigeo.clear(); if(iesUB.length > 0) tableIEUbigeo.rows.add(JSON.parse(iesUB)).draw();
				$('#dpto').html('<option " selected>' + dpto + '</option>');
				$('#prov').html('<option " selected>' + pro + '</option>');
				$('#dist').html('<option " selected>' + dis + '</option>');
				//console.log(iesUB);
				if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
				if($('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 0) $('.ajaxPreliminar').show();
			}
        });
	}
	
	table.on('click', 'button', function(){
		//console.log(table.row($(this).parents("tr")).data());
		//table.row($(this).parents("tr")).deselect();
		var data = [];
		(table.row(this).child.isShown())? data = table.row(this).data() : data = table.row($(this).parents("tr")).data();
		
		if($(this).hasClass('actionEdit')){editarReg('editar',data.idregistroevento);}
		if($(this).hasClass('actionInforme')){
			resetPreliminar();
			$('#formInforme .iq-header-title h4').html('Datos Preliminares de la Emergencia');
			$('#informe').val('');
			/*if(!$('#nav-tab a:first').hasClass('active'))$('#nav-tab a:first').addClass('active');
			$('#nav-danios').show();
			$("#nav-tab a:first").tab('show');*/
			//$('#nav-tab:visible:first a').tab('show');
			$('#idregevento').val(data.idregistroevento);
			$('#version').val(0);
			informe(data.idregistroevento,data.ubigeo,data.departamento,data.provincia,data.distrito,0);
		}
		if($(this).hasClass('actionReport')){window.open('informe?id='+data.idregistroevento+'&version=0', "_blank");}
		if($(this).hasClass('actionComp')){
			$('#tipoEvtComp').val(data.tipo_evento);
			$('#evtComp').val(data.evento);
			$('#ubdesComp').val(data.ubigeo_descripcion);
			$('#fechaComp').val(data.fecha+' '+data.hora);
			$('#idregComp').val(data.idregistroevento);
			$('#ubigeoComp').val(data.ubigeo);
			$('#dptoComp').val(data.departamento);
			$('#provComp').val(data.provincia);
			$('#dttoComp').val(data.distrito);
			$.ajax({
				data: { idevento: data.idregistroevento },
				url: path + "buscaVersion",
				method: "POST",
				dataType: "json",
				beforeSend: function () {},
				success: function (data) {
					console.log(data);
					const { versiones } = data;
					const { max } = data;
					
					$('#versionComp').val(max);
					tabComp.clear(); if(versiones.length > 0) tabComp.rows.add(versiones).draw(); else tabComp.draw();
				}
			});
			setTimeout(function () {
				if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
				if($('.ajaxComplementario').css('display') == 'none' || $('.ajaxComplementario').css('opacity') == 0) $('.ajaxComplementario').show();
			}, 500);
		}
	});
	
	$(document).ready(function () {
		$('.iq-menu li #linkAjax').each(function() {
			$(this).on('click',function(evt) {
				var rel= $(this).attr('rel');
				evt.preventDefault();
				if(rel == 'nuevo'){
					resetForm();
					$('#tipo').val('registrar');
					ocultarElem(false);
				}else if(rel !== 'nuevo' && rel != null){
					ocultarElem(true);
					resetForm();
				}
			});
		});
	});
}