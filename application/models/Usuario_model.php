<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Usuario_model extends CI_Model
{
    private $id;
    private $usuario;
    private $password;
	private $idperfil;
    private $idrol;
    private $Anio_Ejecucion;
    private $Codigo_Usuario;
    private $dni;
    private $apellidos;
    private $nombres;
	private $idDpto;
	private $idProv;
    private $avatar;
    private $activo;
	private $provincia;
	
    public function setAnio_Ejecucion($data){ $this->Anio_Ejecucion = $this->db->escape_str($data); }
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setactivo($data){ $this->activo = $this->db->escape_str($data); }
    public function setUsuario($data){ $this->usuario = $this->db->escape_str($data); }
    public function setPassword($data){ $this->password = $this->db->escape_str($data); }
    public function setIdRol($data){ $this->idrol = $this->db->escape_str($data); }
    public function setDNI($data){ $this->dni = $this->db->escape_str($data); }
    public function setApellidos($data){ $this->apellidos = $this->db->escape_str($data); }
    public function setNombres($data){ $this->nombres = $this->db->escape_str($data); }
    public function setPerfil($data){ $this->idperfil = $this->db->escape_str($data); }
    public function setRegion($data){ $this->Codigo_Region = $this->db->escape_str($data); }
	public function setProvincia($data){ $this->provincia = $this->db->escape_str($data); }
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
        $this->db->select("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo,p.perfil");
        $this->db->from("usuarios u");
        $this->db->join("perfil p", "u.idperfil=p.idperfil");
        $this->db->group_by("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo");
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
	public function avatar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("avatar", $this->avatar, TRUE);
        $this->db->where("idusuario", $this->id);
        $error = array();
        if ($this->db->update('usuarios')) return 1;
        else { $error = $this->db->error(); return $error["code"]; }
    }
	public function perfiles(){
		$this->db->select('idperfil,perfil');
		$this->db->from('perfil');
		$this->db->where("activo", '1');
		return $this->db->get();
	}
	public function existe()
    {
        $this->db->select("COUNT(1) total");
        $this->db->from("usuarios");
        $this->db->where("usuario", $this->usuario);
        $result = $this->db->get();
        $row = $result->row();

        if ($row->total > 0)
            return true;
        else
            return false;
    }
    public function registrar()
    {
        $data = array(
            "dni" => $this->dni,
			"avatar" => "user.jpg",
            "apellidos" => strtoupper($this->apellidos),
            "nombres" => strtoupper($this->nombres),
			'usuario' => $this->usuario,
			"passwd" => sha1('123456'),
            "idperfil" => $this->idperfil,
            "activo" => "1"
        );
        if ($this->db->insert('usuarios', $data))
            return true;
        else
            return false;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("DNI", $this->DNI, TRUE);
        $this->db->set("Apellidos", strtoupper($this->Apellidos), TRUE);
        $this->db->set("Nombres", strtoupper($this->Nombres), TRUE);
        $this->db->set("Usuario", $this->usuario, TRUE);
        $this->db->set("Codigo_Perfil", $this->Codigo_Perfil, TRUE);
        $this->db->set("Codigo_Region", $this->Codigo_Region, TRUE);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}