<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Workshops extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('my_workshops_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
            redirect('login', 'refresh');
        }
	}

	public function index(){
		$get_list_by_inscribed_user = $this->my_workshops_model->get_workshops_by_inscribed_user($this->user_id);
		
		$dataView=[
			'page'=>'my_workshops',
			'lisss'=>$get_list_by_inscribed_user
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_teacher($id){
		$teacher = $this->my_workshops_model->get_teacher_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'teacher_list',
			'listaa'=>$teacher
		];
		$this->load->view('template/basic',$dataView);
	}

}