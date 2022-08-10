<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata("usuario"))
			header("location:" . base_url() . "login");
    }

    public function index()
    {
		
    }
	public function perfil()
    {   
        $this->load->view('main');
    }
	public function password()
    {
        $this->load->model("Usuario_model");
        
        $actual = $this->input->post("old_password");
        $password = $this->input->post("password");
        $id = $this->session->userdata("idusuario");

        $this->Usuario_model->setPassword($actual);
        $this->Usuario_model->setId($id);
        $status = 500;
        
        $message = 'Contrase&ntilde;a actual no coincide'. $id;
        $validacion = $this->Usuario_model->validar_password();
		if($validacion == 1){
			
			$this->Usuario_model->setPassword($password);
            $message = 'No se pudo actualizar la contrase&ntilde;a';
            if ($this->Usuario_model->password() == 1){
                $message = 'La contrase&ntilde;a ha sido actualizada';
                $status = 200;
            }
        }
        echo json_encode(array("status"=>$status,"message"=>$message,'actual' => $actual,'pass' => $validacion));
    }
}