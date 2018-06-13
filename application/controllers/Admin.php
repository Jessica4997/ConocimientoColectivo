<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');

		$this->user_id = $this->session->userdata('s_iduser');
		$u_data = $this->admin_model->check_admin($this->user_id);
        if ($this->user_id === null || $u_data['role'] != 'Admin'){
        redirect('login', 'refresh');
    	}
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
		//var_dump($_POST['category_name']);exit();
		if (!empty($_POST['category_name']) && trim($_POST['category_name']) != '') {
			$this->admin_model->update_category($_POST,$category_id);
			redirect('admin/categories_list/','refresh');
		}else{
			echo "Campo vacio";
		}	
	}

	public function save_category(){
		if (!empty($_POST['category_name']) && trim($_POST['category_name']) != '') {
			$this->admin_model->create_category($_POST);
			redirect('admin/categories_list', 'refresh');
		}else{
			echo "Campo vacio";
		}
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
			'lists'=>$w_list,
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
		if (!empty($_POST['subcategory_name']) && trim($_POST['subcategory_name']) != '') {
			$this->admin_model->create_subcategory($_POST, $category_id);
			redirect('admin/categories_list/' .$category_id, 'refresh');
		}else{
			echo "Campo vacio";
		}

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
		//var_dump($_POST);exit();
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		if (!empty($_POST['subcategory_name']) && trim($_POST['subcategory_name']) != '') {
			$this->admin_model->update_subcategory($_POST,$subcategory_id);
			redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');
		}else{
			echo "Campo vacio";
		}
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
		ini_set('date.timezone','America/Lima'); 
        $fechaActual = date('d-m-Y g:i A');
		//var_dump($_POST);exit();
		if ($_POST['fecha_inicio'] > $fechaActual) {
		
			if($_POST['hora_fin'] > $_POST['hora_inicio']){
				$this->admin_model->update_pw_description($_POST, $id);
				redirect('admin/proposed_workshop_description/'.$id, 'refresh');
			}else{
				echo "Debes escoger una hora de fin mayor";
			}
		}else{
			echo "La fecha ya paso";
		}

	}

	public function proposed_workshop_delete($id){
		$this->admin_model->delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}

	public function proposed_workshop_cancel_delete($id){
		$this->admin_model->cancel_delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}


//RATINGS

	public function show_student_list($iu_w_id){
		$student_list = $this->admin_model->get_student_list($iu_w_id);
		$teacher = $this->admin_model->get_teacher($iu_w_id);
		$dataView=[
			'page'=>'admin/workshops/student_list',
			'list'=>$student_list,
			'teacher'=>$teacher
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_student_rate($iu_w_id, $user_id){
		$iu_id = $this->admin_model->get_iu_id($iu_w_id,$user_id);
		//var_dump($iu_id);exit();
		$dataView=[
			'page'=>'admin/workshops/edit_delete_student_rate',
			'iu_id'=>$iu_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function edit_student_rate($iu_id){
		$this->admin_model->update_student_rating($_POST,$iu_id);
		//PARA INSERTAR CALIFICACION FINAL EN USUARIO
		$iu_user_id = $this->admin_model->get_user_by_iu_id($iu_id);
		$this->admin_model->insert_final_rating_to_users($iu_user_id['iu_user_id']);
		//redirect('admin/show_edit_student_rate/'.$id, 'refresh');
	}

	public function delete_rate_student($iu_id){
		$this->admin_model->delete_student_rating($_POST,$iu_id);

		$iu_user_id = $this->admin_model->get_user_by_iu_id($iu_id);
		
		$this->admin_model->insert_final_rating_to_users($iu_user_id['iu_user_id']);
		//redirect('my_created_workshops/show_profile/'.$user_id, 'refresh');
	}

	public function show_edit_teacher_rate($iu_w_id, $user_id){
		$iu_id = $this->admin_model->get_iu_id($iu_w_id,$user_id);
		//$this->admin_model->update_student_rating($iu_id);
		$dataView=[
			'page'=>'admin/workshops/edit_delete_teacher_rate',
			'iu_id'=>$iu_id
		];
		$this->load->view('template/basic',$dataView);
	}


	public function edit_teacher_rate($iu_id){
		$this->admin_model->update_teacher_rating($_POST,$iu_id);
		//PARA INSERTAR CALIFICACION FINAL EN USUARIO
		$iu_w_id = $this->admin_model->get_user_by_iu_id($iu_id);
		$w_user_id = $this->admin_model->get_user_id_by_iu_w_id($iu_w_id['iu_w_id']);
		$this->admin_model->insert_final_teacher_rating_to_users($iu_w_id['iu_w_id'],$w_user_id['user_id']);
		//redirect('admin/show_edit_student_rate/'.$id, 'refresh');
	}

//PROPOSED_SUBCATEGORIES

	public function proposed_subcategories_list(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$psc_list = $this->admin_model->search_psc_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->admin_model->get_psc_total_search($category,$q,$rp);
		$catlist = $this->admin_model->get_categories_list();
		$dataView=[
			'page'=>'admin/proposed_subcategories/list',
			'lists'=>$psc_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_subcategories_description($id) {
		$proposed_subcategory_description = $this->admin_model->proposed_subcategories_show_by_id($id);
		//var_dump($proposed_workshop_description);exit();
		$dataView=[
			'page'=>'admin/proposed_subcategories/description',
			'description'=>$proposed_subcategory_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_subcategories_edit($id){
		$categorylist = $this->admin_model->get_categories_list();
		$proposed_subcategory_description = $this->admin_model->proposed_subcategories_show_by_id($id);
		$dataView=[
			'page'=>'admin/proposed_subcategories/edit',
			'prueba'=>$categorylist,
			'psc_data'=>$proposed_subcategory_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_subcategories_save_edit($id){
		$this->admin_model->update_proposed_subcategories($_POST,$id);
		redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
	}

	public function proposed_subcategories_delete($id){
		$this->admin_model->delete_proposed_subcategories($id);
		redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
	}

	public function proposed_subcategories_cancel_delete($id){
		$this->admin_model->cancel_delete_proposed_subcategories($id);
		redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
	}

	public function proposed_subcategories_open_request($id){
		$sc_info = $this->admin_model->proposed_subcategories_show_by_id($id);
		if ($sc_info['votes_quantity'] >= 10) {
			$this->admin_model->open_subcategory_request($id,$_POST);
			$this->admin_model->change_proposed_subcategory_status($id);
			//var_dump($_POST);exit();
			redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
		}else{
			echo "No tiene suficientes votos";
		}
	}

//REPORTS

	public function show_reports() {
		$month = $this->input->get('mes');
		$inscriptions_month = $this->admin_model->inscriptions_per_month($month);
		$pw_month = $this->admin_model->workshops_request_per_month($month);

		//var_dump($inscriptions_month);exit();
		$dataView=[
			'page'=>'admin/reports/reports',
			'inscriptions_month'=>$inscriptions_month,
			'pw_month'=>$pw_month
		];
		$this->load->view('template/basic',$dataView);
	}

	public function to_pdf() {

		$this->load->helper('pdf_helper');

		$dataView=[
			'page'=>'admin/reports/topdf'
		];
		$this->load->view('template/basic',$dataView);
	}

}