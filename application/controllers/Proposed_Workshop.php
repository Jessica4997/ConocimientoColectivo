<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposed_Workshop extends CI_Controller {

	private $user_id= '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('proposed_workshop_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }
	}


	public function index(){
		$wrk = $this->proposed_workshop_model->get_list();
		$catlist = $this->proposed_workshop_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_workshops/list',
			'lists'=>$wrk ,
			'lis'=>$catlist
		]; 
		$this->load->view('template/basic',$dataView);
	}

	public function description($id) {
		$proposed_workshop_description = $this->proposed_workshop_model->show_by_id($id);
		//var_dump($proposed_workshop_description);exit();
		$dataView=[
			'page'=>'proposed_workshops/description',
			'description'=>$proposed_workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function create(){
		$categorylist = $this->proposed_workshop_model->get_categories_list();
		$levellist = $this->proposed_workshop_model->get_level_list();
		$subcategorylist = $this->proposed_workshop_model->get_subcategories_list();

		$dataView=[
			'page'=>'proposed_workshops/create',
			'prueba'=>$categorylist,
			'intento'=>$levellist,
			'subcat'=>$subcategorylist
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save(){
		//var_dump($_POST);
		$this->proposed_workshop_model->create($_POST, $this->user_id);
		redirect('proposed_workshop', 'refresh');
	}


	public function show_my_requests(){
		$request = $this->proposed_workshop_model->get_my_request_list($this->user_id);
			$dataView=[
			'page'=>'proposed_workshops/my_requests',
			'request_list'=>$request
		];
		$this->load->view('template/basic',$dataView);
	}


	public function open_request($pw_id){
		$pw_data = $this->proposed_workshop_model->get_proposed_workshop_data($pw_id);
		//var_dump($pw_data);exit();
		$dataView=[
			'page'=>'proposed_workshops/open_request',
			'abc'=>$pw_data
		];
		$this->load->view('template/basic',$dataView);

	}





}