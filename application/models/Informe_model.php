<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Informe_model extends CI_Model
{
	private $idRegistroEvento;
	private $ubigeo;
	private $nombImg;
	private $version;
	private $descripcion;
	private $tipoDanio;
	private $cantidad;
	private $tipoAccion;
	private $fechaHora;
	private $idIES;
	private $accion;
	private $campo;
	private $tabla;
	private $camposClonar;
	private $campos;
	private $uRegistro;
	private $fRegistro;
	private $uActualiza;
	private $fActualiza;
	
	#Registro
	public function setIdEvento($data){ $this->idRegistroEvento = $this->db->escape_str($data); }
	public function setUbigeo($data){ $this->ubigeo = $this->db->escape_str($data); }
	public function setImg($data){ $this->nombImg = $this->db->escape_str($data); }
	public function setVersion($data){ $this->version = $this->db->escape_str($data); }
	public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
	public function setTipoDanio($data){ $this->tipoDanio = $this->db->escape_str($data); }
	public function setCantidad($data){ $this->cantidad = $this->db->escape_str($data); }
	public function setTipoAccion($data){ $this->tipoAccion = $this->db->escape_str($data); }
	public function setFechaHora($data){ $this->fechaHora = $this->db->escape_str($data); }
	public function setIdIES($data){ $this->idIES = $this->db->escape_str($data); }
	public function setAccion($data){ $this->accion = $this->db->escape_str($data); }
	public function setCampo($data){ $this->campo = $this->db->escape_str($data); }
	public function setTabla($data){ $this->tabla = $this->db->escape_str($data); }
	public function setCamposClonar($data){ $this->camposClonar = $this->db->escape_str($data); }
	public function setCampos($data){ $this->campos = $this->db->escape_str($data); }
	public function setUsuarioReg($data){ $this->uRegistro = $this->db->escape_str($data); }
	public function setFechaReg($data){ $this->fRegistro = $this->db->escape_str($data); }
	public function setUsuarioAct($data){ $this->uActualiza = $this->db->escape_str($data); }
	public function setFechaAct($data){ $this->fActualiza = $this->db->escape_str($data); }
    
    public function clonarAcciones(){
		$query = 'INSERT INTO '.$this->tabla.' ('.$this->camposClonar.') SELECT '.$this->campos.' FROM '.
				$this->tabla.' WHERE idregistroevento='.$this->idRegistroEvento.' AND version='.$this->version;
		$this->db->query($query);
		
		$this->db->db_debug = FALSE;
		$data = array( 'idusuario_apertura' => $this->uRegistro, 'fecha_apertura' => $this->fRegistro );
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version', $this->version + 1);
		return $this->db->update( $this->tabla, $data );
	}
	public function cierraAcciones(){
		$this->db->db_debug = FALSE;
		/*$data = array( 'idusuario_actualizacion' => $this->uRegistro, 'fecha_actualizacion' => $this->fRegistro,'fecha_cierre' => $this->fRegistro,
					'idusuario_cierre' => $this->uRegistro, 'activo' => 0 );*/
		$data = array( 'fecha_cierre' => $this->fRegistro,'idusuario_cierre' => $this->uRegistro, 'activo' => 0 );
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version', $this->version);
		return  $this->db->update( $this->tabla, $data );
	}
	/*
	public function traeComplementario(){
		$query = 'SELECT DISTINCT version,fecha_apertura,activo FROM '.$this->tabla.' WHERE idregistroevento='.$this->idRegistroEvento.'  AND version > 0';
		return $this->db->query($query);
	}
	*//**/
	public function traeVersion(){
		$data = array();$i = 0;
		$this->db->distinct(); $this->db->select('version,fecha_apertura,fecha_cierre,activo'); $this->db->from('evento_tipo_danio'); $this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version >', '0'); $this->db->order_by("version", "DESC"); $data[$i] = $this->db->get(); $i++;
		$this->db->distinct();$this->db->select('version,fecha_apertura,fecha_cierre,activo'); $this->db->from('tipo_accion_evento'); $this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version >', '0'); $this->db->order_by("version", "DESC"); $data[$i] = $this->db->get(); $i++;
		$this->db->distinct(); $this->db->select('version,fecha_apertura,fecha_cierre,activo'); $this->db->from('galeria_evento'); $this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version >', '0'); $this->db->order_by("version", "DESC"); $data[$i] = $this->db->get(); $i++;
		$this->db->distinct(); $this->db->select('version,fecha_apertura,fecha_cierre,activo'); $this->db->from('iest_2020_all_evento'); $this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version >', '0'); $this->db->order_by("version", "DESC"); $data[$i] = $this->db->get(); $i++;
		
		$max = max($data[0]->num_rows(),$data[1]->num_rows(),$data[2]->num_rows(),$data[3]->num_rows());
		return array('version'=>$max,'data'=>$data);
	}
	public function listaDanio()
	{
		$this->db->select('da.ideventotipodanio,da.version,da.idtipodanio,da.cantidad,da.activo,da.idusuario_apertura,da.fecha_apertura,td.tipo_danio');
        $this->db->from('evento_tipo_danio da');
		$this->db->join('tipo_danio td','td.idtipodanio = da.idtipodanio');
		$this->db->where('da.idregistroevento', $this->idRegistroEvento);
		$this->db->where('da.version', $this->version);
        return $this->db->get();
    }
	public function listaAccion()
	{
		$this->db->select('ap.idtipoaccionevento,ap.version,ap.idtipoaccion,ap.descripcion,ap.fecha,DATE_FORMAT(ap.fecha,"%H:%i:%s") hora,ap.idusuario_apertura,ap.fecha_apertura,ta.tipo_accion');
        $this->db->from('tipo_accion_evento ap');
		$this->db->join('tipo_accion ta','ap.idtipoaccion = ta.idtipoaccion');
		$this->db->where('ap.idregistroevento', $this->idRegistroEvento);
		$this->db->where('ap.version', $this->version);
        return $this->db->get();
    }
	public function listaFotos()
	{
		$this->db->select('idgaleria,version,fotografia,descripcion,idusuario_apertura,fecha_apertura');
        $this->db->from('galeria_evento');
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		$this->db->where('version', $this->version);
        return $this->db->get();
    }
	public function listaIE()
	{
		$this->db->select('ie.idiestevento,ie.idiest,ie.version,ie.descripcion,DATE_FORMAT(ie.fecha, "%Y-%m-%d") fecha,ie.idusuario_apertura,ie.fecha_apertura,ed.CEN_EDU,ed.COD_MOD,ed.CODLOCAL,ed.D_NIV_MOD');
        $this->db->from('iest_2020_all_evento ie');
		$this->db->join('iest_2020_all ed','ie.idiest = ed.ID');
		$this->db->where('ie.idregistroevento', $this->idRegistroEvento);
		$this->db->where('ie.version', $this->version);
        return $this->db->get();
    }
	public function buscaIE(){
		$this->db->select('ID,CEN_EDU,COD_MOD,CODLOCAL,NIV_MOD,D_NIV_MOD,D_DPTO,D_PROV,D_DIST');
        $this->db->from('iest_2020_all');
		$this->db->where('CODGEO', $this->ubigeo);		
        return $this->db->get();
	}
	public function borraPreliminar(){
		//$consulta = $this->db->query('DELETE FROM galeria_evento WHERE version='.$this->version);
		$this->db->where('version', $this->version);
		$this->db->where('idregistroevento', $this->idRegistroEvento);
		return $this->db->delete($this->tabla);;
	}
	public function registrarFotos(){		
		$data = array(
			'version' => $this->version,
			'idregistroevento' => $this->idRegistroEvento,
			'fotografia' => $this->nombImg,
			'descripcion' => $this->descripcion,
			'idusuario_apertura' => $this->uRegistro,
			'fecha_apertura' => $this->fRegistro,
			'idusuario_actualizacion' => $this->uActualiza,
			'fecha_actualizacion' => $this->fActualiza,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarDanios(){		
		$data = array(
			'version' => $this->version,
			'idtipodanio' => $this->tipoDanio,
			'idregistroevento' => $this->idRegistroEvento,
			'cantidad' => $this->cantidad,
			'idusuario_apertura' => $this->uRegistro,
			'fecha_apertura' => $this->fRegistro,
			'idusuario_actualizacion' => $this->uActualiza,
			'fecha_actualizacion' => $this->fActualiza,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarAcciones(){
		$data = array(
			'version' => $this->version,
			'idtipoaccion' => $this->tipoAccion,
			'idregistroevento' => $this->idRegistroEvento,
			'descripcion' => $this->descripcion,
			'fecha' => $this->fechaHora,
			'idusuario_apertura' => $this->uRegistro,
			'fecha_apertura' => $this->fRegistro,
			'idusuario_actualizacion' => $this->uActualiza,
			'fecha_actualizacion' => $this->fActualiza,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function registrarIES(){
		$data = array(
			'version' => $this->version,
			'idiest' => $this->idIES,
			'idregistroevento' => $this->idRegistroEvento,
			'descripcion' => $this->descripcion,
			'fecha' => $this->fechaHora,
			'idusuario_apertura' => $this->uRegistro,
			'fecha_apertura' => $this->fRegistro,
			'idusuario_actualizacion' => $this->uActualiza,
			'fecha_actualizacion' => $this->fActualiza,
			'activo' => 1
		);
		if($this->db->insert($this->tabla, $data)) {
			return $this->db->insert_id();
		}else { return 0; }
	}
	public function existeAccion()
	{
        $this->db->select("1");
        $this->db->from($this->tabla);
        $this->db->where('idregistroevento',$this->idRegistroEvento);
		$this->db->where($this->campo, $this->accion);
        $rs =  $this->db->get();
        return $rs->num_rows();
    }
	
}