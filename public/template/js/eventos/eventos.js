function eventos() {
	const fileLoad = document.getElementById('file-upload');
	const formulario = document.getElementById('formPreliminar');
	
	$('#btnDanio').on('click',function(evt){
		var jSon = [{'idtipodanio':$('select[name="tipodanio"] option:selected').text(),'cantidad':$('#cantidad').val()}];
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
		var jSon = [{'idtipoaccion':$('select[name="tipoaccion"] option:selected').text(),'descripcion':$('#descripaccion').val(),
					'fecha':$('#fechaaccion').val(),'hora':$('#horaaccion').val()}];
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
					
					var jSon = [{'fotografia':file.name,'descripcion':file.name,'foto': this.result}];
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
	
	$("#btnPreliminar").on('click', function(evt){
		evt.preventDefault();
		ocultar();
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
		tableIE.clear(); tableIE.draw();
		formulario.reset();
	}
}