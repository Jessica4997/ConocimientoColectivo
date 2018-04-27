<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Page extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'users/profile'
		];
		$this->load->view('template/basic',$dataView);
	}
}