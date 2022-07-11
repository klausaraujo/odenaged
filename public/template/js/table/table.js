function tablePersonalized(table, lista, titulo){
	
	let cols = []; let titles = []; let render = []; //let colu = ''; let tit = '';
	
	if(lista.length > 0){
		let j = 1; let i = 0; //colu = '[{"data":null},'; tit = '[{"title":"Acciones","targets":0},';
		cols.push({data:null});
		lista.forEach(function(col){
			for(const [key, value] of Object.entries(col)){
				let pal = '';
				if(j < 8 && i == 0){
					//Crear columnas y titulos de datatables con un for y un String para JSON
					/*colu += '{"data":"'+key+'"},';
					tit += '{"title":"'+key.toUpperCase()+'","targets":'+j+'},';*/
					//Crear columnas y titulos de datatables con un for y un array
					cols.push({data:key});
					key == 'fecnac'? pal = 'Fecha Nac.': key !== 'dni'? pal = key.replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase()):pal = key.toUpperCase();
					titles.push({title:pal,targets:j});
				}/*else if(j == 8){
					colu += '{"data":"'+key+'"}';
					tit += '{"title":"'+key.toUpperCase()+'","targets":'+j+'}';
					cols.push({data:key});
					titles.push({title:key.toUpperCase(),targets:j});
				}*/
				j++;
			}
			i++;
		});
		//colu = JSON.parse(colu += ']'); tit = JSON.parse(tit += ']');
		
	}else{
		if(titulo == 'evento'){
			//colu = JSON.parse('[{"data":"dni"},{"data":"apellidos"},{"data":"nombres"},{"data":"fecnac"},{"data":"sexo"},{"data":"domicilio"},{"data":"correo"}]');
			cols = [
				{data:null},{data:'anio_evento'},{data:'numero_evento'},{data:'descripcion'},{data:'ubigeo'},{data:'latitud'},{data:'longitud'},{data:'fecha'}
			];
			titles = [
				{title:'Acciones',targets:0},{title:'A&ntilde;o Evento',targets:1},{title:'N&uacute;mero del Evento',targets:2},{title:'Evento',targets:3},
				{title:'Ubigeo',targets:4},{title:'Latitud',targets:5},{title:'Longitud',targets:6},{title:'Fecha del Evento',targets:7}
			]
			
		}if(titulo == 'mostrar'){
		}
	}
	
	render = [
		{
			title: 'Acciones',
				targets: 0,
				data: null,
				render: function (data, type, row, meta) {
				const btnEdit = '<button class="btn btn-success btn-sm actionEdit" title="Editar Registro" type="button" alt="editar"'+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
				const btnCargas = '<button class="btn btn-warning btn-circle btn-sm actionCargas" title="Registrar Cargas Familiares" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-users" aria-hidden="true"></i></button>';
				const btnEst = '<button class="btn btn-warning btn-circle btn-sm actionEstud" title="Registrar Estudios" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-graduation-cap" aria-hidden="true"></i></button>';
				const btnPdf = '<button class="btn btn-warning btn-circle btn-sm actionReport" title="Ver Reporte" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px""><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
				return btnEdit+btnCargas+btnEst+btnPdf;
				
				}
		}	
	];
	
	titles = render.concat(titles);
	
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
		"data": lista,
		/*"bPaginate":false,
		"bInfo":false,
		"bFilter":false,
		"bScrollCollapse": false,
		"bJQueryUI": false,*/
		"bAutoWidth": true,
		"bDestroy": true,		
		//"responsive": true,
		"select": true,
		//"pageLength": "10",
		//dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
		lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
		
		"columns":cols,
		"columnDefs":titles,
		"dom": '<"row"<"col-sm-12 mb-2"B><"col-sm-6 float-left"l><"col-sm-6 float-right"f>>rtip',
		"buttons": {
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
		}
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
			buttons: [{
			  extend: 'copy',
			  title: 'Lista General de Canillitas',
			  exportOptions: { columns: [0, 1, 2, 3, 6] },
			},
			{
			  extend: 'csv',
			  title: 'Lista General de Canillitas',
			  exportOptions: { columns: [0, 1, 2, 3, 6] },
			},
			{
			  extend: 'excel',
			  title: 'Lista General de Canillitas',
			  exportOptions: { columns: [0, 1, 2, 3, 6] },
			},
			{
			  extend: 'pdf',
			  title: 'Lista General de Canillitas',
			  orientation: 'landscape',
			  exportOptions: { columns: [0, 1, 2, 3, 6] },
			},
			{
			  extend: 'print',
			  title: '',
			  exportOptions: { columns: [0, 1, 2, 3, 6] },
			  customize: function (win) {
				$(win.document.body).addClass('white-bg');
				$(win.document.body).css('font-size', '8px');

				$(win.document.body).find('table')
				  .addClass('compact')
				  .css('font-size', '8px');

				var css = '@page { size: landscape; }',
				  head = win.document.head || win.document.getElementsByTagName('head')[0],
				  style = win.document.createElement('style');

				style.type = 'text/css';
				style.media = 'print';

				if (style.styleSheet) {
				  style.styleSheet.cssText = css;
				}
				else {
				  style.appendChild(win.document.createTextNode(css));
				}

				head.appendChild(style);
			  }
			},
			{
			  extend: 'pageLength',
			  titleAttr: 'Registros a Mostrar',
			  className: 'selectTable'
			}]
		}*/
	});
	
	$(table + ' tbody').on('click', '.cont', function(){
		if($(this).children().attr('alt') === 'editar'){
			if(dataTable.row(this).child.isShown()){
				var data = dataTable.row(this).data();
				//console.log(data);
			}else{
				var data = dataTable.row($(this).parents("tr")).data();
			}
			console.log(data);
			/*$("#decisionModal").modal("show");
			$(".modal-title").html('Editar Canillita');*/
		}
	});
	
	return dataTable;
}