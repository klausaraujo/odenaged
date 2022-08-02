<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Informes extends CI_Controller
{
	private $path;
	
	public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario"))
			header("location:" . base_url() . "login");
		$this->path = $_SERVER["DOCUMENT_ROOT"].'/odenaged/';
    }

    public function index()
    {
    }
	
	function preliminar(){
		//echo $this->input->post('idevento');
		$this->load->model("Informe_model");
		$this->Informe_model->setIdEvento($this->input->post('idevento'));
		$this->Informe_model->setUbigeo($this->input->post('ubigeo'));
		$danio = $this->Informe_model->listaDanio();
		$accion = $this->Informe_model->listaAccion();
		$fotos = $this->Informe_model->listaFotos();
		$ies = $this->Informe_model->listaIE();
		$ieUB = $this->Informe_model->buscaIE();
		
		($danio->num_rows() > 0)? $danio = json_encode($danio->result()) : $danio = array();
		($accion->num_rows() > 0)? $accion = json_encode($accion->result()) : $accion = array();
		($fotos->num_rows() > 0)? $fotos = json_encode($fotos->result()) : $fotos = array();
		($ies->num_rows() > 0)? $ies = json_encode($ies->result()) : $ies = array();
		($ieUB->num_rows() > 0)? $ieUB = json_encode($ieUB->result()) : $ieUB = array();
		
		$data = array(
			'danio' => $danio,
			'accion' => $accion,
			'fotos' => $fotos,
			'ies' => $ies,
			'iesUB' => $ieUB,
			'url' => 'public/images/galerias_eventos/',
			'status' => 200
		);
		echo json_encode($data);
	}
	
	function registrar(){
		$this->load->model("Informe_model");
		//$this->Informe_model->setVersion($row->version);
		$this->Informe_model->setIdEvento($this->input->post('id'));
		$this->Informe_model->setVersion($this->input->post('version'));
		$status = 0; $img = '';$id = 0;
		
		$fotos = json_decode($_POST['fotos']); $danios = json_decode($_POST['danio']);
		$acciones = json_decode($_POST['accion']); $ies = json_decode($_POST['ies']);
		
		# Guardar Fotos
		$this->Informe_model->setTabla('galeria_evento');
		$del = $this->Informe_model->borraPreliminar();
		
		$this->load->library('general');
		$ubi = $this->path.'public/images/galerias_eventos/';
		foreach($fotos as $row){
			if(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $row->foto),true)){
				$img = $this->general->saveImage($ubi,$row->foto);
			}else{
				$nombre = explode('/',$row->foto);
				$file = base64_encode(file_get_contents($row->foto));
				$img = end($nombre);
				$this->general->saveImage1($ubi,$file,$img);
			}
			if(!$img == ''){
				$this->Informe_model->setImg($img);
				//$this->Informe_model->setFoto($row->foto);
				$this->Informe_model->setDescripcion($row->descripcion);
				$id = $this->Informe_model->registrarFotos();
			}
		}
		
		# Guardar Daños
		$this->Informe_model->setTabla('evento_tipo_danio');
		$this->Informe_model->borraPreliminar();
		
		foreach($danios as $row){
			$this->Informe_model->setTipoDanio($row->idtipodanio);
			$this->Informe_model->setCantidad($row->cantidad);
			$id = $this->Informe_model->registrarDanios();
		}
		
		# Guardar Acciones
		$this->Informe_model->setTabla('tipo_accion_evento');
		$this->Informe_model->borraPreliminar();
		$dtz = new DateTimeZone("America/Lima");
		
		foreach($acciones as $row){
			$this->Informe_model->setTipoAccion($row->idtipoaccion);
			$this->Informe_model->setDescripcion($row->descripcion);
			$dt = new DateTime($row->fecha, $dtz);
			$fecha = $dt->format("Y-m-d h:i:s");
			$this->Informe_model->setFechaHora($fecha);
			$id = $this->Informe_model->registrarAcciones();
		}
		
		# Guardar IES
		$this->Informe_model->setTabla('iest_2020_all_evento');
		$this->Informe_model->borraPreliminar();
		
		foreach($ies as $row){
			$this->Informe_model->setIdIES($row->idiest);
			$this->Informe_model->setDescripcion($row->descripcion);
			$dt = new DateTime($row->fecha, $dtz);
			$fecha = $dt->format("Y-m-d");
			$this->Informe_model->setFechaHora($fecha);
			$id = $this->Informe_model->registrarIES();
		}
		
		if ($id > 0)$status = 200;
		else $status = 500;
		
		$data = array(
			'img' => $img,
			'status' => $status
		);
		
		echo json_encode($data);
	}
	
	function buscaIE(){
		$this->load->model("Informe_model");
		$ubigeo = $this->input->post('dpto').$this->input->post('prov').$this->input->post('dtto');
		$this->Informe_model->setUbigeo($ubigeo);
		$ies = $this->Informe_model->buscaIE();
		($ies->num_rows() > 0)? $ies = $ies->result() : $ies = array();
		
		return $ies;
	}
}