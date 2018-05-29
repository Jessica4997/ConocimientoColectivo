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
		$rp = 2;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$request_list = $this->created_workshops_model->search_created_w_list_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->created_workshops_model->get_created_w_list_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'workshops/my_created',
			'hhh'=>$request_list,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages
		];
		$this->load->view('template/basic',$dataView);

	}

	public function show_student_list($id){
		$students_list = $this->created_workshops_model->get_students_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'workshops/student_list',
			'listaa'=>$students_list
		];
		$this->load->view('template/basic',$dataView);
	}

}