<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Page extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'register_page'
		];
		$this->load->view('template/basic',$dataView);
	}
}