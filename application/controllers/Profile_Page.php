<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Page extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }
	}

	public function index(){
		$data_profile= $this->user_model->show_profile_by_id($this->user_id);
		$dataView=[
			'page'=>'users/profile',
			'user_data'=>$data_profile
		];
		$this->load->view('template/basic',$dataView);
	}
}