<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
	$this->load->model('admin_model');
	$lis = $this->admin_model->show_all_users();
	//var_dump($lis);exit();
		$dataView=[
			'page'=>'admin/users_list',
			'lista_u'=> $lis
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_profile($user_id){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users_profile',
		'list'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_profile($user_id){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users_edit_profile',
		'data_id'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_edit_profile($user_id){
		$edit_profile = $this->admin_model->update_users_profiles($_POST, $user_id);
		redirect('admin/show_profile/'.$user_id, 'refresh');
	}

	public function remove_users($user_id){
		$edit_profile = $this->admin_model->delete_users($user_id);
		redirect('admin/show_profile/'.$user_id, 'refresh');
	}


	public function categories_list(){
		$show_categories = $this->admin_model->get_categories_list();
		$dataView=[
		'page'=>'admin/categories_list',
		'lista_c'=>$show_categories
		];
		$this->load->view('template/basic',$dataView);
	}


	public function subcategories_list($category_id){
		$show_subcategories = $this->admin_model->get_subcategories_list($category_id);
		$dataView=[
		'page'=>'admin/subcategories_list',
		'lista_sc'=>$show_subcategories
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_subcategory($category_id){
		$this->admin_model->create_subcategory($_POST, $category_id);
		redirect('admin/subcategories_list/' .$category_id, 'refresh');
	}

	public function show_edit_subcategory($subcategory_id){
		$get_specific_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		//var_dump($get_specific_sc);exit();
		$dataView=[
			'page'=>'admin/subcategories_edit_delete',
			'sc_id'=>$get_specific_sc
		];
		$this->load->view('template/basic',$dataView);
	}


	public function edit_subcategory($subcategory_id){
		$this->admin_model->update_subcategory($_POST,$subcategory_id);
		redirect('admin/subcategories_list/', 'refresh');
	}


	public function delete_subcategory($subcategory_id){
		$this->admin_model->delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/', 'refresh');

	}

	public function cancel_delete_subcategory($subcategory_id){
		$this->admin_model->cancel_delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/', 'refresh');

	}


	public function search_subcategory(){
		$search_sc = $this->admin_model->search_subcategory_by_name($sub_name);
		$dataView=[
			'page'=>'admin/subcategories_list',
			'lista_sc'=>$search_sc
		];
		$this->load->view('template/basic',$dataView);
	}

}