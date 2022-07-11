<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Evento_model extends CI_Model
{
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
	
	#Registro
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
	
	#Actualizacion	
    public function setUsuarioAct($data){ $this->usuarioActualizacion = $this->db->escape_str($data); }
    public function setFechaAct($data){ $this->fechaActualizacion = $this->db->escape_str($data); }
    
    public function listar()
	{
        #$this->db->select("brigadista_id id,apellidos,nombres,Tipo_Documento_Codigo,documento_numero,genero,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') fecha_nacimiento,foto");
        $this->db->select("*");
        $this->db->from("registro_evento");
		
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
}