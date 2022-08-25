function tablePersonalized(table, headersCols, data, comp){
	
	let cols = [], titles = [], render = [], imagen = [], lista = [], j = 0;
	cols.push({data:null});j++;
	if(headersCols.length > 0){
		headersCols.forEach(function(col){
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
				
				const btnDel = (data.activo == '0')? '<button class="btn btn-warning btn-circle btn-sm actionDelete" title="Eliminar" '+
						'style="margin-right:5px;padding:1px;padding-left:3px" disabled ><i class="fa fa-trash" aria-hidden="true"></i></button>':
						'<button class="btn btn-warning btn-circle btn-sm actionDelete" title="Eliminar" '+
						'style="margin-right:5px;padding:1px;padding-left:3px" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
				const btnEdit = '<button class="btn btn-warning btn-circle btn-sm actionEdit" title="Editar Registro" type="button" '+
						'style="margin-right:5px;padding:1px;padding-left:3px" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'
				const btnPreliminar = '<button class="btn btn-warning btn-circle btn-sm actionInforme" title="Acciones" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px" ><i class="fa fa-file" aria-hidden="true"></i></button>';
				const btnPdf = '<button class="btn btn-warning btn-circle btn-sm actionReport" title="Ver Reporte" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
				const btnHome = '<button class="btn btn-warning btn-circle btn-sm actionComp" title="Complementarios" type="button"'+
						'style="margin-right:5px;padding:1px;padding-left:3px" ><i class="fa fa-home" aria-hidden="true"></i></button>';
				return (comp == 'complementario')? btnPreliminar+btnDel+btnPdf : btnEdit+btnPreliminar+btnHome+btnPdf;
			}
		}	
	];
	
	titles = render.concat(titles);
	let botones = '<"row"<"col-sm-12 mb-2"B><"col-sm-6 float-left"l><"col-sm-6 float-right"f>rt>ip';
	
	if(comp == 'complementario'){
		activo = [
			{
				data: 'fecha_cierre',
				render: function(data,type,row){
					let fecha = (data) ? data.split("-") : 0;
					return ( parseInt(fecha[0]) > 0 ) ? data : '';
				}
			},
			{
				data: 'activo',
				render: function(data,type,row){
					return (data == '1') ? 'Abierto' : 'Cerrado';
				}
			}
		]
		
		cols = cols.concat(activo);titles = titles.concat([{title: 'Fecha Cierre',targets: j},{title: 'Estado',targets: j + 1}]);
		botones = '<"row"<"col-sm-6 float-left"l><"col-sm-6 float-right"f>rt>ip';
		
	}else{
		mes = [
			{
				data: 'mes',
				render: function(data,type,row){
					return (data)? data : '';
				}
			}
		];
		cols = cols.concat(mes);
		titles.push({title: 'Mes', targets: [j],/* visible: false*/});
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
	
	/*#yourTable{
    table-layout: fixed !important;
    word-wrap:break-word;
	}*/
	

	const tabla = $(table).DataTable({
		"data": data,
		/*"bPaginate":false,
		"bInfo":false,
		"bFilter":false,
		"bScrollCollapse": false,*/
		//"bJQueryUI": true,
		"bAutoWidth": true,
		"bDestroy": true,
		"responsive": true,
		"select": false,
		//"pageLength": "10",
		//dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
		lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
		"columns":cols,
		"columnDefs":titles,
		"dom": botones,
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
		},
		initComplete: function(){
			/*if(!comp){
				let tab = this;
				this.api().columns().every( function () {
					let col = this;
					if(col.dataSrc() == 'anio_evento'){ col.search($("#anio").val()).draw(); }
					if(col.dataSrc() == 'mes'){ col.search($("#mes").val()).draw(); }
					$('#anio').on('change', function(){ col.search($(this).val()).draw(); });
					$('#mes').on('change', function(){ col.search($(this).val()).draw(); });
				});
			}*/
			if(typeof comp === 'undefined'){ this.api().search($("#anio").val()).draw(); this.api().search($("#mes").val()).draw(); }
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
	
	return tabla;
}