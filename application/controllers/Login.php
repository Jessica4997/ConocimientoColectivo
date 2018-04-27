<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index(){
		/*$newdata = array(
			'id_usuario'  => '1',
			'name'     => 'jessica'
		);
		
		$this->session->set_userdata($newdata); */
		$message = "";
		$dataView=[
			'page'=>'users/login',
			'error' => $message
		];
		$this->load->view('template/basic',$dataView);
	}

	public function user_login(){
		$u = $this->input->post('correo');
		$p = $this->input->post('contrasena');

		$result = $this->User_model->check_user_login($u,$p);

		if ($result == 1) {
		$dataView=[
			'page'=>'users/profile',
		];
		$this->load->view('template/basic',$dataView);
		}else{
			$message = "Usuario o contraseña incorrecta";
			$dataView=[
			'page'=>'users/login',
			'error' => $message
		];

		$this->load->view('template/basic',$dataView);
		}
	}

}

