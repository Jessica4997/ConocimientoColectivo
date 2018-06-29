<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposed_Workshop extends CI_Controller {

	private $user_id= '0';
	private $today = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('proposed_workshop_model');
		$this->load->model('user_model');
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


	public function index(){
		$rp = 2;
		$category = (isset($_GET['category']))? $_GET['category']:[];
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		$page = (isset($_GET['page']))? preg_replace('([^1-9])', '', $_GET['page']):'1';
		$pw_list = $this->proposed_workshop_model->search_by_category_title($page,$category,$q,$rp);
		$num_pages = $this->proposed_workshop_model->get_total_search($category,$q,$rp);
		$catlist = $this->proposed_workshop_model->get_categories_list();
		$dataView=[
			'page'=>'proposed_workshops/list',
			'lists'=>$pw_list ,
			'lis'=>$catlist,
			'q'=>$q,
			'category'=>$category,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}

	public function description($id = null) {
		$proposed_workshop_description = $this->proposed_workshop_model->show_by_id($id);
		$error = $this->input->get('message');
		if($proposed_workshop_description['removed'] == 'Activo'){
			$dataView=[
				'page'=>'proposed_workshops/description',
				'description'=>$proposed_workshop_description,
				'error'=>$error
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
		$category_id = $this->input->post('categoria_pw_first_step');
		if($category_id){
			$level_list = $this->proposed_workshop_model->level_list();
			$subcategorylist = $this->proposed_workshop_model->get_filter_subcategories_list($category_id);
			$error = $this->input->get('message');

			$dataView=[
				'page'=>'proposed_workshops/create_second_step',
				'level_list'=>$level_list,
				'subcat'=>$subcategorylist,
				'error'=>$error
			];
			$this->load->view('template/basic',$dataView);
		}else{
			$dataView=[
				'page'=>'error',
				'category_id'=>$category_id
			];
			$this->load->view('template/basic',$dataView);				
		}
	}

	public function save(){
		//var_dump($_POST);exit();

		ini_set('date.timezone','America/Lima');
        $today_modified = new Datetime();
        $today_modified->add(new DateInterval('P2D'));

		if (!empty($_POST['titulo']) && trim($_POST['titulo']) != '' && !empty($_POST['fecha_inicio']) && trim($_POST['fecha_inicio']) != '' && !empty($_POST['hora_inicio']) && trim($_POST['hora_inicio']) != '' && !empty($_POST['hora_fin']) && trim($_POST['hora_fin']) != '') {

				    $hour_format1 = $this->validate_hour1($_POST['hora_inicio'], $format = 'H:i');
        			$hour_format2 = $this->validate_hour2($_POST['hora_fin'], $format = 'H:i');
					if ($hour_format1 == 'true' && $hour_format2 == 'true'){

							$category_id = $this->proposed_workshop_model->get_category_id_by_subcategory_id($_POST['sub_categoria']);

					        $proposed_workshop_date = new Datetime($_POST['fecha_inicio']);

					        if ($proposed_workshop_date > $today_modified){
					        	if ($_POST['hora_fin'] > $_POST['hora_inicio']) {
					        		$this->proposed_workshop_model->create($_POST,$category_id['categories_id'], $this->user_id);
					        		$toRedirect = 'proposed_workshop';
					        	}else{
					        		$error = urlencode("La hora de fin debe ser mayor a la hora de inicio");
					        		$toRedirect = 'proposed_workshop/create_second_step?message='.$error;
					        	}
					        }else{
					        	$error = urlencode("Debes escoger una fecha posterior");
					        	$toRedirect = 'proposed_workshop/create_second_step?message='.$error;
					        }
					        redirect($toRedirect, 'refresh');

					}else{
						$error = urlencode("Ingresa un formato de hora adecuado");
						$toRedirect = 'proposed_workshop/create_second_step?message='.$error;
					}
		}else{
			$error = urlencode("Campos obligatorios vacios");
        	$toRedirect = 'proposed_workshop/create_second_step?message='.$error;
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


	public function show_my_requests(){
		$rp = 2;
		$q = (isset($_GET['q']))? preg_replace('([^A-Za-záéíó ])', '', $_GET['q']):'';
		$page = (isset($_GET['page']))? $_GET['page']:'1';
		$request_list = $this->proposed_workshop_model->search_request_list_by_title($this->user_id,$page,$q,$rp);
		$num_pages = $this->proposed_workshop_model->get_request_list_total_search($this->user_id,$q,$rp);
		$dataView=[
			'page'=>'proposed_workshops/my_requests',
			'request_list'=>$request_list,
			'q'=>$q,
			'pagination'=>$page,
			'num_pages'=>$num_pages,
		];
		$this->load->view('template/basic',$dataView);
	}

    public function send_email($email,$pw_title){
      $this->load->library("email");

      $config_email = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'conocimientocolectivo2018@gmail.com',
        'smtp_pass' => 'lifeline44',
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'newline' => "\r\n"
      );

      $this->email->initialize($config_email);

      $this->email->from('conocimientocolectivo2018@gmail.com');
      $this->email->to($email);
      $this->email->subject('Apertura de Solicitud de Taller');

      $dataView=[
      	'pw_title'=>$pw_title
      ];

      $html = $this->load->view('proposed_workshops/email',$dataView, TRUE);

      $this->email->message($html);
    
      //$this->email->message("Se le informa que el taller " .$pw_title. " que usted solicito, se ha aperturado");

      if($this->email->send()){
      	return TRUE;
      }
    }

	public function open_request($pw_id = null){
		$pw_data = $this->proposed_workshop_model->get_proposed_workshop_data($pw_id);

		if ($pw_data){

		        $proposed_workshop_date = new Datetime($pw_data['start_date']);

				if($pw_data['pw_user_id'] != $this->user_id && $proposed_workshop_date > $this->today){
					$dataView=[
						'page'=>'proposed_workshops/open_request',
						'abc'=>$pw_data
					];
				}else{
					$dataView=[
					'page'=>'error',
					];
				}

		}else{
			$dataView=[
				'page'=>'error',
			];
		}
		$this->load->view('template/basic',$dataView);
	}

	public function insert_to_workshop($id = null){
		//var_dump($_POST);
		if ($id === null) {
			$dataView=[
				'page'=>'error',
			];
			$this->load->view('template/basic',$dataView);exit();
		}
		$pw_data = $this->proposed_workshop_model->get_proposed_workshop_data($id);
		$email = $this->proposed_workshop_model->get_pw_creator_email($pw_data['pw_user_id']);
		//var_dump($pw_data);exit();
		//var_dump($email['email']);exit();
		//if(){
		//Todo se enviará por POST
			$this->proposed_workshop_model->open_workshop_request($_POST, $this->user_id);
			$this->proposed_workshop_model->remove_from_list($id);
			$this->proposed_workshop_model->change_status($id);
			$this->send_email($email['email'],$pw_data['pw_title']);
			redirect('workshop','refresh');
		//}
	}

	public function vote($pw_id = null){
		$proposed_workshop_description = $this->proposed_workshop_model->show_by_id($pw_id);
		//var_dump($proposed_workshop_description);exit();

        $proposed_workshop_date = new Datetime($proposed_workshop_description['start_date']);

		$verify_votes = $this->proposed_workshop_model->get_votes_quantity($pw_id);
		$verify_user_vote = $this->proposed_workshop_model->verify_user_vote($pw_id, $this->user_id);
	
		if($verify_user_vote){
			$error = urlencode("Ya votaste por este taller");
			$toRedirect = 'proposed_workshop/description/'.$pw_id.'?message='.$error;
		}else if($proposed_workshop_date < $this->today){
			$error = urlencode("La fecha de inicio culminó");
			$toRedirect = 'proposed_workshop/description/'.$pw_id.'?message='.$error;
		}else{
			if($verify_votes['votes_quantity'] < 10){
				$this->proposed_workshop_model->insert_into_votes($pw_id, $this->user_id);
				$verify_votes['votes_quantity'] = $verify_votes['votes_quantity'] + 1;
				$this->proposed_workshop_model->update_votes_quantity($pw_id, $verify_votes['votes_quantity']);
				$toRedirect = 'proposed_workshop/description/'.$pw_id;
			}else{
				$error = urlencode("Alcanzó el maximo de votos");
				$toRedirect = 'proposed_workshop/description/'.$pw_id.'?message='.$error;
			}
		}
		redirect($toRedirect, 'refresh');
	}

}