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
		
		$tipoevento = $this->Evento_model->tipoEvento();
		$nivel = $this->Evento_model->cargaNivel();
		$dpto = $this->Ubigeo_model->dptos();
		$listar = $this->Evento_model->listar();
		
		if ($listar->num_rows() > 0) {
            $listar = $listar->result();
        } else {
            $listar = array();
        }
		
		$data = array(
			"tipoevento" => $tipoevento->result(),
			"dpto" => $dpto->result(),
			"nivel" => $nivel->result(),
			"lista" => json_encode($listar)
		);
		
		$this->load->view($this->uri->segment(1).'/main',$data);
    }
	public function listar(){
		$this->load->model("Evento_model");
		$listar = $this->Evento_model->listar();		
		
		if ($listar->num_rows() > 0) {
            $listar = $listar->result();
        } else {
            $listar = array();
        }

        $data = array(
            "status" => 200,
            "data" => array( "lista" => $listar )
        );

        echo json_encode($data);
	}
	public function cargarEvento(){
		$this->load->model("Evento_model");
		$this->Evento_model->setIdTipoEvt($this->input->post("tipo"));
		$evento = $this->Evento_model->cargarEvento();
		$data = array(
			"lista" => $evento->result()
		);
		
		echo json_encode($data);
	}
	public function cargarprov(){
		$this->load->model("Ubigeo_model");
		$this->Ubigeo_model->setIdDpto($this->input->post("region"));
		
		$listaProv = $this->Ubigeo_model->prov();		
		
		$data = array(
            "lista" => $listaProv->result()
        );
        
        echo json_encode($data);
	}
	public function cargardis(){
		$this->load->model("Ubigeo_model");
		
		$this->Ubigeo_model->setIdDpto($this->input->post("region"));
		$this->Ubigeo_model->setIdProv($this->input->post("provincia"));
		
		$listaDis = $this->Ubigeo_model->dttos();		
		
		$data = array(
            "lista" => $listaDis->result()
        );
        
        echo json_encode($data);
	}
	public function cargarLatLng(){
		$this->load->model("Ubigeo_model");
		
		$ubig = $this->input->post("dpto").$this->input->post("prov").$this->input->post("dtto");
		$this->Ubigeo_model->setUbigeo($this->input->post("dpto").$this->input->post("prov").$this->input->post("dtto"));
		$ubigeo = $this->Ubigeo_model->ubigeo();
		
		$data = array(
			"ubigeo" => $ubigeo->result(),
			"ubi" => $ubig
		
		);
		
		echo json_encode($data);
		
	}
	public function registrar()
    {
		$this->load->model("Evento_model");
		
		$dtz = new DateTimeZone("America/Lima");
        $dt = new DateTime("now", $dtz);
        //$fechaActual = $dt->format("Y-m-d h:i:s a");
		$fechaActual = $dt->format("Y-m-d h:i:s");
		$count = $this->Evento_model->sumaEventos();
		
		$this->Evento_model->setAnio($this->input->post('anio'));
		$this->Evento_model->setCtaEvento($count + 1);
		$this->Evento_model->setNivelEvento($this->input->post('nivelevento'));
		$this->Evento_model->setIdEvento($this->input->post('evento'));
		$this->Evento_model->setDescripcion($this->input->post('descripcion'));
		$this->Evento_model->setUbigeo($this->input->post('ubigeo'));
		$this->Evento_model->setLat($this->input->post('lat'));
		$this->Evento_model->setLng($this->input->post('lng'));
		$this->Evento_model->setFechaEvento($this->input->post('fechaevento'));
		$this->Evento_model->setHoraEvento($this->input->post('fechaevento')." ".$this->input->post('horaevento'));
		$this->Evento_model->setAfecta($this->input->post('afecta'));
		$this->Evento_model->setZoom($this->input->post('zoom'));
		$this->Evento_model->setUsuarioReg($this->session->userdata("idusuario"));
		$this->Evento_model->setFechaReg($fechaActual);
		
		$campos = array(
			'anio' =>  $this->input->post('anio'),
			'idusuario' =>  $this->session->userdata("idusuario"),
			'fecha' =>  $fechaActual,
			'nivel' => $this->input->post('nivelevento'),
			'idevento' => $this->input->post('evento'),
			'evento' => $this->input->post('descripcion'),
			'ubigeo' => $this->input->post('ubigeo'),
			'latitud' => $this->input->post('lat'),
			'longitud' => $this->input->post('lng'),
			'fechaevento' => $this->input->post('fechaevento'),
			'horaevento' => $this->input->post('fechaevento')." ".$this->input->post('horaevento'),
			'afecta' => $this->input->post('afecta'),
			'zoom' => $this->input->post('zoom'),
		);
				
		if (strlen($this->input->post('evento')) < 1 or strlen($this->input->post('nivelevento')) < 1 or strlen($this->input->post('fechaevento')) < 1)
		{
            $data = array(
                "status" => 500,
				"campos" => $campos
            );
        }else{
			$id = $this->Evento_model->registrar();
			if ($id > 0){
				$data = array(
					"status" => 200,
					"campos" => $campos
                );
			}else{
				$data = array(
					"status" => 500,
					"campos" => $campos
                 );
            }
		}
		
		echo json_encode($data);
    }
}