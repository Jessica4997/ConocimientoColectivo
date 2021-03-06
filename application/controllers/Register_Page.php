<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_page extends CI_Controller {

	private $user_id = '0';
    private $today = '0';
    public function __construct() {
    	parent::__construct();
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id){
            redirect('', 'refresh');
        }
        ini_set('date.timezone','America/Lima');
        $this->today = new Datetime();

        $this->output->set_header('X-XSS-Protection: 1; mode=block');

	}

	public function index(){
        $error = $this->input->get('message');
		$dataView=[
			'page'=>'users/register',
            'error'=> $error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function saveuser(){
		//svar_dump($_POST);exit();
    if($_POST){

        if (!empty($_POST['correo']) && trim($_POST['correo']) != '' && !empty($_POST['contrasena']) && trim($_POST['contrasena']) != '' && !empty($_POST['nombres']) && trim($_POST['nombres']) != '' && !empty($_POST['apellidos']) && trim($_POST['apellidos']) != '' && !empty($_POST['fecha_nacimiento']) && trim($_POST['fecha_nacimiento']) != ''){

            $email_exist = $this->user_model->find_user_by_email($_POST['correo']);
            $var = $_POST['fecha_nacimiento'];
            $birth = new Datetime($var);

            if(false === filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)){
                $error=urlencode("Ingresa un email valido");
                $toRedicrect='register_page?message='.$error;
                redirect($toRedicrect, 'refresh');exit();
            }

            if($email_exist){
                $error = urlencode("El correo ya está siendo usado");
                redirect ('register_page?message='.$error,'refresh');
            }else{

                if($_POST['contrasena'] != $_POST['recontrasena']){
                    $error = urlencode("Las contraseñas no coinciden");
                    redirect ('register_page?message='.$error,'refresh');
                    
                }else if($birth >= $this->today){
                    $error = urlencode("Fecha incorrecta");
                    redirect ('register_page?message='.$error,'refresh');
                }else{
                    $this->user_model->createuser($_POST);
                    redirect('login','refresh');
                }
            }
        }else{
            $error = urlencode("Faltan completar campos");
            redirect ('register_page?message='.$error,'refresh');
        }
    }else{
        $dataView=[
            'page'=>'error'
        ];
        $this->load->view('template/basic',$dataView);
    }
  }
}