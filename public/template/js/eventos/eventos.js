function eventos() {
	const fileLoad = document.getElementById('file-upload');
	const formulario = document.getElementById('formPreliminar');
		
	function showModal(event,title) {
        $("#myModalLabel").text(title);
		$("#modalIE").modal("show");
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
	function resetear(){
		$('#formInforme')[0].reset();
		$('#formInforme select').each(function(){ $(this).prop('selectedIndex',0); });
	}
	
	$('#btnbuscaIE').on('click', function(){
		showModal(event,'Buscar Instituciones Educativas');
	});
	
	$('#btnDanio').on('click',function(evt){
		var jSon = [{'idtipodanio':$('#tipodanio').val(),'tipo_danio':$('select[name="tipodanio"] option:selected').text(),'version':1,'cantidad':$('#cantidad').val()}];
		var row = [];
		tableDanio.rows().data().each(function (value) { row.push(value); });
		row = row.concat(jSon);
		tableDanio.clear();
		tableDanio.rows.add(row).draw();
	});
	
	tableDanio.on('click', 'button', function(){
		if($(this).hasClass('actionDelete')){
			if(tableDanio.row(this).child.isShown()) tableDanio.row(this).remove().draw();
			else tableDanio.row($(this).parents("tr")).remove().draw();
		}
	});
	
	$('#btnAccion').on('click',function(evt){
		var jSon = [{'idtipoaccion':$('#tipoaccion').val(),'version':1,'tipo_accion':$('select[name="tipoaccion"] option:selected').text(),'descripcion':$('#descripaccion').val(),
					'fecha':$('#fechaaccion').val()+' '+$('#horaaccion').val()}];
		var row = [];
		tableAccion.rows().data().each(function (value) { row.push(value); });
		row = row.concat(jSon);
		tableAccion.clear();
		tableAccion.rows.add(row).draw();
	});
	
	tableAccion.on('click', 'button', function(){
		if($(this).hasClass('actionDelete')){
			if(tableAccion.row(this).child.isShown()) tableAccion.row(this).remove().draw();
			else tableAccion.row($(this).parents("tr")).remove().draw();
		}
	});
	
	tableFotos.on('click', 'button', function(){
		if($(this).hasClass('actionDelete')){
			if(tableFotos.row(this).child.isShown()) tableFotos.row(this).remove().draw();
			else tableFotos.row($(this).parents("tr")).remove().draw();
		}
	});
	
	$('#btnIE').on('click',function(evt){
		var jSon = [{'idiest':$('#idiest').val(),'version':1,'CEN_EDU':$('#institucion').val(),'descripcion':$('#descripie').val(),'fecha':$('#fechaie').val()}];
		var row = [];
		tableIEF.rows().data().each(function (value) { row.push(value); });
		row = row.concat(jSon);
		tableIEF.clear();
		tableIEF.rows.add(row).draw();
	});
	
	tableIEF.on('click', 'button', function(){
		if($(this).hasClass('actionDelete')){
			if(tableIEF.row(this).child.isShown()) tableIEF.row(this).remove().draw();
			else tableIEF.row($(this).parents("tr")).remove().draw();
		}
	});
	
	tableIEUbigeo.on('dblclick', 'tr', function(){
		var data = tableIEUbigeo.row( this ).data();
		console.log(data);
		$('#idiest').val(data.ID);
		$('#institucion').val(data.CEN_EDU);
		resetIE();
	});
	
	$('.close').on('click',function(){ resetIE(); });
	//$('#modalIE').on('hide.bs.modal', function (e) { resetIE(); });
	
	function resetIE(){
		$('select').each(function(){ $(this).prop('selectedIndex',0); });
		tableIEUbigeo.clear();
		tableIEUbigeo.draw();
		$("#modalIE").modal("hide");
	}
	
	$('#drop-files').on('click', function(){
		$('#file-upload').trigger('click');
		//$('#file-upload').trigger('change');
	});
	
	fileLoad.onchange = function (e) {
		const file = fileLoad.files[0];
		//var input =  e.srcElement;
		//alert(file.name);
		if ( file ) {
			if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
				var reader = new FileReader();
				reader.addEventListener("load", function () {
					/*console.log(this.result);
					var divCol = document.createElement("div");
					var filePreview = document.createElement('img');
					var previewZone = document.getElementById('file-preview-zone');
					
					divCol.classList.add('col-sm-2');
					filePreview.id = 'file-preview';
					
					filePreview.src = this.result;
					filePreview.classList.add('img-fluid');
					
					divCol.appendChild(filePreview);
					previewZone.appendChild(divCol);*/
					
					var jSon = [{'version':1,'fotografia': file.name,'descripcion' : file.name, 'foto' : this.result}];
					var row = [];
					tableFotos.rows().data().each(function (value) { row.push(value); });
					row = row.concat(jSon);
					tableFotos.clear();
					tableFotos.rows.add(row).draw();
					
				}, false);
				
				/*reader.onload = function (e) {
					//e.target.result contents the base64 data from the image uploaded
					//console.log(e.target.result);
				}*/
				
				reader.readAsDataURL(file);
			}
		}
    }
	
	$("#btnInforme").on('click', function(evt){
		evt.preventDefault();
		let fotos = [], accion = [], danio = [], ie = [], i = 0, id = $('#idregevento').val();
		//var formData = new FormData();
		tableFotos.rows().data().each(function (value) {
			fotos.push({ version:value.version,fotografia:value.fotografia,descripcion:value.descripcion,foto:value.foto });
		});
		tableDanio.rows().data().each(function (value) {
			danio.push({ idtipodanio:value.idtipodanio,version:value.version,tipodanio:value.tipo_danio,cantidad:value.cantidad });
		});
		tableAccion.rows().data().each(function (value) {
			accion.push({ idtipoaccion:value.idtipoaccion,version:value.version,tipoaccion:value.tipo_accion,descripcion:value.descripcion,fecha:value.fecha });
		});
		tableIEF.rows().data().each(function (value) {
			ie.push({ idiest:value.idiest,version:value.version,descripcion:value.descripcion,fecha:value.fecha });
		});
		fotos = JSON.stringify(fotos); danio = JSON.stringify(danio); accion = JSON.stringify(accion); ie = JSON.stringify(ie);
		
		$.ajax({
            data: { id:id,version:$('#version').val(),fotos:fotos,danio:danio,accion:accion,ies:ie },
            url: URI + "registraInforme",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
				
            },
            success: function (data) {
				loadTables(id);
            }
        });
		//ocultar();
	});
	
	$("#btnCancelPrel").on('click', function(evt){
		evt.preventDefault();
		ocultar();
	});
	
	function ocultar(){
		if($('.ajaxTable').css('display') == 'none' || $('.ajaxTable').css('opacity') == 0) $('.ajaxTable').show();
		if(!$('.ajaxPreliminar').css('display') == 'none' || $('.ajaxPreliminar').css('opacity') == 1) $('.ajaxPreliminar').hide();
		tableDanio.clear(); tableDanio.draw();
		tableAccion.clear(); tableAccion.draw();
		tableFotos.clear(); tableFotos.draw();
		tableIEF.clear(); tableIEF.draw();
		resetear();
	}
	
	$('#dpto').change(function(){
		var id = $(this).val();
        if (id.length > 0) {
          $.ajax({
            data: { region: id },
            url: URI + "cargarprov",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
				$("#dist").html('<option value="">--Seleccione--</option>');
				$("#prov").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>';
				});
				$("#prov").html($html);
            }
          });
    
        }
    });
	
	$('#prov').change(function(){
		var id = $(this).val();
        var departamento = $("#dpto").val();
        if (id.length > 0) {
          $.ajax({
            data: { region: departamento, provincia: id },
            url: URI + "cargardis",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $("#dist").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
				var $html = '<option value="">--Seleccione--</option>';
				$.each(data.lista, function (i, e) {
					$html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
				});
				$("#dist").html($html);
            }
          });
    
        }
    });
	$('#dist').change(function(){
		var id = $(this).val();
        var dpto = $("#dpto").val();
		var prov = $("#prov").val();
        if (id.length > 0) {
			$.ajax({
				data: { dpto: dpto, prov: prov, dtto: id },
				url: URI + "buscaIE",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$('#content').html('<div class="loading"><img src="'+path+'public/template/images/loader.gif" alt="loading" /><br/>Cargando...</div>');
					//if($('#loading').css('display') == 'none' || $('#loading').css('opacity') == 0) $('#loading').show();
				},
				success: function (data) {
					//console.log(data);
					const { ies } = data;
					tableIEUbigeo.clear();
					tableIEUbigeo.rows.add(ies).draw();
					$('#content').fadeIn(1000).html('');
				}
			});
        }
    });
	
	function loadTables(id){
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
				const { ies } = data;
				const { url } = data;
				tableDanio.clear(); if(danio.length > 0) tableDanio.rows.add(JSON.parse(danio)).draw();
				tableAccion.clear(); if(accion.length > 0) tableAccion.rows.add(JSON.parse(accion)).draw();
				tableFotos.clear();
				tableIEF.clear(); if(ies.length > 0) tableIEF.rows.add(JSON.parse(ies)).draw();
				$('#version').val(1);
				if(fotos.length > 0){
					let json = [];
					let row = JSON.parse(fotos);
					row.forEach(function(col){
						json.push({'version':col.version,'fotografia':col.fotografia,'descripcion':col.descripcion,'foto':path+url+col.fotografia});
					});
					tableFotos.rows.add(json).draw();
				}
			}
        });
	}
}