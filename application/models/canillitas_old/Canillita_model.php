<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Canillita_model extends CI_Model
{
    private $id;
    private $apellidos;
    private $nombres;
    private $documento_numero;
    private $genero;
    private $fecha_nacimiento;
    private $estado_civil;
	private $condicion;
    private $foto;
    private $domicilio;
    #private $ubigeo_domicilio;
    private $telefono_01;
    private $telefono_02;
    private $email;
	private $obs;
    private $usuario_registro;
    private $fecha_registro;
    private $usuario_actualizacion;
    private $fecha_actualizacion;
	
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setApellidos($data){ $this->apellidos = $this->db->escape_str($data); }
    public function setNombres($data){ $this->nombres = $this->db->escape_str($data); }
    public function setDocumento_numero($data){ $this->documento_numero = $this->db->escape_str($data); }
    public function setGenero($data){ $this->genero = $this->db->escape_str($data); }
    public function setFecha_nacimiento($data){ $this->fecha_nacimiento = $this->db->escape_str($data); }
    public function setEstado_civil($data){ $this->estado_civil = $this->db->escape_str($data); }
    public function setCondicion($data){ $this->condicion = $this->db->escape_str($data); }
    public function setFoto($data){ $this->foto = $this->db->escape_str($data); }
    public function setDomicilio($data){ $this->domicilio = $this->db->escape_str($data); }
    #public function setUbigeo_domicilio($data){ $this->ubigeo_domicilio = $this->db->escape_str($data); }
    public function setTelefono_01($data){ $this->telefono_01 = $this->db->escape_str($data); }
    public function setTelefono_02($data){ $this->telefono_02 = $this->db->escape_str($data); }
    public function setEmail($data){ $this->email = $this->db->escape_str($data); }
	public function setObs($data){ $this->obs = $this->db->escape_str($data); }
    public function setUsuario_registro($data){ $this->usuario_registro = $this->db->escape_str($data); }
    public function setFecha_registro($data){ $this->fecha_registro = $this->db->escape_str($data); }
    public function setUsuario_actualizacion($data){ $this->usuario_actualizacion = $this->db->escape_str($data); }
    public function setFecha_actualizacion($data){ $this->fecha_actualizacion = $this->db->escape_str($data); }
    
    public function listar(){
        #$this->db->select("brigadista_id id,apellidos,nombres,Tipo_Documento_Codigo,documento_numero,genero,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') fecha_nacimiento,foto");
        $this->db->select("*");
        $this->db->from("canillita");
		
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
			"dni" => $this->documento_numero,
            "apellidos" => $this->apellidos, 
            "nombres" => $this->nombres,
			"fecnac" => $this->fecha_nacimiento,
			"sexo" => $this->genero,
			"idestadocivil" => $this->estado_civil,
			"idcondicion" => $this->estado_civil, 
            "domicilio" => $this->domicilio,  
            "telefono01" => $this->telefono_01, 
            "telefono02" => $this->telefono_02,
            "correo" => $this->email,
			"idbase" => 1,
			"idpuntoVenta" => 1,
			"observaciones" => $this->obs,
			"usuario_registro" => $this->usuario_registro,
			"fecha_registro" => $this->fecha_registro,
        );
        if($this->db->insert("canillita", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
	
	public function existe_canillita(){
        $this->db->select("1");
        $this->db->from("canillita");
        $this->db->where("dni",$this->documento_numero);
        $rs =  $this->db->get();
        return $rs->num_rows();
    }
}