<?php
class User_model extends CI_Model {


  public function createuser($dataform){
    $data = array(
        'email' => $dataform['correo'],
        'password' => $dataform['contrasena'],
        'name' => $dataform['nombres'],
        'last_name' => $dataform['apellidos'],
        'cell_phone' => $dataform['celular'],
        'phone' => $dataform['telefono'],
        'gender' => $dataform['genero'],
        'date_birth' => $dataform['fecha_nacimiento'],
        'description' => $dataform['descripcion'],
        'status' => 'Confirmado'
    );

    $this->db->insert('users', $data);

  }

  public function check_user_login($u,$p){

    $this->db->select('id,name,last_name,description');
    $this->db->from('users');
    $this->db->where('email',$u);
    $this->db->where('password',$p);

    $query = $this->db->get();
    if ($query->num_rows() == 1) {
        $q = $query->row();

        $session_user = array(
            's_iduser' => $q ->id,
            's_username' => $q ->name.", ".$q->last_name
        );

        $this->session->set_userdata('$session_user');
        return 1;

    }else{
        return 0;
    }
    


  }


 }
