<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Evento_model extends CI_Model
{
	private $id;
	private $idTipoEvt;
	private $anio;
	private $ctaEvento;
	private $nivelEvento;
	private $idEvento;
	private $descripcion;
    private $ubigeo;
	private $lat;
	private $lng;
	private $fechaEvt;
	private $horaEvt;
	private $afecta;
	private $zoom;
    private $usuarioReg;
    private $fechaReg;
	private $usuarioActualizacion;
    private $fechaActualizacion;
	private $mapa;
	private $latSismo;
	private $lngSismo;
	private $profundidad;
	private $magnitud;
	private $referencia;
	private $intensidad;
	
	#Registro
	public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setIdTipoEvt($data){ $this->idTipoEvt = $this->db->escape_str($data); }
    public function setAnio($data){ $this->anio = $this->db->escape_str($data); }
	public function setCtaEvento($data){ $this->ctaEvento = $this->db->escape_str($data); }
	public function setNivelEvento($data){ $this->nivelEvento = $this->db->escape_str($data); }
	public function setIdEvento($data){ $this->idEvento = $this->db->escape_str($data); }
	public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
    public function setUbigeo($data){ $this->ubigeo = $this->db->escape_str($data); }
	public function setLat($data){ $this->lat = $this->db->escape_str($data); }
	public function setLng($data){ $this->lng = $this->db->escape_str($data); }
	public function setFechaEvento($data){ $this->fechaEvt = $this->db->escape_str($data); }
	public function setHoraEvento($data){ $this->horaEvt = $this->db->escape_str($data); }
	public function setAfecta($data){ $this->afecta = $this->db->escape_str($data); }
	public function setZoom($data){ $this->zoom = $this->db->escape_str($data); }
    public function setUsuarioReg($data){ $this->usuarioReg = $this->db->escape_str($data); }
	public function setFechaReg($data){ $this->fechaReg = $this->db->escape_str($data); }
	public function setMapa($data){ $this->mapa = $this->db->escape_str($data); }
	public function setlatSismo($data){ $this->latSismo = $this->db->escape_str($data); }
	public function setlngSismo($data){ $this->lngSismo = $this->db->escape_str($data); }
	public function setProfundidad($data){ $this->profundidad = $this->db->escape_str($data); }
	public function setMagnitud($data){ $this->magnitud = $this->db->escape_str($data); }
	public function setIntensidad($data){ $this->intensidad = $this->db->escape_str($data); }
	public function setReferencia($data){ $this->referencia = $this->db->escape_str($data); }
	
	#Actualizacion	
    public function setUsuarioAct($data){ $this->usuarioActualizacion = $this->db->escape_str($data); }
    public function setFechaAct($data){ $this->fechaActualizacion = $this->db->escape_str($data); }
    
    public function listar()
	{
        #$this->db->select("brigadista_id id,apellidos,nombres,Tipo_Documento_Codigo,documento_numero,genero,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') fecha_nacimiento,foto");
        #$this->db->select("*");
		$this->db->select("idregistroevento idevento,anio_evento anio,numero_evento numero,descripcion,ubigeo,DATE_FORMAT(fecha,'%d/%m/%Y') fecha");
        $this->db->from("registro_evento");
        return $this->db->get();
    }	
	public function tipoEvento(){
		$this->db->select("*");
        $this->db->from("tipo_evento");
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function cargarEvento(){
		$this->db->select('idevento,evento');
        $this->db->from('evento');
		$this->db->where('idtipoevento', $this->idTipoEvt);
		$this->db->where('activo', '1');
		return $this->db->get();
	}
	public function sumaEventos(){
		$this->db->select('*');
        $this->db->from('registro_evento');
		return $this->db->count_all_results();
	}
	public function cargaNivel(){
		$this->db->select("idnivel,nivel");
        $this->db->from("nivel");
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function registrar()
	{
        $data = array(
			"anio_evento" => $this->anio,
            "numero_evento" => $this->ctaEvento, 
            "idnivel" => $this->nivelEvento,
			"idevento" => $this->idEvento,
			"descripcion" => $this->descripcion,
			"ubigeo" => $this->ubigeo,
			"latitud" => $this->lat, 
            "longitud" => $this->lng, 
            "fecha" => $this->fechaEvt, 
            "hora" => $this->horaEvt,
            "afecta_sector" => $this->afecta,
			"idusuario_registro" => $this->usuarioReg,
			"fecha_registro" => $this->fechaReg,
			"latitud_sismo" => $this->latSismo,
			"longitud_sismo" => $this->lngSismo,
			"profundidad_sismo" => $this->profundidad,
			"magnitud_sismo" => $this->magnitud,
			"intensidad_sismo" => $this->intensidad,
			"referencia_sismo" => $this->referencia,
			"idestado" => 1,
			"zoom" => $this->zoom,
        );
        if($this->db->insert("registro_evento", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
	public function editarEvento(){
		
	}
	public function guardarMapa(){
		$this->db->db_debug = FALSE;
        
        $this->db->set('mapa_imagen', $this->mapa, TRUE);
        $this->db->where("idregistroevento", $this->id);
        $error = array();
        if ($this->db->update('registro_evento'))
            return 1;
        else { $error = $this->db->error(); return $error["code"];}
	}
}