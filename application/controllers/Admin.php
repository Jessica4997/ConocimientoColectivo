<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
	$this->load->model('admin_model');
	$lis = $this->admin_model->show_all_users();
	var_dump($lis);exit();
		$dataView=[
			'page'=>'admin',
			'lista_u'=>'lis'
		];
		$this->load->view('template/basic',$dataView);
	}
}