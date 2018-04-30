<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
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

		$session_user = $this->User_model->check_user_login($u,$p);

		if($session_user){
			$this->session->set_userdata($session_user);
			$toRedicrect="/profile_page";
		}else{
			$error=urlencode("Usuario o constraseña incorrecta");
			$toRedicrect='/login?message='.$error;
		}

		redirect($toRedicrect, 'refresh');
		

	}

}

