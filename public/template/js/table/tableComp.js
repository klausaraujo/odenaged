function tableComp(table, headersCols, data,img){
	
	let cols = [], titles = [], render = [], imagen = [], lista = [], j = 1;
	cols.push({'acciones':''});
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
	
	render = [
		{
			title: 'Acciones',
			width: '20px',
			targets: 0,
			data: null,
			render: function (data, type, row, meta) {
				const btnDel = '<button class="btn btn-warning btn-circle btn-sm actionDelete" title="Eliminar" '+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-trash" aria-hidden="true"></i></button>';
				const btnEdit = '<button class="btn btn-warning btn-circle btn-sm actionEdit" title="Editar Registro" '+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
				const btnPdf = '<button class="btn btn-warning btn-circle btn-sm actionReport" title="Ver Reporte" '+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
				return (img == 'complementario')? btnEdit+btnDel+btnPdf : btnDel;
			}
		}
	];
	
	if(img == 'foto'){
		imagen = [
			{
				data: 'foto',
				render: function (data, type, row) {
					let img = '<img src="'+data+'" alt="'+type+'" class="img-fluid" />';
					if(data)
						return '<div style="width:35px;height:35px;margin:0" class="mx-auto">'+img+'</div>';
					else
						return '';
				}
			}/*,
			{
				data: 'descripcion',
				render: function (data, type, row) {
					let input = '<input type="text" value="'+data+'" />';
					return '<div class="justify-content-center" >'+input+'</div>';
				}
				
			}*/
		];
	}
	titles = render.concat(titles);
	if(img == 'foto'){ cols = cols.concat(imagen);titles = titles.concat([{title: 'Foto',targets: j}]); }
	/**/
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
	
	const tabla = $(table).DataTable({
		"data": data,
		/*"bPaginate":false,
		"bInfo":false,
		"bFilter":false,
		"bScrollCollapse": false,*/
		"bJQueryUI": false,
		"bAutoWidth": false,
		"bDestroy": true,		
		//"responsive": true,
		"select": false,
		"pageLength": "4",
		//dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
		//lengthMenu: [[4, 10, 25, 50, 100, -1], [4, 10, 25, 50, 100, 'Todas']],
		
		"columns":cols,
		"columnDefs":titles,
		//"dom": '<"row mt-5"rt><"row"<"col-sm-4 offset-5"p>>',
		"dom": '<"row mt-5"rt><"row float-right"p>',
		/*"buttons": {
			dom: {
			  container: {
				tag: 'div',
				className: 'flexcontent'
			  },
			  buttonLiner: {
				tag: null
			  }
			},
			buttons: [
				'copy','csv','excel','pdf','print'
			]
		}*/
	});
	
	return tabla;
}