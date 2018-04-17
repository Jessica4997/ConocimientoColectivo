<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'prueba'
		];
		$this->load->view('template/basic',$dataView);
	}
}