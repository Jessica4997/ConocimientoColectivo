<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Workshops extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'my_workshops'
		];
		$this->load->view('template/basic',$dataView);
	}
}