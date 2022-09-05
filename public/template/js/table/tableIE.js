function tableIE(table, headersCols, data){/**/
	
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

	const tabla = $(table).DataTable({
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
	
	return tabla;
}