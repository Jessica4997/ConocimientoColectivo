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
		if($proposed_workshop_description['removed'] == 'Activo'){
		//var_dump($proposed_workshop_description);exit();
		$dataView=[
			'page'=>'proposed_workshops/description',
			'description'=>$proposed_workshop_description
		];
		$this->load->view('template/basic',$dataView);
		}else{
			echo "Esta solicitud esta eliminada";
		}
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
		if($pw_data['removed'] == 'Activo' && $pw_data['pw_user_id'] != $this->user_id){
		//var_dump($pw_data);exit();
		$dataView=[
			'page'=>'proposed_workshops/open_request',
			'abc'=>$pw_data
		];
		$this->load->view('template/basic',$dataView);
		}else{
			$dataView=[
			'page'=>'error',
		];
		$this->load->view('template/basic',$dataView);
		}

	}

	public function insert_to_workshop($id){
		//if(){
		//Todo se enviará por POST
			$this->proposed_workshop_model->open_workshop_request($_POST, $this->user_id);
			$this->proposed_workshop_model->remove_from_list($id);
			redirect('workshop','refresh');
		//}
	}

	public function vote($pw_id){
		$verify_votes = $this->proposed_workshop_model->get_votes_quantity($pw_id);
		$verify_user_vote = $this->proposed_workshop_model->verify_user_vote($pw_id, $this->user_id);

		if($verify_user_vote){
			echo "Ya votaste por este taller";
		}else{
			if($verify_votes['votes_quantity'] < 10){
				$this->proposed_workshop_model->insert_into_votes($pw_id, $this->user_id);
				$verify_votes['votes_quantity'] = $verify_votes['votes_quantity'] + 1;
				$this->proposed_workshop_model->update_votes_quantity($pw_id, $verify_votes['votes_quantity']);
				//redirect('proposed_workshop', 'refresh');
			}else{
				echo "Alcanzó el maximo de votos";
			}
		}
	}
}