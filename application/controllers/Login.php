<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
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
		$p = $this->input->post('contrasena');

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
		//$error = $this->input->get('message');
		$dataView=[
			'page'=>'users/forgot_password'
		];
		$this->load->view('template/basic',$dataView);
	}

	public function get_token($token){
		//var_dump($token);exit();
		$user_d = $this->user_model->find_user_by_token($token);
		if(!$user_d){
			echo "El token no existe";exit();
		}
		$this->user_model->delete_token($user_d['id']);
		
		$dataView=[
			'page'=>'users/new_password',
			'id_user'=>$user_d['user_id']
		];
		$this->load->view('template/basic',$dataView);
	}


	public function update_new_password(){
		if($_POST['contrasena'] === $_POST['recontrasena']){
		$this->user_model->update_user_password($_POST);
		redirect('','refresh');
		}else{
			echo "Las contraseñas no coinciden";
		}
	}


	public function recovery_password(){
		$email = $this->input->post('correo');
		$u_data = $this->user_model->find_user_by_email($email);

		if($u_data){
			$this->load->helper('string');
			$token = random_string('alnum',20);
			$this->user_model->insert_to_token($_POST,$token);

			$this->send_email($email,$token);

			redirect('','refresh');
		}else{
			echo "El correo no existe";
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
