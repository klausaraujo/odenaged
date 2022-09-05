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
		
		$reg = $this->Ubigeo_model->zonasRegion(); $i = 0; $tree = ''; $sub = [];
		
		if($reg->num_rows() > 0){
			$reg = $reg->result();
			$tree .= '<ul class="row root">';
			foreach($reg as $row):
				$tree .= '<li id="'.$row->cod_dep.'" class="col-sm-12 dep"><i data-tree="DRE" class="collapsible exp"></i>
						<i class="checkbox unchecked"></i>'.$row->departamento.'</li>';
				
				/*$this->Ubigeo_model->setIdDpto($row->cod_dep);
				$tempDRE = $this->Ubigeo_model->zonasDRE();
				
				if($tempDRE->num_rows() > 0){ $tree .= '<ul>'; $tempDRE = $tempDRE->result(); }else $tempDRE = array();
				
				foreach($tempDRE as $drow):
					$tree .= "<li id='".$drow->codigo_dre."' ><a href='#'>".$drow->codigo_dre.' - '.$drow->nombre.'</a>';
					
					$this->Ubigeo_model->setIdDre($drow->iddre);
					$tempUGEL = $this->Ubigeo_model->zonasUGEL(); if($tempUGEL->num_rows() > 0){ $tempUGEL = $tempUGEL->result(); $tree .= '<ul>'; }
					
					foreach($tempUGEL as $urow):
						$tree .= "<li id='".$urow->idugel."' ><a href='#'>".$urow->codigo_ugel.' - '.$urow->nombre.'</a>';
						$this->Ubigeo_model->setIdProv(substr($urow->codigo_ugel,4,2));
						$tempPro = $this->Ubigeo_model->zonasPro(); if($tempPro->num_rows() > 0){ $tempPro = $tempPro->result();}else $tempPro = array();
						foreach($tempPro as $prow):
							$tree .= "<ul><li id='".$prow->cod_pro."' ><a href='#'>".$prow->provincia.'</a></li></ul>';
							$sub[$i] = $prow;
							$i++;
						endforeach;
					endforeach;
					
					$tree .= '</li></ul>';
				endforeach;
				
				$tree .= '</li></ul>';*/
			endforeach;
			
			$tree .= '</ul>';
			
		}
		
		$data = array( 'tree' => $tree );

        echo json_encode($data);
	}
	public function buscaDRE(){
		$this->load->model("Ubigeo_model");
		$id = $this->input->post('id'); $datatree = $this->input->post('tree'); $check = $this->input->post('check'); $zonas = null; $tree = '';
		$check = ($check === '1')? 'checked' : 'unchecked'; $pro = '';
		
		if($datatree === 'DRE'){ $this->Ubigeo_model->setIdDpto($id); $zonas = $this->Ubigeo_model->zonasDRE(); }
		else if($datatree === 'UGEL'){ $this->Ubigeo_model->setIdDre($id); $zonas = $this->Ubigeo_model->zonasUGEL(); }
		else if($datatree === 'PROV'){ $this->Ubigeo_model->setIdUgel($id); $zonas = $this->Ubigeo_model->ubigeoUgel(); }
		
		if(!$zonas == null && $zonas->num_rows() > 0){
			$zonas = $zonas->result(); $tree .= '<ul class="niveles row">';
			
			foreach($zonas as $row):
				
				if($datatree === 'DRE'){ $data = 'UGEL'; $idzona = $row->iddre; $lia = $row->codigo_dre.' - '.$row->nombre; }
				elseif($datatree === 'UGEL'){ $data = 'PROV'; $idzona = $row->idugel; $lia = $row->codigo_ugel.' - '.$row->nombre; }
				
				if($datatree === 'PROV'){
					if(!$pro == $row->provincia){
						$pro = $row->provincia; $data = 'DIS'; $idzona = $row->cod_pro; $lia = $row->provincia;
						$tree .= '<li id="'.$idzona.'" class="col-sm-12"><i class="checkbox '.$check.'"></i>'.$lia.'</li>';
					}
				}else{
					$tree .= '<li id="'.$idzona.'" class="col-sm-12"><i data-tree="'.$data.'" class="collapsible exp"></i><i class="checkbox '.$check.'"></i>'.$lia.'</li>';
				}
			endforeach;
			
			$tree .= '</ul>';
		
		}else{ $zonas = array(); }
		
		$data = array( 'tree' => $tree );
		
		echo json_encode($data);
	}
}