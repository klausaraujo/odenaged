function main(){
	let upload = $('.upload-button'), file = $('.file-upload'), contSrc = $(".profile-pic"), curl = $('.btn_curl'), tablaUsuarios;
	//function quitaFolder(){ $('.jstree-themeicon').attr('class',''); }
	
	$('body').on('click dblclick', 'input, button, a, i', function(e){
		var elementType = $(this).prop('nodeName');
		if($(this).attr('rel') && $(this).attr('rel') === 'nuevousuario'){ resetForm(); ocultar(true); }
		else if($(this).attr('name') === 'btnCancelar'){ let evt = e || e.target; evt.preventDefault(); resetForm(); ocultar(false); }
		else if($(this).hasClass('loading')){
			let ul = $(this).closest('li').children('ul');
			if(ul.length === 0){
				let el = $(this).closest('li'), id = el.attr('id'), tree = $(this).attr('data-tree'), p = $(this), chek = $(this).next();
				$.ajax({
					type: 'POST',
					url: path + 'buscaDRE',
					data: { id:id, tree:tree, check:(chek.hasClass('checked'))? 1 : 0 },
					dataType: 'json',
					success: function (data){
						const { tree } = data; el.find('.niveles').remove(); el.append(tree); p.prop('class','collapsible colap');
					}
				}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
			}
		};
	});
	
	function ocultar(on){
		$('html, body').animate({ scrollTop: 0 }, 'fast');
		if(on){
			if(!$('.tablaUsuario').css('display') == 'none' || $('.tablaUsuario').css('opacity') == 1) $('.tablaUsuario').hide();
			if($('.nuevoAjax').css('display') == 'none' || $('.nuevoAjax').css('opacity') == 0) $('.nuevoAjax').show();
			$('.tituloUsers h4').html('Registrar Nuevo Usuario');
		}else{
			if(!$('.nuevoAjax').css('display') == 'none' || $('.nuevoAjax').css('opacity') == 1) $('.nuevoAjax').hide();
			if($('.tablaUsuario').css('display') == 'none' || $('.tablaUsuario').css('opacity') == 0) $('.tablaUsuario').show();
			$('.tituloUsers h4').html('Gesti&oacute;n de Usuarios');
			$('.active').removeClass('active');
		}
	}
	
	function resetForm(){ $("#formUsuarios")[0].reset();$("#formUsuarios select").prop('selectedIndex',0); }
	
	$('#btnPermisos').bind('click', function(e){
		/*let evt = e || e.target;
		evt.preventDefault();*/
		let dep = $('.dep').children('.checkbox'), dre = $('.dre').children('.checkbox'), ugel = $('.ugel').children('.checkbox'), prov = $('.prov').children('.checkbox');
		let dptos = [], dres = [], ugels = [], provs = [], i = 0, idusuario = $('#idusuarioPermiso').val();
		
		if(dep.length > 0){ dep.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked')){ dptos[i] = $(this).attr('data-check'); i++; } }); }
		if(dre.length > 0){ i= 0; dre.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked')){ dres[i] = $(this).attr('data-check'); i++; } }); }
		if(ugel.length > 0){ i= 0; ugel.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked')){ ugels[i] = $(this).attr('data-check'); i++; } }); }
		if(prov.length > 0){ i= 0; prov.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked')){ provs[i] = $(this).attr('data-check'); i++; } }); }
		
		console.log(dptos+'  '+dres+'  '+ugels+'  '+provs);
		
		if(dptos.length > 0 || dres.length > 0 || ugels.length > 0 || provs.length > 0){
			dptos = JSON.stringify(dptos); dres = JSON.stringify(dres); ugels = JSON.stringify(ugels); provs = JSON.stringify(provs);
			$.ajax({
				type: 'POST',
				url: path + 'permisos',
				data: {dptos:dptos,dres:dres,ugels:ugels,provs:provs,idusuario:idusuario},
				dataType: 'json',
				success: function (data) {
					console.log(data);
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
		}
	});
	
	$('#permisosModal').on('show.bs.modal',function(e){
		let evt = e || e.target, boton = $(evt.relatedTarget), tab = boton.closest('table').attr('id');
		let idusuario = $('#'+tab).dataTable().api().row($(boton).parents("tr")).data()[1];
		//console.log());
		//console.log(tab.row($(boton).parents("tr")).data());
		$.ajax({
			type: 'POST',
			url: path + 'buscaRegion',
			data: {idusuario:idusuario},
			dataType: 'json',
			success: function (data) { const { tree } = data; $('#jstree').html(tree); $('#idusuarioPermiso').val(idusuario); $('#jstree').animate({ scrollTop: 0 }, 'fast'); }
		}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
	});
	
	$("#formUsuarios").validate({
		rules: {
			usuario: { required: function () { if ($("#usuario").css("display") != "none") return true; else return false; } },
			dni: { required: function () { if ($("#dni").css("display") != "none") return true; else return false; } },
			apellidos: { required: function () { if ($("#nivelevento").css("display") != "none") return true; else return false; } },
			nombres: { required: function () { if ($("#fechaevento").css("display") != "none") return true; else return false; } },
		},
		messages: {
			usuario: { required : "Campo Requerido" },
			dni: { required : "Campo Requerido" },
			apellidos: { required : "Campo Requerido" },
			nombres: { required : "Campo Requerido" },
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "dni") {
				error.insertAfter(".group-dni");
			}else error.insertAfter(element);
		},
		/*submitHandler: function (form, event) {
			event.preventDefault();
			var formData = new FormData(document.querySelector('form'));
			/*formData.set('afecta',$("#afecta").is(':checked')? 1 : 0);
			formData.set('anio',($("#fechaevento").val()).substring(0,4));
			formData.set('ubigeo',$("#region").val() + $("#provincia").val() + $("#distrito").val());
			
			$.ajax({
				data: formData,
				url: path + 'regusuario',
				method: "POST",
				dataType: "json",
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					/*$("#cargando").html("<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i>");/*fa-spinner,fa-circle-o-notch,fa-refresh,fa-cog,fa-spinner fa-pulse
					$("#message").hide(); $('#cargando').show();
				},
				success: function (data) {
					console.log(data);
					/*var $message = "";
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
				//setTimeout(function () { $('#cargando').hide(); $("#message").html(/*jqXHR + ",  " + textStatus.toUpperCase() + ":  " + errorThrown); $("#message").show()}, 500);
				console.log(data);
			});
		}*/
	});
	
	upload.bind('click',function(e){ file.trigger('click'); });
	
	curl.bind('click',function(){
		let dni = $('#dni').val();
		if(dni !== ''){
			if(dni.length === 8){
				$.ajax({
					data: {type: '01',dni: $('#dni').val()},
					url: path + 'curl',
					method: "POST",
					dataType: "json",
					beforeSend: function () { curl.html('<i class="fa fa-spinner fa-pulse"></i>'); },
					success: function (data) {
						curl.html('<i class="fa fa-search aria-hidden="true"></i>');
						$('#apellidos').val(data.data.attributes.apellido_paterno+' '+data.data.attributes.apellido_materno);
						$('#nombres').val(data.data.attributes.nombres);
					}
				}).fail( function( jqXHR, textStatus, errorThrown ) {//Tambien se activa si da error
					curl.html('<i class="fa fa-search aria-hidden="true"></i>');
					alert(jqXHR + ",  " + textStatus + ",  " + errorThrown);
				});
			}else{ alert('Debe ingresar un DNI válido'); $('#dni').focus(); }
		}else{ alert('Debe ingresar un DNI'); $('#dni').focus(); }
	});
	
	file.bind('change',function(){
		var e = e || window.event;
		let files = e.target.files; //todos los archivos si el load tiene opcion multiple, si no solo trae uno
		if(files.length > 0){
			let img = URL.createObjectURL(files[0]);
			contSrc.attr( 'src', img );
			$('.top-avatar').attr( 'src', img );
			cargaImg(files[0],resultado);
		}
	});
	
	function resultado(src){ uploadImagenes(src,'uploadIMG'); }
	
	function cargaImg(file,callback){
		if (!file.type.match('image.*')) { alert('Solo pueden cargarse imagenes'); return false; }
		let fr = new FileReader();
		fr.addEventListener("load", function (e) {
			e = e || window.event;
			callback(e.target.result);
		}, false);
		fr.readAsDataURL(file); //name = file.name;
	}
	
	function uploadImagenes(file,control){
		$.ajax({
			data: {src:file},
			url: path + control,
			method: "POST",
			dataType: "json",
			beforeSend: function () {},
			success: function (data) {
				console.log(data);
			}
		});
	}
	
	$(document).ready(function () {
		if($('#tablaUsuarios')){ tablaUsuarios = $('#tablaUsuarios').DataTable(); tablaUsuarios.columns(1).visible(false);/*console.log($(tablaUsuarios.data()[1][3]))*/}
		
		$("#formPassword").validate({
			rules: {
				old_password: { required: true },
				password: { required: true, minlength: 6 },
				re_password: { required: true, equalTo: "#password" }
			},
			messages: {
				old_password: { required: "Ingrese la contrase\xf1a actual" },
				password: { required: "Ingrese la nueva contrase\xf1a", minlength: "Por lo menos 6 caracteres" },
				re_password: { required: "Ingrese nuevamente la contrase\xf1a", equalTo: "Las contrase\xf1as deben ser iguales" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					data: $("#formPassword").serialize(),
					url: path + "pass",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#formPassword .cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
						$("#formPassword button[type=submit]").addClass("disabled");
						$(".alert span").html("");

					},
					success: function (data) {
						$("#formPassword .cargando").html("<i></i>");
						$("#formPassword button[type=submit]").removeClass("disabled");

						$('html, body').animate({ scrollTop: 0 }, 'fast');

						if (parseInt(data.status) == 200) {
							//createAlert('', '', '  Se cambió la clave correctamente.', 'success', false, true, 'pageMessages');

							//$(".alert-success").removeClass("hide");
							$(".alert-success span").html(data.message);
							$("#formPassword")[0].reset();
							setTimeout(function () { $(".alert-success span").html('');/*$(".alert-success").addClass("hide");*/ }, 3000);
						}
						else {
							//createAlert('', '', '  Hubo algún error al actualizar la clave, intentar nuevamente.', 'warning', false, true, 'pageMessages');

							//$(".alert-danger").removeClass("hide");
							$(".alert-danger span").html(data.message);
							setTimeout(function () { $(".alert-danger span").html('');/*$(".alert-danger").addClass("hide");*/ }, 3000);
						}

					}
				});

			}
		});
	});
}