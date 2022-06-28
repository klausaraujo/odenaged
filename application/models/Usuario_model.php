<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Usuario_model extends CI_Model
{
    private $id;
    private $usuario;
    private $password;
    private $passPIA;
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
    public function setAnio_Ejecucion($data)
    {
        $this->Anio_Ejecucion = $this->db->escape_str($data);
    }
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setactivo($data)
    {
        $this->activo = $this->db->escape_str($data);
    } 
    public function setUsuario($data)
    {
        $this->usuario = $this->db->escape_str($data);
    }
    public function setPassword($data)
    {
        $this->password = $this->db->escape_str($data);
    }
    public function setPassPIA($data)
    {
        $this->passPIA = $this->db->escape_str($data);
    }
    public function setIdRol($data)
    {
        $this->idrol = $this->db->escape_str($data);
    }
    public function setCodigo_Usuario($data)
    {
        $this->Codigo_Usuario = $this->db->escape_str($data);
    }
    public function setDNI($data)
    {
        $this->DNI = $this->db->escape_str($data);
    }
    public function setApellidos($data)
    {
        $this->Apellidos = $this->db->escape_str($data);
    }
    public function setNombres($data)
    {
        $this->Nombres = $this->db->escape_str($data);
    }
    public function setCodigo_Perfil($data)
    {
        $this->Codigo_Perfil = $this->db->escape_str($data);
    }
    public function setCodigo_Region($data)
    {
        $this->Codigo_Region = $this->db->escape_str($data);
    }
    public function setCodigo_Sector($data)
    {
        $this->Codigo_Sector = $this->db->escape_str($data);
    }
    public function setCodigo_Pliego($data)
    {
        $this->Codigo_Pliego = $this->db->escape_str($data);
    }
    public function setCodigo_Ejecutora($data)
    {
        $this->Codigo_Ejecutora = $this->db->escape_str($data);
    }
    public function setCodigo_Centro_Costos($data)
    {
        $this->Codigo_Centro_Costos = $this->db->escape_str($data);
    }
    public function setCodigo_Sub_Centro_Costos($data)
    {
        $this->Codigo_Sub_Centro_Costos = $this->db->escape_str($data);
    }
    public function setAvatar($data)
    {
        $this->avatar = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function iniciar()
    {
        $this->db->select('usuarios.idusuario,usuarios.usuario,usuarios.avatar,usuarios.apellidos apellido,usuarios.nombres nombre,usuarios.idperfil idrol,usuarios.activo');
        $this->db->from('usuarios');
        $this->db->where("usuarios.usuario", $this->usuario);
        $this->db->where("usuarios.passwd", sha1($this->password));
        $this->db->where("usuarios.activo", "1");
        return $this->db->get();
    }
    /*public function actualizar_chat () {
        $this->db->select('cu.idchat_usuario, cu.Guid, cu.Estado');
        $this->db->from('chat_usuario cu');
        $this->db->where('cu.Codigo_usuario', $this->id);
        $result = $this->db->get();
        $row = $result->row();
        if ($row->idchat_usuario > 0) {
            $this->db->db_debug = FALSE;
            $this->db->set("Estado", $this->Estado, TRUE);
            $this->db->where("Codigo_Usuario", $this->id);
            $this->db->update('chat_usuario');
            return $result;
        }
        else {
            $data = array(
                "Codigo_Usuario" => $this->id,
                "Nombre_usuario" => strtoupper($this->Nombres),
                "Apellido_usuario" => strtoupper($this->Apellidos),
                "Estado" => $this->Estado
            );
            $this->db->set('Guid', 'UUID()', FALSE);
            if ($this->db->insert('chat_usuario', $data)){
                $id = $this->db->insert_id();
                $response = $this->db->get_where('chat_usuario', array('idchat_usuario' => $id));
                return $response;
            }
            else
                return false;
        }
    }
    */
    /*public function areas()
    {
        $this->db->select('ua.Codigo_Usuario,ua.Anio_Ejecucion,ua.Codigo_Sector,ua.Codigo_Pliego,ua.Codigo_Ejecutora,ua.Codigo_Centro_Costos,ua.Codigo_Sub_Centro_Costos,ua.Codigo_Area,ua.Activo');
        $this->db->from('usuarios u');
        $this->db->join('usuarios_areas ua', 'u.Codigo_Usuario=ua.Codigo_Usuario');
        $this->db->where("u.Codigo_Usuario", $this->id);
        return $this->db->get();
    }*/
    public function listaModulo()
    {
        $this->db->select('modulo.idmodulo,descripcion,menu,icono,url,modulo_rol.activo,imagen,mini');
        $this->db->from('modulo');
        $this->db->join('modulo_rol', 'modulo_rol.idmodulo = modulo.idmodulo');
        $this->db->where("idperfil", $this->idrol);
        $this->db->order_by("orden", "asc");
        return $this->db->get();
    }
    /*public function listaChat()
    {
        $this->db->select('cu.Nombre_Usuario, cu.Guid, cu.Estado, u.avatar');
        $this->db->from('chat_usuario cu');
        $this->db->join("usuarios u", "u.Codigo_Usuario  = cu.Codigo_usuario");
        $this->db->where_not_in("cu.Codigo_usuario", $this->id);
        $this->db->order_by("cu.Estado", "desc");
        $this->db->order_by("cu.Nombre_Usuario", "asc");
        return $this->db->get();
    }
    */
    public function lista()
    {
        $this->db->select("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo,p.descripcion");
        $this->db->from("usuarios u");
        $this->db->join("perfil p", "u.idperfil=p.idperfil");
        $this->db->group_by("u.idusuario,u.dni,u.avatar,u.apellidos,u.nombres,u.usuario,u.passwd,u.idperfil,u.activo");
        return $this->db->get();
    }
    public function existe()
    {
        $this->db->select("COUNT(1) total");
        $this->db->from("usuarios");
        $this->db->where("Usuario", $this->usuario);
        $result = $this->db->get();
        $row = $result->row();

        if ($row->total > 0)
            return true;
        else
            return false;
    }
    public function existeByCodigo()
    {
        $this->db->select("COUNT(1) total");
        $this->db->from("usuarios");
        $this->db->where("Usuario", $this->usuario);
        $this->db->where("Codigo_Usuario!=", $this->Codigo_Usuario);
        $result = $this->db->get();
        $row = $result->row();
        if ($row->total > 0)
            return true;
        else
            return false;
    }
    public function generarCodigo()
    {
        $this->db->select("MAX(Codigo_Usuario*1) Codigo");
        $this->db->from("usuarios");
        $result = $this->db->get();
        $row = $result->row();
        return ($row->Codigo + 1);
    }

    public function registrar()
    {
        $data = array(
            "Codigo_Usuario" => $this->Codigo_Usuario,
            "Usuario" => $this->usuario,
            "DNI" => $this->DNI,
            "Apellidos" => strtoupper($this->Apellidos),
            "Nombres" => strtoupper($this->Nombres),
            "Codigo_Perfil" => $this->Codigo_Perfil,
            "Codigo_Region" => $this->Codigo_Region,
            "avatar" => "user.jpg",
            "Passwd" => sha1('123456'),
            "Activo" => "1"
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
    public function password()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Passwd", sha1($this->password), TRUE);
        $this->db->where("Usuario", $this->id);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function password2()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Passwd", sha1($this->password), TRUE);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function resetpassword()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Passwd", sha1("123456"), TRUE);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function validar_password()
    {
        $this->db->select('Passwd passwd');
        $this->db->from('usuarios');
        $this->db->where("Usuario", $this->id);
        $pass = $this->db->get();
        $pass = $pass->row();
        if(sha1($this->password) == $pass->passwd) return 1;
        else return $this->id;
    }
    public function desactivar()
    {
        $this->db->set("Activo", "0", TRUE);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function activar()
    {
        $this->db->set("Activo", "1", TRUE);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function imagen()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("avatar", $this->avatar, TRUE);
        $this->db->where("Codigo_Usuario", $this->id);
        $error = array();
        if ($this->db->update('usuarios'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }   
    public function perfilByID()
    {
        $this->db->select("Codigo_Perfil");
        $this->db->from("usuarios");
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        return $this->db->get();
    }
}