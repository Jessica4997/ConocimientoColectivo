<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Created_Workshops extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('created_workshops_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
            redirect('login', 'refresh');
        }
	}

	public function index(){
		$get_list_by_user = $this->created_workshops_model->get_workshops_by_user($this->user_id);
		
		$dataView=[
			'page'=>'my_created_workshops',
			'hhh'=>$get_list_by_user
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_student_list($id){
		$students_list = $this->created_workshops_model->get_students_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'student_list',
			'listaa'=>$students_list
		];
		$this->load->view('template/basic',$dataView);
	}


}