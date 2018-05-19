<?php
class User_model extends CI_Model {

  public function createuser($dataform){
    $comprobarc = $dataform['contrasena'];
    $comprobar = $dataform['recontrasena'];
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
        'removed' => 'Activo'
    );

    if ($dataform['contrasena'] === $dataform['recontrasena']) {
        $this->db->insert('users', $data);
    }else{
        return "error";
    }

  }

  public function check_user_login($u,$p){

    $this->db->select('id,name,last_name');
    $this->db->from('users');
    $this->db->where('removed','Activo');
    $this->db->where('email',$u);
    $this->db->where('password',$p);

    $query = $this->db->get();
    if ($query->num_rows() == 1) {
        $q = $query->row();
        return array(
            's_iduser' => $q->id,
            //'s_username' => $q->name.", ".$q->last_name
        );
    }else{
        return false;
    }
    
  }

  public function show_profile_by_id($user_id){
 
        $sql = "SELECT
                u.id,
                u.name,
                u.last_name,
                u.email,
                u.cell_phone,
                u.phone,
                DATE_FORMAT(u.date_birth,'%d-%m-%Y') AS date_birth,
                u.description,
                u.gender
              FROM
                users AS u
                    WHERE u.`id` = ?
                    LIMIT 1";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->row_array();
  }

    public function update_user_profile($dataform){
        $data = array(
            //'password' => $dataform['contrasena'],
            'name' => $dataform['nombres'],
            'last_name' => $dataform['apellidos'],
            'cell_phone' => $dataform['celular'],
            'phone' => $dataform['telefono'],
            'date_birth' => $dataform['fecha_nacimiento'],
            'description' => $dataform['descripcion']
        );

        $this->db->update('users', $data, array('id' => $this->session->userdata('s_iduser')));
    }
}
