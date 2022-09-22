<?php
//error_reporting(0);
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Login extends CI_Controller
{

    public function __construct(){ parent::__construct(); }

    public function index(){ if ($this->session->userdata("usuario")) $this->load->view('main'); else header("location:" . base_url() . "login"); }

    public function login(){ $this->load->view("login"); }
    
    public function doLogin()
    {
     
        $this->load->model("Usuario_model");
        $this->load->model("Menu_model");
		$this->load->model("Ubigeo_model");
		
        $usuario = $this->input->post("usuario");
        $pass = $this->input->post("key");

        $this->Usuario_model->setUsuario($usuario);
        $this->Usuario_model->setPassword($pass);
        $this->Usuario_model->setAnio_Ejecucion(date("Y"));
        
        $result = $this->Usuario_model->iniciar();
        
		$this->session->set_flashdata("usuarioError", $usuario);
		
        if ($result->num_rows() > 0) {

            $row = $result->row();

            if ($row->activo == "0") {
                $this->session->set_flashdata("loginError", "Usuario deshabilitado");
                header("location:" . base_url() . "login");
            }
			
			$this->Usuario_model->setIdRol($row->idrol);
			$this->Menu_model->setIdUsuario($row->idusuario);
            
			# Modulos y Menus del usuario
			$listaModulo = $this->Usuario_model->listaModulo();
			$lMenu = $this->Menu_model->listaMenuPermisos();
			$lSubMenu = $this->Menu_model->listaSubMenuPermisos();
			
			$listaModulo = ($listaModulo->num_rows() > 0)? $listaModulo->result() : array();
			$lMenu = ($lMenu->num_rows() > 0)? $lMenu->result() : array();
			$lSubMenu = ($lSubMenu->num_rows() > 0)? $lSubMenu->result() : array();
			
			#Trae el ubigeo del usuario
            $this->Ubigeo_model->setIdUser($row->idusuario);
			$dptos = $this->Ubigeo_model->depUser(); $ubigeo = (Object)[]; $i = 0; $j = 0;
			
			if( $dptos->num_rows() > 0 ){
				$dptos = $dptos->result();
				foreach($dptos as $dpto):
					if($i === 0){
						$this->Ubigeo_model->setIdDpto($dpto->cod_dep);
						$ubigeo->cod_dep = $dpto->cod_dep;
						$prov = $this->Ubigeo_model->proUser();
						if( $prov->num_rows() > 0 ){
							$prov = $prov->result();
							foreach($prov as $pro):
								if($j === 0){
									$this->Ubigeo_model->setIdProv($pro->cod_pro);
									$ubigeo->cod_pro = $pro->cod_pro;
									$dttos = $this->Ubigeo_model->dttos();
									$dttos = ($dttos->num_rows() > 0)? $dttos->result() : array();
									$j++;
								}
							endforeach;
							
						}else $prov = array();
						
						$ubigeo->dptos = $dptos;
						$ubigeo->prov = $prov;
						$ubigeo->dttos = $dttos;
						$i++;
					}
				endforeach;
				$this->session->set_userdata('ubigeo', $ubigeo);
			}
			/*$areas = $this->Usuario_model->areas();*/

            /*$area = array();

            foreach ($areas->result() as $arow) :
                $area[] = $arow->Codigo_Area;

            endforeach;
            
            if (($idrol == ROL_ADMIN or $idrol == ROL_SUPER_ADMIN)) {
                $this->session->set_flashdata("loginError", "El usuario no tiene &aacute;reas asignadas");
                header("location:" . base_url() . "login");
				exit();
            }

            if ($idrol == ROL_USUARIO_REGION and strlen($row->Codigo_Region) < 1) {
                $this->session->set_flashdata("loginError", "El usuario no tiene una regi&oacute;n asignada");
                header("location:" . base_url() . "login");
				exit();
            }
            
            $this->Usuario_model->setNombres($row->nombre);
            $this->Usuario_model->setactivo(1);
            /*$resultChat = $this->Usuario_model->actualizar_chat();
            $rowChat = $resultChat->row();
            $this->session->set_userdata("uuid", $rowChat->Guid);*/
            $this->session->set_userdata("idusuario", $row->idusuario);
            $this->session->set_userdata("idrol", $row->idrol);
            $this->session->set_userdata("usuario", $row->usuario);
            $this->session->set_userdata("nombre", $row->nombre);
            $this->session->set_userdata("apellido", $row->apellido);
            $this->session->set_userdata("avatar", $row->avatar);
            $this->session->set_userdata("modulos", $listaModulo);
            $this->session->set_userdata("menu", $lMenu);
			$this->session->set_userdata("submenu", $lSubMenu);
            /*$token = JWT::encode(array("usuario"=>sha1($row->idusuario),"modulos"=>$listaModulo->result()),getenv("SECRET_SERVER_KEY"));
            $this->session->set_userdata("token", $token);*/

            //$permisos = ($permisosOpcion->num_rows()>0)?$permisosOpcion->result():null;
            //$this->session->set_userdata("Permisos_Opcion", $permisos);
            /*$this->session->set_userdata("Codigo_Region", $row->Codigo_Region);
            $this->session->set_userdata("Anio_Ejecucion", $row->Anio_Ejecucion);
            $this->session->set_userdata("Codigo_Sector", $row->Codigo_Sector);
            $this->session->set_userdata("Codigo_Pliego", $row->Codigo_Pliego);
            $this->session->set_userdata("Codigo_Ejecutora", $row->Codigo_Ejecutora);
            $this->session->set_userdata("Codigo_Centro_Costos", $row->Codigo_Centro_Costos);
            $this->session->set_userdata("Codigo_Sub_Centro_Costos", $row->Codigo_Sub_Centro_Costos);
            $this->session->set_userdata("Codigo_Area", $area);*/
			$anio = $this->Usuario_model->anio();
			$mes = $this->Usuario_model->mes();
			$this->session->set_userdata("anio", $anio->result());
			$this->session->set_userdata("mes", $mes->result());

            header("location:" . base_url());
        } else {
            $this->session->set_flashdata("loginError", "Usuario o contrase&ntilde;a incorrectos");
            header("location:" . base_url() . "login");
        }
    }

    public function logout()
    {
        $this->load->model("Usuario_model");
        $this->Usuario_model->setId($this->session->userdata("idusuario"));
        $this->Usuario_model->setactivo(0);

        /*$resultChat = $this->Usuario_model->actualizar_chat();*/
        $this->session->sess_destroy();
        header("location:" . base_url());
    }
}