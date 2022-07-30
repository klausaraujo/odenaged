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
		$danio = $this->Informe_model->listaDanio();
		$accion = $this->Informe_model->listaAccion();
		$fotos = $this->Informe_model->listaFotos();
		
		($danio->num_rows() > 0)? $danio = $danio->result() : $danio = array();
		($accion->num_rows() > 0)? $accion = $accion->result() : $accion = array();
		($fotos->num_rows() > 0)? $fotos = $fotos->result() : $fotos = array();
		
		$data = array(
			'danio' => json_encode($danio),
			'accion' => json_encode($accion),
			'fotos' => json_encode($fotos),
			'status' => 200
		);
		echo json_encode($data);
		
		if($this->input->post('tipo')){
			
			
			$dtz = new DateTimeZone("America/Lima");
			$dt = new DateTime("now", $dtz);
			//$fechaActual = $dt->format("Y-m-d h:i:s a");
			$fechaActual = $dt->format("Y-m-d h:i:s");
			
			//if($this->input->post('tipo') == 'registrar'){
				/*$this->Evento_model->setAnio($this->input->post('anio'));
				$this->Evento_model->setCtaEvento($this->coun);
				$this->Evento_model->setNivelEvento($this->input->post('nivelevento'));
				$this->Evento_model->setIdEvento($this->input->post('evento'));
				$this->Evento_model->setDescripcion($this->input->post('descripcion'));
				$this->Evento_model->setUbigeo($this->input->post('ubigeo'));
				$this->Evento_model->setLat($this->input->post('lat'));
				$this->Evento_model->setLng($this->input->post('lng'));
				$this->Evento_model->setFechaEvento($this->input->post('fechaevento')." ".$this->input->post('horaevento'));
				$this->Evento_model->setAfecta($this->input->post('afecta'));
				$this->Evento_model->setZoom($this->input->post('zoom'));
				$this->Evento_model->setUsuarioReg($this->session->userdata("idusuario"));
				$this->Evento_model->setFechaReg($fechaActual);
				$this->Evento_model->setlatSismo($this->input->post('latitudsismo'));
				$this->Evento_model->setlngSismo($this->input->post('longitudsismo'));
				$this->Evento_model->setProfundidad($this->input->post('profundidad'));
				$this->Evento_model->setMagnitud($this->input->post('magnitud'));
				$this->Evento_model->setIntensidad($this->input->post('intensidad'));
				$this->Evento_model->setReferencia($this->input->post('referencia'));
				$this->registrar();*/
			/*}
			if($this->input->post('tipo') == 'editar'){
				$this->editar();
			}*/
		}
	}
}