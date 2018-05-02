<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Created_Workshops extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('created_workshops_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('/', 'refresh');
        }
	}

	public function index(){
		$get_work_b_u = $this->created_workshops_model->get_workshops_by_user($this->user_id);
		
		$dataView=[
			'page'=>'my_created_workshops',
			'hhh'=>$get_work_b_u
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_student_list(){
		
		$dataView=[
			'page'=>'student_list'
		];
		$this->load->view('template/basic',$dataView);
	}


}