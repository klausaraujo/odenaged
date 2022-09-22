<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Mapas_model extends CI_Model
{
    private $idUser;
	private $idRegEvt;
	private $inicio;
	private $fin;
	private $dpto;
	private $pro;
	private $dis;
	private $tipo;
	private $nivel;
	private $evento;
	private $campos;
    
    public function setId($data){ $this->idUser = $this->db->escape_str($data); }
	public function setIdRegEvt($data){ $this->idRegEvt = $this->db->escape_str($data); }
	public function setFechaInicio($data){ $this->inicio = $this->db->escape_str($data); }
	public function setFechaFin($data){ $this->fin = $this->db->escape_str($data); }
	public function setDpto($data){ $this->dpto = $this->db->escape_str($data); }
	public function setPro($data){ $this->pro = $this->db->escape_str($data); }
	public function setDis($data){ $this->dis = $this->db->escape_str($data); }
	public function setTipoEvt($data){ $this->tipo = $this->db->escape_str($data); }
	public function setNivel($data){ $this->nivel = $this->db->escape_str($data); }
	public function setEvento($data){ $this->evento = $this->db->escape_str($data); }
	public function setCampos($data){ $this->campos = $this->db->escape_str($data); }
	
    public function buscaEventoMapa()
    {
		$this->db->select($this->campos);
		$this->db->from('lista_general_eventos');
		//$this->db->join('evento_versiones ev','lg.idregistroevento = ev.idregistroevento');
		if($this->dpto){
			$this->db->where('SUBSTR(ubigeo,1,2)', $this->dpto);
			if($this->pro){
				$this->db->where('SUBSTR(ubigeo,3,2)', $this->pro);
				if($this->dis){
					$this->db->where('SUBSTR(ubigeo,5,2)', $this->dis);
				}
			}
		}
		if($this->nivel)$this->db->where('idnivel', $this->nivel);
		if($this->tipo)$this->db->where('idtipoevento', $this->tipo);
		if($this->evento)$this->db->where('idevento', $this->evento);
		$this->db->where('fecha >=',$this->inicio);
		$this->db->where('fecha <=',$this->fin);
		$this->db->where('activo', '1');
		//$this->db->group_by('lg.idregistroevento');
		return $this->db->get();
    }
}