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
		
		$data = array(
			'tipoevento' => $tipoevento,
			'nivel' => $nivel,
			'lista' => json_encode($listar),
			'danio' => $tipodanio,
			'accion' => $tipoaccion,
			'dpto' => $dpto,
			'ubigeo' => $this->config->item('path_url'),
			'eventos' => 'eventos'
		);
		//$this->informe($this->load->view('index.html',NULL,TRUE));
		//$this->load->view($this->uri->segment(1).'/main',$data);
		$this->load->view('main',$data);
    }
	
	#Funcion para conectarse a la api de la RENIEC
	public function curl()
    {
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("dni");
        $api = "http://mpi.minsa.gob.pe/api/v1/ciudadano/ver/";
        $token = "Bearer d90f5ad5d9c64268a00efaa4bd62a2a0";
        $handler = curl_init();

        curl_setopt($handler, CURLOPT_URL,  $api. $tipo_documento . "/" . $documento . "/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            "Authorization: " . $token,
            "Content-Type: application/json"
        ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        curl_close($handler);

        echo $data;
    }
}