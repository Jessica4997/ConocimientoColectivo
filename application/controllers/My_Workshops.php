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
		
		$rp = 2;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$get_list_by_inscribed_user = $this->my_workshops_model->search_my_works_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->my_workshops_model->get_my_works_total_search($this->user_id,$q,$rp);

		$dataView=[
			'page'=>'workshops/my_inscribed',
			'lisss'=>$get_list_by_inscribed_user,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages
		];
		$this->load->view('template/basic',$dataView);

	}

	public function show_teacher($id){
		$teacher = $this->my_workshops_model->get_teacher_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'workshops/teacher_list',
			'listaa'=>$teacher
		];
		$this->load->view('template/basic',$dataView);
	}

}