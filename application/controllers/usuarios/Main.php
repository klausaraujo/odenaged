<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if ($this->session->userdata("usuario")) $this->load->view('main');
        else header("location:" . base_url() . "login");
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
	public function buscaRegionPermiso(){
		echo json_encode('region');
	}
}