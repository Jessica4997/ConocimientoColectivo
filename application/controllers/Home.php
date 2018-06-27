<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $user_id= '0';
    public function __construct() {
		parent::__construct();

		$ruta = $this->uri->segment(1, '/');
		$whiteList=array('/');
        if (!in_array($ruta,$whiteList)){
            redirect('', 'refresh');
        }
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
	}

	public function index(){
		$dataView=[
			'page'=>'home'
		];
		$this->load->view('template/basic',$dataView);
	}
}
