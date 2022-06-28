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
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setIdModulo($data)
    {
        $this->idmodulo = $this->db->escape_str($data);
    }
    public function setIdMenuDetalle($data)
    {
        $this->idmenudetalle = $this->db->escape_str($data);
    }
    public function setIdUsusario($data)
    {
        $this->idusuario = $this->db->escape_str($data);
    }
    public function setStatus($data)
    {
        $this->status = $this->db->escape_str($data);
    }
    public function setIdPermiso($data)
    {
        $this->idpermiso = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("idmenu,descripcion,nivel,url,icono");
        $this->db->from("menu");
        $this->db->where("idmodulo", $this->idmodulo);
        return $this->db->get();
    }
    public function listaPermisos()
    {
        $this->db->select("m.idmenu,descripcion,nivel,url,icono,idmodulo");
        $this->db->from("menu m");
        $this->db->join("permisos_menu pm","pm.idmenu=m.idmenu");
        $this->db->where("idmodulo", $this->idmodulo);
        $this->db->where("idusuario", $this->idusuario);
        $this->db->where("pm.activo", "1");
        return $this->db->get();
    }
    public function listaSubMenu()
    {
        $this->db->select("idmenudetalle,idmenu,descripcion,url,icono,orden,mini");
        $this->db->from("menu_detalle");
        $this->db->where("idmenu", $this->id);
        $this->db->order_by("orden", "ASC");
        return $this->db->get();
    }
    public function listaSubMenuPermisos()
    {
        $this->db->select("md.idmenudetalle,idmenu,descripcion,url,icono,orden");
        $this->db->from("menu_detalle md");
        $this->db->join("permisos_menu_detalle p","p.idmenudetalle=md.idmenudetalle");
        $this->db->where("idmenu", $this->id);
        $this->db->where("idusuario", $this->idusuario);
        $this->db->where("Activo", "1");
        $this->db->order_by("orden", "ASC");
        return $this->db->get();
    }
    public function listaPermisosOpcion(){
        $this->db->select("idpermisoopcion,idpermiso,idusuario,Activo");
        $this->db->from("permisos_opcion");
        $this->db->where("idusuario", $this->idusuario);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function listaMenuUsuario(){
        $this->db->select("idmenu,idmodulo,descripcion,nivel,url,icono,estado");
        $this->db->from("menu");
        $this->db->where("estado", "1");
        return $this->db->get();
    }
    public function listaSubMenuUsuario(){
        $this->db->select("idmenudetalle,idmenu,descripcion,url,icono,orden,estado");
        $this->db->from("menu_detalle");
        $this->db->where("estado", "1");
        return $this->db->get();
    }
    public function listaSubMenuUsuarioById(){
            $this->db->select("idmenudetalle,idmenu,descripcion,url,icono,orden,estado");
            $this->db->from("menu_detalle");
            $this->db->where("estado", "1");
            $this->db->where("idmenu", $this->id);
            return $this->db->get();
        }
    public function permisos(){
        $this->db->select("idpermiso,descripcion,tipo,orden,estado,idmodulo");
        $this->db->from("permiso");
        $this->db->where("estado", "1");

        return $this->db->get();
    }
    public function permisosMenu(){
        $this->db->select("m.idmenu,pm.Activo,idmodulo,nivel");
        $this->db->from("menu m");
        $this->db->join("permisos_menu pm","m.idmenu=pm.idmenu","LEFT");
        $this->db->where("idusuario", $this->idusuario);
        return $this->db->get();
    }
    public function permisosSubMenu(){
        $this->db->select("m.idmenudetalle,pm.Activo,m.idmenu");
        $this->db->from("menu_detalle m");
        $this->db->join("permisos_menu_detalle pm","m.idmenudetalle=pm.idmenudetalle","LEFT");
        $this->db->where("idusuario", $this->idusuario);
        return $this->db->get();
    }
    public function permisosSubMenuById(){
        $this->db->select("m.idmenudetalle,pm.Activo,m.idmenu");
        $this->db->from("menu_detalle m");
        $this->db->join("permisos_menu_detalle pm","m.idmenudetalle=pm.idmenudetalle","LEFT");
        $this->db->where("idusuario", $this->idusuario);
        $this->db->where("idmenu", $this->id);
        return $this->db->get();
    }
    public function permisosDetalle(){
        $this->db->select("m.idpermiso,pm.Activo,m.idmodulo");
        $this->db->from("permiso m");
        $this->db->join("permisos_opcion pm","m.idpermiso=pm.idpermiso","LEFT");
        $this->db->where("idusuario", $this->idusuario);
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