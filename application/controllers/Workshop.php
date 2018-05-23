<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('workshop_model');
		//$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }
	}

	public function index() {
		$rp = 2;
		/*
		if(isset($_GET['category'])){
			$category = $_GET['category'];
		}else{
			$category = [];
		}
		*/
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$wrk = $this->workshop_model->search_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->workshop_model->get_total_search($category,$q,$rp);
		$catlist = $this->workshop_model->get_categories_list();
		$dataView=[
			'page'=>'workshop',
			'lists'=>$wrk ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
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
		$subcategorylist = $this->workshop_model->get_subcategories_list();
		$dataView=[
			'page'=>'workshops/create',
			'prueba'=>$categorylist,
			'list_sc'=>$subcategorylist,
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
		//$toString = implode($verifycreator);
		$verifyvacancy = $this->workshop_model->get_vacancy_number($id);
		//var_dump($verifycreator);exit;
		if ($verifydata) {
			echo "Ya te matriculaste";
		}else if($verifycreator['user_id'] == $this->user_id) {
			echo "No puedes matricularte porque tu lo creaste";
		}
		else{
			if ($verifyvacancy['vacancy'] > 0) {
				$this->workshop_model->enroll_workshop($this->user_id, $id);
				$verifyvacancy['vacancy'] = $verifyvacancy['vacancy'] - 1;
				$this->workshop_model->update_vacany_number($id, $verifyvacancy['vacancy']);
				redirect('workshop','refresh');
			}else{
				echo "No hay vacantes";
			}

		}
	}
}
