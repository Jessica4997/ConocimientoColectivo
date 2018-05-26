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
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$pw_list = $this->proposed_workshop_model->search_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->proposed_workshop_model->get_total_search($category,$q,$rp);
		$catlist = $this->proposed_workshop_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_workshops/list',
			'lists'=>$pw_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
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

			ini_set('date.timezone','America/Lima'); 
              $fechaActual = date('d-m-Y g:i A');

              var_dump($proposed_workshop_description['start_date']);
              var_dump($fechaActual);
		if($proposed_workshop_description['start_date'] < $fechaActual){
			echo "La fecha de inicio ya paso";}
	}

	public function search_by_category(){
		$search_c = $this->proposed_workshop_model->search_list_by_category($category_id);
		$catlist = $this->proposed_workshop_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_workshops/list',
			'lists'=>$search_c,
			'lis'=>$catlist
		]; 
		$this->load->view('template/basic',$dataView);

	}

	public function create(){
		$categorylist = $this->proposed_workshop_model->get_categories_list();
		$level_list = $this->proposed_workshop_model->level_list();
		$subcategorylist = $this->proposed_workshop_model->get_subcategories_list();

		$dataView=[
			'page'=>'proposed_workshops/create',
			'prueba'=>$categorylist,
			'level_list'=>$level_list,
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
		$rp = 2;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$request_list = $this->proposed_workshop_model->search_request_list_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->proposed_workshop_model->get_request_list_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'proposed_workshops/my_requests',
			'request_list'=>$request_list,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}


	public function open_request($pw_id){

			ini_set('date.timezone','America/Lima'); 
              $fechaActual = date('d-m-Y g:i A');

		$pw_data = $this->proposed_workshop_model->get_proposed_workshop_data($pw_id);
		if($pw_data['pw_user_id'] != $this->user_id && $pw_data['start_date'] > $fechaActual){
		//var_dump($pw_data);
		//var_dump($fechaActual);exit();
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
			$this->proposed_workshop_model->change_status($id);
			redirect('workshop','refresh');
		//}
	}

	public function vote($pw_id){

              ini_set('date.timezone','America/Lima'); 
              $fechaActual = date('d-m-Y g:i A');

		$verify_votes = $this->proposed_workshop_model->get_votes_quantity($pw_id);
		$verify_user_vote = $this->proposed_workshop_model->verify_user_vote($pw_id, $this->user_id);
		$proposed_workshop_description = $this->proposed_workshop_model->show_by_id($pw_id);
		//var_dump($pw_data);exit();

		if($verify_user_vote){
			echo "Ya votaste por este taller";
		}else if($proposed_workshop_description['start_date'] < $fechaActual){
			echo "La fecha de inicio culmino";

		}else{
			if($verify_votes['votes_quantity'] < 10){
				$this->proposed_workshop_model->insert_into_votes($pw_id, $this->user_id);
				$verify_votes['votes_quantity'] = $verify_votes['votes_quantity'] + 1;
				$this->proposed_workshop_model->update_votes_quantity($pw_id, $verify_votes['votes_quantity']);
				redirect('proposed_workshop/description/' .$pw_id, 'refresh');
			}else{
				echo "Alcanzó el maximo de votos";
			}
		}
	}
}