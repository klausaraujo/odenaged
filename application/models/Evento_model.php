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
	private $fuente;
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
	public function setFuente($data){ $this->fuente = $this->db->escape_str($data); }
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
	    
    public function listar()
	{
		$this->db->select("idregistroevento,anio_evento,numero_evento,nivel,tipo_evento,ubigeo,ubigeo_descripcion,departamento,provincia,distrito,estado");
        $this->db->from("lista_general_eventos");
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
	public function cargaNivel(){
		$this->db->select("idnivel,nivel");
        $this->db->from("nivel");
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function tipoDanio(){
		$this->db->select("idtipodanio,tipo_danio");
        $this->db->from("tipo_danio");
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function tipoAccion(){
		$this->db->select("idtipoaccion,tipo_accion");
        $this->db->from("tipo_accion");
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function sumaEventos(){
		$this->db->select('*');
        $this->db->from('registro_evento');
		return $this->db->count_all_results();
	}
	public function registrar()
	{
		#$this->descripcion = $this->db->escape($this->descripcion);
		#$this->fuente = $this->db->escape($this->fuente);
        $data = array(
			"anio_evento" => $this->anio,
            "numero_evento" => $this->ctaEvento, 
            "idnivel" => $this->nivelEvento,
			"idevento" => $this->idEvento,
			"descripcion" => $this->descripcion,
			"fuente_inicial" => $this->fuente,
			"ubigeo" => $this->ubigeo,
			"latitud" => $this->lat, 
            "longitud" => $this->lng, 
            "fecha" => $this->fechaEvt,
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
        }else { return 0; }
    }
	public function editar()
	{
		#$this->descripcion = $this->db->escape($this->descripcion);
		#$this->fuente = $this->db->escape($this->fuente);
        $data = array(
			"anio_evento" => $this->anio,
            "idnivel" => $this->nivelEvento,
			"idevento" => $this->idEvento,
			"descripcion" => $this->descripcion,
			"fuente_inicial" => $this->fuente,
			"ubigeo" => $this->ubigeo,
			"latitud" => $this->lat, 
            "longitud" => $this->lng, 
            "fecha" => $this->fechaEvt,
            "afecta_sector" => $this->afecta,
			"idusuario_actualizacion" => $this->usuarioReg,
			"fecha_actualizacion" => $this->fechaReg,
			"latitud_sismo" => $this->latSismo,
			"longitud_sismo" => $this->lngSismo,
			"profundidad_sismo" => $this->profundidad,
			"magnitud_sismo" => $this->magnitud,
			"intensidad_sismo" => $this->intensidad,
			"referencia_sismo" => $this->referencia,
			"zoom" => $this->zoom,
        );
        $this->db->where('idregistroevento', $this->id);
		$result = $this->db->update('registro_evento',$data);
		if($result) return true;
        else return false;
    }
	public function editarEvento(){
		$this->db->select('*');
        $this->db->from('registro_evento re');
		$this->db->join('evento e','re.idevento=e.idevento');
		$this->db->join('tipo_evento te','e.idtipoevento=te.idtipoevento');
		$this->db->where('re.idregistroevento',$this->id);
		$this->db->limit(1);
		//$this->db->where('activo','1');
		return $this->db->get();
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