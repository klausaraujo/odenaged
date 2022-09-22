<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Menu_model extends CI_Model
{
    private $id;
    private $idmodulo;
    private $idmenudetalle;
    private $idusuario;
    private $status;
    private $idpermiso;
	
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setIdModulo($data){ $this->idmodulo = $this->db->escape_str($data); }
    public function setIdMenuDetalle($data){ $this->idmenudetalle = $this->db->escape_str($data); }
    public function setIdUsuario($data){ $this->idusuario = $this->db->escape_str($data); }
    public function setStatus($data){ $this->status = $this->db->escape_str($data); }
    public function setIdPermiso($data){ $this->idpermiso = $this->db->escape_str($data); }
    
	public function __construct(){ parent::__construct(); }
    
	public function listaMenuPermisos()
    {
        $this->db->select("pm.idmenu,descripcion,nivel,url,icono,idmodulo,pm.activo");
        $this->db->from("permisos_menu pm");
        $this->db->join("menu m","pm.idmenu=m.idmenu");
		$this->db->where("idusuario", $this->idusuario);
        //$this->db->where("idmodulo", $this->idmodulo);
        $this->db->where("pm.activo", "1");
        return $this->db->get();
    }
	public function listaSubMenuPermisos()
    {
        $this->db->select("pd.idmenudetalle,idmenu,descripcion,url,icono,orden,pd.activo");
        $this->db->from("permisos_menu_detalle pd");
        $this->db->join("menu_detalle md","pd.idmenudetalle=md.idmenudetalle");
        $this->db->where("idusuario", $this->idusuario);
		//$this->db->where("idmenu", $this->id);
        $this->db->where("pd.activo", "1");
        $this->db->order_by("pd.idmenudetalle", "ASC");
		$this->db->order_by("orden", "ASC");
        return $this->db->get();
    }
    public function listaPermisosOpcion(){
        $this->db->select("idpermisoopcion,idpermiso,idusuario,activo");
        $this->db->from("permisos_opcion");
        $this->db->where("idusuario", $this->idusuario);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function permisos(){
        $this->db->select("idpermiso,descripcion,tipo,orden,estado,idmodulo");
        $this->db->from("permiso");
        $this->db->where("estado", "1");

        return $this->db->get();
    }
    public function otorgarPermisoMenu(){
        $this->db->select("Activo");
        $this->db->from("permisos_menu");
        $this->db->where("idmenu", $this->id);
        $this->db->where("idusuario", $this->idusuario);
        $permiso = $this->db->get();
        if($this->status=="1"){
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                if($permiso->Activo=="0"){
                    $this->db->set("Activo", "1", TRUE);
                    $this->db->where("idmenu", $this->id);
                    $this->db->where("idusuario", $this->idusuario);
                    $this->db->update('permisos_menu');
                }
            }
            else{
                $data = array(
                    "idmenu" => $this->id,
                    "idusuario" => $this->idusuario,
                    "Activo" => "1"
                );
                $this->db->insert('permisos_menu', $data);
            }
        }
        else{
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                if($permiso->Activo=="1"){
                    $this->db->set("Activo", "0", TRUE);
                    $this->db->where("idmenu", $this->id);
                    $this->db->where("idusuario", $this->idusuario);
                    $this->db->update('permisos_menu');
                    }
                }
        }
    }
    public function otorgarPermisoSubMenu(){
        $this->db->select("Activo");
        $this->db->from("permisos_menu_detalle");
        $this->db->where("idmenudetalle", $this->idmenudetalle);
        $this->db->where("idusuario", $this->idusuario);
        $permiso = $this->db->get();
        if($this->status=="1"){
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                if($permiso->Activo=="0"){
                    $this->db->set("Activo", "1", TRUE);
                    $this->db->where("idmenudetalle", $this->idmenudetalle);
                    $this->db->where("idusuario", $this->idusuario);
                    $this->db->update('permisos_menu_detalle');
                }
            }
            else{
                $data = array(
                    "idmenudetalle" => $this->idmenudetalle,
                    "idusuario" => $this->idusuario,
                    "Activo" => "1"
                );

                $this->db->insert('permisos_menu_detalle', $data);
            }
        }
        else{
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                $this->db->set("Activo", "0", TRUE);
                $this->db->where("idmenudetalle", $this->idmenudetalle);
                $this->db->where("idusuario", $this->idusuario);
                $this->db->update('permisos_menu_detalle');
            }
        }
    }
    public function otorgarPermiso(){
        $this->db->select("Activo");
        $this->db->from("permisos_opcion");
        $this->db->where("idpermiso", $this->idpermiso);
        $this->db->where("idusuario", $this->idusuario);
        $permiso = $this->db->get();
        if($this->status=="1"){
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                if($permiso->Activo=="0"){
                    $this->db->set("Activo", "1", TRUE);
                    $this->db->where("idpermiso", $this->idpermiso);
                    $this->db->where("idusuario", $this->idusuario);
                    $this->db->update('permisos_opcion');
                }
            }
            else{
                $data = array(
                    "idpermiso" => $this->idpermiso,
                    "idusuario" => $this->idusuario,
                    "Activo" => "1"
                );
                $this->db->insert('permisos_opcion', $data);
            }
        }
        else{
            if($permiso->num_rows()>0){
                $permiso = $permiso->row();
                $this->db->set("Activo", "0", TRUE);
                $this->db->where("idpermiso", $this->idpermiso);
                $this->db->where("idusuario", $this->idusuario);
                $this->db->update('permisos_opcion');
            }
        }
    }
    public function elimninarPermisosMenu(){
        $this->db->db_debug = FALSE;
        $this->db->where("idusuario", $this->idusuario);
        $error = array();
        if ($this->db->delete('permisos_menu'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function elimninarPermisosMenuDetalle(){
        $this->db->db_debug = FALSE;
        $this->db->where("idusuario", $this->idusuario);
        $error = array();
        if ($this->db->delete('permisos_menu_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function elimninarPermisosOpcion(){
        $this->db->db_debug = FALSE;
        $this->db->where("idusuario", $this->idusuario);
        $error = array();
        if ($this->db->delete('permisos_opcion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }       
    }
}