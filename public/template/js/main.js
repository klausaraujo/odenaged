$('html, body').animate({ scrollTop: 0 }, 'fast');

$('body').bind('change','select', function(e){
	let evt = e || e.target, el = evt.target, id = $(el).val(), $html = '<option value="">--Seleccione--</option>';
	
	if (id.length > 0){
		if($(el).hasClass('region') || $(el).hasClass('provincia')){
			let dpto = $('.region').val();
			$.ajax({
				data: ($(el).hasClass('region')? { region: id } : { region: dpto, provincia: id }),
				url: ($(el).hasClass('region')? 'cargarprov' : 'cargardis'),
				method: 'POST',dataType: 'json',
				beforeSend: function () {
					if($(el).hasClass('region')){
						$('.distrito').html('<option value="">--Seleccione--</option>'); $('.provincia').html('<option value=""> Cargando...</option>');
					}else $(".distrito").html('<option value="">Cargando...</option>');
				},
				success: function(data){
					if($(el).hasClass('region')){
						$.each(data, function (i, e){ $html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>'; });
						$('.provincia').html($html);
					}else{
						$.each(data, function (i, e){ $html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>'; });
						$(".distrito").html($html);
					}
				}
			});
		}else if($(el).hasClass('tipoevento')){
			if($('.sismo') && !$('.sismo').css('display') == 'none' || $('.sismo').css('opacity') == 1) $('.sismo').hide();
			$.ajax({
				data: { tipo: id }, url: 'evtbytipo', method: 'POST', dataType: 'json',
				beforeSend: function () { $('.evento').html('<option value="">Cargando...</option>'); },
				success: function (data) {
					$.each(data, function (i, e) { $html += '<option value="' + e.idevento + '">' + e.evento + '</option>'; });
					$('.evento').html($html);
				}
			});
		}
	}
});
$('body').bind('click','a',function(e){
	let evt = e || e.target, el = evt.target;
	
	if($(el).closest('div').hasClass('submenu-1')){
		let li = $(el).closest('ul').closest('li'), idMenu = (li.attr('id')).substr(0,4); if(idMenu === 'menu') li.attr('class','active');
		if($(el).attr('href') == 'consolidado'){
			reporteEvento.clear(); reporteEvento.draw();
			if(!$('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 1) $('.ajaxTable').hide();
			if(!$('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 1) $('.ajaxPreliminar').hide();
			if(!$('.ajaxComplementario').css('display') == 'none' || $('.ajaxComplementario').css('opacity') == 1) $('.ajaxComplementario').hide();
			if(!$('.ajaxForm').css('display') == 'none' || $('.ajaxForm').css('opacity') == 1) $('.ajaxForm').hide();
			$('#formReportes')[0].reset(); $('#formReportes select').each(function(){ $(this).prop('selectedIndex',0); });
			if($('.repòrteConsolidado').css('display') == 'none' || $('.repòrteConsolidado').css('opacity') == 0) $('.repòrteConsolidado').show();
			evt.preventDefault();
			return false;
		}else if($(el).attr('href') == 'mapas'){
			return true;
		}
	}else if($(el).closest('a').attr('id') === 'linkAjax'){
		let ulPadre = $(el).parents('.iq-menu'), a = ulPadre.find('a');
		a.each(function(i,e){
			//console.log(i);
			if($(this).attr('data-toggle') === 'collapse'){
				$(this).attr('aria-expanded','false');
				$(this).attr('class','collapsed');
				if($(this).closest('li').find('.collapse').hasClass('show')){
					let el = $(this).closest('li').find('.collapse'); el.removeClass('show');
				}
			}
		});		
	}else if($(el).hasClass('buscaConsolidado')){
		let region = $('#regionMapa').val(),pro = $('#provinciaMapa').val(),dis = $('#distritoMapa').val(), desde = $('#fechadesde').val(), idbtn = $(el).attr('id');
		let hasta = $('#fechahasta').val(), tipo = $('#tipoeventoMapa').val(), nivel = $('#nivelMapa').val(), evento = $('#eventoMapa').val();
		if(idbtn === 'buscarMapa'){
			$.ajax({
				url: 'buscaEventoMapa',
				data: {idregion:region,idpro:pro,iddis:dis,inicio:desde,fin:hasta,tipo:tipo,nivel:nivel,evt:evento,idboton:idbtn},
				method: 'post', dataType: 'json',
				success: function (resp) {
					const { data } = resp;
					marcadores(data);
					console.log(data);
				}
			});
		}else if(idbtn === 'buscaEvtCons'){
			inicio = document.getElementById('fechadesde').value; fin = document.getElementById('fechahasta').value;
			$(el).text("Cargando..."); $(el).addClass("disabled");
			reporteEvento.ajax.reload();
		}
	}
});