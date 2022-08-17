function perfil(URI){
	let upload = $('.upload-button'), file = $('.file-upload'), contSrc = $(".profile-pic");
	
	upload.bind('click',function(e){ file.trigger('click'); });
	
	file.bind('change',function(){
		var e = e || window.event;
		let files = e.target.files;
		if(files.length > 0)
			contSrc.attr( 'src', URL.createObjectURL(files[0]));
		let imagenes = cargaImg(files);
		console.log(imagenes);
		//uploadImagenes(imagenes,'uploadIMG');
	});
	
	function cargaImg(files){
		let name = '', data = [];
		$.each(files, function(index, file) {
			if (!file.type.match('image.*')) { alert('Solo pueden cargarse imagenes'); return false; }
			let fr = new FileReader();
			fr.onload = (function(file) {
				return function(e){
					e = e || window.event;
					let src = e.target.result;
					data.push({'img':name,'src':src});
				}
			})(files[index]);
			fr.readAsDataURL(file); name = file.name;
		});
		return data;
	}
	
	function uploadImagenes(file,control){
		let formData = new FormData();
		formData.append("file", file);
		$.ajax({
			data: formData,
			url: URI + control,
			method: "POST",
			dataType: "json",
			beforeSend: function () {},
			success: function (data) {
				console.log(data);
			}
		});
	}
	
	$(document).ready(function () {
		//alert(URI);
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
					url: URI + "pass",
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