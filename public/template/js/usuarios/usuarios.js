function main(){
	let upload = $('.upload-button'), file = $('.file-upload'), contSrc = $(".profile-pic"), curl = $('.btn_curl'), tablaUsuarios;
	//function quitaFolder(){ $('.jstree-themeicon').attr('class',''); }
	
	$('body').on('click dblclick', 'input, button, a, i', function(e){
		var elementType = $(this).prop('nodeName');
		if($(this).attr('rel') && $(this).attr('rel') === 'nuevousuario'){ resetForm(); ocultar(true); }
		else if($(this).attr('rel') && $(this).attr('rel') === 'usuarios'){ resetForm(); ocultar(false); }
		else if($(this).attr('name') === 'btnCancelar'){ let evt = e || e.target; evt.preventDefault(); resetForm(); ocultar(false); }
		else if($(this).hasClass('loading')){
			let ul = $(this).closest('li').children('ul');
			if(ul.length === 0){
				let el = $(this).closest('li'), id = el.attr('id'), chek = $(this).next(), idusuario = $('#idusuarioPermiso').val(), p = $(this);
				$.ajax({
					type: 'POST',
					url: path + 'buscaUGEL',
					data: { id:id, check:(chek.hasClass('checked'))? 1 : 0,idusuario:idusuario },
					dataType: 'json',
					success: function (data){
						const { tree } = data; el.find('.niveles').remove(); el.append(tree); p.prop('class','collapsible colap');
					}
				}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
			}
		};
	});
	
	$('#btnPermisos').bind('click', function(e){
		/*let evt = e || e.target;
		evt.preventDefault();*/
		let dre = $('.dre').children('.checkbox'), ugel = $('.ugel').children('.checkbox'), dres = [], ugels = [], i = 0, idusuario = $('#idusuarioPermiso').val();
		
		if(dre.length > 0){ i= 0; dre.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked') || $(this).hasClass('ddbb'))
												{ dres[i] = { dres:$(this).attr('data-check') }; i++; } }); }
		if(ugel.length > 0){ i= 0; ugel.each(function(){ if($(this).hasClass('checked') || $(this).hasClass('mid-checked') || $(this).hasClass('ddbb'))
												{ ugels[i] = { ugel:$(this).attr('data-check'), dre:$(this).attr('data-dre') }; i++; } }); }
		
		//console.log(dptos+'  '+dres+'  '+ugels+'  '+provs);
		
		if(dres.length > 0 || ugels.length > 0){
			dres = JSON.stringify(dres); ugels = JSON.stringify(ugels);
			$.ajax({
				type: 'POST',
				url: path + 'permisos',
				data: { dres:dres,ugels:ugels,idusuario:idusuario },
				dataType: 'json',
				beforeSend: function(){ $("#loadGuardaPer").show(); },
				success: function (data) {
					//console.log(data);
					$("#loadGuardaPer").hide();
					if(data.status === 200) $('.mesg').attr('class','mesg text-success');
					else $('.mesg').attr('class','mesg text-danger');
					
					$('.mesg').html(data.msg); $('.mesg').show();
					$('#permisosModal').modal('hide');
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
		}else{ alert('Debe elegir alguna DRE'); $("#loadGuardaPer").hide(); return;}
	});
	
	$('#permisosModal').on('show.bs.modal',function(e){
		let evt = e || e.target, boton = $(evt.relatedTarget), tab = boton.closest('table').attr('id');
		let idusuario = $('#'+tab).dataTable().api().row($(boton).parents("tr")).data()[1], apell = $('#'+tab).dataTable().api().row($(boton).parents("tr")).data()[5];
		let nomb = $('#'+tab).dataTable().api().row($(boton).parents("tr")).data()[6], user = $('#'+tab).dataTable().api().row($(boton).parents("tr")).data()[7];
		
		$('#apPermisos').val(apell), $('#nmPermisos').val(nomb), $('#lgPermisos').val(user); $('#idusuarioPermiso').val(idusuario);
		//console.log());
		//console.log(tab.row($(boton).parents("tr")).data());
		$.ajax({
			type: 'POST',
			url: 'buscaDRE',
			data: {idusuario:idusuario},
			dataType: 'json',
			success: function (data) {
				//console.log(data);
				const { tree } = data; $('#jstree').html(tree); $('#jstree').animate({ scrollTop: 0 }, 'fast');
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) { alert(jqXHR + ",  " + textStatus + ",  " + errorThrown); });
	});
	
	$('#permisosModal').on('hidden.bs.modal',function(e){
		$('#jstree').find('.checkbox').attr('class','checkbox unchecked');
		$('body,html').animate({ scrollTop: 0 }, 'fast');
		setTimeout(function () { if(!$('.mesg').css('display') == 'none' || $('.mesg').css('opacity') == 1) $('.mesg').hide('slow'); }, 3000);
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
			//$('.active').removeClass('active');
		}
	}
	
	function resetForm(){ $("#formUsuarios")[0].reset();$("#formUsuarios select").prop('selectedIndex',0); }
		
	$("#formUsuarios").validate({
		rules: {
			tipodoc: { required: function () { if ($("#usuario").css("display") != "none") return true; else return false; } },
			dni: { required: function () { if ($("#dni").css("display") != "none") return true; else return false; }, minlength: 8 },
			apellidos: { required: function () { if ($("#nivelevento").css("display") != "none") return true; else return false; } },
			nombres: { required: function () { if ($("#fechaevento").css("display") != "none") return true; else return false; } },
			usuario: { required: function () { if ($("#usuario").css("display") != "none") return true; else return false; } },
			codperfil: { required: function () { if ($("#usuario").css("display") != "none") return true; else return false; } },
		},
		messages: {
			tipodoc: { required : "Campo Requerido" },
			dni: { required : "Campo Requerido", minlength: "Debe ingresar mínimo 8 caracteres" },
			apellidos: { required : "Campo Requerido" },
			nombres: { required : "Campo Requerido" },
			usuario: { required : "Campo Requerido" },
			codperfil: { required : "Campo Requerido" },
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
		let dni = $('#dni').val(), doc = $('#tipodoc').val(); $('#apellidos').val(''); $('#nombres').val('');
		
		if(dni !== '' && doc !== ''){
			if(dni.length < 8){ alert('Debe ingresar un documento válido'); $('#dni').focus(); return}
			if(doc === '01' && dni.length !== 8){ alert('Debe ingresar un número de DNI válido, 8 caracteres'); $('#dni').focus(); return}
			if(doc === '04' && dni.length < 9){ alert('Debe ingresar un número de documento válido, 9 caracteres'); $('#dni').focus(); return}
			if(doc === '04')doc = '0' + (parseInt(doc)-1).toString();
			
			$.ajax({
				data: {type: doc,dni: dni},
				url: path + 'curl',
				method: "POST",
				dataType: "json",
				error: function (xhr) { curl.removeAttr("disabled"); curl.html('<i class="fa fa-search aria-hidden="true"></i>'); },
				beforeSend: function () { curl.html('<i class="fa fa-spinner fa-pulse"></i>'); curl.attr('disabled', 'disabled'); },
				success: function (data) {
					let msg = data.errors? data.errors[0].detail : '';
					curl.html('<i class="fa fa-search aria-hidden="true"></i>');
					curl.removeAttr("disabled");
					if(msg === ''){
						$('#apellidos').val(data.data.attributes.apellido_paterno+' '+data.data.attributes.apellido_materno);
						$('#nombres').val(data.data.attributes.nombres);
					}else alert(msg);
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				curl.html('<i class="fa fa-search aria-hidden="true"></i>'); curl.removeAttr("disabled"); alert(jqXHR + ",  " + textStatus + ",  " + errorThrown);
			});
		}else{ 
			if(doc === ''){ alert('Debe elegir un tipo de Documento'); $('#tipodoc').focus(); }
			else{ alert('Debe ingresar un número de documento válido'); $('#dni').focus(); }
		}
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
		if($('#tablaUsuarios')){ tablaUsuarios = $('#tablaUsuarios').DataTable(); tablaUsuarios.columns(1).visible(false); $('#tablaUsuarios').show(); }
		
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
							$(".alert-success span").html(data.message); $("#formPassword")[0].reset();
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