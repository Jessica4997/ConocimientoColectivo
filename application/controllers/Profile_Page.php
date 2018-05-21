<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Page extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
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

	public function show_edit_profile(){
		$data_u = $this->user_model->show_profile_by_id($this->user_id);
		$dataView=[
		'page'=>'users/edit',
		'user_d'=>$data_u
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_edit_profile_data(){

		$this->user_model->update_user_profile($_POST);
		redirect('profile_page', 'refresh');
	}



}