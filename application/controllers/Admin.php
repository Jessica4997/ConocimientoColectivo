<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}

//USERS

	public function index(){
		$q = $this->input->get('q');

		if(!empty($q)){
			$u_list = $this->admin_model->search_users_by_name($q);
		}else{
			$u_list = $this->admin_model->show_all_users();
		};
		//var_dump($lis);exit();
		$dataView=[
			'page'=>'admin/users/list',
			'lista_u'=> $u_list
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_profile($user_id){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/profile',
		'list'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_profile($user_id){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/edit_profile',
		'data_id'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_password($user_id){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/edit_password',
		'data_id'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}


	public function save_edit_profile($user_id){
		$edit_profile = $this->admin_model->update_users_profiles($_POST, $user_id);
		redirect('admin/show_profile/'.$user_id, 'refresh');
	}

	public function save_edit_password($user_id){
		if ($_POST['contrasena'] === $_POST['recontrasena']){
			$edit_profile = $this->admin_model->update_users_password($_POST, $user_id);
			redirect('admin/show_profile/'.$user_id, 'refresh');
		}else{
			echo "Las contraseñas no coinciden";
		}
	}

	public function remove_users($user_id){
		$edit_profile = $this->admin_model->delete_users($user_id);
		redirect('admin/show_profile/'.$user_id, 'refresh');
	}

//CATEGORIES

	public function categories_list(){
		$show_categories = $this->admin_model->get_categories_list();
		$dataView=[
		'page'=>'admin/categories_list',
		'lista_c'=>$show_categories
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_category($category_id){
		$specific_c = $this->admin_model->get_specific_category($category_id); 
		$dataView=[
			'page'=>'categories_edit_delete',
			'c_id'=>$specific_c
		];
		$this->load->view('template/basic',$dataView);
	}


	public function edit_category($category_id){
		$this->admin_model->update_category($_POST,$category_id);
		redirect('admin/categories_list/','refresh');
	}


//WORKSHOPS

	public function workshop_list(){
		$catlist = $this->admin_model->get_categories_list();
		$category = $this->input->get('category');
		$q = $this->input->get('q');

		if(!is_null($category) || !empty($q)){
			$pw_list = $this->admin_model->search_by_category_title_w($category,$q);
		}else{
			$pw_list = $this->admin_model->get_w_list();
		}
		
		$dataView=[
			'page'=>'admin/workshops/list',
			'lists'=>$pw_list ,
			'lis'=>$catlist
		]; 
		$this->load->view('template/basic',$dataView);
	}

	public function workshop_description($id) {
		$workshop_description = $this->admin_model->show_w_by_id($id);
		$dataView=[
			'page'=>'admin/workshops/description',
			'description'=>$workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function workshop_show_edit($id){
		$show_by_id = $this->admin_model->show_w_by_id($id);
		$show_categories = $this->admin_model->get_categories_list();
		$show_subcategories = $this->admin_model->get_subcategories_list_no_filter();
		$dataView=[
			'page'=>'admin/workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'w_by_id'=>$show_by_id

		];
		$this->load->view('template/basic',$dataView);
	}

	public function workshop_save_edit($id){
		$this->admin_model->update_w_description($_POST, $id);
		redirect('admin/workshop_description/'.$id, 'refresh');
	}

	public function workshop_delete($id){
		$this->admin_model->delete_w($id);
		redirect('admin/workshop_description/' .$id, 'refresh');
	}

	public function workshop_cancel_delete($id){
		$this->admin_model->cancel_delete_w($id);
		redirect('admin/workshop_description/' .$id, 'refresh');
	}

//SUBCATEGORIES

	public function subcategories_list($category_id){
		$q = $this->input->get('q');

		if(!empty($q)){
			$show_subcategories = $this->admin_model->search_subcategory_by_name($category_id,$q);
		}else{
			$show_subcategories = $this->admin_model->get_subcategories_list($category_id);
		}

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
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		$this->admin_model->update_subcategory($_POST,$subcategory_id);
		redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');
	}


	public function delete_subcategory($subcategory_id){
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		$this->admin_model->delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');

	}

	public function cancel_delete_subcategory($subcategory_id){
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		$this->admin_model->cancel_delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');

	}

//PROPOSED WORKSHOPS

	public function proposed_workshop_list(){
		$catlist = $this->admin_model->get_categories_list();
		$category = $this->input->get('category');
		$q = $this->input->get('q');

		if(!is_null($category) || !empty($q)){
			$pw_list = $this->admin_model->search_by_category_title($category,$q);
		}else{
			$pw_list = $this->admin_model->get_pw_list();
		}
		
		$dataView=[
			'page'=>'admin/proposed_workshops/list',
			'lists'=>$pw_list ,
			'lis'=>$catlist
		]; 
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_description($id){
		 $show_by_id = $this->admin_model->show_by_id($id);
		 $dataView=[
			'page'=>'admin/proposed_workshops/description',
			'description'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_show_edit($id){
		$show_by_id = $this->admin_model->show_by_id($id);
		$show_categories = $this->admin_model->get_categories_list();
		$show_subcategories = $this->admin_model->get_subcategories_list_no_filter();
		$dataView=[
			'page'=>'admin/proposed_workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'pw_by_id'=>$show_by_id

		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_delete($id){
		$this->admin_model->delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}

	public function proposed_workshop_cancel_delete($id){
		$this->admin_model->cancel_delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}
}