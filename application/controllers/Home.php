<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{

		$newdata = array(
			'id_usuario'  => '1',
			'name'     => 'jose'
		);
	
		$this->session->set_userdata($newdata); 



		$dataView=[
			'page'=>'home'
		];
		$this->load->view('template/basic',$dataView);
	}
}
