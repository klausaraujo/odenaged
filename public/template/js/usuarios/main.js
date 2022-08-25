function main(){
	let upload = $('.upload-button'), file = $('.file-upload'), contSrc = $(".profile-pic"), curl = $('.btn_curl');
	
	$('.iq-menu li #linkAjax').each(function() {
		$(this).on('click',function(evt) {
			var rel= $(this).attr('rel');
			evt.preventDefault();
			if( rel == 'nuevousuario' ){ resetForm(); ocultar(true); alert('nuevousuario'); }
		});
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
	
	upload.bind('click',function(e){ file.trigger('click'); });
	
	curl.bind('click',function(){
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
		if($('#tablaUsuarios')){
			const headers = [{'idusuario':'id usuario','dni':'dni','avatar':'avatar','apellidos':'apellidos','nombres':'nombres','usuario':'usuario','perfil':'perfil','activo':'estado'}];
			const tablaUsuarios = tablePersonalized('#tablaUsuarios',headers,listaUsuarios);
		}
		
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