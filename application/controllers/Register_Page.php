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


	public function createuser(){
		$dataView=[
			'page'=>'users/register'
		];
		$this->load->view('template/basic',$dataView);
	}


	public function saveuser(){
		//var_dump($_POST);
		$this->user_model->createuser($_POST);
	}
}