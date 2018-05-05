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
}
