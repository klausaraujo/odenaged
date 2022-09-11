function mapaEventosMonitoreo(URI, modalType) {

	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		clear: "Limpiar",
		format: "mm/dd/yyyy",
		titleFormat: "MM yyyy",
		weekStart: 0
	};

	$('.datetimepicker').datepicker({
		format: 'dd/mm/yyyy',
		maxDate: moment(),
		language: "es",
		endDate: new Date(),
		autoclose: true
	});

	$(document).ready(function () {

		$(".form__icon").click(function (ev) {
			$("#leyendaMapa").modal("show");
		})

		$("#departamento").change(function () {

			var id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: { departamento: id },
					url: URI + "mapas/main/cargarProvincias",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#provincia").html('<option value="">Cargando...</option>');
						$("#distrito").html('<option value="0">-- TODOS --</option>');
					},
					success: function (data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>';

						});
						$("#provincia").html($html);

					}
				});

			}
		});

		$("#provincia").change(function () {

			var id = $(this).val();
			var departamento = $("#departamento").val();

			if (id.length > 0 && departamento.length > 0) {

				$.ajax({
					data: { departamento: departamento, provincia: id },
					url: URI + "mapas/main/cargarDistritos",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#distrito").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';

						});
						$("#distrito").html($html);

					}
				});

			}
		});

		$("#tipoEvento").change(function () {

			id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: {
						tipoEvento: id
					},
					url: URI
						+ "mapas/main/cargarEvento",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#evento")
							.html(
								'<option value="">Cargando...</option>');
					},
					success: function (
						data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';

						});
						$("#evento").html($html);

					}
				});

			}

		});
		$("#formMapaEventos").validate({
			rules: {
				departamento: { required: false },
				provincia: { required: false },
				distrito: { required: false },
				nivelEmergencia: { required: false },
				tipoEvento: { required: false },
				evento: { required: false },
				desde: { required: true },
				hasta: { required: true }
			},
			messages: {
				desde: {
					required: "Campo requerido"
				},
				hasta: {
					required: "Campo requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var desde = $("#desde").val();
				var hasta = $("#hasta").val();

				if (desde.length != 10 || hasta.length != 10) {
					$("#alertaModal").modal("show");
					$("#alertaModal #tituloalerta").text("Error");
					$("#alertaModal #mensajealerta").html("Verifique las fechas");

					return false;

				} else {
					$("#activar").val(1);
				}
				$.ajax({
					url: URI + "mapas/main/datosMapaEventosMonitoreo",
					method: "POST",
					data: $("#formMapaEventos").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#btnObtenerReporte").text("Cargando...");
						$("#numeroEvento").text('');
						$("#btnObtenerReporte").addClass("disabled");
						$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					},
					success: function (data) {
						var numeroEvento = data.registros.length
						if (mapMarkers && mapMarkers.length > 0) {
							for (var i = 0; i < mapMarkers.length; i++) {
								mapMarkers[i].setMap(null);
							}
						}
						mapMarkers = [];
						marcadores = [];

						$.each(data.registros, function (i, e) {

							var coordenadas = e.Evento_Coordenadas.split(",");
							var posicion = { "latitud": coordenadas[0], "longitud": coordenadas[1] };
							marcadores[i] = [
								{
									id: e.Evento_Registro_Numero,
									posicion: posicion,
									nivel: e.Evento_Nivel_Codigo,
									tipo: e.Evento_Tipo_Codigo,
									tipoEvento: e.Evento_Codigo
								}
							];

						});

						$("#btnObtenerReporte").text("Mostrar Reporte dentro del Mapa");
						$("#numeroEvento").text(`${numeroEvento} Registros Encontrados`);
						$("#btnObtenerReporte").removeClass("disabled");

						cargarFull(0, marcadores, modalType);
					}
				});

			}
		});

	});

}