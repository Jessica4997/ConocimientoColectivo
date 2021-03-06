<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $user_id = '0';
    private $today = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');

		$this->user_id = $this->session->userdata('s_iduser');
		$u_data = $this->admin_model->check_admin($this->user_id);
        if ($this->user_id === null || $u_data['role'] != 'Admin'){
        redirect('', 'refresh');
    	}

    	ini_set('date.timezone','America/Lima');
        $this->today = new Datetime();
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

	public function show_profile($user_id = null){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/profile',
		'list'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_profile($user_id = null){
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/edit_profile',
		'data_id'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_password($user_id = null){
		$error = $this->input->get('message');
		$show_by_id = $this->admin_model->show_specific_user($user_id);
		$dataView=[
		'page'=>'admin/users/edit_password',
		'data_id'=>$show_by_id,
		'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}


	public function save_edit_profile($user_id = null){
		$edit_profile = $this->admin_model->update_users_profiles($_POST, $user_id);
		redirect('admin/show_profile/'.$user_id, 'refresh');
	}

	public function save_edit_password($user_id){
		if ($_POST['contrasena'] === $_POST['recontrasena']){
			$edit_profile = $this->admin_model->update_users_password($_POST, $user_id);
			redirect('admin/show_profile/'.$user_id, 'refresh');
		}else{
			$error = urlencode("Las contraseñas no coinciden");
			redirect('admin/show_edit_password/'.$user_id.'?message='.$error, 'refresh');
		}
	}

	public function remove_users($user_id = null){
		$edit_profile = $this->admin_model->delete_users($user_id);
		redirect('admin/show_edit_password/'.$user_id, 'refresh');
	}



	public function show_create_user(){
        $error = $this->input->get('message');
		$dataView=[
			'page'=>'admin/users/create',
            'error'=> $error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function create_user(){
		//svar_dump($_POST);exit();
    if($_POST){

        if (!empty($_POST['correo']) && trim($_POST['correo']) != '' && !empty($_POST['contrasena']) && trim($_POST['contrasena']) != '' && !empty($_POST['nombres']) && trim($_POST['nombres']) != '' && !empty($_POST['apellidos']) && trim($_POST['apellidos']) != '' && !empty($_POST['fecha_nacimiento']) && trim($_POST['fecha_nacimiento']) != ''){

            $email_exist = $this->admin_model->find_user_by_email($_POST['correo']);
            $var = $_POST['fecha_nacimiento'];
            $birth = new Datetime($var);

            if($email_exist){
                $error = urlencode("El correo ya está siendo usado");
                redirect ('admin/show_create_user?message='.$error,'refresh');
            }else{

                if($_POST['contrasena'] != $_POST['recontrasena']){
                    $error = urlencode("Las contraseñas no coinciden");
                    redirect ('admin/show_create_user?message='.$error,'refresh');
                    
                }else if($birth >= $this->today){
                    $error = urlencode("Fecha incorrecta");
                    redirect ('admin/show_create_user?message='.$error,'refresh');
                }else{
                    $this->admin_model->createuser($_POST);
                    redirect('admin','refresh');
                }
            }
        }else{
            $error = urlencode("Faltan completar campos");
            redirect ('admin/show_create_user?message='.$error,'refresh');
        }
    }else{
        $dataView=[
            'page'=>'error'
        ];
        $this->load->view('template/basic',$dataView);
    }
  }



//CATEGORIES

	public function categories_list(){
		$rp = 3;
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
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

	public function show_edit_category($category_id = null){
		$specific_c = $this->admin_model->get_specific_category($category_id); 
		$dataView=[
			'page'=>'admin/categories/edit_delete',
			'c_id'=>$specific_c
		];
		$this->load->view('template/basic',$dataView);
	}

	public function edit_category($category_id = null){
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

	public function remove_category($category_id = null){
		$this->admin_model->delete_category($category_id);
		redirect('admin/categories_list/', 'refresh');
	}

	public function cancel_remove_category($category_id = null){
		$this->admin_model->cancel_delete_category($category_id);
		redirect('admin/categories_list/', 'refresh');
	}


//WORKSHOPS

	public function workshop_list(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
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

	public function workshop_description($id = null) {
		$workshop_description = $this->admin_model->show_w_by_id($id);
		$dataView=[
			'page'=>'admin/workshops/description',
			'description'=>$workshop_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function workshop_show_edit($id = null){

		$error = $this->input->get('message');
		$show_by_id = $this->admin_model->show_w_by_id($id);
		$show_categories = $this->admin_model->get_categories_list();
		$show_subcategories = $this->admin_model->get_subcategories_list_no_filter();
		$show_level = $this->admin_model->level_list();
		$dataView=[
			'page'=>'admin/workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'w_by_id'=>$show_by_id,
			'level_list'=>$show_level,
			'error'=>$error

		];
		$this->load->view('template/basic',$dataView);
	}

	public function workshop_save_edit($id = null){

		//var_dump($_POST);exit();
		//var_dump($_POST['fecha_inicio']);
		//var_dump($this->today);exit();

		$workshop_date = new Datetime($_POST['fecha_inicio']);

		if ($_POST['hora_inicio'] >= $_POST['hora_fin']) {
			$error = urlencode("La hora de fin tiene que ser mayor a la hora de inicio");
			redirect('admin/workshop_show_edit/'.$id.'?message='.$error, 'refresh');
		}

		if ($workshop_date <= $this->today) {
			$error = urlencode("Escoge una fecha posterior");
			redirect('admin/workshop_show_edit/'.$id.'?message='.$error, 'refresh');
		}

		$this->admin_model->update_w_description($_POST, $id);
		redirect('admin/workshop_description/'.$id, 'refresh');
	}

	public function workshop_delete($id = null){
		$this->admin_model->delete_w($id);
		redirect('admin/workshop_description/' .$id, 'refresh');
	}

	public function workshop_cancel_delete($id){
		$this->admin_model->cancel_delete_w($id);
		redirect('admin/workshop_description/' .$id, 'refresh');
	}

//SUBCATEGORIES

	public function subcategories_list($category_id = null){
		$rp = 4;
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
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

	public function show_create_subcategory($category_id = null){
		$specific_c = $this->admin_model->get_specific_category($category_id); 
		$dataView=[
			'page'=>'admin/categories/create',
			'c_id'=>$specific_c
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_subcategory($category_id = null){
		if (!empty($_POST['subcategory_name']) && trim($_POST['subcategory_name']) != '') {
			$this->admin_model->create_subcategory($_POST, $category_id);
			redirect('admin/categories_list/' .$category_id, 'refresh');
		}else{
			echo "Campo vacio";
		}

	}

	public function show_edit_subcategory($subcategory_id = null){
		$get_specific_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		//var_dump($get_specific_sc);exit();
		$dataView=[
			'page'=>'admin/subcategories/edit_delete',
			'sc_id'=>$get_specific_sc
		];
		$this->load->view('template/basic',$dataView);
	}


	public function edit_subcategory($subcategory_id = null){
		//var_dump($_POST);exit();
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		if (!empty($_POST['subcategory_name']) && trim($_POST['subcategory_name']) != '') {
			$this->admin_model->update_subcategory($_POST,$subcategory_id);
			redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');
		}else{
			echo "Campo vacio";
		}
	}


	public function delete_subcategory($subcategory_id = null){
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		$this->admin_model->delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');

	}

	public function cancel_delete_subcategory($subcategory_id = null){
		$specif_sc = $this->admin_model->get_specific_subcategory($subcategory_id);
		$this->admin_model->cancel_delete_subcategory($subcategory_id);
		redirect('admin/subcategories_list/' .$specif_sc['categories_id'], 'refresh');

	}

//PROPOSED WORKSHOPS

	public function proposed_workshop_list(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
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

	public function proposed_workshop_description($id = null){
		 $show_by_id = $this->admin_model->show_by_id($id);
		 $dataView=[
			'page'=>'admin/proposed_workshops/description',
			'description'=>$show_by_id
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_show_edit($id = null){
		$error = $this->input->get('message');
		$show_by_id = $this->admin_model->show_by_id($id);
		$show_categories = $this->admin_model->get_categories_list();
		$show_subcategories = $this->admin_model->get_subcategories_list_no_filter();
		$level_list = $this->admin_model->level_list();
		$dataView=[
			'page'=>'admin/proposed_workshops/edit',
			'prueba'=>$show_categories,
			'subcat'=>$show_subcategories,
			'pw_by_id'=>$show_by_id,
			'level_list'=>$level_list,
			'error'=>$error

		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_workshop_save_edit($id = null){
		ini_set('date.timezone','America/Lima'); 
        $fechaActual = date('d-m-Y g:i A');
		//var_dump($_POST);exit();
		if ($_POST['fecha_inicio'] > $fechaActual) {
		
			if($_POST['hora_fin'] > $_POST['hora_inicio']){
				$this->admin_model->update_pw_description($_POST, $id);
				redirect('admin/proposed_workshop_description/'.$id, 'refresh');
			}else{
				$error = urlencode("Debes escoger una hora de fin mayor") ;
				redirect('admin/proposed_workshop_show_edit/'.$id.'?message='.$error, 'refresh');
			}
		}else{
			$error = urlencode("La fecha ya paso") ;
			redirect('admin/proposed_workshop_show_edit/'.$id.'?message='.$error, 'refresh');
		}

	}

	public function proposed_workshop_delete($id = null){
		$this->admin_model->delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}

	public function proposed_workshop_cancel_delete($id = null){
		$this->admin_model->cancel_delete_pw($id);
		redirect('admin/proposed_workshop_description/' .$id, 'refresh');
	}

//RATINGS

	public function show_student_list($iu_w_id = null){
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
		$error = $this->input->get('message');
		$iu_id = $this->admin_model->get_iu_id($iu_w_id,$user_id);
		//var_dump($iu_id);exit();
		$dataView=[
			'page'=>'admin/workshops/edit_delete_student_rate',
			'iu_id'=>$iu_id,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function edit_student_rate($iu_id = null){
		$info_by_iu = $this->admin_model->get_user_by_iu_id($iu_id);
		$user_id = $info_by_iu['iu_user_id'];
		$w_id = $info_by_iu['iu_w_id'];
		//var_dump($_POST);exit();
		if ($_POST['puntaje_alumno'] >= 1 && $_POST['puntaje_alumno'] <= 5){
			$this->admin_model->update_student_rating($_POST,$iu_id);

			$this->admin_model->insert_final_rating_to_users($user_id);
			redirect('admin/show_student_list/'.$w_id, 'refresh');
		}else{
			$error = urlencode("La calificación debe ser entre 1 y 5");
			redirect('admin/show_edit_student_rate/'.$w_id.'/'.$user_id.'/?message='.$error, 'refresh');
		}
	}

	public function delete_rate_student($iu_id = null){
		$this->admin_model->delete_student_rating($_POST,$iu_id);

		$iu_user_id = $this->admin_model->get_user_by_iu_id($iu_id);
		
		$this->admin_model->insert_final_rating_to_users($iu_user_id['iu_user_id']);
		//redirect('my_created_workshops/show_profile/'.$user_id, 'refresh');
	}

	public function show_edit_teacher_rate($iu_w_id, $user_id){
		$error = $this->input->get('message');
		$iu_id = $this->admin_model->get_iu_id($iu_w_id,$user_id);
		$dataView=[
			'page'=>'admin/workshops/edit_delete_teacher_rate',
			'iu_id'=>$iu_id,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}


	public function edit_teacher_rate($iu_id = null){
		//INFORMACION POR IU_ID
		$info_by_iu = $this->admin_model->get_user_by_iu_id($iu_id);
		$iu_user_id = $info_by_iu['iu_user_id'];
		$w_id = $info_by_iu['iu_w_id'];
		//INFORMACION POR IU_W_ID
		$w_info = $this->admin_model->get_user_id_by_iu_w_id($w_id);
		$w_user_id = $w_info['w_user_id'];

		if ($_POST['puntaje_docente'] >= 1 && $_POST['puntaje_docente'] <= 5){
			$this->admin_model->update_teacher_rating($_POST,$iu_id);

			$f =$this->admin_model->insert_final_teacher_rating_to_users($w_user_id);
			redirect('admin/show_student_list/'.$w_id, 'refresh');
		}else{
			$error = urlencode("La calificación debe ser entre 1 y 5");
			redirect('admin/show_edit_teacher_rate/'.$w_id.'/'.$user_id.'/?message='.$error, 'refresh');
		}		
	}

//PROPOSED_SUBCATEGORIES

	public function proposed_subcategories_list(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
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

	public function proposed_subcategories_description($id = null) {
		$error = $this->input->get('message');
		$proposed_subcategory_description = $this->admin_model->proposed_subcategories_show_by_id($id);
		//var_dump($proposed_workshop_description);exit();
		$dataView=[
			'page'=>'admin/proposed_subcategories/description',
			'description'=>$proposed_subcategory_description,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_subcategories_edit($id = null){
		$categorylist = $this->admin_model->get_categories_list();
		$proposed_subcategory_description = $this->admin_model->proposed_subcategories_show_by_id($id);
		$dataView=[
			'page'=>'admin/proposed_subcategories/edit',
			'prueba'=>$categorylist,
			'psc_data'=>$proposed_subcategory_description
		];
		$this->load->view('template/basic',$dataView);
	}

	public function proposed_subcategories_save_edit($id = null){
		$this->admin_model->update_proposed_subcategories($_POST,$id);
		redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
	}

	public function proposed_subcategories_delete($id = null){
		$this->admin_model->delete_proposed_subcategories($id);
		redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
	}

	public function proposed_subcategories_cancel_delete($id = null){
		$this->admin_model->cancel_delete_proposed_subcategories($id);
		redirect('admin/proposed_subcategories_description/'.$id, 'refresh');
	}

	public function proposed_subcategories_open_request($id = null){
		$sc_info = $this->admin_model->proposed_subcategories_show_by_id($id);
		if ($sc_info['votes_quantity'] >= 10) {
			$this->admin_model->open_subcategory_request($id,$_POST);
			$this->admin_model->change_proposed_subcategory_status($id);
			//var_dump($_POST);exit();
			redirect('admin/proposed_subcategories_description/' .$id, 'refresh');
		}else{
			$error = urlencode("No tiene suficientes votos");
			redirect('admin/proposed_subcategories_description/' .$id.'?message='.$error, 'refresh');
		}
	}

//REPORTS

	public function show_reports() {
		$month = $this->input->get('mes');
		//WORKSHOP INSCRIPTIONS
		//$inscription_number = $this->admin_model->number_inscriptions_per_month($month);
		//$inscriptions_month = $this->admin_model->inscriptions_per_month($month);
		//PROPOSED_WORKSHOPS
		
		//PROPOSED_SUBCATEGORIES
		
		//USERS REGISTRATION

		//MOST_POPULAR_CATEGORY
		$popular_categories = $this->admin_model->most_popular_category();

		$draw =$this->admin_model->category_draw();

		$inscriptions_draw = $this->admin_model->incriptions_draw();

		//var_dump($inscriptions_month);exit();
		$dataView=[
			'page'=>'admin/reports/reports',
			'month'=>$month,

			'popular_categories'=>$popular_categories,
			'draw'=>$draw,
			'inscription_draw'=>$inscriptions_draw
		];
		$this->load->view('template/basic',$dataView);
	}

	public function to_pdf(){
		$month = $this->input->post('mes_pdf');
		//var_dump($month);exit();
		$inscription_number = $this->admin_model->number_inscriptions_per_month($month);
		$inscriptions_month = $this->admin_model->inscriptions_per_month($month);

		$pw_number = $this->admin_model->number_workshops_request_per_month($month);
		$pw_month = $this->admin_model->workshops_request_per_month($month);

		$psc_number = $this->admin_model->number_subcategories_request_per_month($month);
		$psc_month = $this->admin_model->subcategories_request_per_month($month);

		$users_number = $this->admin_model->number_user_registration_per_month($month);
		$users_month = $this->admin_model->user_registration_per_month($month);

		$dataView=[
			'month'=>$month,
			'inscription_number'=>$inscription_number,
			'inscriptions_month'=>$inscriptions_month,
			'pw_number'=>$pw_number,
			'pw_month'=>$pw_month,
			'psc_number'=>$psc_number,
			'psc_month'=>$psc_month,
			'users_number'=>$users_number,
			'users_month'=>$users_month,
		];

		$this->load->library('pdf');
		$this->load->view('admin/reports/topdf',$dataView);
	}

	public function workshop_inscriptions_per_month() {
		$month = $this->input->get('mes');
		//WORKSHOP INSCRIPTIONS
		$inscription_number = $this->admin_model->number_inscriptions_per_month($month);
		$inscriptions_month = $this->admin_model->inscriptions_per_month($month);
		$dataView=[
			'inscription_number'=>$inscription_number,
			'inscriptions_month'=>$inscriptions_month,
		];
		$this->load->view('admin/reports/workshops_inscription_per_month',$dataView);
	}

	public function proposed_workshops_per_month(){
		$month = $this->input->get('mes');

		$pw_number = $this->admin_model->number_workshops_request_per_month($month);
		$pw_month = $this->admin_model->workshops_request_per_month($month);
		$dataView=[
			'pw_number'=>$pw_number,
			'pw_month'=>$pw_month,
		];
		$this->load->view('admin/reports/proposed_workshops_per_month',$dataView);
	}

	public function proposed_subcategories_per_month(){
		$month = $this->input->get('mes');

		$psc_number = $this->admin_model->number_subcategories_request_per_month($month);
		$psc_month = $this->admin_model->subcategories_request_per_month($month);
		$dataView=[
			'psc_number'=>$psc_number,
			'psc_month'=>$psc_month,
		];
		$this->load->view('admin/reports/proposed_subcategories_per_month',$dataView);
	}

	public function registrations_per_month(){
		$month = $this->input->get('mes');

		$users_number = $this->admin_model->number_user_registration_per_month($month);
		$users_month = $this->admin_model->user_registration_per_month($month);
		$dataView=[
			'users_number'=>$users_number,
			'users_month'=>$users_month,
		];
		$this->load->view('admin/reports/registrations_per_month',$dataView);
	}

	public function chart() {
		$category_draw = $this->admin_model->category_draw();
		$inscriptions_draw = $this->admin_model->incriptions_draw();

		$dataView=[
		'draw'=>$category_draw,
		'inscription_draw'=>$inscriptions_draw
		];
		$this->load->view('admin/reports/charts',$dataView);
	}

	public function empty() {
		$this->load->view('admin/reports/empty');
	}


}