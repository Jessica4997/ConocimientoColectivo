<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Workshops extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('my_workshops_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
            redirect('login', 'refresh');
        }
	}

	public function index(){
		
		$rp = 2;
		$q = (isset($_GET['q']))? $_GET['q']:'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$get_list_by_inscribed_user = $this->my_workshops_model->search_my_works_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->my_workshops_model->get_my_works_total_search($this->user_id,$q,$rp);

		$dataView=[
			'page'=>'workshops/my_inscribed',
			'lisss'=>$get_list_by_inscribed_user,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages
		];
		$this->load->view('template/basic',$dataView);

	}

	public function show_teacher($w_id){
		$error = $this->input->get('message');
		$teacher = $this->my_workshops_model->get_teacher_list($w_id);
		//var_dump($teacher);exit;
		$dataView=[
			'page'=>'workshops/teacher_list',
			'listaa'=>$teacher,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_rate_teacher($user_id,$w_id){
		$error = $this->input->get('message');
		$w_info = $this->my_workshops_model->get_workshop_info($w_id);

		ini_set('date.timezone','America/Lima');
  		$today = new Datetime();
      	$workshop_date = new Datetime($w_info['start_date']);
      	$workshop_date->add(new DateInterval('P1D'));

      	//var_dump($w_info);exit();
		if ($today > $workshop_date) {
			$teacher_info = $this->my_workshops_model->get_teacher_info($w_id, $this->user_id);
			$final = $this->my_workshops_model->get_teacher_final_rating($w_info['user_id']);
			//var_dump($teacher_info);exit;
			$dataView=[
				'page'=>'workshops/rate_teacher',
				'teacher_info'=>$teacher_info,
				'final'=>$final,
				'error'=>$error
			];
			$this->load->view('template/basic',$dataView);
		}else{
			$error = urlencode("El taller aun no ha finalizado");
			redirect('my_workshops/show_teacher/'.$user_id.'/'.$w_id.'/?message='.$error,'refresh');
		}
	}

	public function rate_teacher($iu_id){
		$get_w_id = $this->my_workshops_model->find_w_id_by_iu_id($iu_id);
		if($_POST['puntaje']>=1 && $_POST['puntaje']<=5){
			$this->my_workshops_model->rate_teacher($_POST,$iu_id);
			$tutor_user_id = $this->my_workshops_model->find_user_by_w_id($get_w_id['iu_w_id']);
			$this->my_workshops_model->insert_final_tutor_rating_to_users($tutor_user_id['w_user_id']);
			redirect('my_workshops/show_rate_teacher/'.$get_w_id['iu_user_id'].'/'.$get_w_id['iu_w_id'], 'refresh');
		}else{
			$error = urlencode("La calificación debe ser entre 1 y 5");
			redirect('my_workshops/show_rate_teacher/'.$get_w_id['iu_user_id'].'/'.$get_w_id['iu_w_id'].'/?message='.$error, 'refresh');
		}
		

		
		
		//
	}

}