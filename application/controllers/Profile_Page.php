<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Page extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'profile_page'
		];
		$this->load->view('template/basic',$dataView);
	}
}