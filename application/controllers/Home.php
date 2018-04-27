<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index(){
		/*$newdata = array(
			'id_usuario'  => '1',
			'name'     => 'jessica'
		);
		
		$this->session->set_userdata($newdata); */


		/*if(isset($_POST['password'])){
			$this->load->model('User_model');
			if($this->User_model->login($_POST['email'],$_POST['password'])){
				redirect('workshop');
			}else{
				redirect('/');
			} */
			
		$dataView=[
			'page'=>'home'
		];
		$this->load->view('template/basic',$dataView);
	}


}
