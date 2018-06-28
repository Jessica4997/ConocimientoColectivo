<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Page extends CI_Controller {

	private $user_id = '0';
    public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('created_workshops_model');
		$this->load->model('my_workshops_model');
		$this->user_id = $this->session->userdata('s_iduser');
        if ($this->user_id === null){
            redirect('login', 'refresh');
        }

        $this->output->set_header('X-XSS-Protection: 1; mode=block');
	}

	public function index(){
		$data_profile= $this->user_model->show_profile_by_id($this->user_id);
		$this->created_workshops_model->get_student_final_rating($this->user_id);
		$this->created_workshops_model->insert_final_rating_to_users($this->user_id);

		$this->my_workshops_model->get_teacher_final_rating($this->user_id);
		$this->my_workshops_model->insert_final_tutor_rating_to_users($this->user_id);

		$total_workshops = $this->user_model->get_total_workshops_by_user($this->user_id);
		$total_proposed_workshops = $this->user_model->get_total_proposed_workshops_by_user($this->user_id);
		$total_inscriptions = $this->user_model->get_total_inscriptions_by_user($this->user_id);
		$dataView=[
			'page'=>'users/profile',
			'user_data'=>$data_profile,
			'total_workshops'=>$total_workshops,
			'total_proposed_workshops'=>$total_proposed_workshops,
			'total_inscriptions'=>$total_inscriptions
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_profile(){
		$data_u = $this->user_model->show_profile_by_id($this->user_id);
		$error = $this->input->get('message');
		$dataView=[
			'page'=>'users/edit',
			'user_d'=>$data_u,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function show_edit_password(){
		$data_u = $this->user_model->show_profile_by_id($this->user_id);
		$error = $this->input->get('message');
		$dataView=[
			'page'=>'users/edit_password',
			'user_d'=>$data_u,
			'error'=>$error
		];
		$this->load->view('template/basic',$dataView);
	}

	public function save_edit_profile_data(){
		//var_dump($_POST);exit();
		if (!empty($_POST['nombres']) || trim($_POST['nombres']) != '' || !empty($_POST['apellidos']) || trim($_POST['apellidos']) != '' || trim($_POST['descripcion']) != '') {
			$this->user_model->update_user_profile($_POST);
			$toRedirect = 'profile_page';
		}else{
			$error = urlencode("Campos vacíos");
			$toRedirect = 'profile_page/show_edit_profile?message='.$error;
		}
		redirect($toRedirect, 'refresh');

	}

	public function save_edit_password_data(){
		if($_POST['contrasena'] === $_POST['recontrasena']){
			$this->user_model->change_user_password($_POST);
			$toRedirect = 'profile_page';
		}else{
			$error = urlencode("Las contraseñas no coinciden");
			$toRedirect = 'profile_page/show_edit_password?message='.$error;
		}
		redirect($toRedirect, 'refresh');
	}

	public function upload_profile_photo(){

		$uploadedfileload="true";
		$uploadedfile_size=$_FILES['profile_photo']['size'];
		echo $_FILES['profile_photo']['name'];
		if ($_FILES['profile_photo']['size']>200000){
			echo "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
			$uploadedfileload="false";
		}

		if (!($_FILES['profile_photo']['type'] =="image/jpeg" OR $_FILES['profile_photo']['type'] =="image/gif")){
			echo " Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
			$uploadedfileload="false";
		}

		$file_name=$_FILES['profile_photo']['name'];
		$add="uploads/$file_name";
		if($uploadedfileload=="true"){
			if(move_uploaded_file ($_FILES['profile_photo']['tmp_name'], $add)){
				echo " Ha sido subido satisfactoriamente";
			}else{
				echo "Error al subir el archivo";
			}
		}else{
			echo "NO SE";
		}
	}
}