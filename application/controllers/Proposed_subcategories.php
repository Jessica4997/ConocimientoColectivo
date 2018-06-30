<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposed_subcategories extends CI_Controller {

	private $user_id= '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('proposed_subcategories_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }

        $this->output->set_header('X-XSS-Protection: 1; mode=block');
	}


	public function index(){

		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		$page = (isset($_GET['page']))? preg_replace('([^1-9])', '', $_GET['page']):'1';
		//$page = (isset($_GET['page']))? $_GET['page']:'1';
		$psc_list = $this->proposed_subcategories_model->search_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->proposed_subcategories_model->get_total_search($category,$q,$rp);
		$catlist = $this->proposed_subcategories_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_subcategories/list',
			'lists'=>$psc_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}


	public function description($id = null) {
		$error = $this->input->get('message');
		$proposed_subcategory_description = $this->proposed_subcategories_model->show_by_id($id);
		if($proposed_subcategory_description['removed'] == 'Activo'){
		//var_dump($proposed_workshop_description);exit();
		$dataView=[
			'page'=>'proposed_subcategories/description',
			'description'=>$proposed_subcategory_description,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
		}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);
		}
	}


	public function create(){
		$error = $this->input->get('message');
		$categorylist = $this->proposed_subcategories_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_subcategories/create',
			'prueba'=>$categorylist,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save(){
		//var_dump($_POST);exit();
		if(!empty($_POST['nombre_subcategoria']) && trim($_POST['nombre_subcategoria']) != ''){
				$sc_exist = $this->proposed_subcategories_model->check_if_subcategory_exist($_POST['categoria'],$_POST['nombre_subcategoria']);
				if ($sc_exist){
					$error = urldecode("Esta subcategoria ya existe");
					$toRedirect = 'proposed_subcategories/create?message='.$error;
				}else{
					$this->proposed_subcategories_model->create($_POST, $this->user_id);
					$toRedirect = 'proposed_subcategories';
				}
		}else{
			$error = urldecode("Campos obligatorios vacios");
			$toRedirect = 'proposed_subcategories/create?message='.$error;
		}

		redirect($toRedirect, 'refresh');
	}


	public function show_my_requests(){
		$rp = 2;
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$request_list = $this->proposed_subcategories_model->search_request_list_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->proposed_subcategories_model->get_request_list_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'proposed_subcategories/my_request',
			'request_list'=>$request_list,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}


	public function vote($psc_id = null){
		//var_dump($proposed_workshop_description);exit();
		$verify_votes = $this->proposed_subcategories_model->get_votes_quantity($psc_id);
		$verify_user_vote = $this->proposed_subcategories_model->verify_user_vote($psc_id, $this->user_id);
	
		if($verify_user_vote){
			$error = urlencode("Ya votaste por este tema");
			$toRedirect = 'proposed_subcategories/description/'.$psc_id.'?message='.$error;
		}else{
			if($verify_votes['votes_quantity'] < 20){
				$this->proposed_subcategories_model->insert_into_votes($psc_id, $this->user_id);
				$verify_votes['votes_quantity'] = $verify_votes['votes_quantity'] + 1;
				$this->proposed_subcategories_model->update_votes_quantity($psc_id, $verify_votes['votes_quantity']);
				$toRedirect = 'proposed_subcategories/description/'.$psc_id.'?message='.$error;
			}else{
				$error = urlencode("Alcanzó el maximo de votos");
				$toRedirect = 'proposed_subcategories/description/'.$psc_id.'?message='.$error;
			}
		}
		redirect($toRedirect, 'refresh');
	}
}