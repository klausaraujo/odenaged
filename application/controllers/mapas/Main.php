<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{
	private $idusuario;

    public function __construct()
    {
        parent::__construct();
		$this->idusuario = $this->session->userdata('idusuario');
		if (!$this->idusuario) header('location:' . base_url() . 'login');
	}

    public function index(){ }
	
	public function buscaEvento(){
		$this->load->model('Mapas_model');	
		$reg = $this->input->post('idregion'); $pro = $this->input->post('idpro'); $dis = $this->input->post('iddis');
		$desde = $this->input->post('inicio'); $hasta = $this->input->post('fin'); $tipo = $this->input->post('tipo');
		$nivel = $this->input->post('nivel');
		
		$dtz = new DateTimeZone("America/Lima");
		$dt = new DateTime($desde, $dtz);
		$desde = $dt->format('d/m/Y');
		$dt = new DateTime($hasta, $dtz);
		$hasta = $dt->format('d/m/Y');
		
		# Setear las variables del Modelo
		$this->Mapas_model->setId($this->idusuario);
		(!$reg == '')? $this->Mapas_model->setDpto($reg):''; (!$pro == '')? $this->Mapas_model->setPro($pro):''; (!$dis == '')?$this->Mapas_model->setDis($dis):'';
		(!$tipo == '')? $this->Mapas_model->setTipoEvt($tipo):''; (!$nivel == '')? $this->Mapas_model->setNivel($nivel):'';
		$this->Mapas_model->setFechaInicio($desde); $this->Mapas_model->setFechaFin($hasta);
		
		$detevt = $this->Mapas_model->buscaEvento();
		$detevt = ($detevt->num_rows() > 0)? $detevt->result() : array();
		
		$data = array( 'data' => $detevt );
		
		echo json_encode($data);
	}
	public function infoWindowEventos(){
		$this->load->model('Evento_model');
		$idEvt = $this->input->post('id');
		$this->Evento_model->setId($idEvt);
		
		$evento = $this->Evento_model->listarEvento();
		$evento = ($evento->num_rows() > 0)? $evento->row() : array();
		
		
		echo json_encode($evento);
	}
}