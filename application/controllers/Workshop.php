<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {

	private $user_id = '0';
	private $today = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('workshop_model');
		$this->load->model('created_workshops_model');
		$this->load->model('my_workshops_model');
		
		$this->user_id = $this->session->userdata('s_iduser');
		$ruta = $this->uri->segment(2, '/');
		$whiteList=array('/','description');
        if ($this->user_id === null && !in_array($ruta,$whiteList)){
            redirect('login', 'refresh');
        }
        ini_set('date.timezone','America/Lima');
        $this->today = new Datetime();

        $this->output->set_header('X-XSS-Protection: 1; mode=block');


	}

	public function index() {
		$rp = 2;
		/*
		if(isset($_GET['category'])){
			$category = $_GET['category'];
		}else{
			$category = [];
		}
		*/
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		//$q = (isset($_GET['q']))? $_GET['q']:'';
		//$page = (isset($_GET['page']))? preg_replace('([^1-9])', '', $_GET['page']):'1';
		$page = (isset($_GET['page']) )? preg_replace('([^1-9])', '', $_GET['page']):'1';
		$wrk = $this->workshop_model->search_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->workshop_model->get_total_search($category,$q,$rp);
		$catlist = $this->workshop_model->get_categories_list();
		$dataView=[
			'page'=>'workshops/list',
			'lists'=>$wrk ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		//var_dump($dataView);exit();

		$this->load->view('template/basic',$dataView);
	}



	public function description($id = null) {

		$workshop_description = $this->workshop_model->show_by_id($id);
		//var_dump($workshop_description);exit();
		$w_by_user = $this->workshop_model->get_inscribed_workshops_by_user($this->user_id,$workshop_description['sc_id']);
		$w_by_user_validate = isset($w_by_user)? $w_by_user :1;

		$postulants_number = $this->workshop_model->get_postulants_number($id);
		$this->my_workshops_model->get_teacher_final_rating($id);
		$this->my_workshops_model->insert_final_tutor_rating_to_users($workshop_description['workshop_creator']);

		$error = $this->input->get('message');
		if($workshop_description['removed'] == 'Activo'){
			$dataView=[
				'page'=>'workshops/description',
				'description'=>$workshop_description,
				'w_historial'=>$w_by_user_validate,
				'error'=>$error,
				'postulants_number'=>$postulants_number
			];
			$this->load->view('template/basic',$dataView);
		}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);
		}
	}

	public function create_second_step(){
		$category_id = $this->input->post('categoria_first_step');
		$category_id_get = $this->input->get('ci');
		if(is_null($category_id)){
			if (is_null($category_id_get)) {
				redirect('workshop','refresh');
			}else{
				$category_id = $category_id_get;
			}
			
		}

		$error = $this->input->get('message');
		

		$subcategorylist = $this->workshop_model->get_filter_subcategories_list($category_id);
		$level_list = $this->workshop_model->level_list();
		$error = $this->input->get('message');
		$dataView=[
			'page'=>'workshops/create_second_step',
			'list_sc'=>$subcategorylist,
			'level_list'=>$level_list,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);			
		
	}

	public function save(){
		$category_id = $this->workshop_model->get_category_id_by_subcategory_id($_POST['subcategoria']);
        $workshop_date = new Datetime($_POST['fecha']);

        $urlbase = 'workshop/create_second_step?ci='.$category_id['categories_id'];

        ini_set('date.timezone','America/Lima');
        $today_modified = new Datetime();
        $today_modified->add(new DateInterval('P6D'));
        //var_dump($_POST);exit();
        if (!empty($_POST['titulo']) && trim($_POST['titulo']) != '' && !empty($_POST['fecha']) && trim($_POST['fecha']) != '' && !empty($_POST['hora_inicio']) && trim($_POST['hora_inicio']) != '' && !empty($_POST['hora_fin']) && trim($_POST['hora_fin']) != '' && !empty($_POST['vacantes']) && trim($_POST['vacantes']) != '' && !empty($_POST['monto']) && trim($_POST['monto']) != '') {

        			$hour_format1 = $this->validate_hour1($_POST['hora_inicio'], $format = 'H:i');
        			$hour_format2 = $this->validate_hour2($_POST['hora_fin'], $format = 'H:i');
					if ($hour_format1 == 'true' && $hour_format2 == 'true') {

							if ($workshop_date > $today_modified){
								if ( $_POST['hora_fin'] > $_POST['hora_inicio']) {
									$this->workshop_model->create($_POST, $category_id['categories_id'], $this->user_id);
									//redirect('workshop', 'refresh');
									$toRedirect = 'workshop';
								}else{
									$error = urlencode("La hora de fin debe ser mayor a la hora de inicio");
									$toRedirect = $urlbase.'&message='.$error;
								}
							}else{
								$error = urlencode("Debes escoger una fecha posterior");
								$toRedirect = $urlbase.'&message='.$error;
							}

					}else{
						$error = urlencode("Ingresa un formato de hora adecuado");
						$toRedirect = $urlbase.'&message='.$error;
					}


        }else{
        	$error = urlencode("Hay campos vacíos");
			$toRedirect = $urlbase.'&message='.$error;
        }
		redirect($toRedirect, 'refresh');
	}


	public function validate_hour1($hour, $format = 'H:i'){
		$h = DateTime::createFromFormat($format, $hour);
    	return $h && $h->format($format) == $hour;
    }


	public function validate_hour2($hour, $format = 'H:i'){
		$h = DateTime::createFromFormat($format, $hour);
    	return $h && $h->format($format) == $hour;
    }


	public function save_inscribed_user($id = null){
		$workshop_description = $this->workshop_model->show_by_id($id);

      	$workshop_date = new Datetime($workshop_description['start_date']);

		$verifydata = $this->workshop_model->verify_enroll_user($id, $this->user_id);
		$verifycreator = $this->workshop_model->check_user_creator($id);
		
		$w_by_user = $this->workshop_model->get_inscribed_workshops_by_user($this->user_id,$workshop_description['sc_id']);

		$postulants_number = $this->workshop_model->get_postulants_number($id);

		$today_modified = new Datetime();
        $today_modified->add(new DateInterval('P2D'));

		//$w_by_user_validate = isset($w_by_user['dificult'])? $w_by_user['dificult'] :$w_by_user['dificult']=1;
		if ($id === null) {
			echo "No valido";exit();
		}
		
		if ($verifydata) {
			$error = urlencode("Ya te matriculaste");
			$toRedirect = 'workshop/description/'.$id.'?message='.$error;

		}else if($verifycreator['user_id'] == $this->user_id) {
			$error = urlencode("No puedes matricularte porque tu lo creaste");
			$toRedirect = 'workshop/description/'.$id.'?message='.$error;

		}else if(intval($w_by_user['dificult']) +1 < intval($workshop_description['dificult'])){
			$error = urlencode("No puedes matricularte porque necesitas llevar algun taller previo");
			$toRedirect = 'workshop/description/'.$id.'?message='.$error;

		}else if($workshop_date < $today_modified){
			$error = urlencode("La fecha de postulación ya paso");
			$toRedirect = 'workshop/description/'.$id.'?message='.$error;

		}else if ($workshop_description['vacancy'] <= 0) {
			$error = urlencode("No hay vacantes");
			$toRedirect = 'workshop/description/'.$id.'?message='.$error;
		}
		else{
			if ($postulants_number < 15){
				$this->workshop_model->enroll_workshop($this->user_id, $id);
				$toRedirect = 'workshop';
			}else{
				$error = urlencode("Se superó el número de postulantes");
				$toRedirect = 'workshop/description/'.$id.'?message='.$error;
			}
		}
		redirect($toRedirect,'refresh');
	}
}
