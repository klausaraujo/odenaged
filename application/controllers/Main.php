<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario"))
			header("location:" . base_url() . "login");
    }

    public function index()
    {
		
    }
	public function eventos()
    {
		//$this->informe();
		$this->load->model("Evento_model");
		$this->load->model("Ubigeo_model");
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		
		$tipoevento = $this->Evento_model->tipoEvento();
		$nivel = $this->Evento_model->cargaNivel();
		$listar = $this->Evento_model->listar();
		$tipodanio = $this->Evento_model->tipoDanio();
		$tipoaccion = $this->Evento_model->tipoAccion();
		$dpto = $this->Ubigeo_model->dptos();
		//$ubigeo = $this->Ubigeo_model->ubigeo();
		
		($tipoevento->num_rows() > 0)? $tipoevento = $tipoevento->result() : $tipoevento = array();
		($nivel->num_rows() > 0)? $nivel = $nivel->result() : $nivel = array();
        ($listar->num_rows() > 0)? $listar = $listar->result() : $listar = array();
		($tipodanio->num_rows() > 0)? $tipodanio = $tipodanio->result() : $tipodanio = array();
		($tipoaccion->num_rows() > 0)? $tipoaccion = $tipoaccion->result() : $tipoaccion = array();
		($dpto->num_rows() > 0)? $dpto = $dpto->result() : $dpto = array();
		//$pdf = $this->informe($this->load->view('eventos/dompdf.php',NULL,TRUE));
		
		$data = array(
			'tipoevento' => $tipoevento,
			'nivel' => $nivel,
			'lista' => json_encode($listar),
			'danio' => $tipodanio,
			'accion' => $tipoaccion,
			'dpto' => $dpto,
			'url' => $this->config->item('path_url'),
			'uri' => base_url()
		);
		
		//$this->load->view($this->uri->segment(1).'/main',$data);
		$this->load->view('main',$data);
    }
}