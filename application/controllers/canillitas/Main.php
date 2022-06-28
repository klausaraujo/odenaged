<?php
if (! defined("BASEPATH"))
    exit("No direct script access allowed");

class Main extends CI_Controller
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
	public function canillitas()
    {
		$this->load->model("canillitas/Canillita_model");
		$listaCanillitas = $this->Canillita_model->listar();
		
		if ($listaCanillitas->num_rows() > 0) {
            $listaCanillitas = $listaCanillitas->result();
        } else {
            $listaCanillitas = array();
        }		
		
		$data = array(
			"formNew" => $this->load->view('canillitas/form-new', NULL, TRUE),
			"listarCanillita" => json_encode($listaCanillitas)
		);
		#$data['formNew'] = $this->load->view('canillitas/form-new', NULL, TRUE);
		$this->load->view($this->uri->segment(1).'/main',$data);
    }
	
	public function listar(){
		$this->load->model("canillitas/Canillita_model");
		$listaCanillitas = $this->Canillita_model->listar();		
		
		if ($listaCanillitas->num_rows() > 0) {
            $listaCanillitas = $listaCanillitas->result();
        } else {
            $listaCanillitas = array();
        }

        $data = array(
            "status" => 200,
            "data" => array(
						"listarCanillita" => $listaCanillitas
					)
        );

        echo json_encode($data);
	}
	
	public function registrar()
    {
		$this->load->model("canillitas/Canillita_model");
		$dtz = new DateTimeZone("America/Lima");
        $dt = new DateTime("now", $dtz);
        $fechaActual = $dt->format("Y-m-d h:i:s a");
		
		/*$fechanac = strtotime($this->input->post("fechaNac"));
		$fechanac = date('Y-m-d H:i:s');*/
		
		$dni = $this->input->post("documento_numero");
		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$fechanac = $this->input->post("fechaNac");
		$genero = $this->input->post("genero");
		$edocivil = $this->input->post("edoCivil");
		$condicion = $this->input->post("condic");
		$domic = $this->input->post("domicilio");
		$telf = $this->input->post("tlf1");
		$telf2 = $this->input->post("tlf2");
		$email = $this->input->post("correo");
		$obs = $this->input->post("observacion");
		
		$this->Canillita_model->setDocumento_numero($dni);
		$this->Canillita_model->setNombres($nombres);
		$this->Canillita_model->setApellidos($apellidos);		
		$this->Canillita_model->setFecha_nacimiento($fechanac);
		$this->Canillita_model->setGenero($genero);
		$this->Canillita_model->setEstado_civil($edocivil);
		$this->Canillita_model->setCondicion($condicion);
		$this->Canillita_model->setDomicilio($domic);
		$this->Canillita_model->setTelefono_01($telf);
		$this->Canillita_model->setTelefono_02($telf2);
		$this->Canillita_model->setEmail($email);
		$this->Canillita_model->setObs($obs);
		$this->Canillita_model->setUsuario_registro($this->session->userdata("idusuario"));
		$this->Canillita_model->setFecha_registro($fechaActual);
		
		
		
		$campos = array(
			'dni ' =>  $this->input->post("documento_numero"),
			'nombres ' =>  $this->input->post("nombres"),
			'apellidos ' =>  $this->input->post("apellidos"),
			'fechanac ' =>  $fechanac,
			'genero ' =>  $this->input->post("genero"),
			'edocivil ' =>  $this->input->post("edoCivil"),
			'condicion ' =>  $this->input->post("condic"),
			'domic ' =>  $this->input->post("domicilio"),
			'telf ' =>  $this->input->post("tlf1"),
			'telf2 ' =>  $this->input->post("tlf2"),
			'email ' =>  $this->input->post("correo"),
			'obs ' =>  $this->input->post("observacion"),
			'usuario' => $this->session->userdata("idusuario"),
		);
		
		$count = $this->Canillita_model->existe_canillita();
		
		
		if (strlen($apellidos) < 1 or strlen($nombres) < 1 or strlen($dni) < 1 or strlen($genero) < 1 or strlen($fechanac) < 1)
        {
            $data = array(
                "status" => 500,
				"campos" => $campos
            );
        }else{
			if ($count > 0)
            {
                $data = array(
                    "status" => 201,
					"campos" => $campos
                );
            }else{
				$id = $this->Canillita_model->registrar();
				if ($id > 0){
					$data = array(
                        "status" => 200,
						"campos" => $campos
                    );
				}else{
                    $data = array(
                        "status" => 500,
						"campos" => $campos
                    );
                }
			}
		}
		echo json_encode($data);
		//$this->load->view($this->uri->segment(1).'/form-new');
    }
}