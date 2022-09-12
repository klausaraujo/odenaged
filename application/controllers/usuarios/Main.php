<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario")) header("location:" . base_url() . "login");
	}

    public function index(){ }
	
	public function registrar()
    {
        $this->load->model("Usuario_model");

        $tipodoc = $this->input->post('tipodoc');
		$usuario = $this->input->post('usuario');
        $dni = $this->input->post('dni');
        $apellidos = $this->input->post('apellidos');
        $nombres = $this->input->post('nombres');
        $codPerfil = $this->input->post('codperfil');

        $this->Usuario_model->setTipoDoc(intval($tipodoc));
		$this->Usuario_model->setUsuario($usuario);
        $this->Usuario_model->setDNI($dni);
        $this->Usuario_model->setApellidos($apellidos);
        $this->Usuario_model->setNombres($nombres);
        $this->Usuario_model->setPerfil($codPerfil);
		$this->session->set_flashdata('claseMsg', 'warning');

        if (! $this->Usuario_model->existe()) {
			if ($this->Usuario_model->registrar()) {
				$this->session->set_flashdata('flashSuccess', 'Usuario Registrado Exitosamente');
                $this->session->set_flashdata('claseMsg', 'success');
            }else{
                $this->session->set_flashdata('flashSuccess', 'No se pudo registrar el usuario');
            }
        }else { $this->session->set_flashdata('flashSuccess', 'El usuario ya existe, elija otro'); }
		
		header('location:' . base_url() . 'usuarios');
    }
	public function buscaDRE(){
        $this->load->model("Ubigeo_model");
		
		$idusuario = $this->input->post('idusuario'); $this->Ubigeo_model->setIdUser($idusuario); $tree = '';
		
		$zonasDRE = $this->Ubigeo_model->zonasDRE(); $usuarioDRE = $this->Ubigeo_model->dreUsuario();
		//$reg = $this->Ubigeo_model->zonasRegion(); $i = 0; $tree = ''; $sub = [];
		//$permisosreg = $this->Ubigeo_model->depUser();
		$usuarioDRE = ($usuarioDRE->num_rows() > 0)? $usuarioDRE->result() : array();
		
		if($zonasDRE->num_rows() > 0){
			$tree .= '<ul class="row root">';
			$dres = $zonasDRE->result();
			foreach($dres as $row):
				$check = 'unchecked';
				if(!empty($usuarioDRE)){
					foreach($usuarioDRE as $udre):
						if($row->iddre === $udre->iddre) $check ='ddbb';
					endforeach;
				}
				$tree .= '<li id="'.$row->iddre.'" class="col-sm-12 dre"><i data-tree="UGEL" class="collapsible exp"></i>
							<i class="checkbox '.$check.'" data-check="'.$row->iddre.'"></i>'.$row->nombre.'</li>';
			endforeach;
			
			$tree .= '</ul>';
		}
		
		$data = array( 'tree' => $tree );
		
		echo json_encode($data);
	}	
	public function buscaUGEL(){
		$this->load->model("Ubigeo_model");
		
		$id = $this->input->post('id'); $check = $this->input->post('check'); $zonas = null; $tree = ''; $idusuario = $this->input->post('idusuario');
		
		$this->Ubigeo_model->setIdUser($idusuario);
		$this->Ubigeo_model->setIdDre($id);
		$zonasUGEL= $this->Ubigeo_model->zonasUGEL();
		$usuarioUGEL = $this->Ubigeo_model->ugelUsuario(); $usuarioUGEL = ($usuarioUGEL->num_rows() > 0)? $usuarioUGEL->result() : array();
		
		if(!$zonasUGEL == null && $zonasUGEL->num_rows() > 0){
			$zonasUGEL = $zonasUGEL->result(); $tree .= '<ul class="niveles row">';
			
			foreach($zonasUGEL as $row):
				$ch = ($check === '1')? 'checked' : 'unchecked';
				
				if(!empty($usuarioUGEL)){
					foreach($usuarioUGEL as $drow):
						if($row->idugel === $drow->idugel) $ch ='ddbb';
					endforeach;
				}
				$data = 'PROV'; $idzona = $row->idugel; $lia = $row->codigo_ugel.' - '.$row->nombre; $li = 'ugel';
				
				$tree .= '<li id="'.$idzona.'" class="col-sm-12 ugel"></i><i class="checkbox '.$ch.'" data-dre="'.$row->iddre.'" data-check="'.$idzona.'"></i>'.$lia.'</li>';
			endforeach;
			
			$tree .= '</ul>';
		}
		
		$data = array( 'idusuario' => $idusuario, 'check' => $check, 'iddre' => $id, 'tree' => $tree );
		echo json_encode($data);
	}
	
	public function permisos(){
		$this->load->model("Ubigeo_model"); $this->load->model("Usuario_model");
		# Arrays desde Ajax
		$dres = json_decode($_POST['dres']); $ugels = json_decode($_POST['ugels']); $msg = '';
		# Variables de la funcion
		$id = $this->input->post('idusuario'); $ugelQuery = ''; $dreQuery = ''; $i; $zonasUGEL = null; $rUg = null; $rDre = null; $bUg = null; $bDre = null;
		$status = 500;
		//insert into dre(iddre,codigo_dre,nombre,codigo_region) values (1,'0100','DRE AMAZONAS','01');
		if(!empty($dres)){
			foreach($dres as $dre):
				$i = 0; $dre1 = $dre->dres;
				if(!empty($ugels)){
					foreach($ugels as $ugel):
						if($ugel->dre === $dre1){ $ugelQuery .= (($ugelQuery === '')?'(' : ',(').$id.','.$ugel->ugel.',1)'; $i++; }
					endforeach;
					if($i > 0){ $dreQuery .= (($dreQuery === '')?'(' : ',(').$id.','.$dre->dres.',1)'; }
				}
				if($i === 0){
					$this->Ubigeo_model->setIdDre($dre1);
					$zonasUGEL = $this->Ubigeo_model->zonasUGEL(); $zonasUGEL = ($zonasUGEL->num_rows() > 0)? $zonasUGEL->result() : array();
					if(!empty($zonasUGEL)){
						foreach($zonasUGEL as $zugel):
							if($zugel->iddre === $dre1) $ugelQuery .= (($ugelQuery === '')?'(' : ',(').$id.','.$zugel->idugel.',1)';
						endforeach;
					}
					$dreQuery .= (($dreQuery === '')?'(' : ',(').$id.','.$dre1.',1)';
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
			'msg' => (($status === 200)?'Permisos Registrados Exitosamente' : 'No se pudo Registrar los Permisos'),
			'drequery' => $dreQuery,
			'ugelquery' => $ugelQuery,
		);
		
		echo json_encode($data);
	}
}