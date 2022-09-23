<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{
	private $idusuario;

    public function __construct()
    {
        parent::__construct();
		$this->idusuario = $this->session->userdata("idusuario");
		if (!$this->idusuario) header("location:" . base_url() . "login");
	}

    public function index(){ }
	
	public function eventos()
    {
		$this->load->model("Evento_model"); $this->load->model('Ubigeo_model');
		$zonas = $this->session->userdata('ubigeo'); $this->Ubigeo_model->setIdUser($this->idusuario);
		$ubis = []; $i = 0; $tipoevento = null; $nivel = null; $tipodanio = null; $tipoaccion = null;
		if(null !== $zonas){
			$evts = $this->Evento_model->listarEv();
			if($evts->num_rows() > 0){
				$evts = $evts->result();
				foreach($evts as $evt):
					$pro = $evt->provincia;
					$this->Ubigeo_model->setIdProv($pro);
					$ctatemp = $this->Ubigeo_model->ubigeosEvtUser();
					if($ctatemp > 0){ $ubis[$i] = $evt; $i++; }
				endforeach;
			}
			
			$tipoevento = $this->Evento_model->tipoEvento();
			$nivel = $this->Evento_model->cargaNivel();
			$tipodanio = $this->Evento_model->tipoDanio();
			$tipoaccion = $this->Evento_model->tipoAccion();			
			$tipoevento = ($tipoevento->num_rows() > 0)? $tipoevento->result() : array();
			$nivel = ($nivel->num_rows() > 0)? $nivel->result() : array();
			$tipodanio = ($tipodanio->num_rows() > 0)? $tipodanio->result() : array();
			$tipoaccion = ($tipoaccion->num_rows() > 0)? $tipoaccion->result() : array();
		}
		
		$data = array(
			'tipoevento' => $tipoevento,
			'nivel' => $nivel,
			'danio' => $tipodanio,
			'accion' => $tipoaccion,
			'url' => $this->config->item('path_url'),
			'uri' => base_url(),
			'ubi' => $ubis,
			'zonas' => $zonas,
		);
		
		$this->load->view('main',$data);
    }
	public function usuarios(){
		$status = 500; $i = 0; $j = 0; $prov; $dttos; $ubigeo = (Object)[];
		
		$this->load->model("Usuario_model");
		$this->Usuario_model->setId($this->idusuario);
		
		$listaUsers = $this->Usuario_model->lista();
		$perfiles = $this->Usuario_model->perfiles();
		
		$listaUsers = ( $listaUsers->num_rows() > 0 )? $listaUsers->result() : array();
		$perfiles = ( $perfiles->num_rows() > 0 )? $perfiles->result() : array();
		
		$data = array(
			'data' => $listaUsers,
			'status' => $status,
			'perfil' => $perfiles
		);
		$this->load->view('main',$data);
	}
	public function fichas(){
		$data = array(
			'data' => 'Fichas',
		);
		
		$this->load->view('main',$data);
	}
	public function mapas(){
		//echo 'Mapas Interactivos';
		$this->load->model("Evento_model");
		$tipoevento = $this->Evento_model->tipoEvento();
		$nivel = $this->Evento_model->cargaNivel();
		$tipoevento = ($tipoevento->num_rows() > 0)? $tipoevento->result() : array();
		$nivel = ($nivel->num_rows() > 0)? $nivel->result() : array();
		
		$data = array( 'tipo' => $tipoevento, 'nivel' => $nivel );
		
		$this->load->view('mapas/mapas',$data);
	}
	public function cargarprov(){
		$this->load->model("Ubigeo_model");
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		$this->Ubigeo_model->setIdDpto($this->input->post("region"));
		
		$listaProv = $this->Ubigeo_model->proUser();
		
        echo json_encode($listaProv->result());
	}
	public function cargardis(){
		$this->load->model("Ubigeo_model");
		
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		$this->Ubigeo_model->setIdDpto($this->input->post("region"));
		$this->Ubigeo_model->setIdProv($this->input->post("provincia"));
		
		$listaDis = $this->Ubigeo_model->dttos();
        
        echo json_encode($listaDis->result());
	}
	public function cargarLatLng(){
		$this->load->model("Ubigeo_model");
		
		$this->Ubigeo_model->setUbigeo($this->input->post("dpto").$this->input->post("prov").$this->input->post("dtto"));
		$ubigeo = $this->Ubigeo_model->latLng();
		
		$data = array( 'ubigeo' => ($ubigeo->num_rows() > 0)? $ubigeo->result() : array() );
		echo json_encode($data);
	}
	public function curl(){
		$this->load->library('general');
		$tipo = $this->input->post('type'); $doc = $this->input->post('dni');
		$resp = $this->general->curl($tipo, $doc);
		echo $resp;
	}
	public function cargaEventoByTipo(){
		$this->load->model("Evento_model");
		$this->Evento_model->setIdTipoEvt($this->input->post("tipo"));
		$evtByTip = $this->Evento_model->cargarEvento();
		$evtByTip = ($evtByTip->num_rows() > 0)? $evtByTip->result() : array();
		
		echo json_encode($evtByTip);
	}
}