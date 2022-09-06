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

    public function index()
    {
		
    }
	public function eventos()
    {
		//$this->informe();
		$this->load->model("Evento_model");
		$zonas = $this->session->userdata('ubigeo');
		$ubis = array(); $i = 0; $tipoevento = null; $nivel = null; $tipodanio = null; $tipoaccion = null;
		if(null !== $zonas){
			foreach($zonas->dptos as $drow):
				$dep = $drow->cod_dep;
				foreach($zonas->prov as $prow):
					$ubigeo = $drow->cod_dep.$prow->cod_pro;
					$this->Evento_model->setUbigeo($ubigeo);
					$temp = $this->Evento_model->listarEv();
					if($temp->num_rows() > 0){ $ubis[$i] = $temp->result(); $i++; }
				endforeach;
			endforeach;
			
			$tipoevento = $this->Evento_model->tipoEvento();
			$nivel = $this->Evento_model->cargaNivel();
			//$listar = $this->Evento_model->listar();
			$tipodanio = $this->Evento_model->tipoDanio();
			$tipoaccion = $this->Evento_model->tipoAccion();
			
			($tipoevento->num_rows() > 0)? $tipoevento = $tipoevento->result() : $tipoevento = array();
			($nivel->num_rows() > 0)? $nivel = $nivel->result() : $nivel = array();
			//($listar->num_rows() > 0)? $listar = $listar->result() : $listar = array();
			($tipodanio->num_rows() > 0)? $tipodanio = $tipodanio->result() : $tipodanio = array();
			($tipoaccion->num_rows() > 0)? $tipoaccion = $tipoaccion->result() : $tipoaccion = array();
			//$pdf = $this->informe($this->load->view('eventos/dompdf.php',NULL,TRUE));
		}
		
		$data = array(
			'tipoevento' => $tipoevento,
			'nivel' => $nivel,
			//'lista' => json_encode($listar),
			'danio' => $tipodanio,
			'accion' => $tipoaccion,
			'url' => $this->config->item('path_url'),
			'uri' => base_url(),
			'ubi' => $ubis,
			'zonas' => $zonas
		);
		
		//$this->load->view($this->uri->segment(1).'/main',$data);
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
	public function curl(){
		$this->load->library('general');
		$tipo = $this->input->post('type'); $doc = $this->input->post('dni');
		$resp = $this->general->curl($tipo, $doc);
		echo $resp;
	}
}