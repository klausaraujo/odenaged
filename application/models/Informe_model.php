<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Informe_model extends CI_Model
{
	private $idRegistroEvento;
	
	#Registro
	public function setIdEvento($data){ $this->idRegistroEvento = $this->db->escape_str($data); }
    
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
		$this->db->select('ap.idtipoaccionevento,ap.version,ap.idtipoaccion,ap.descripcion,ap.fecha,ta.tipo_accion');
        $this->db->from('tipo_accion_evento ap');
		$this->db->join('tipo_accion ta','ap.idtipoaccion = ta.idtipoaccion');
		$this->db->where('ap.idregistroevento', $this->idRegistroEvento);
		$this->db->where('ap.activo', '1');
        return $this->db->get();
    }
	public function listaFotos()
	{
		$this->db->select('idgaleria,fotografia,descripcion');
        $this->db->from('galeria_evento');
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('activo', '1');
        return $this->db->get();
    }
}