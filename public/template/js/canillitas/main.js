function canillitas(URI,table) {

	function showModal(title) {
		//tablePersonalized('#tabla1');
		$("#decisionModal").modal("show");
		$(".modal-title").html(title);
	}
	
	function deshabilitarReniec() {
		$("input[name=nombres]").attr("readonly", "readonly");
		$("input[name=apellidos]").attr("readonly", "readonly");
		$("input[name=fechaNac]").attr("readonly", "readonly");
		//$("input[name=edad]").attr("readonly", "readonly");
		$("select[name=genero]").attr("readonly", "readonly");
		$("select[name=edoCivil]").attr("readonly", "readonly");
	}
	
	function resetForm(){
		$("#formCanillita")[0].reset();$("#formCanillita select").prop('selectedIndex',0);$('#blah').attr('src',URI+'public/images/camera.png');
	}
	
	$("#formCanillita").validate({
		rules: {
			documento_numero: { required: function () { if ($("#documento_numero").css("display") != "none") return true; else return false; }, digits: true },
			nombres: { required: function () { if ($("#nombres").css("display") != "none") return true; else return false; } },
			apellidos: { required: function () { if ($("#apellidos").css("display") != "none") return true; else return false; } },
			fechaNac: { required: function () { if ($("#FechaNac").css("display") != "none") return true; else return false; } },
			genero: { required: function () { if ($("#genero").css("display") != "none") return true; else return false; } },
			edoCivil: { required: function () { if ($("#edoCivil").css("display") != "none") return true; else return false; } },
			condic: { required: function () { if ($("#condic").css("display") != "none") return true; else return false; } },
			//grupo_sanguineo: { min: 1 },
			domicilio: { required: function () { if ($("#domicilio").css("display") != "none") return true; else return false; } },
			tlf1: { required: function () { if ($("#tlf1").css("display") != "none") return true; else return false; } },
			tlf2: { required: function () { if ($("#tlf2").css("display") != "none") return true; else return false; } },
			correo: { required: function () { if ($("#correo").css("display") != "none") return true; else return false; } }
		},
		messages: {
			documento_numero: { required:"Campo Requerido"},
			nombres: { required:"Campo Requerido"},
			apellidos: { required:"Campo Requerido"},
			fechaNac: { required:"Campo Requerido"},
			genero: { required:"Campo Requerido"},
			edoCivil: { required:"Campo Requerido"},
			condic: { required:"Campo Requerido"},
			domicilio: { required:"Campo Requerido"},
			tlf1: { required:"Campo Requerido"},
			tlf2: { required:"Campo Requerido"},
			correo: { required:"Campo Requerido"}
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "documento_numero") {
				error.insertAfter("#error_numero_documento");
			}
			else if (element.attr("name") == "fechaNac") {
				error.insertAfter("#error_fechaNac");
			}
			else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form, event) {
			event.preventDefault();
			$('#message').switchClass('succes', 'warn');
			$('#cargando').html('');
			$("#message").html('');
			if(!$("#message").is(":visible"))$("#message").slideDown();
			
			var formData = new FormData(document.getElementById("formCanillita"));
			formData.append("file", document.getElementById("file"));
			$.ajax({
				data: formData,
				url: URI + "canillitas/registrar",
				method: "POST",
				dataType: "json",
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#cargando").html("<i class='fa fa-refresh fa-spin fa-2x fa-fw'></i>");
					//const tiempo = setTimeout(function () { $("#message").html("<i class='fa fa-refresh fa-spin fa-2x fa-fw'></i>"); }, 3500);
				},
				success: function (data) {
					console.log(data);
					$('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					$('#message').switchClass('succes', 'warn');
					
					if (parseInt(data.status) == 200){ $('#message').switchClass('warn', 'succes'); $message = 'Canillita registrado exitosamente'; }
					else if (parseInt(data.status) == 201) { $message = 'No se pudo registrar, el Canillita ya existe'; }
					else { $message = 'No se pudo registrar el Canillita'; }
					
					setTimeout(function () { $('#cargando').html(''); $("#message").html($message); }, 500);
					if (parseInt(data.status) == 200){ loadData(); setTimeout(function () { $("#message").slideUp(); }, 2000);}
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				// Un callback .fail()
				setTimeout(function () { $('#cargando').html(''); $("#message").html(/*jqXHR + ",  " +*/ textStatus.toUpperCase() + ":  " + errorThrown);}, 500);
				
			});
		}
	});

	$(document).ready(function () {
		
		$('.iq-menu li a').each(function() {
			$(this).on('click',function(evt) {
				var rel= $(this).attr('rel');
				if(rel != 'canillitas' && rel != null){
					deshabilitarReniec();
					showModal('Registrar Canillita');
				}
			});
			/*$.ajax({
			  type: 'POST',
			  url: URI + 'main/formAjax',
			  data: {dni:'valor'},
			  dataType: 'json',
			  error: function (xhr) { },
			  beforeSend: function () {  },
			  success: function (response) {
				  $('#ajaxdata').html(response);
			  }
			});*/			
		});
		
		$('#btnEnviar').on('click',function(){ $("#formCanillita").submit(); });
		
		$("#btnCancelar").on("click", function () { resetForm(); });
		
		$("#btnNuevo").on("click", function () { resetForm(); });
		
		/*Buscar RENIEC*/
		$("#btn-buscar").on("click", function () {
			var type = '01';
			var documento_numero = $("input[name=documento_numero]").val();
			if (documento_numero.length > 8) {type = "03";}
			if(documento_numero != ""){
				$.ajax({
					url: URI + "main/curl",
					data: { type: type, dni: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (jqXHR, textStatus, errorThrown) {
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>Buscar');
						alert(jqXHR + ",  " + textStatus + ",  " + errorThrown);
					},
					beforeSend: function () { $("#btn-buscar").html('<i class="fa fa-spinner fa-pulse"></i>'); },
					success: function (response) {
						$("#btn-buscar").html('<i class="fa fa-search aria-hidden="true"></i>Buscar');
						const { data } = response;
						const { errors } = response;
						if(data){
							console.log(data);
							var fecha = (data.attributes.fecha_nacimiento).split("-");
							fecha = fecha[0] + "-" + fecha[1] + "-" + fecha[2];;
							$("input[name=fechaNac]").val(fecha);
							$("input[name=nombres]").val(data.attributes.nombres);
							$("input[name=apellidos]").val(data.attributes.apellido_paterno+" "+data.attributes.apellido_materno);
							$("select[name=edoCivil]").val(data.attributes.estado_civil);
							$("select[name=edoCivil]").attr("rel", data.attributes.estado_civil);
							$("select[name=genero]").val(data.attributes.sexo);
							$("select[name=genero]").attr("rel", data.attributes.sexo);
							$("textarea[name=domicilio]").val(data.attributes.domicilio_direccion);
							//$('#message').toggleClass('warn');
							//$('#message').switchClass('succes', 'warn');
							let foto = data.attributes.foto;
							$("#foto_dni_str").val(foto);
							$("#blah").attr("src", 'data:image/(png|jpg);base64, ' + foto);
						}
						if(errors){}
					}
				}).fail( function( jqXHR, textStatus, errorThrown ) {
					// Un callback .fail()
					alert(jqXHR + ",  " + textStatus + ",  " + errorThrown);
				});
			}else{
				alert("Debe ingresar el numero de documento");
		  }
		});
	});
	
	function loadData() {
		$.ajax({
		  type: 'POST',
		  url: URI + 'canillitas/main/listar',
		  data: {},
		  dataType: 'json',
		  success: function (response) {
			const { data: { listarCanillita } } = response;
			table.clear();
			table.rows.add(listarCanillita).draw();
			
			/*$(".actionEdit").on('click', function (event) {
			  var valor ="", i = 0;
			  $(this).parents("tr").find("td").each(function(){
				if(i == 1)
				  valor = $(this).html();
				i++;
			  });
		
			  buscar(valor);
			  showModal(event, 'Editar Usuario');
			});*/
		  }
		});
	}
}