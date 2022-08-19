<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Usuario extends CI_Controller
{
	private $path;
	private $usuario;
	
    public function __construct()
    {
        parent::__construct();
		$this->usuario = $this->session->userdata("idusuario");
		if (!$this->usuario) header("location:" . base_url() . "login");
		
		$this->path = $_SERVER["DOCUMENT_ROOT"].'/odenaged/';
    }

    public function index()
    {
		
    }
	public function perfil()
    {   
		
        $this->load->view('main');
    }
	public function uploadIMG(){
		$this->load->library('general');
		$this->load->model("Usuario_model");
		$src = $this->input->post('src'); $img = ''; $status = 500; $msg = '';
		$ubi = $this->path.'public/images/perfil_usuarios/';
		
		if(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $src),true)){
			$img = $this->general->saveImage($ubi,$src);
			if(!$img == ''){
				$this->Usuario_model->setId($this->usuario);
				$this->Usuario_model->setAvatar($img);
				$resp = $this->Usuario_model->avatar();
				if($resp === 1){
					$msg = 'Se actualizó exitosamente';
					$status = 200;
					$this->session->set_userdata("avatar", $img);
				}else
					$msg = $resp;
			}
		}
		echo json_encode('upload  '.$status.'  '.$resp.'  '.$this->usuario.'  '.$img);
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