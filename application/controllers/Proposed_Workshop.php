<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposed_Workshop extends CI_Controller {
	private $dataView = array();

	private $id_usuario = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('proposed_workshop_model');
		$this->id_usuario = $this->session->userdata('id_usuario');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->id_usuario === null && !in_array($ruta,$whiteList)){
            redirect('/', 'refresh');
        }
	}


	public function index(){
		$wrk = $this->proposed_workshop_model->get_list();
		$catlist = $this->proposed_workshop_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_workshop',
			'lists'=>$wrk ,
			'lis'=>$catlist
		];
		$this->load->view('template/basic',$dataView);
	}

	public function description($id) {
		$proposed_workshop_description = $this->proposed_workshop_model->show_by_id($id);
		$dataView=[
			'page'=>'proposed_workshop_description',
			'description'=>$proposed_workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function create(){
		$categorylist = $this->proposed_workshop_model->get_categories_list();
		$levellist = $this->proposed_workshop_model->get_level_list();

		$dataView=[
			'page'=>'proposed_workshops/create',
			'prueba'=>$categorylist,
			'intento'=>$levellist
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save(){
		//var_dump($_POST);
		$this->proposed_workshop_model->create($_POST);
		redirect('proposed_workshop', 'refresh');
	}





}