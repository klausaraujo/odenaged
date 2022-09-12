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
	public function cargarprov(){
		$this->load->model("Ubigeo_model");
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
		$this->Ubigeo_model->setIdDpto($this->input->post("region"));
		
		$listaProv = $this->Ubigeo_model->proUser();		
		
		$data = array(
            "lista" => $listaProv->result()
        );
        
        echo json_encode($data);
	}
	public function cargardis(){
		$this->load->model("Ubigeo_model");
		
		$this->Ubigeo_model->setIdUser($this->session->userdata("idusuario"));
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
		
		$data = array( 'ubigeo' => ($ubigeo->num_rows() > 0)? $ubigeo->result() : array() );
		echo json_encode($data);
	}
	public function curl(){
		$this->load->library('general');
		$tipo = $this->input->post('type'); $doc = $this->input->post('dni');
		$resp = $this->general->curl($tipo, $doc);
		echo $resp;
	}
	public function mapasInteractivos(){
		$data = array(
            "tipo" => array(),
            "nivel" => array(),
            "departamentos" => array()
        );
		
		$this->load->view("mapas/eventosMonitoreo", $data);
	}
	
	/*public function urlCurl() {
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$zoom = $this->input->post('zoom');
		$url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=".trim($lat).",".trim($lng)."&markers=color:red|label:|".trim($lat).",".trim($lng)."&zoom=".$zoom."&size=596x280&key=AIzaSyByPoOpv9DTDZfL0dnMxewn5RHnzC8LGpc";

		$imagen = $_SERVER["DOCUMENT_ROOT"].'/odenaged/public/imagen_mapa.png';
		$ch = curl_init();
		$fp = fopen($imagen, 'wb');
		curl_setopt($ch, CURLOPT_URL, trim($url));
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, false);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- don't forget this
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- and this
		$result = curl_exec($ch);
		curl_close($ch);
		//fwrite($fp, $result);
		fclose($fp);
		
		
		$data = array(
			'resp' => ($result === true)? 200 : 500,
			'curl' => $result,
			'lat' => $lat,
			'lng' => $lng,
			'zoom' => $zoom,
			'url' => $url,
		);

		echo json_encode($data);
	}*/
}