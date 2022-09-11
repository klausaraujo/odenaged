<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario")) header("location:" . base_url() . "login");
	}

    public function index()
    {
		
    }
	public function registrar()
    {
        $this->load->model("Usuario_model");

        $usuario = $this->input->post("usuario");
        $dni = $this->input->post("dni");
        $apellidos = $this->input->post("apellidos");
        $nombres = $this->input->post("nombres");
        $codPerfil = $this->input->post("codPerfil");
        /*$codRegion = $this->input->post("codRegion");
		$codPro = $this->input->post("codPro");*/

        $this->Usuario_model->setUsuario($usuario);
        $this->Usuario_model->setDNI($dni);
        $this->Usuario_model->setApellidos($apellidos);
        $this->Usuario_model->setNombres($nombres);
        $this->Usuario_model->setPerfil($codPerfil);
        /*$this->Usuario_model->setRegion($codRegion);
		$this->Usuario_model->setProvincia($codPro);*/
		$this->session->set_flashdata('claseMsg', 'warning');

        if (! $this->Usuario_model->existe()) {
			//$this->session->keep_flashdata('mensajeError');
			if ($this->Usuario_model->registrar()) {
				$this->session->set_flashdata('flashSuccess', 'Usuario Registrado Exitosamente');
                $this->session->set_flashdata('claseMsg', 'success');
            }else{
                $this->session->set_flashdata('flashSuccess', 'No se pudo registrar el usuario');
            }
        }else { $this->session->set_flashdata('flashSuccess', 'El usuario ya existe, elija otro'); }
		
		header('location:' . base_url() . 'usuarios');
    }
	
	public function buscaRegiones(){
        $this->load->model("Ubigeo_model");
		$idusuario = $this->input->post('idusuario');
		
		$reg = $this->Ubigeo_model->zonasRegion(); $i = 0; $tree = ''; $sub = [];
		
		$this->Ubigeo_model->setIdUser($idusuario);
		$permisosreg = $this->Ubigeo_model->depUser();
		$permisosreg = ($permisosreg->num_rows() > 0)? $permisosreg->result() : array();
		
		if($reg->num_rows() > 0){
			$regiones = $reg->result();
			$tree .= '<ul class="row root">';
			foreach($regiones as $row):
				$check = 'unchecked';
				if(!empty($permisosreg)){
					foreach($permisosreg as $drow):
						if($row->cod_dep === $drow->cod_dep) $check ='ddbb';
					endforeach;
				}
				$tree .= '<li id="'.$row->cod_dep.'" class="col-sm-12 dep"><i data-tree="DRE" class="collapsible exp"></i>
						<i class="checkbox '.$check.'" data-check="'.$row->cod_dep.'"></i>'.$row->departamento.'</li>';
			endforeach;
			
			if($reg->num_rows() > 0) $tree .= '</ul>';
		}
		$data = array( 'tree' => $tree, );
		echo json_encode($data);
	}
	
	public function buscaDRE(){
		$this->load->model("Ubigeo_model");
		
		$id = $this->input->post('id'); $datatree = $this->input->post('tree'); $check = $this->input->post('check'); $zonas = null; $tree = '';
		$idusuario = $this->input->post('idusuario'); $pro = ''; $dreUsuario; $dep = '';
		
		$this->Ubigeo_model->setIdUser($idusuario);
		
		if($datatree === 'DRE'){
			$this->Ubigeo_model->setIdDpto($id); $zonas = $this->Ubigeo_model->zonasDRE();
			$dreUsuario = $this->Ubigeo_model->dreUsuario(); $dreUsuario = ($dreUsuario->num_rows() > 0)? $dreUsuario->result() : array();
		}else if($datatree === 'UGEL'){
			$this->Ubigeo_model->setIdDre($id); $zonas = $this->Ubigeo_model->zonasUGEL();
			$dreUsuario = $this->Ubigeo_model->ugelUsuario(); $dreUsuario = ($dreUsuario->num_rows() > 0)? $dreUsuario->result() : array();
		}		
		
		if(!$zonas == null && $zonas->num_rows() > 0){
			$zonas = $zonas->result(); $tree .= '<ul class="niveles row">';
			
			foreach($zonas as $row):
				$ch = ($check === '1')? 'checked' : 'unchecked';
				
				if(!empty($dreUsuario)){
					foreach($dreUsuario as $drow):
						if($datatree === 'DRE'){ if($row->iddre === $drow->iddre) $ch ='ddbb'; }
						if($datatree === 'UGEL'){ if($row->idugel === $drow->idugel) $ch ='ddbb'; }
					endforeach;
				}
				if($datatree === 'DRE'){ $data = 'UGEL'; $idzona = $row->iddre; $lia = $row->codigo_dre.' - '.$row->nombre; $li = 'dre'; $dep = $this->input->post('dpto'); }
				elseif($datatree === 'UGEL'){ $data = 'PROV'; $idzona = $row->idugel; $lia = $row->codigo_ugel.' - '.$row->nombre; $li = 'ugel'; $dep = $row->iddre; }
				
				$tree .= '<li id="'.$idzona.'" class="col-sm-12 '.$li.'">'.(($datatree === 'DRE')? '<i data-tree="'.$data.'" class="collapsible exp">' : '').
						'</i><i class="checkbox '.$ch.'" data-dep="'.$dep.'" data-check="'.$idzona.'"></i>'.$lia.'</li>';
			endforeach;
			
			$tree .= '</ul>';
		}
		
		$data = array( 'idusuario' => $dep, 'tree' => $tree );
		echo json_encode($data);
	}
	
	public function permisos(){
		$this->load->model("Ubigeo_model"); $this->load->model("Usuario_model");
		# Arrays desde Ajax
		$dptos = json_decode($_POST['dptos']); $provs = json_decode($_POST['provs']); $dres = json_decode($_POST['dres']); $ugels = json_decode($_POST['ugels']); $msg = '';
		# Variables de la funcion
		$id = $this->input->post('idusuario'); $ugelQuery = ''; $dreQuery = '';$i = 0; $j = 0; $zonasUGEL = null; $rUg = null; $rDre = null; $bUg = null; $bDre = null;
		$status = 500;
		//insert into dre(iddre,codigo_dre,nombre,codigo_region) values (1,'0100','DRE AMAZONAS','01');
		if(!empty($dptos)){
			foreach($dptos as $dpto):
				$i = 0;
				if(!empty($dres)){
					foreach($dres as $dre):
						$j = 0;
						if(!empty($ugels)){
							foreach($ugels as $ugel):
								if($dre->dep === $dpto)
									if($ugel->dep === $dre->dres){ $ugelQuery .= (($ugelQuery === '')?'(' : ',(').$id.','.$ugel->ugel.',1)'; $j++; }
							endforeach;
							if($j > 0){ $dreQuery .= (($dreQuery === '')?'(' : ',(').$id.','.$dre->dres.',1)'; }
						}
						if($dre->dep === $dpto && $j === 0){
							$msg .= $dre->dep;
							$this->Ubigeo_model->setIdDre($dre->dres);
							$zonasUGEL = $this->Ubigeo_model->zonasUGEL(); $zonasUGEL = ($zonasUGEL->num_rows() > 0)? $zonasUGEL->result() : array();
							foreach($zonasUGEL as $zugel):
								if($dre->dep === $dpto){ $ugelQuery .= (($ugelQuery === '')?'(' : ',(').$id.','.$zugel->idugel.',1)'; }
							endforeach;
							$dreQuery .= (($dreQuery === '')?'(' : ',(').$id.','.$dre->dres.',1)';
							$i++;
						}
					endforeach;
				}
				if($i === 0){
					#$this->Ubigeo_model->setIdDpto($dpto);
					#$ubigeo = $this->Ubigeo_model->ubigeoByDep(); $regiones[$j] = ($ubigeo->num_rows() > 0)? $ubigeo->result() : array(); $j++;
				}
			endforeach;
			
			$this->Usuario_model->setId($id);
		}
		
		if(!$dreQuery == ''){
			$bDre = $this->Usuario_model->borraDreUsuario(); $this->Usuario_model->setValores($dreQuery); $rDre = $this->Usuario_model->guardaDreUsuario();
			if(!$ugelQuery == ''){
				$bUg = $this->Usuario_model->borraUgelUsuario(); $this->Usuario_model->setValores($ugelQuery); $rUg = $this->Usuario_model->guardaUgelUsuario();
			}
			if($rDre) $status = 200;
		}
		
		$data = array(
			'ugelBd' => $rUg,
			'dreBd' => $rDre,
			'borra1' => $bUg,
			'borra2' => $bDre,
			'status' => $status,
			'msg' => (($status === 200)?'Permisos Registrados con &Eacute;xito' : 'No se pudo Registrar los Permisos')
		);
		
		echo json_encode($data);
	}
}