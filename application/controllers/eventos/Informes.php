<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Informes extends CI_Controller
{
	private $path;
	private $fecha;
	
	public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario"))
			header("location:" . base_url() . "login");
		$this->path = $_SERVER["DOCUMENT_ROOT"].'/odenaged/';
		 $this->fecha = date('Y-m-d H:i:s');
    }

    public function index()
    {
    }
	
	function preliminar(){
		//echo $this->input->post('idevento');
		$this->load->model("Informe_model");
		$this->Informe_model->setIdEvento($this->input->post('idevento'));
		$this->Informe_model->setUbigeo($this->input->post('ubigeo'));
		$this->Informe_model->setVersion($this->input->post('version'));
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
	
	function complementario(){
		$this->load->model("Informe_model");
		$id = $this->input->post('idevento');
		//$ub = $this->input->post('ubigeo');
		$ver = $this->input->post('version');
		
		$this->Informe_model->setIdEvento($id);
		//$this->Informe_model->setUbigeo($ub);
		$this->Informe_model->setVersion($ver);
		
		$this->Informe_model->setUsuarioReg($this->session->userdata('idusuario'));
		$this->Informe_model->setFechaReg($this->fecha);
		
		$this->Informe_model->setTabla('evento_tipo_danio');
		$this->Informe_model->setCamposClonar('version,idtipodanio,idregistroevento,cantidad,activo');
		$this->Informe_model->setCampos('version + 1,idtipodanio,idregistroevento,cantidad,activo');
		$dan = $this->Informe_model->clonarAcciones();
		$dan = $this->Informe_model->cierraAcciones();
		$this->Informe_model->setTabla('tipo_accion_evento');
		$this->Informe_model->setCamposClonar('version,idtipoaccion,idregistroevento,descripcion,fecha,activo');
		$this->Informe_model->setCampos('version + 1,idtipoaccion,idregistroevento,descripcion,fecha,activo');
		$ac = $this->Informe_model->clonarAcciones();
		$ac = $this->Informe_model->cierraAcciones();
		$this->Informe_model->setTabla('iest_2020_all_evento');
		$this->Informe_model->setCamposClonar('version,idiest,idregistroevento,descripcion,fecha,activo');
		$this->Informe_model->setCampos('version + 1,idiest,idregistroevento,descripcion,fecha,activo');
		$ie = $this->Informe_model->clonarAcciones();
		$ie = $this->Informe_model->cierraAcciones();
		$this->Informe_model->setTabla('galeria_evento');
		$this->Informe_model->setCamposClonar('version,idregistroevento,fotografia,descripcion,activo');
		$this->Informe_model->setCampos('version + 1,idregistroevento,fotografia,descripcion,activo');
		$fot = $this->Informe_model->clonarAcciones();
		$fot = $this->Informe_model->cierraAcciones();
		
		$ver++;
		$this->Informe_model->setVersion($ver);
		$v = $this->Informe_model->traeVersion();
		$version = array(); $maximo = 0;
		$maximo = $v['version'];
		foreach($v['data'] as $row):
			if( $row->num_rows() === $maximo )
				$version['acciones'] = $row->result();
		endforeach;
		/*$danio = $this->Informe_model->listaDanio();
		$accion = $this->Informe_model->listaAccion();
		$fotos = $this->Informe_model->listaFotos();
		$ies = $this->Informe_model->listaIE();
		//$version = $this->Informe_model->traeVersion();
		
		//$query = max($dan,$ac,$ie,$fot);
		//foreach ($query->result() as $row){ echo $row->title; }
		
		$dan = ($dan->num_rows() > 0)? json_encode($dan->result()) : array();
		$ac = ($ac->num_rows() > 0)? json_encode($ac->result()) : array();
		$fot = ($fot->num_rows() > 0)? json_encode($fot->result()) : array();
		$ie = ($ie->num_rows() > 0)? json_encode($ie->result()) : array();*/
		
		echo json_encode(array($version,'version' => $maximo));
	}
	
	public function traeVersion(){
		$this->load->model("Informe_model");
		$id = $this->input->post('idevento');
		$this->Informe_model->setIdEvento($id);
		$v = $this->Informe_model->traeVersion();
		$version = array(); $maximo = 0;
		$maximo = $v['version'];
		foreach($v['data'] as $row):
			if( $row->num_rows() === $maximo )
				$version['acciones'] = $row->result();
		endforeach;
		/*foreach($v->result() as $row):
			//$version[$fil] = floatval($fil);
			foreach($row as $fil=>$col):
				if($fil !== 'fecha_apertura'){ if(floatval($col) > $ver) $ver = floatval($col); }
				else {if($fil !== $fap) $fap = $col;}
			endforeach;
			if($ver > $maximo){
				$maximo = $ver;
				$version[$i]['version'] = $ver;
				$version[$i]['fecha_apertura'] = $fap;	
			}
			$i++;
		endforeach;*/
		//$version = max($version);
		echo json_encode(array($version,'version' => $maximo));
	}
	
	
	function registrar(){
		$this->load->model("Informe_model");
		//$this->Informe_model->setVersion($row->version);
		$this->Informe_model->setIdEvento($this->input->post('id'));
		$this->Informe_model->setVersion($this->input->post('version'));
		//$this->Informe_model->setHoy($fecha);
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
				$this->Informe_model->setUsuarioAct(null);
				$this->Informe_model->setFechaAct(null);
				$this->Informe_model->setImg($img);
				//$this->Informe_model->setFoto($row->foto);
				$this->Informe_model->setDescripcion($row->descripcion);
				if(isset($row->idusuario_apertura)){
					$this->Informe_model->setUsuarioReg($row->idusuario_apertura);
					$this->Informe_model->setFechaReg($row->fecha_apertura);
					$this->Informe_model->setUsuarioAct($this->session->userdata('idusuario'));
					$this->Informe_model->setFechaAct($this->fecha);
				}else{
					$this->Informe_model->setUsuarioReg($this->session->userdata('idusuario'));
					$this->Informe_model->setFechaReg($this->fecha);
				}
				$id = $this->Informe_model->registrarFotos();
			}
		}
		
		# Guardar Daños
		$this->Informe_model->setTabla('evento_tipo_danio');
		$this->Informe_model->borraPreliminar();
		$this->Informe_model->setUsuarioAct(null);
		$this->Informe_model->setFechaAct(null);
		
		foreach($danios as $row){
			$this->Informe_model->setTipoDanio($row->idtipodanio);
			$this->Informe_model->setCantidad($row->cantidad);
			
			if(isset($row->idusuario_apertura)){
				$this->Informe_model->setUsuarioReg($row->idusuario_apertura);
				$this->Informe_model->setFechaReg($row->fecha_apertura);
				$this->Informe_model->setUsuarioAct($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaAct($this->fecha);
			}else{
				$this->Informe_model->setUsuarioReg($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaReg($this->fecha);
			}
			$id = $this->Informe_model->registrarDanios();
		}
		
		# Guardar Acciones
		$this->Informe_model->setTabla('tipo_accion_evento');
		$this->Informe_model->borraPreliminar();
		$dtz = new DateTimeZone("America/Lima");
		$this->Informe_model->setUsuarioAct(null);
		$this->Informe_model->setFechaAct(null);
		
		foreach($acciones as $row){
			$this->Informe_model->setTipoAccion($row->idtipoaccion);
			$this->Informe_model->setDescripcion($row->descripcion);
			$dt = new DateTime($row->fecha, $dtz);
			$fechaAccion = $dt->format("Y-m-d h:i:s");
			$this->Informe_model->setFechaHora($fechaAccion);
			if(isset($row->idusuario_apertura)){
				$this->Informe_model->setUsuarioReg($row->idusuario_apertura);
				$this->Informe_model->setFechaReg($row->fecha_apertura);
				$this->Informe_model->setUsuarioAct($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaAct($this->fecha);
			}else{
				$this->Informe_model->setUsuarioReg($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaReg($this->fecha);
			}
			$id = $this->Informe_model->registrarAcciones();
		}
		
		# Guardar IES
		$this->Informe_model->setTabla('iest_2020_all_evento');
		$this->Informe_model->borraPreliminar();
		$this->Informe_model->setUsuarioAct(null);
		$this->Informe_model->setFechaAct(null);
		
		foreach($ies as $row){
			$this->Informe_model->setIdIES($row->idiest);
			$this->Informe_model->setDescripcion($row->descripcion);
			$dt = new DateTime($row->fecha, $dtz);
			$fechaAccion = $dt->format("Y-m-d");
			$this->Informe_model->setFechaHora($fechaAccion);
			if(isset($row->idusuario_apertura)){
				$this->Informe_model->setUsuarioReg($row->idusuario_apertura);
				$this->Informe_model->setFechaReg($row->fecha_apertura);
				$this->Informe_model->setUsuarioAct($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaAct($this->fecha);
			}else{
				$this->Informe_model->setUsuarioReg($this->session->userdata('idusuario'));
				$this->Informe_model->setFechaReg($this->fecha);
			}
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
	function existeAccion(){
		$this->load->model("Informe_model");
		$idEvt = $this->input->post('id');
		$idaccion = $this->input->post('idaccion');
		$accion = $this->input->post('accion');
		
		$this->Informe_model->setIdEvento($idEvt);
		
		if($accion == 'danios'){ 
			$this->Informe_model->setTabla('evento_tipo_danio'); $this->Informe_model->setAccion($idaccion); $this->Informe_model->setCampo('idtipodanio');
		}if($accion == 'acciones'){ 
			$this->Informe_model->setTabla('tipo_accion_evento'); $this->Informe_model->setAccion($idaccion); $this->Informe_model->setCampo('idtipoaccion');
		}if($accion == 'ies'){ 
			$this->Informe_model->setTabla('iest_2020_all_evento'); $this->Informe_model->setAccion($idaccion); $this->Informe_model->setCampo('idiest');
		}
		
		$count = $this->Informe_model->existeAccion();
		if($count > 0) echo json_encode(500);
		else echo json_encode(200);
	}
	public function informe(){
		if ( $this->input->get('id') !== null){
			$id = $this->input->get('id');
			
			$this->load->model("Evento_model");
			$this->load->model("Informe_model");
			$this->Evento_model->setId($id);
			$this->Informe_model->setIdEvento($id);
			
			$evento = $this->Evento_model->listarEvento();
			$danios = $this->Informe_model->listaDanio();
			$acciones = $this->Informe_model->listaAccion();
			$fotos = $this->Informe_model->listaFotos();
			$ies = $this->Informe_model->listaIE();
			
			($danios->num_rows() > 0)? $danios = $danios->result() : $danios = array();
			($acciones->num_rows() > 0)? $acciones = $acciones->result() : $acciones = array();
			($fotos->num_rows() > 0)? $fotos = $fotos->result() : $fotos = array();
			($ies->num_rows() > 0)? $ies = $ies->result() : $ies = array();
			
			if($evento->num_rows() > 0){
				$this->load->library("dom");
				$evento = $evento->row();
				$data = array(
					'evento' => $evento,
					'danios' => $danios,
					'acciones' => $acciones,
					'fotos' => $fotos,
					'ies' => $ies
				);
				$html = $this->load->view('eventos/informe', $data, true);
				$this->dom->generate("portrait", "informe", $html, "Informe");
				/*foreach($danios as $row):
					echo var_dump($row);
					echo $row->ideventotipodanio;
				endforeach;*/
			}
		}
	}
}