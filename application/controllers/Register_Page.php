<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_page extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
    	parent::__construct();
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id){
            redirect('', 'refresh');
        }
	}

	public function index(){
		$dataView=[
			'page'=>'users/register'
		];
		$this->load->view('template/basic',$dataView);
	}

	public function saveuser(){
        ini_set('date.timezone','America/Lima');
        $var = $_POST['fecha_nacimiento'];
        $birth = new Datetime($var);
        $today = new Datetime();
        
		//var_dump($_POST);exit();
        if (!empty($_POST['correo']) || trim($_POST['correo']) != '' || !empty($_POST['contrasena']) || trim($_POST['contrasena']) != '' || !empty($_POST['nombres']) || trim($_POST['nombres']) != '' || !empty($_POST['apellidos']) || trim($_POST['apellidos']) != ''){

            $email_exist = $this->user_model->find_user_by_email($_POST['correo']);
            if($email_exist){
                echo "El correo ya está siendo usado";
            }else{

                if($_POST['contrasena'] != $_POST['recontrasena']){
                    echo "Las contraseñas no coinciden";
                }else if($birth >= $today){
                echo "Fecha incorrecta";

                }else{
                    $this->user_model->createuser($_POST);
                    redirect('','refresh');
                }
            }
        }else{
            echo "Faltan completar campos";
        }
	}
}