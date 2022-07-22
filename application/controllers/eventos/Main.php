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
			
			if($this->input->post('tipo') == 'registrar'){
				$this->coun = ($this->Evento_model->sumaEventos()) + 1;
				$this->Evento_model->setAnio($this->input->post('anio'));
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
				$this->registrar();
			}
			if($this->input->post('tipo') == 'editar'){
				$this->editar();
			}
		}
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
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
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
		
		$this->Ubigeo_model->setUbigeo($this->input->post("dpto").$this->input->post("prov").$this->input->post("dtto"));
		$ubigeo = $this->Ubigeo_model->latLng();
		
		$data = array(
			"ubigeo" => $ubigeo->result()
		);
		echo json_encode($data);
	}
	
	public function registrar()
    {
		$this->load->model("Evento_model");
		$id = $this->Evento_model->registrar();
		if ($id > 0){
			$pa = '';
			$imag = $this->saveImage($this->path .'public/template/images/eventos/',$this->coun);
			$resp_Mapa = '';
			if($this->path)
				$pa = $this->path;
			
			if(!$imag == ''){
				$this->Evento_model->setId($id);
				$this->Evento_model->setMapa($imag);
				$resp_Mapa = $this->Evento_model->guardarMapa();
			}
			$data = array(
				"status" => 200,
				"img" => $imag,
				'mapa' => $resp_Mapa,
				'segmento' => $this->uri->segment(2),
				'path' => $pa
            );
		}else{
			$data = array(
				"status" => 500,
				"campos" => $campos
            );
        }
		
		echo json_encode($data);
    }
	
	public function editar(){
		$data = array(
			'data' => 200
		);
		echo json_encode($data);
	}
	
	public function ubicacion($data){
		$this->load->model('Ubigeo_model');
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		$this->Ubigeo_model->setUbigeo($data->ubigeo);
		#Obtener Provincias del Usuario
		$this->Ubigeo_model->setIdDpto(substr($data->ubigeo, 0, 2));
		$prov = $this->Ubigeo_model->prov();		
		$prov->num_rows() > 0? $prov = $prov->result() : $prov = array();
		#Obtener Distritos del Usuario
		$this->Ubigeo_model->setIdProv(substr($data->ubigeo,2,2));
		$dtto = $this->Ubigeo_model->dttos();
		$dtto->num_rows() > 0? $dtto = $dtto->result() : $dtto = array();
		$ubicacion = array(
			'prov' => $prov,
			'dtto' => $dtto
		);
		return $ubicacion;
	}
	
	public function editarEvento(){
		$this->load->model('Evento_model');
		
		if($this->input->post('segmento') === 'editar'){
			$this->Evento_model->setId($this->input->post('data'));
			$data = $this->Evento_model->editarEvento();
			
			if($data->num_rows() > 0){
				$data = $data->row();
				#Carga ubigeo del evento y regiones generales
				$ubicacion = $this->ubicacion($data);
				#Carga datos generales de los eventos
				#$tipo = $this->Evento_model->tipoEvento(); $tipo->num_rows() > 0? $tipo = $tipo->result() : $tipo = array();
				#$nivel = $this->Evento_model->cargaNivel(); $nivel->num_rows() > 0? $nivel = $nivel->result() : $nivel = array();
				$this->Evento_model->setIdTipoEvt($data->idtipoevento);
				$evento = $this->Evento_model->cargarEvento(); $evento->num_rows() > 0? $evento = $evento->result() : $evento = array();
				
				$data = array(
					'regiones' => $ubicacion,
					#'tipoevento' => $tipo,
					#'nivel' => $nivel,
					'eventos' => $evento,
					'data' => $data,
					'status' => 200
				);
				
				//$data =  array('form'=>$this->load->view('eventos/form-edit',$data,TRUE),'data'=>$data);
			}else{
				$data = array(
					'status' => 500
				);
			}
		}
		
		echo json_encode($data);
	}
	
	public function saveImage($path,$count){
		$url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=" . trim($this->input->post('lat')) ."," . trim($this->input->post('lng')) . "&markers=color:red|label:|" . trim($this->input->post('lat')) . "," . trim($this->input->post('lng')) . "&zoom=" . $this->input->post('zoom') . "&size=596x280&key=AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc";
		$img = $count . "_gm.png";
		if(!file_exists($path)){
			$parts = explode('/', $path);
			array_pop($parts);
			$dir = implode( '/', $parts );;
			if( !is_dir( $dir ) )
				mkdir( $dir, 0777, true );
		}
		if(!file_put_contents($path . $img, file_get_contents($url),LOCK_EX) > 0)
			$img = '';
		
		return $img;
	}
	
	public function informe($html){
		$this->load->library("dom");
		//$html = $this->load->view($vista, $data, true);
        $this->dom->generate("portrait", "informe", $html, "Informe");
	}
}