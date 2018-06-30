<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $user_id = '0';
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');

		$this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

	public function index(){
		$error = $this->input->get('message');
		$dataView=[
			'page'=>'users/login',
			'error' => $error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function user_login(){
		$u = $this->input->post('correo');
		$p = $this->input->post('contrasena', TRUE);
		if (empty($u) && empty($p)) {
			$error=urlencode("Campos vacios");
			$toRedicrect='/login?message='.$error;
			redirect($toRedicrect, 'refresh');exit();
		}

		if(false === filter_var($u, FILTER_VALIDATE_EMAIL)){
			$error=urlencode("Ingresa un email valido");
			$toRedicrect='/login?message='.$error;
			redirect($toRedicrect, 'refresh');
		}

		$session_user = $this->user_model->check_user_login($u,$p);

		if($session_user){
			$this->session->set_userdata($session_user);
			$toRedicrect="workshop";
		}else{
			$error=urlencode("Usuario o constraseña incorrecta");
			$toRedicrect='/login?message='.$error;
		}

		redirect($toRedicrect, 'refresh');
	}

	public function user_logout(){
		$this->session->unset_userdata('s_iduser');
		$this->session->sess_destroy();
		redirect('login');
	}

	public function show_forgot_password(){
		$error = $this->input->get('message');
		$dataView=[
			'page'=>'users/forgot_password',
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function get_token($token){
		//var_dump($token);exit();
		$user_d = $this->user_model->find_user_by_token($token);
		if(!$user_d){
			$error = urlencode("El token no existe");
			redirect('login/show_forgot_password?message='.$error, 'refresh');exit();
		}
		$this->user_model->delete_token($user_d['id']);
		
		$dataView=[
			'page'=>'users/new_password',
			'id_user'=>$user_d['user_id']
		];
		$this->load->view('template/basic',$dataView);
	}


	public function update_new_password(){
		if (empty($_POST['contrasena'])  && trim($_POST['contrasena']) == '') {
			$error = urlencode("Se ha ingresado campos vacios al modificar la contraseña");
			redirect('login/show_forgot_password?message='.$error, 'refresh');exit();
		}

		if($_POST['contrasena'] === $_POST['recontrasena']){
		$this->user_model->update_user_password($_POST);
		redirect('','refresh');
		}else{
			$error = urlencode("Las contraseñas ingresadas no coincidian");
			redirect('login/show_forgot_password?message='.$error, 'refresh');exit();
		}
	}


	public function recovery_password(){
		$email = $this->input->post('correo');
		$u_data = $this->user_model->find_user_by_email($email);

		if (empty($email) && trim($email) == ''){
			$error = urlencode("Ingresa un correo");
			redirect('login/show_forgot_password?message='.$error, 'refresh');exit();
		}

		if(false === filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error=urlencode("Ingresa un email valido");
			$toRedicrect='login/show_forgot_password?message='.$error;
			redirect($toRedicrect, 'refresh');exit();
		}


		if($u_data){
			$this->load->helper('string');
			$token = random_string('alnum',20);
			$this->user_model->insert_to_token($_POST,$token);

			$this->send_email($email,$token);

			redirect('','refresh');
		}else{
			$error=urlencode("Este correo no existe");
			$toRedicrect='login/show_forgot_password?message='.$error;
			redirect($toRedicrect, 'refresh');exit();
		}
	}


	public function send_email($email,$token){
		$this->load->library("email");

		$config_email = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
            'smtp_user' => 'conocimientocolectivo2018@gmail.com',
            'smtp_pass' => 'lifeline44',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
		);

		$this->email->initialize($config_email);

        $this->email->from('conocimientocolectivo2018@gmail.com');
        $this->email->to($email);
        $this->email->subject('Recuperación de password');

		$dataView=[
			'token'=>$token
		];

        $html = $this->load->view('users/email',$dataView, TRUE);
		
        $this->email->message($html);

        if($this->email->send()){
        	return TRUE;
        }
	}
}
