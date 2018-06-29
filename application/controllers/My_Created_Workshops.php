<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Created_Workshops extends CI_Controller {

	private $user_id = '0';
	private $today = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('created_workshops_model');
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

	public function show_postulants_list($id = null){
		$workshop_creator_validation = $this->created_workshops_model->check_if_is_my_created_workshop_validation($id);
		$error = $this->input->get('message');
		$postulants_list = $this->created_workshops_model->get_postulants_list($id);
		$workshop_info = $this->created_workshops_model->get_workshop_info($id);

		if ($workshop_info['id']){
			if ($workshop_creator_validation['w_user_id'] == $this->user_id) {
				$dataView=[
					'page'=>'workshops/postulants_list',
					'list'=>$postulants_list,
					'error'=>$error,
					'workshop_info'=>$workshop_info
				];
			}else{
				$dataView=[
					'page'=>'error'
				];
			}
		}else{
			$dataView=[
				'page'=>'error'
			];
		}
		$this->load->view('template/basic',$dataView);
	}

	public function validate_student($user_id,$w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);
		$inscribed_user_is_my_student = $this->created_workshops_model->check_if_inscribed_user_is_my_student($w_id,$user_id);

      	$workshop_date = new Datetime($w_info['start_date']);
		$workshop_date->sub(new DateInterval('P1D'));
		//var_dump($w_info);exit();
		//VALIDAR QUE SEA MI TALLER Y QUE EL ALUMNO ESTE EN EL TALLER
		if($w_info['user_id'] == $this->user_id && $inscribed_user_is_my_student){

				if ($this->today > $workshop_date){
					$error = urlencode("La fecha de modificación culminó");
					redirect('my_created_workshops/show_postulants_list/' .$w_id.'/?message='.$error ,'refresh');
				}else{
					if ($w_info['vacancy'] > 0) {
						$get_iu_id = $this->created_workshops_model->get_student_info($user_id, $w_id);
						if ($get_iu_id['iu_status'] == 'No confirmado') {
							$this->created_workshops_model->validate_student($get_iu_id['iu_id']);
							
							$w_info['vacancy'] = $w_info['vacancy'] - 1;
							$this->created_workshops_model->update_vacancy_number($w_id, $w_info['vacancy']);
							redirect('my_created_workshops/show_postulants_list/' .$w_id, 'refresh');
						}else{
							$error = urlencode("Ya se validó a este alumno");
							redirect('my_created_workshops/show_postulants_list/' .$w_id.'/?message='.$error ,'refresh');
						}
					}else{
						$error = urlencode("Ya no hay vacantes");
						redirect('my_created_workshops/show_postulants_list/' .$w_id.'/?message='.$error ,'refresh');
					}
				}

		}else{
			$dataView=[
				'page'=>'error'
			];
			$this->load->view('template/basic',$dataView);
		}
	}

	public function cancel_validate_student($user_id,$w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);
		$inscribed_user_is_my_student = $this->created_workshops_model->check_if_inscribed_user_is_my_student($w_id,$user_id);

      	$workshop_date = new Datetime($w_info['start_date']);
      	//VALIDAR QUE SEA MI TALLER Y QUE EL ALUMNO ESTE EN EL TALLER
      	if ($w_info['user_id'] == $this->user_id && $inscribed_user_is_my_student) {

		      	if ($this->today > $workshop_date) {
					$error = urlencode("La fecha de modificación culminó");
					redirect('my_created_workshops/show_postulants_list/' .$w_id.'/?message='.$error ,'refresh');
				}else{
					$get_iu_id = $this->created_workshops_model->get_student_info($user_id, $w_id);
					//var_dump($get_iu_id);exit();
					if ($get_iu_id['iu_status'] == 'Confirmado') {
						$this->created_workshops_model->cancel_student($get_iu_id['iu_id']);

						$w_info['vacancy'] = $w_info['vacancy'] + 1;
						$this->created_workshops_model->update_vacancy_number($w_id, $w_info['vacancy']);
						redirect('my_created_workshops/show_postulants_list/' .$w_id, 'refresh');
					}else{
						$error = urlencode("Ya se canceló a este alumno");
						redirect('my_created_workshops/show_postulants_list/' .$w_id.'/?message='.$error ,'refresh');
					}	
				}

      	}else{
  			$dataView=[
				'page'=>'error'
			];
			$this->load->view('template/basic',$dataView);    		
      	}
	}

	public function show_student_list($id = null){
		$workshop_creator_validation = $this->created_workshops_model->check_if_is_my_created_workshop_validation($id);
		$error = $this->input->get('message');
		$students_list = $this->created_workshops_model->get_students_list($id);
		$workshop_info = $this->created_workshops_model->get_workshop_info($id);
		//var_dump($students_list);exit();

		if ($workshop_info['id']){
			if ($workshop_creator_validation['w_user_id'] == $this->user_id) {
				$dataView=[
					'page'=>'workshops/student_list',
					'listaa'=>$students_list,
					'error'=>$error,
					'workshop_info'=>$workshop_info
				];
			}else{
				$dataView=[
					'page'=>'error'
				];
			}
		}else{
			$dataView=[
				'page'=>'error'
        	];				
		}
		$this->load->view('template/basic',$dataView);	
	}

	public function show_rate_students($user_id, $w_id){
		$w_info = $this->created_workshops_model->get_workshop_info($w_id);
		$inscribed_user_is_my_student = $this->created_workshops_model->check_if_inscribed_user_is_my_student($w_id,$user_id);
		$error = $this->input->get('message');

		//PARA VERIFICAR QUE EL TALLER SEA UNO QUE HE CREADO Y COMPROBAR QUE EL USUARIO QUE ESCOJA ESTE EN MI TALLER
		if($w_info['user_id'] == $this->user_id && $inscribed_user_is_my_student){
		      	$workshop_date = new Datetime($w_info['start_date']);
		      	$workshop_date->add(new DateInterval('P1D'));

		      	$workshop_limit = new Datetime($w_info['start_date']);
		      	$workshop_limit->add(new DateInterval('P5D'));

		      	if ($this->today > $workshop_date && $this->today <= $workshop_limit){
		      		$student_info = $this->created_workshops_model->get_student_info($user_id, $w_id);
		      		$final = $this->created_workshops_model->get_student_final_rating($user_id);

		      		$this->created_workshops_model->insert_final_rating_to_users($user_id);
		      		$dataView=[
		      			'page'=>'workshops/rate_students',
						'info'=>$student_info,
						'final'=>$final,
						'error'=>$error
					];
					$this->load->view('template/basic',$dataView);
				}else{
					$error = "No se puede modificar, esta fuera de fecha";
					redirect('my_created_workshops/show_student_list/' .$w_id.'/?message='.$error ,'refresh');
				}
		}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);
		}
	}

	public function rate_student($iu_id){
		$info_by_iu = $this->created_workshops_model->get_info_by_iu($iu_id);
		//var_dump($info_by_iu);exit();
		if ($info_by_iu['w_user_id'] == $this->user_id && $info_by_iu['iu_status'] == 'Confirmado'){

				$inscribed_user_id = $this->created_workshops_model->find_user_by_iu_id($iu_id);
				if ($inscribed_user_id['iu_student_rating']){
					$error = urlencode("Ya ha calificado al alumno");
					redirect('my_created_workshops/show_rate_students/'.$inscribed_user_id['iu_user_id'].'/'.$inscribed_user_id['iu_w_id'].'/?message='.$error, 'refresh');
				}else{

					if (is_numeric($_POST['puntaje']) && !empty($_POST['puntaje']) && trim($_POST['puntaje']) != ''){

							if($_POST['puntaje']>=1 && $_POST['puntaje']<=5){
								$this->created_workshops_model->rate_student($_POST,$iu_id);
							
								$this->created_workshops_model->insert_final_rating_to_users($inscribed_user_id['iu_user_id']);
								redirect('my_created_workshops/show_rate_students/'.$inscribed_user_id['iu_user_id'].'/'.$inscribed_user_id['iu_w_id'], 'refresh');
							}else{
								$error = urlencode("La calificación debe ser entre 1 y 5");
								redirect('my_created_workshops/show_rate_students/'.$inscribed_user_id['iu_user_id'].'/'.$inscribed_user_id['iu_w_id'].'/?message='.$error, 'refresh');
							}

					}else{
						$error = urlencode("Datos incorrectos");
						redirect('my_created_workshops/show_rate_students/'.$inscribed_user_id['iu_user_id'].'/'.$inscribed_user_id['iu_w_id'].'/?message='.$error, 'refresh');
					}

				}
		}else{
			$dataView=[
				'page'=>'error'
        	];
        	$this->load->view('template/basic',$dataView);
		}
	}
}