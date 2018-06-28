<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Workshops extends CI_Controller {

	private $user_id = '0';
	private $today = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('my_workshops_model');
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
            redirect('login', 'refresh');
        }
        ini_set('date.timezone','America/Lima');
        $this->today = new Datetime();

        $this->output->set_header('X-XSS-Protection: 1; mode=block');
	}

	public function index(){
		
		$rp = 2;
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		$page = (isset($_GET['page']))? preg_replace('([^1-9])', '', $_GET['page']):'1';
		$get_list_by_inscribed_user = $this->my_workshops_model->search_my_works_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->my_workshops_model->get_my_works_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'workshops/my_inscribed',
			'lisss'=>$get_list_by_inscribed_user,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);

	}

	public function show_teacher($w_id){
		$user_is_confirm_validation = $this->my_workshops_model->check_if_user_is_confirm_validation($w_id,$this->user_id);
		//var_dump($user_is_confirm_validation);exit();
		if ($user_is_confirm_validation['iu_status'] == 'Confirmado') {
			$error = $this->input->get('message');
			$teacher = $this->my_workshops_model->get_teacher_list($w_id);
			$workshop_info = $this->my_workshops_model->get_workshop_info($w_id);
			//var_dump($teacher);exit;
			$dataView=[
				'page'=>'workshops/teacher_list',
				'listaa'=>$teacher,
				'error'=>$error,
				'workshop_info'=>$workshop_info
			];
			$this->load->view('template/basic',$dataView);
		}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);			
		}

	}

	public function show_rate_teacher($user_id,$w_id){
		$error = $this->input->get('message');
		$w_info = $this->my_workshops_model->get_workshop_info($w_id);

      	$workshop_date = new Datetime($w_info['start_date']);
      	$workshop_date->add(new DateInterval('P1D'));

      	$workshop_limit = new Datetime($w_info['start_date']);
      	$workshop_limit->add(new DateInterval('P5D'));

      	//var_dump($w_info);exit();
      	//COMPROBAR QUE EL TALLER QUE HAYA INGRESADO SEA UNO EN EL QUE ESTE CONFIRMADO
      	$user_is_confirm_validation = $this->my_workshops_model->check_if_user_is_confirm_validation($w_id,$this->user_id);
      	if($user_is_confirm_validation['iu_status'] == 'Confirmado' && $w_info['user_id'] == $user_id ){

				if ($this->today > $workshop_date && $this->today <= $workshop_limit) {
					$teacher_info = $this->my_workshops_model->get_teacher_info($w_id, $this->user_id);
					$final = $this->my_workshops_model->get_teacher_final_rating($w_info['user_id']);
					//var_dump($teacher_info);exit;
					$this->my_workshops_model->insert_final_tutor_rating_to_users($w_info['user_id']);
					$dataView=[
						'page'=>'workshops/rate_teacher',
						'teacher_info'=>$teacher_info,
						'final'=>$final,
						'error'=>$error
					];
					$this->load->view('template/basic',$dataView);
				}else{
					$error = urlencode("No se puede modificar, esta fuera de fecha");
					redirect('my_workshops/show_teacher/'.$w_id.'/?message='.$error,'refresh');
				}
      	}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);	
      	}
	}

	public function rate_teacher($iu_id){
		$get_w_id = $this->my_workshops_model->find_w_id_by_iu_id($iu_id);
		if ($get_w_id['iu_tutor_rating']) {
			$error = urlencode("Ya ha calificado al alumno");
			redirect('my_workshops/show_rate_teacher/'.$get_w_id['iu_user_id'].'/'.$get_w_id['iu_w_id'].'/?message='.$error, 'refresh');
		}else{
			if($_POST['puntaje']>=1 && $_POST['puntaje']<=5){
				$this->my_workshops_model->rate_teacher($_POST,$iu_id);
				$tutor_user_id = $this->my_workshops_model->find_user_by_w_id($get_w_id['iu_w_id']);
				$this->my_workshops_model->insert_final_tutor_rating_to_users($tutor_user_id['w_user_id']);
				redirect('my_workshops/show_rate_teacher/'.$get_w_id['iu_user_id'].'/'.$get_w_id['iu_w_id'], 'refresh');
			}else{
				$error = urlencode("La calificación debe ser entre 1 y 5");
				redirect('my_workshops/show_rate_teacher/'.$get_w_id['iu_user_id'].'/'.$get_w_id['iu_w_id'].'/?message='.$error, 'refresh');
			}
		}	
	}

}