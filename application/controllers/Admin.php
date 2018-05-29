<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}

//USERS

	public function index(){
		$rp = 3;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$u_list = $this->admin_model->search_users_by_name($q,$page,$rp);
		$num_row = $this->admin_model->get_rows_number($q,$page,$rp);
		//var_dump($u_list);exit();

		//var_dump($num_row);exit();
		//var_dump($u_list);exit();
		$dataView=[
			'page'=>'admin/users/list',
			'lista_u'=> $u_list,
			'q'=>$q,
			'num_pages'=>$num_row,
			'pagination'=>$page
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
		$rp = 3;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$c_list = $this->admin_model->search_categories_by_name($q,$page,$rp);
		$num_row = $this->admin_model->get_rows_number_categories($q,$page,$rp);
		//$sc_on_c=$this->admin_model->check_subcategory_exist($category_id);

		$dataView=[
		'page'=>'admin/categories/list',
		'lista_c'=>$c_list,
		'q'=>$q,
		'pagination'=>$page,
		'num_pages'=>$num_row,
		
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_category($category_id){
		$specific_c = $this->admin_model->get_specific_category($category_id); 
		$dataView=[
			'page'=>'admin/categories/edit_delete',
			'c_id'=>$specific_c
		];
		$this->load->view('template/basic',$dataView);
	}

	public function edit_category($category_id){
		$this->admin_model->update_category($_POST,$category_id);
		redirect('admin/categories_list/','refresh');
	}

	public function save_category(){
		$this->admin_model->create_category($_POST);
		redirect('admin/categories_list', 'refresh');
	}

	public function remove_category($category_id){
		$this->admin_model->delete_category($category_id);
		redirect('admin/categories_list/', 'refresh');
	}

	public function cancel_remove_category($category_id){
		$this->admin_model->cancel_delete_category($category_id);
		redirect('admin/categories_list/', 'refresh');
	}


//WORKSHOPS

	public function workshop_list(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$w_list = $this->admin_model->search_w_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->admin_model->get_w_total_search($category,$q,$rp);
		$catlist = $this->admin_model->get_categories_list();
		$dataView=[
			'page'=>'admin/workshops/list',
			'lists'=>$w_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
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
		$show_level = $this->admin_model->level_list();
		$dataView=[
			'page'=>'admin/workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'w_by_id'=>$show_by_id,
			'level_list'=>$show_level

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
		$rp = 4;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$sc_list = $this->admin_model->search_subcategories_by_name($category_id,$q,$page,$rp);
		$num_row = $this->admin_model->get_rows_number_subcategories($category_id,$q,$page,$rp);
		$sc_on_c = $this->admin_model->check_subcategory_exist($category_id);

		$dataView=[
		'page'=>'admin/subcategories/list',
		'lista_sc'=>$sc_list,
		'q'=>$q,
		'pagination'=>$page,
		'num_pages'=>$num_row,
		'sc_on_c'=>$sc_on_c
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_create_subcategory($category_id){
		$specific_c = $this->admin_model->get_specific_category($category_id); 
		$dataView=[
			'page'=>'admin/categories/create',
			'c_id'=>$specific_c
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_subcategory($category_id){
		$this->admin_model->create_subcategory($_POST, $category_id);
		redirect('admin/categories_list/' .$category_id, 'refresh');
	}

	public function show_edit_subcategory($subcategory_id){
		$get_specific_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		//var_dump($get_specific_sc);exit();
		$dataView=[
			'page'=>'admin/subcategories/edit_delete',
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
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$pw_list = $this->admin_model->search_pw_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->admin_model->get_pw_total_search($category,$q,$rp);
		$catlist = $this->admin_model->get_categories_list();
		$dataView=[
			'page'=>'admin/proposed_workshops/list',
			'lists'=>$pw_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
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
		$level_list = $this->admin_model->level_list();
		$dataView=[
			'page'=>'admin/proposed_workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'pw_by_id'=>$show_by_id,
			'level_list'=>$level_list

		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_save_edit($id){
		$this->admin_model->update_pw_description($_POST, $id);
		redirect('admin/proposed_workshop_description/'.$id, 'refresh');
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