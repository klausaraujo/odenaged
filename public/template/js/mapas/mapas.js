function mapas(){
	//marcadores();
	$('body').bind('click','button',function(e){
		let evt = e || e.target, region = $('.region').val(),pro = $('.provincia').val(),dis = $('.distrito').val();
		let desde = $('#fechadesde').val(), hasta = $('#fechahasta').val(), tipo = $('#tipoevento').val(), nivel = $('#nivel').val();
		//if(region == '' || pro == '' || dis == ''){ alert('Debe Elegir Region, Provincia y Distrito'); return;}
		//console.log(region+'  '+pro+'  '+dis);
		if($(evt.target).attr('id') === 'buscar'){
			$.ajax({
				url: 'buscaEvento',
				data: {idregion:region,idpro:pro,iddis:dis,inicio:desde,fin:hasta,tipo:tipo,nivel:nivel},
				method: "post",
				dataType: "json",
				success: function (resp) {
					const { data } = resp;
					marcadores(data);
				}
            });
		}
	});
}
