<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Informe_model extends CI_Model
{
	private $idRegistroEvento;
	private $ubigeo;
	private $nombImg;
	private $version;
	private $descripcion;
	private $tipoDanio;
	private $cantidad;
	private $tipoAccion;
	private $fechaHora;
	private $idIES;
	private $tabla;
	
	#Registro
	public function setIdEvento($data){ $this->idRegistroEvento = $this->db->escape_str($data); }
	public function setUbigeo($data){ $this->ubigeo = $this->db->escape_str($data); }
	public function setImg($data){ $this->nombImg = $this->db->escape_str($data); }
	public function setVersion($data){ $this->version = $this->db->escape_str($data); }
	public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
	public function setTipoDanio($data){ $this->tipoDanio = $this->db->escape_str($data); }
	public function setCantidad($data){ $this->cantidad = $this->db->escape_str($data); }
	public function setTipoAccion($data){ $this->tipoAccion = $this->db->escape_str($data); }
	public function setFechaHora($data){ $this->fechaHora = $this->db->escape_str($data); }
	public function setIdIES($data){ $this->idIES = $this->db->escape_str($data); }
	public function setTabla($data){ $this->tabla = $this->db->escape_str($data); }
    
    public function listaDanio()
	{
		$this->db->select('da.ideventotipodanio,da.version,da.idtipodanio,da.cantidad,td.tipo_danio');
        $this->db->from('evento_tipo_danio da');
		$this->db->join('tipo_danio td','td.idtipodanio = da.idtipodanio');
		$this->db->where('da.idregistroevento', $this->idRegistroEvento);
		$this->db->where('da.activo', '1');
        return $this->db->get();
    }
	public function listaAccion()
	{
		$this->db->select('ap.idtipoaccionevento,ap.version,ap.idtipoaccion,ap.descripcion,ap.fecha,DATE_FORMAT(ap.fecha,"%H:%i:%s") hora,ta.tipo_accion');
        $this->db->from('tipo_accion_evento ap');
		$this->db->join('tipo_accion ta','ap.idtipoaccion = ta.idtipoaccion');
		$this->db->where('ap.idregistroevento', $this->idRegistroEvento);
		$this->db->where('ap.activo', '1');
        return $this->db->get();
    }
	public function listaFotos()
	{
		$this->db->select('idgaleria,version,fotografia,descripcion');
        $this->db->from('galeria_evento');
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('activo', '1');
        return $this->db->get();
    }
	public function listaIE()
	{
		$this->db->select('ie.idiestevento,ie.idiest,ie.version,ie.descripcion,ie.fecha,ed.CEN_EDU');
        $this->db->from('iest_2020_all_evento ie');
		$this->db->join('iest_2020_all ed','ie.idiest = ed.ID');
		$this->db->where('ie.idregistroevento', $this->idRegistroEvento);
		$this->db->where('ie.activo', '1');
        return $this->db->get();
    }
	public function buscaIE(){
		$this->db->select('ID,CEN_EDU,COD_MOD,CODLOCAL,NIV_MOD,D_NIV_MOD');
        $this->db->from('iest_2020_all');
		$this->db->where('CODGEO', $this->ubigeo);		
        return $this->db->get();
	}
	public function borraPreliminar(){
		//$consulta = $this->db->query('DELETE FROM galeria_evento WHERE version='.$this->version);
		$this->db->where('version', $this->version);
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		return $this->db->delete($this->tabla);;
	}
	public function registrarFotos(){		
		$data = array(
			'version' => $this->version,
			'idregistroevento' => $this->idRegistroEvento,
			'fotografia' => $this->nombImg,
			'descripcion' => $this->descripcion,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarDanios(){		
		$data = array(
			'version' => $this->version,
			'idtipodanio' => $this->tipoDanio,
			'idregistroevento' => $this->idRegistroEvento,
			'cantidad' => $this->cantidad,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarAcciones(){
		$data = array(
			'version' => $this->version,
			'idtipoaccion' => $this->tipoAccion,
			'idregistroevento' => $this->idRegistroEvento,
			'descripcion' => $this->descripcion,
			'fecha' => $this->fechaHora,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarIES(){
		$data = array(
			'version' => $this->version,
			'idiest' => $this->idIES,
			'idregistroevento' => $this->idRegistroEvento,
			'descripcion' => $this->descripcion,
			'fecha' => $this->fechaHora,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	
}