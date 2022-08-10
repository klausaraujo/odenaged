<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Usuario_model extends CI_Model
{
    private $id;
    private $usuario;
    private $password;
    private $idrol;
    private $Anio_Ejecucion;
    private $Codigo_Usuario;
    private $DNI;
    private $Apellidos;
    private $Nombres;
    private $Codigo_Perfil;
    private $Codigo_Region;
    private $Codigo_Sector;
    private $Codigo_Pliego;
    private $Codigo_Ejecutora;
    private $codigo_Centro_Costos;
    private $codigo_Sub_Centro_Costos;
    private $avatar;
    private $activo;
	
    public function setAnio_Ejecucion($data){ $this->Anio_Ejecucion = $this->db->escape_str($data); }
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setactivo($data){ $this->activo = $this->db->escape_str($data); }
    public function setUsuario($data){ $this->usuario = $this->db->escape_str($data); }
    public function setPassword($data){ $this->password = $this->db->escape_str($data); }
    public function setIdRol($data){ $this->idrol = $this->db->escape_str($data); }
    public function setDNI($data){ $this->DNI = $this->db->escape_str($data); }
    public function setApellidos($data){ $this->Apellidos = $this->db->escape_str($data); }
    public function setNombres($data){ $this->Nombres = $this->db->escape_str($data); }
    public function setCodigo_Perfil($data){ $this->Codigo_Perfil = $this->db->escape_str($data); }
    public function setCodigo_Region($data){ $this->Codigo_Region = $this->db->escape_str($data); }
    public function setAvatar($data){ $this->avatar = $this->db->escape_str($data); }
	
    public function __construct() { parent::__construct(); }
	
    public function iniciar()
    {
        $this->db->select('usuarios.idusuario,usuarios.usuario,usuarios.avatar,usuarios.apellidos apellido,usuarios.nombres nombre,usuarios.idperfil idrol,usuarios.activo');
        $this->db->from('usuarios');
        $this->db->where("usuarios.usuario", $this->usuario);
        $this->db->where("usuarios.passwd", sha1($this->password));
        $this->db->where("usuarios.activo", "1");
		$this->db->limit(1);
        return $this->db->get();
    }
	public function anio(){
		$this->db->select('*');
		$this->db->from('anio');
		return $this->db->get();
	}
	public function mes(){
		$this->db->select('*');
		$this->db->from('mes');
		return $this->db->get();
	}
    public function listaModulo()
    {
        $this->db->select('modulo.idmodulo,descripcion,menu,icono,url,modulo_rol.activo,imagen,mini');
        $this->db->from('modulo');
        $this->db->join('modulo_rol', 'modulo_rol.idmodulo = modulo.idmodulo');
        $this->db->where("idperfil", $this->idrol);
        $this->db->order_by("orden", "asc");
        return $this->db->get();
    }
    public function lista()
    {
        $this->db->select("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo,p.descripcion");
        $this->db->from("usuarios u");
        $this->db->join("perfil p", "u.idperfil=p.idperfil");
        $this->db->group_by("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo");
        return $this->db->get();
    }
	public function listaUbigeos()
    {
        $this->db->select("cod_dep,cod_pro");
        $this->db->from("usuarios_ubigeo");
		$this->db->where("idusuario", $this->idusuario);
        return $this->db->get();
    }
	public function validar_password()
    {
        $this->db->select('passwd');
        $this->db->from('usuarios');
        $this->db->where("idusuario", $this->id);
        $pass = $this->db->get();
        $pass = $pass->row();
        if(sha1($this->password) == $pass->passwd) return 1;
        else return 0;
    }
	public function password()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("passwd", sha1($this->password), TRUE);
        $this->db->where("idusuario", $this->id);
        $error = array();
        if ($this->db->update('usuarios')) return 1;
        else { $error = $this->db->error(); return $error["code"]; }
    }
}