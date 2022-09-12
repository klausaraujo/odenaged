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
    
	# Devuelve las regiones asignadas al usuario
	public function depUser()
    {
		$this->db->distinct();
        $this->db->select('cod_dep,departamento');
        $this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('idusuario', $this->idUser);
        $this->db->order_by('cod_dep', 'ASC');
		return $this->db->get();
    }
	# Devuelve las provincias asignadas al usuario
	public function proUser()
    {
		$this->db->distinct();
        $this->db->select('cod_dep,cod_pro,provincia');
        $this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('idusuario', $this->idUser);
		$this->db->where('cod_dep', $this->idDpto);
        $this->db->order_by('cod_pro', 'ASC');
		return $this->db->get();
    }
	
	public function dttos(){
        $this->db->select('cod_dis,distrito');
        $this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('idusuario', $this->idUser);
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
		$this->db->order_by('codigo_region', 'asc');
		return $this->db->get();
	}
	public function dreUsuario(){
		$this->db->select('iddre');
		$this->db->from('usuarios_dre');
		$this->db->where('idusuario', $this->idUser);
		$this->db->order_by('iddre', 'asc');
		return $this->db->get();
    }
	public function zonasUGEL(){
		$this->db->select('idugel,iddre,codigo_ugel,nombre');
		$this->db->from('ugel');
		$this->db->where('iddre', $this->iddre);
		$this->db->order_by('iddre', 'asc');
		return $this->db->get();
	}	
	public function ugelUsuario(){
		$this->db->select('idugel');
		$this->db->from('usuarios_ugel');
		$this->db->where('idusuario', $this->idUser);
		$this->db->order_by('idugel', 'asc');
		return $this->db->get();
    }
	public function ubigeoByDep(){
		$this->db->distinct();
		$this->db->select('cod_dep,cod_pro');
		$this->db->from('ubigeo');
		$this->db->where('cod_dep', $this->idDpto);
		$this->db->order_by('cod_dep', 'asc');
		return $this->db->get();
    }
	public function ubigeosEvtUser(){
		$this->db->distinct();
		$this->db->select('cod_pro');
        $this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('idusuario', $this->idUser);
		$this->db->where('provincia', $this->idProv);
		$this->db->limit(1);
		return $this->db->count_all_results();
	}
	public function buscaIEDre(){
		$this->db->distinct();
		$this->db->select('iddre,dre,codigo_dre');
		$this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('idusuario', $this->idUser);
		$this->db->where('cod_dep', $this->idDpto);
		$this->db->order_by('iddre', 'asc');
		return $this->db->get();
	}
	public function buscaIEUgel(){
		$this->db->distinct();
		$this->db->select('idugel,codigo_ugel,ugel');
		$this->db->from('acceso_usuarios_dre_ugeles_ubigeos');
		$this->db->where('iddre', $this->iddre);
		$this->db->order_by('idugel', 'asc');
		return $this->db->get();
	}
}