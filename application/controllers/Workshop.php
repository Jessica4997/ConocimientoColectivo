<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('workshop_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }
	}

	public function index() {
		$wrk = $this->workshop_model->get_list();
		$catlist = $this->workshop_model->get_categories_list();
		//var_dump($wrk);exit;
		$dataView=[
			'page'=>'workshop',
			'lists'=>$wrk ,
			'lis'=>$catlist

		];
		$this->load->view('template/basic',$dataView);
	}


	public function description($id) {
		$workshop_description = $this->workshop_model->show_by_id($id);
		$dataView=[
			'page'=>'workshop_description',
			'description'=>$workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function create(){
		$categorylist = $this->workshop_model->get_categories_list();
		$levellist = $this->workshop_model->get_level_list();

		$dataView=[
			'page'=>'workshops/create',
			'prueba'=>$categorylist,
			'intento'=>$levellist
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save(){
		//var_dump($_POST);
		$this->workshop_model->create($_POST, $this->user_id);
		redirect('workshop', 'refresh');
	}

	public function save_inscribed_user($id){
		$verifydata = $this->workshop_model->verify_enroll_user($id, $this->user_id);
		$verifycreator = $this->workshop_model->check_user_creator($id);
		$toString = implode($verifycreator);
		//var_dump($verifycreator);exit;
		if ($verifydata) {
			echo "Ya te matriculaste";
		}else if( $toString == $this->user_id) {
			echo "No puedes matricularte porque tu lo creaste";
		}
		else{
		$this->workshop_model->enroll_workshop($this->user_id, $id);
		redirect('workshop','refresh');
		}
	}
}
