<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposed_Workshops extends CI_Controller {
	public function index()
	{
		$dataView=[
			'page'=>'proposed_workshops'
		];
		$this->load->view('template/basic',$dataView);
	}
}