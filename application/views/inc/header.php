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
		
		/**/
		/*.container{width: 100%;}*/
.user-box {
    width: 200px;
    border-radius: 0 0 3px 3px;
    padding: 10px;
    position: relative;
}
.user-box .name {
    word-break: break-all;
    padding: 10px 10px 10px 10px;
    background: #EEEEEE;
    text-align: center;
    font-size: 20px;
}
.user-box form{display: inline;}
.user-box .name h4{margin: 0;}
.user-box img#imagePreview{width: 100%;}

.editLink {
    position:absolute;
    top:28px;
    right:10px;
    opacity:0;
    transition: all 0.3s ease-in-out 0s;
    -mox-transition: all 0.3s ease-in-out 0s;
    -webkit-transition: all 0.3s ease-in-out 0s;
    background:rgba(255,255,255,0.2);
}
.img-relative:hover .editLink{opacity:1;}
.overlay{
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
    background: rgba(255,255,255,0.7);
}
.overlay-content {
    position: absolute;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}
.uploadProcess img{
    max-width: 207px;
    border: none;
    box-shadow: none;
    -webkit-border-radius: 0;
    display: inline;
}


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