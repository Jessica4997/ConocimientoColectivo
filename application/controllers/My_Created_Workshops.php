<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Created_Workshops extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('created_workshops_model');
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
		$request_list = $this->created_workshops_model->search_created_w_list_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->created_workshops_model->get_created_w_list_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'workshops/my_created',
			'hhh'=>$request_list,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages
		];
		$this->load->view('template/basic',$dataView);

	}

	public function show_postulants_list($id){
		$postulants_list = $this->created_workshops_model->get_postulants_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'workshops/postulants_list',
			'list'=>$postulants_list
		];
		$this->load->view('template/basic',$dataView);
	}

	public function validate_student($user_id,$w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);

		ini_set('date.timezone','America/Lima');
  		$today = new Datetime();
      	$workshop_date = new Datetime($w_info['start_date']);
		$workshop_date->sub(new DateInterval('P1D'));
		//var_dump($workshop_date);exit();
		//var_dump($w_info);exit();
		if ($today > $workshop_date){
			echo "La fecha de modificación culminó";
		}else{
			if ($w_info['vacancy'] > 0) {
				$get_iu_id = $this->created_workshops_model->get_student_info($user_id, $w_id);
				if ($get_iu_id['iu_status'] == 'No confirmado') {
					$this->created_workshops_model->validate_student($get_iu_id['iu_id']);
					
					$w_info['vacancy'] = $w_info['vacancy'] - 1;
					$this->created_workshops_model->update_vacancy_number($w_id, $w_info['vacancy']);
					redirect('my_created_workshops/show_postulants_list/' .$w_id, 'refresh');
				}else{
					echo "Ya se validó a este alumno";
				}
			}else{
				echo "Ya no hay vacantes";
			}
		}
	}

	public function cancel_validate_student($user_id,$w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);

		ini_set('date.timezone','America/Lima');
  		$today = new Datetime();
      	$workshop_date = new Datetime($w_info['start_date']);

      	if ($today > $workshop_date) {
			echo "La fecha de inicio culminó";
		}else{
			$get_iu_id = $this->created_workshops_model->get_student_info($user_id, $w_id);
			//var_dump($get_iu_id);exit();
			if ($get_iu_id['iu_status'] == 'Confirmado') {
				$this->created_workshops_model->cancel_student($get_iu_id['iu_id']);

				$w_info['vacancy'] = $w_info['vacancy'] + 1;
				$this->created_workshops_model->update_vacany_number($w_id, $w_info['vacancy']);
				redirect('my_created_workshops/show_postulants_list/' .$w_id, 'refresh');
			}else{
				echo "Ya se canceló a este alumno";
			}	
		}
	}

	public function show_student_list($id){
		$students_list = $this->created_workshops_model->get_students_list($id);
		//var_dump($students_list);exit;
		$dataView=[
			'page'=>'workshops/student_list',
			'listaa'=>$students_list
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_rate_students($user_id, $w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);

		ini_set('date.timezone','America/Lima');
  		$today = new Datetime();
      	$workshop_date = new Datetime($w_info['start_date']);
      	$workshop_date->add(new DateInterval('P1D'));

      	if ($today > $workshop_date){
      		$student_info = $this->created_workshops_model->get_student_info($user_id, $w_id);
      		$final = $this->created_workshops_model->get_student_final_rating($user_id);
      		$dataView=[
      			'page'=>'workshops/rate_students',
				'info'=>$student_info,
				'final'=>$final
			];
			$this->load->view('template/basic',$dataView);
		}else{
			echo "El taller aun no ha finalizado";
		}
	}

	public function rate_student($iu_id){

		$this->created_workshops_model->rate_student($_POST,$iu_id);

		$inscribed_user_id = $this->created_workshops_model->find_user_by_iu_id($iu_id);
		
		$this->created_workshops_model->insert_final_rating_to_users($inscribed_user_id['iu_user_id']);
		//redirect('my_created_workshops/show_profile/'.$user_id, 'refresh');
	}
}