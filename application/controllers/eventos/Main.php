<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{
	private $path;
	private $coun;
	
    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario"))
			header("location:" . base_url() . "login");
		$this->path = $_SERVER["DOCUMENT_ROOT"].'/odenaged/';
    }

    public function index()
    {
		if($this->input->post('tipo')){
			$this->load->model("Evento_model");
			
			$dtz = new DateTimeZone("America/Lima");
			$dt = new DateTime("now", $dtz);
			//$fechaActual = $dt->format("Y-m-d h:i:s a");
			$fechaActual = $dt->format("Y-m-d h:i:s");
			
			$this->Evento_model->setAnio($this->input->post('anio'));
			$this->Evento_model->setNivelEvento($this->input->post('nivelevento'));
			$this->Evento_model->setIdEvento($this->input->post('evento'));
			$this->Evento_model->setDescripcion($this->input->post('descripcion'));
			$this->Evento_model->setFuente($this->input->post('fuente'));
			$this->Evento_model->setUbigeo($this->input->post('ubigeo'));
			$this->Evento_model->setLat($this->input->post('lat'));
			$this->Evento_model->setLng($this->input->post('lng'));
			$this->Evento_model->setFechaEvento($this->input->post('fechaevento')." ".$this->input->post('horaevento'));
			$this->Evento_model->setAfecta($this->input->post('afecta'));
			$this->Evento_model->setZoom($this->input->post('zoom'));
			$this->Evento_model->setlatSismo($this->input->post('latitudsismo'));
			$this->Evento_model->setlngSismo($this->input->post('longitudsismo'));
			$this->Evento_model->setProfundidad($this->input->post('profundidad'));
			$this->Evento_model->setMagnitud($this->input->post('magnitud'));
			$this->Evento_model->setIntensidad($this->input->post('intensidad'));
			$this->Evento_model->setReferencia($this->input->post('referencia'));
			$this->Evento_model->setUsuarioReg($this->session->userdata("idusuario"));
			$this->Evento_model->setFechaReg($fechaActual);
			
			if($this->input->post('tipo') == 'registrar'){
				$this->coun = ($this->Evento_model->sumaEventos()) + 1;
				$this->Evento_model->setCtaEvento($this->coun);
				$this->registrar();
			}
			if($this->input->post('tipo') == 'editar'){
				$this->Evento_model->setId($this->input->post('idregistro'));
				$this->coun = $this->input->post('ctaevento');
				$this->editar();
			}
		}
    }
	public function listar(){
		$this->load->model("Evento_model"); $this->load->model('Ubigeo_model'); $this->Ubigeo_model->setIdUser($this->session->userdata('idusuario'));
		$evts = $this->Evento_model->listarEv(); $listar = []; $i = 0;
		if($evts->num_rows() > 0){
			$evts = $evts->result();
			foreach($evts as $evt):
				$pro = $evt->provincia;
				$this->Ubigeo_model->setIdProv($pro);
				$ctatemp = $this->Ubigeo_model->ubigeosEvtUser();
				if($ctatemp > 0){ $listar[$i] = $evt; $i++; }
			endforeach;
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
	public function registrar()
    {
		$this->load->model("Evento_model");
		$id = $this->Evento_model->registrar();
		if ($id > 0){
			$this->Evento_model->setId($id); $resp = $this->guardarMapa($id);
			if($resp === 500) $data = array('status' => 200, 'mensaje' => 'Evento Registrado Exitosamente. Imagen del mapa no guardada');
			else $data = array('status' => 200, 'mensaje' => 'Evento Registrado Exitosamente');
			
		}else{ $data = array( "status" => 500, 'mensaje' => 'No se pudo registrar el Evento'); }
		
		echo json_encode($data);
    }
	
	public function editar(){
		$this->load->model("Evento_model");
		
		$id = $this->Evento_model->editar();
		if ($id > 0){
			$edita = $this->guardarMapa($id);
			if($edita === 500) $data = array('status' => 200, 'mensaje' => 'Evento Registrado Exitosamente. Imagen del mapa no guardada');
			else $data = array('status' => 200, 'mensaje' => 'Evento Registrado Exitosamente');
			
		}else{ $data = array( "status" => 500, 'mensaje' => 'No se pudo registrar el Evento'); }
		
		echo json_encode($data);
	}
	
	public function guardarMapa($id){
		$this->load->library('general');
		$pa = '';
		$imag = $this->general->guardarMapaCurl($this->path .'public/images/mapas_eventos/',$this->coun .'_gm.png',
											$this->input->post('lat'),$this->input->post('lng'),$this->input->post('zoom'));
		
		$imag = (!$imag == '')? $imag : ''; $resp_Mapa = false;
		
		if(!$imag == ''){ $this->Evento_model->setMapa($imag); $resp_Mapa = $this->Evento_model->guardarMapa(); }
		
		return ($resp_Mapa)? 200 : 500;
	}
	
	public function ubicacion($data){
		$this->load->model('Ubigeo_model');
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		$this->Ubigeo_model->setUbigeo($data->ubigeo);
		#Obtener Provincias del Usuario correspondientes al ubigeo
		$this->Ubigeo_model->setIdDpto(substr($data->ubigeo, 0, 2));
		$prov = $this->Ubigeo_model->proUser();
		($prov->num_rows() > 0)? $prov = $prov->result() : $prov = array();
		#Obtener Distritos del Usuario correspondientes al ubigeo
		$this->Ubigeo_model->setIdProv(substr($data->ubigeo,2,2));
		$dtto = $this->Ubigeo_model->dttos();
		($dtto->num_rows() > 0)? $dtto = $dtto->result() : $dtto = array();
		$ubicacion = array( 'prov' => $prov, 'dtto' => $dtto );
		
		return $ubicacion;
	}
	
	public function editarEvento(){
		$this->load->model('Evento_model');
		
		$this->Evento_model->setId($this->input->post('id'));
		$data = $this->Evento_model->editarEvento();
		
		if($data->num_rows() > 0){
			$data = $data->row();
			#Carga ubigeo del evento y regiones generales
			$ubicacion = $this->ubicacion($data);
			$this->Evento_model->setIdTipoEvt($data->idtipoevento);
			$evento = $this->Evento_model->cargarEvento(); $evento->num_rows() > 0? $evento = $evento->result() : $evento = array();
			
			$data = array(
				'regiones' => $ubicacion,
				'eventos' => $evento,
				'data' => $data,
				'status' => 200
			);
			
		}else{ $data = array( 'status' => 500 ); }
		
		echo json_encode($data);
	}
}