<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {

	private $dataView = array();

	private $id_usuario = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('workshop_model');
		$this->id_usuario = $this->session->userdata('id_usuario');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->id_usuario === null && !in_array($ruta,$whiteList)){
            redirect('/', 'refresh');
        }

	}

	public function index()
	{
		$wrk = $this->workshop_model->get_list();
		//var_dump($wrkdates);exit;
		$dataView=[
			'page'=>'workshop',
			'lists'=>$wrk
		];
		$this->load->view('template/basic',$dataView);
	}


	public function description($id){
		$workshop_description = $this->workshop_model->show_by_id($id);
		$dataView=[
			'page'=>'workshop_description',
			'description'=>$workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function create()
	{
		$dataView=[
			'page'=>'workshops/create'
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save()
	{
		var_dump($_POST);
		$this->workshop_model->create($_POST);
	}
}
