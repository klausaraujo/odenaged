function tableIE(table, headersCols, data){
	
	let cols = [], titles = [], render = [], imagen = [], lista = [], j = 0;
	
	if(headersCols.length > 0){
		headersCols.forEach(function(col){
			//console.log(col);
			for(const [key, value] of Object.entries(col)){
				let pal = '';
				cols.push({data:key});
				value !== 'dni'? pal = value.replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase()):pal = value.toUpperCase();
				titles.push({title:pal,targets:j});
				j++;
			}
		});
	}
		
	//String JSON con su identificador
	//json = {"data":[{"name":"Tiger Nikon","position":"system"}]};
	//String JSON sin su identificador pero esperando mas datos [0],[1]...
	//json = [{"name":"Tiger Nikon","position":"system"}];
	//String JSON sin su identificador y solo una fila de datos
	//json = {"name":"Tiger Nikon","position":"system"};
	/*for(var i in cols){
		{data:cols[i].data},
	}
	lista.length > 0 ? titles : titulos
	titles = JSON.parse('[{"title":"DNI","targets": 0},{"title":"APELLIDOS","targets": 1},{"title":"NOMBRES","targets": 2}]');
	console.log(cols[0].data);*/
	/*Cambiar a mayusc la primera letra
	palabras.map((palabra) => { 
		return palabra[0].toUpperCase() + palabra.substring(1); 
	}).join(" ");
	for (let i = 0; i < palabras.length; i++) {
		palabras[i] = palabras[i][0].toUpperCase() + palabras[i].substr(1);
	}
	palabras.join(" ");*/

	const dataTable = $(table).DataTable({
		"data": data,
		/*"bPaginate":false,
		"bInfo":false,
		"bFilter":false,
		"bScrollCollapse": false,
		"bJQueryUI": false,*/
		"bAutoWidth": true,
		"bDestroy": true,		
		"responsive": true,
		"select": false,
		"pageLength": 5,
		//dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
		lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],		
		"columns":cols,
		"columnDefs":titles,
		"dom": '<"row mt-1"<"col-sm-6 float-left"l><"col-sm-6 float-right"f>>rtip',
	});
	
	return dataTable;
}