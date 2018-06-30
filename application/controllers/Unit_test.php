<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_test extends CI_Controller {

	private $user_id = '0';
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('workshop_model');
		$this->load->model('my_workshops_model');
		$this->load->model('proposed_workshop_model');
		$this->load->model('proposed_subcategories_model');
		$this->load->model('created_workshops_model');
		
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

//CONTROLADOR_WORKSHOP
	public function validate_hour1($hour, $format){
		$h = DateTime::createFromFormat($format, $hour);
    	return $h && $h->format($format) == $hour;
    }

//MODELO WORKSHOP

	public function index(){
		$this->load->library('unit_test');
		$name1 = "Primero";
		ini_set('date.timezone','America/Lima');

		//$hour = new DateTime();
		//CONTROLADOR WORKSHOP
		//$datos['validate_hour1'] = $this->unit->run($this->validate_hour1($hour, $format = 'H:i'), 'is_true', 'Validación de formato de hora','Notas de mi prueba');

		//MODELO WORKSHOP	
		$id = 1;
		$datos['workshop_info_by_id'] = $this->unit->run($this->workshop_model->show_by_id($id), 'is_array', 'Datos de Workshop por id');

		$user_id = 1;
		$dataform = [
			'titulo' => "Hola", 'subcategoria'=> 1, 'nivel' => 1, 'fecha' => '2018-01-05',
        	'hora_inicio' => 'aa', 'hora_fin' => 'aa', 'monto' => 50, 'vacantes' => 6,
        	'descripcion' => '', 'user_id'=> $user_id
		];
		$category_id = 1; 
		//$datos['workshop_create'] = $this->unit->run($this->workshop_model->create($dataform, $category_id, $user_id), 'is_null', 'Crear Taller');


		$datos['categories_list'] = $this->unit->run($this->workshop_model->get_categories_list(), 'is_array', 'Lista de Categorías');

		$datos['subcategories_list'] = $this->unit->run($this->workshop_model->get_subcategories_list(), 'is_array', 'Lista de Subcategorías');

		$category_id = 1;
		$datos['filter_subcategories_list'] = $this->unit->run($this->workshop_model->get_filter_subcategories_list($category_id), 'is_array', 'Lista de Subcategorías Filtradas');

		$datos['level_list'] = $this->unit->run($this->workshop_model->level_list(), 'is_array', 'Lista de Niveles');

		$id = 1;
		$datos['user_creator'] = $this->unit->run($this->workshop_model->check_user_creator($id), 'is_array', 'Verificar datos de creador del taller');

		$id = 1; $user_id = 2;
		$datos['verify_enroll_user'] = $this->unit->run($this->workshop_model->verify_enroll_user($id, $user_id), 'is_array', 'Verificar matricula de usuario en el taller');

		$user_id = 1; $subcategory_id = 2;
		$datos['iu_by_user'] = $this->unit->run($this->workshop_model->get_inscribed_workshops_by_user($user_id,$subcategory_id), 'is_array', 'Obtener Talleres Inscritos por Usuarios');

		$category = 1;$rp = 2; $q ='';
		$datos['workshop_pages_number'] = $this->unit->run($this->workshop_model->get_total_search($category,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Talleres');

		$datos['get_workshop_sql'] = $this->unit->run($this->workshop_model->get_sql_search($category,$q), 'is_string', 'Obtener SQL de Listar Talleres');

		$datos['postulants_number'] = $this->unit->run($this->workshop_model->get_postulants_number($id), 'is_int', 'Numero de Postulantes');

		//MODELO USER
		$u = 'jessp.4997@gmail.com'; $p = '123456';
		$datos['check_user_login'] = $this->unit->run($this->user_model->check_user_login($u,$p), 'is_array', 'Verificar Logueo de Usuario');

		$user_id = 1 ;
		$datos['user_info_by_id'] = $this->unit->run($this->user_model->show_profile_by_id($user_id), 'is_array', 'Datos de Usuario por id');

		$email = 'kvn0696@gmail.com' ;
		$datos['info_by_email'] = $this->unit->run($this->user_model->find_user_by_email($email), 'is_array', 'Datos de Usuario por email');

		$token = '';
		$datos['user_by_token'] = $this->unit->run($this->user_model->find_user_by_token($token), 'is_null', 'Buscar Usuario por Token');

		$datos['total_workshops_by_user'] = $this->unit->run($this->user_model->get_total_workshops_by_user($user_id), 'is_int', 'Talleres Creados por Usuario');

		$datos['total_proposed_workshops_by_user'] = $this->unit->run($this->user_model->get_total_proposed_workshops_by_user($user_id), 'is_int', 'Solicitudes de Talleres Creados por Usuario');

		$datos['total_inscriptions_by_user'] = $this->unit->run($this->user_model->get_total_inscriptions_by_user($user_id), 'is_int', 'Inscripciones a Talleres por Usuario');


		//MODELO PROPOSED_WORKSHOPS

		$datos['proposed_workshop_sql'] = $this->unit->run($this->proposed_workshop_model->get_sql_search($category,$q), 'is_string', 'Obtener SQL de Listar Solicitudes de Talleres');

		$datos['proposed_workshops_pages_number'] = $this->unit->run($this->proposed_workshop_model->get_total_search($category,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Solicitudes de Talleres');

		$id = 1;
		$datos['proposed_workshop_info_by_id'] = $this->unit->run($this->proposed_workshop_model->show_by_id($id), 'is_array', 'Datos de Solicitudes de Talleres por id');

		$datos['my_proposed_workshop_sql'] = $this->unit->run($this->proposed_workshop_model->get_sql_my_request_list($user_id,$q), 'is_string', 'Obtener SQL de Listar Mis Solicitudes de Talleres');

		$datos['my_proposed_workshop_pages_number'] = $this->unit->run($this->proposed_workshop_model->get_request_list_total_search($user_id,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Mis Solicitudes de Talleres');

		$datos['proposed_workshop_creator_email'] = $this->unit->run($this->proposed_workshop_model->get_pw_creator_email($id), 'is_array', 'Obtener Email de Creador de Solicitud de Taller');

		$pw_id = 2; $user_id = 1;
		$datos['verify_pw_user_vote'] = $this->unit->run($this->proposed_workshop_model->verify_user_vote($pw_id, $user_id), 'is_array', 'Verificar Voto de Usuario por Solicitud de Taller');

		$pw_id = 2;
		$datos['proposed_workshop_votes_quantity'] = $this->unit->run($this->proposed_workshop_model->get_votes_quantity($pw_id), 'is_array', 'Cantidad de Votos de Solicitud de Taller');

		$datos['category_id_by_subcategory_id'] = $this->unit->run($this->proposed_workshop_model->get_category_id_by_subcategory_id($subcategory_id), 'is_array', 'Obtener id de Categoría por id de Subcategoria');


		//MODELO PROPOSED_SUBCATEGORIES

		$datos['proposed_subcategories_sql'] = $this->unit->run($this->proposed_subcategories_model->get_sql_search($category,$q), 'is_string', 'Obtener SQL de Listar Solicitudes de Subcategorias');

		$datos['proposed_subcategories_pages_number'] = $this->unit->run($this->proposed_subcategories_model->get_total_search($category,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Solicitudes de Subcategorias');

		$id = 2;
		$datos['proposed_subcategory_info_by_id'] = $this->unit->run($this->proposed_subcategories_model->show_by_id($id), 'is_array', 'Datos de Solicitudes de Subcategorias por id');

		$category_id = 1; $subcategory_name = 'Bachata';
		$datos['check_proposed_subcategory_name_by_category_id'] = $this->unit->run($this->proposed_subcategories_model->check_if_subcategory_exist($category_id,$subcategory_name), 'is_array', 'Verificar si Subcategoría existe por id de Categoria');

		$datos['my_proposed_subcategories_sql'] = $this->unit->run($this->proposed_subcategories_model->get_sql_my_request_list($user_id,$q), 'is_string', 'Obtener SQL de Listar Mis Solicitudes de Subcategorias');

		$datos['my_proposed_subcategories_pages_number'] = $this->unit->run($this->proposed_subcategories_model->get_request_list_total_search($user_id,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Mis Solicitudes de Subcategorias');

		$psc_id = 2; $user_id = 2;
		$datos['verify_psc_user_vote'] = $this->unit->run($this->proposed_subcategories_model->verify_user_vote($psc_id, $user_id), 'is_array', 'Verificar Voto de Usuario por Solicitud de Subcategoria');

		$psc_id = 2;
		$datos['proposed_subcategory_votes_quantity'] = $this->unit->run($this->proposed_subcategories_model->get_votes_quantity($psc_id), 'is_array', 'Cantidad de Votos de Solicitud de Subcategoria');


		//MODELO MY_WORKSHOPS

		$datos['my_workshops_sql'] = $this->unit->run($this->my_workshops_model->get_sql_my_works_list($user_id,$q), 'is_string', 'Obtener SQL de Mis Talleres');

		$datos['my_workshops_sql_pages_number'] = $this->unit->run($this->my_workshops_model->get_my_works_total_search($user_id,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Mis Talleres');

		$datos['my_workshops_teacher_list'] = $this->unit->run($this->my_workshops_model->get_teacher_list($id), 'is_array', 'Obtener Lista de Profesor por Taller');

		$w_id = 1; $iu_user_id = 2;
		$datos['my_workshops_teacher_info'] = $this->unit->run($this->my_workshops_model->get_teacher_info($w_id,$iu_user_id), 'is_array', 'Obtener Datos de Profesor por Taller');

		$w_user_id = 2;
		$datos['my_workshops_teacher_final_rating'] = $this->unit->run($this->my_workshops_model->get_teacher_final_rating($w_user_id), 'is_string', 'Obtener Puntaje final de Profesor');

		$iu_id = 1;
		$datos['find_w_id_by_iu_id'] = $this->unit->run($this->my_workshops_model->find_w_id_by_iu_id($iu_id), 'is_array', 'Obtener id de Taller por id de Usuario Inscrito');

		$datos['find_user_by_w_id'] = $this->unit->run($this->my_workshops_model->find_user_by_w_id($w_id), 'is_array', 'Obtener id de Usuaio por id de Taller');

		$datos['check_if_user_is_confirm_validation'] = $this->unit->run($this->my_workshops_model->check_if_user_is_confirm_validation($w_id,$user_id), 'is_array', 'Verificar Usuario Confirmado');

		$datos['check_if_workshop_id_exist'] = $this->unit->run($this->my_workshops_model->check_if_workshop_id_exist($w_id), 'is_array', 'Verificar si ID de Taller Existe');

		$datos['get_info_by_iu'] = $this->unit->run($this->my_workshops_model->get_info_by_iu($iu_id), 'is_array', 'Obetener Informacion por ID de Usuario Inscrito');


		//MODELO CREATED_WORKSHOPS

		$datos['get_sql_my_created_w_list'] = $this->unit->run($this->created_workshops_model->get_sql_my_created_w_list($user_id,$q), 'is_string', 'Obetener SQL de Mis Talleres Creados');

		$datos['get_created_w_list_total_search'] = $this->unit->run($this->created_workshops_model->get_created_w_list_total_search($user_id,$q,$rp), 'is_float', 'Obtener Numero de Paginado de Mis Talleres Creados');

		
		


		


		

		

		

		
		
		


		

		

		
		

		


		$datos['page'] = 'unit_test';

		$this->load->view('template/basic',$datos);
	}
}
