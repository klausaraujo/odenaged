<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		if ($this->session->userdata("usuario"))
            $this->load->view("main");
        else
            header("location:" . base_url() . "login");
    }

    public function login()
    {
        $this->load->view("login");
    }
    
    public function doLogin()
    {
     
        $this->load->model("Usuario_model");
        $this->load->model("Menu_model");
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

            $idrol = $row->idrol;

            $this->Usuario_model->setIdRol($idrol);
            $listaModulo = $this->Usuario_model->listaModulo();
            
            $menu = array();
			$idModulos = array();

            $this->Menu_model->setIdUsusario($row->idusuario);
            $permisosOpcion = $this->Menu_model->listaPermisosOpcion();
            foreach ($listaModulo->result() as $lrow) :

                if ($lrow->activo == 1) {
                    $this->Menu_model->setIdModulo($lrow->idmodulo);
                    $lista = $this->Menu_model->listaPermisos();

                    $lMenu = array();
                    $i = 0;
					$j = 0;
                    foreach ($lista->result() as $mrow) :

                        $lMenu[$i]["idmenu"] = $mrow->idmenu;
						$lMenu[$i]["idmodulo"] = $mrow->idmodulo;
                        $lMenu[$i]["descripcion"] = $mrow->descripcion;
                        $lMenu[$i]["nivel"] = $mrow->nivel;
                        $lMenu[$i]["url"] = $mrow->url;
                        $lMenu[$i]["icono"] = $mrow->icono;
                        

                        if ($mrow->nivel == 1) {

                            $this->Menu_model->setId($mrow->idmenu);
                            $listaSubMenu = $this->Menu_model->listaSubMenuPermisos();
                            $lSubMenu = array();
                            $j = 0;
                            foreach ($listaSubMenu->result() as $srow) :
                                $lSubMenu[$j]["idmenudetalle"] = $srow->idmenudetalle;
                                $lSubMenu[$j]["descripcion"] = $srow->descripcion;
                                $lSubMenu[$j]["url"] = $srow->url;
                                $lSubMenu[$j]["icono"] = $srow->icono;
                                $j ++;

                            endforeach;

                            if(count($lSubMenu)>0) $lMenu[$i]["submenu"] = $lSubMenu;
                        }
						
						if(count($lMenu)>0){
							$menu[$j] = $lMenu;
							$j++;
						}
						
                        $i ++;

                    endforeach;

                    

                }

            endforeach;

            $this->Usuario_model->setId($row->idusuario);
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
            */
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
            $this->session->set_userdata("modulos", $listaModulo->result());
            $this->session->set_userdata("menu", $menu);

            /*$token = JWT::encode(array("usuario"=>sha1($row->idusuario),"modulos"=>$listaModulo->result()),getenv("SECRET_SERVER_KEY"));
            $this->session->set_userdata("token", $token);*/

            $permisos = ($permisosOpcion->num_rows()>0)?$permisosOpcion->result():null;
            $this->session->set_userdata("Permisos_Opcion", $permisos);
            /*$this->session->set_userdata("Codigo_Region", $row->Codigo_Region);
            $this->session->set_userdata("Anio_Ejecucion", $row->Anio_Ejecucion);
            $this->session->set_userdata("Codigo_Sector", $row->Codigo_Sector);
            $this->session->set_userdata("Codigo_Pliego", $row->Codigo_Pliego);
            $this->session->set_userdata("Codigo_Ejecutora", $row->Codigo_Ejecutora);
            $this->session->set_userdata("Codigo_Centro_Costos", $row->Codigo_Centro_Costos);
            $this->session->set_userdata("Codigo_Sub_Centro_Costos", $row->Codigo_Sub_Centro_Costos);
            $this->session->set_userdata("Codigo_Area", $area);*/

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