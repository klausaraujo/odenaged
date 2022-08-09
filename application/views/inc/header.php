<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?=TITULO_PRINCIPAL?></title>
   <meta name="author" content="<?=AUTOR?>">
   <link rel="shortcut icon" href="<?=base_url()?>public/template/images/favicon.jpg">
   <link rel="icon" href="<?=base_url()?>public/template/images/favicon.jpg" type="image/x-icon">
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
   <link rel="stylesheet" href="<?=base_url()?>public/template/js/table/datatable/datatables.min.css" type="text/css">
   <?if(isset($eventos)){?>
	<link rel="stylesheet" href="<?=base_url()?>public/template/css/dropzone.css" />
   <?}?>
   
   <style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none; 
			margin: 0; 
	    }
	    input[type=number] { -moz-appearance:textfield; }
		table.dataTable td {font-size: 0.8rem;}
		#message, #cargando{text-align:center}
		.succes{color:#008F39;font-size:1.1rem}
		.warn{color:#FF0000;font-size:1.1rem}
		.dashboard__title{ padding-top: 25px; font-size: 12px; }
		#addModal .modal-dialog{width:550px}
		
		/*Cargador de Archivos Dropzone*/
		#uploader{padding:1em;position:relative}
		#uploader #uploaderCont #dragandrophandler{flex-direction:column;background:#ebebeb;height:30vh;min-height:180px;
								border:1px solid #c8c8c8;display:flex;align-items:center;justify-content:center;transition:all 400ms}
		#uploader #uploaderCont #dragandrophandler>*{transition:all 400ms}
		#uploader #uploaderCont #dragandrophandler svg{width:100px;height:3.3em;opacity:0.12;margin-bottom:7px}
		#uploader #uploaderCont #dragandrophandler label{margin-left:5px;color:#007bff;cursor:pointer}
		#uploader #uploaderCont #dragandrophandler label:hover{text-decoration:underline}
		#uploader #uploaderCont #dragandrophandler.active{box-shadow:0 0 18px 2px inset #979797;background:#bbd3ff}
		#uploader #uploaderCont #dragandrophandler.active svg{transform:translateY(11px);height:3.8em;opacity:1;fill:#fff}
		#uploader #uploaderCont #dragandrophandler.active span{opacity:0}
		/*#uploader #uploaderCont .row.fileQueue{padding:1% 0;border-bottom:thin solid #e6e6e6;opacity:0}
		#uploader #uploaderCont .row.fileQueue>div{display:flex;align-items:center}
		#uploader #uploaderCont .row.fileQueue>div.name b{overflow:hidden;text-overflow:ellipsis}
		#uploader #uploaderCont .row.fileQueue>div.remove{margin-left:20px;justify-content:flex-end}*/
	</style>
</head>