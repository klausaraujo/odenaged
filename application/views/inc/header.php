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
		
		/*Cargador de Archivos Dropzone*/
		#drop-files {
			width: 400px;
			height: 220px;
			background: rgba(0,0,0,0.1);
			border-radius: 10px;
			border: 4px dashed rgba(0,0,0,0.2);
			padding: 60px 0 0 0;
			text-align: center;
			font-size: 2em;
			font-weight: bold;
			margin: 0 20px 20px 0;
			cursor:hand;
		}
		/*#dropped-files {
			float: left;
			position: relative;
			width: 560px;
			height: 125px;
		}*/
		#dropped-files .image {
			height: 150px;
			width: 200px;
			border: 4px solid #fff;
			//position: absolute;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
			background: #fff;
			border-radius: 4px;
			overflow: hidden;
		}
		.image a  {
			padding: 7px 6px 4px 6px;
			border-radius: 100px;
			background: rgba(0,0,0,0.6);
			box-shadow: none;
			font-size: 1em;
			margin-left: 8px;
			text-decoration: none;
			color: #fff;
		}
		.image a:hover { background: rgba(0,0,0,0.8); }
		#extra-files {
			display: none;
			float: left;
			position: relative;
		}
		#extra-files .number {
			background: rgba(0,0,0,0.6);
			border-radius: 4px;
			display: inline-block;
			position: relative;
			font-weight: bold;
			color: #fff;
			padding: 20px 30px;
			margin: 60px 0 0 0;
			cursor: pointer;
			font-size: 30px;
		}
		#extra-files .number:after {
			position: absolute;
			content: " ";
			top: 18px;
			left: -40px;
			display: block;
			border: 20px solid;
			border-color: transparent rgba(0, 0, 0, 0.6) transparent transparent;
		}
		#extra-files #file-list {
			display: none;
			background: white;
			padding: 20px 0;
			border-radius: 5px;
			box-shadow: 0 0 15px rgba(0,0,0,0.1);
			width: 300px;
			top: 100px;
			border: 1px solid #dadada;
			left: -10px;
			left: -16px;
			max-height: 400px;
			top: 150px;
			position: absolute;
			color: #545454;
		}
		#file-list ul {
			overflow: scroll;
			padding: 0;
			border-top: 1px solid #dadada;
			max-height: 200px;
			width: 250px;
			list-style: none;
			border-bottom: 1px solid #dadada !important;
		}
		#file-list ul li:last-of-type {
			border-bottom: 0 !important;
		}
		#extra-files #file-list:after, #extra-files #file-list:before {
			position: absolute;
			content: " ";
			top: -40px;
			left: 40px;
			display: block;
			border: 20px solid;
			border-color: transparent transparent #ffffff transparent;
		}
		#extra-files #file-list:before {
			border-color: transparent transparent #dadada transparent;
			top: -41px;
		}
		#extra-files #file-list li {
			border-bottom: 1px solid #eee;
			font-weight: bold;
			font-size: 1.5em;
			padding: 10px;
		}
	  </style>
</head>