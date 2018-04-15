<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {
	public function index()
	{

		$this->load->model('workshop_model');
		$workshops = $this->workshop_model->get_list();

		var_dump($workshops);
		$dataView=[
			'page'=>'workshop',
			'workshops'=>$workshops
		];
		$this->load->view('template/basic',$dataView);
	}
}
