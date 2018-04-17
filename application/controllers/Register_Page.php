<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_page extends CI_Controller {

    private $dataView = array();

    public function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');

    }


	public function index()
	{
		$dataView=[
			'page'=>'register_page'
		];
		$this->load->view('template/basic',$dataView);
	}


		public function createuser()
	{
		$dataView=[
			'page'=>'register_page'
		];
		$this->load->view('template/basic',$dataView);
	}

	public function saveuser()
	{
		var_dump($_POST);
		$this->user_model->createuser($_POST);
	}
}