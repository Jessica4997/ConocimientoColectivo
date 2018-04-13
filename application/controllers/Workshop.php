<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'workshop'
		];
		$this->load->view('template/basic',$dataView);
	}
}
