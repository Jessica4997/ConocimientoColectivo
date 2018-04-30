<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Created_Workshops extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'my_created_workshops'
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_student_list(){
		$dataView=[
			'page'=>'proposed_workshops/student_list'
		];
		$this->load->view('template/basic',$dataView);
	}
}