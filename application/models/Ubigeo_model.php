<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Ubigeo_model extends CI_Model
{
    private $idDpto;
	private $idProv;
	private $idDtto;
	
    public function setidDpto($data){ $this->idDpto = $this->db->escape_str($data); }
    public function setIdProv($data){ $this->idProv = $this->db->escape_str($data); }
	public function setIdDtto($data){ $this->idDtto = $this->db->escape_str($data); }
        
    public function dptos(){
        $this->db->select("*");
        $this->db->from("lista_departamentos");
		return $this->db->get();
    }
	public function listarProv(){
        $this->db->select("*");
        $this->db->from("lista_provincias");
        $this->db->where("cod_dep", $this->idDpto);
        return $this->db->get();
    }
	public function listarDtto(){
        $this->db->select("cod_dis,distrito");
        $this->db->from("lista_distritos");
		$this->db->where("cod_dep", $this->idDpto);
		$this->db->where("cod_pro", $this->idProv);
		return $this->db->get();
    }
}