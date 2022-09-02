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
	private $iddre;
	private $idugel;
	
    public function setIdUser($data){ $this->idUser = $this->db->escape_str($data); }
	public function setIdDpto($data){ $this->idDpto = $this->db->escape_str($data); }
    public function setIdProv($data){ $this->idProv = $this->db->escape_str($data); }
	public function setIdDtto($data){ $this->idDtto = $this->db->escape_str($data); }
	public function setUbigeo($data){$this->ubigeo = $this->db->escape_str($data);}
	public function setIdDre($data){$this->iddre = $this->db->escape_str($data);}
	public function setIdUgel($data){$this->idugel = $this->db->escape_str($data);}
    
    public function dptos(){
        $this->db->distinct();
		$this->db->select('uu.cod_dep,ld.departamento');
		$this->db->from('usuarios_ubigeo uu');
		$this->db->join('lista_departamentos ld','uu.cod_dep=ld.cod_dep');
		$this->db->where('uu.idusuario', $this->idUser);
		$this->db->order_by('uu.cod_dep', 'asc');
		return $this->db->get();
    }
	public function prov(){
		$this->db->distinct();
		$this->db->select('uu.cod_pro,lp.provincia');
		$this->db->from('usuarios_ubigeo uu');
		$this->db->join('lista_provincias lp','uu.cod_pro=lp.cod_pro');
		$this->db->where('lp.cod_dep', $this->idDpto);
		$this->db->where('uu.idusuario', $this->idUser);
		$this->db->order_by('uu.cod_pro', 'asc');
		return $this->db->get();
    }
	public function dttos(){
        $this->db->select('cod_dis,distrito');
        $this->db->from('lista_distritos');
		$this->db->where('cod_dep', $this->idDpto);
		$this->db->where('cod_pro', $this->idProv);
		$this->db->order_by('cod_dis', 'asc');
		return $this->db->get();
    }
	public function latLng(){
		$this->db->select("latitud,longitud");
        $this->db->from("lista_ubigeo");
		$this->db->where("ubigeo", $this->ubigeo);
		return $this->db->get();
	}
	public function zonasRegion(){
		$this->db->select('cod_dep,departamento');
		$this->db->from('lista_departamentos');
		$this->db->order_by('cod_dep', 'asc');
		return $this->db->get();
	}
	public function zonasDRE(){
		$this->db->select('iddre,codigo_dre,nombre,codigo_region');
		$this->db->from('dre');
		$this->db->where('codigo_region', $this->idDpto);
		$this->db->order_by('codigo_region', 'asc');
		return $this->db->get();
	}
	public function zonasUGEL(){
		$this->db->select('idugel,iddre,codigo_ugel,nombre');
		$this->db->from('ugel');
		$this->db->where('iddre', $this->iddre);
		$this->db->order_by('iddre', 'asc');
		return $this->db->get();
	}
	public function zonasPro(){
		$this->db->distinct();
		$this->db->select('cod_pro,provincia');
		$this->db->from('lista_provincias');
		$this->db->where('cod_dep', $this->idDpto);
		$this->db->where('cod_pro', $this->idProv);
		$this->db->limit(1);
		return $this->db->get();
	}
}