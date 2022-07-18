<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Ubigeo_model extends CI_Model
{
    private $idDpto;
	private $idProv;
	private $idDtto;
	private $ubigeo;
	private $idUser;
	
    public function setIdUser($data){ $this->idUser = $this->db->escape_str($data); }
	public function setIdDpto($data){ $this->idDpto = $this->db->escape_str($data); }
    public function setIdProv($data){ $this->idProv = $this->db->escape_str($data); }
	public function setIdDtto($data){ $this->idDtto = $this->db->escape_str($data); }
	public function setUbigeo($data){$this->ubigeo = $this->db->escape_str($data);}
        
    public function dptos(){
        $this->db->distinct();
		$this->db->select("uu.cod_dep,ld.departamento");
		$this->db->from("usuarios_ubigeo uu");
		$this->db->join("ubigeo ld","uu.cod_dep=ld.cod_dep");
		$this->db->where("uu.idusuario", $this->idUser);
		return $this->db->get();
    }
	public function prov(){
		$this->db->distinct();
		$this->db->select("uu.cod_pro,ld.provincia");
		$this->db->from("usuarios_ubigeo uu");
		$this->db->join("ubigeo ld","uu.cod_pro=ld.cod_pro");
		$this->db->where("ld.cod_dep", $this->idDpto);
		$this->db->where("uu.idusuario", $this->idUser);
		return $this->db->get();
		/*
        $this->db->select("*");
        $this->db->from("lista_provincias");
        $this->db->where("cod_dep", $this->idDpto);
        return $this->db->get();*/
    }
	public function dttos(){
        $this->db->select("cod_dis,distrito");
        $this->db->from("lista_distritos");
		$this->db->where("cod_dep", $this->idDpto);
		$this->db->where("cod_pro", $this->idProv);
		return $this->db->get();
    }
	public function latLng(){
		$this->db->select("latitud,longitud");
        $this->db->from("lista_ubigeo");
		$this->db->where("ubigeo", $this->ubigeo);
		return $this->db->get();
	}
}