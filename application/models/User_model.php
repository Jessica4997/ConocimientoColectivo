<?php
class User_model extends CI_Model {

  public function createuser($dataform){
    $date = new DateTime($dataform['fecha_nacimiento']);
    $dateformat = $date->format('Y-m-d');
    $data = array(
        'email' => $dataform['correo'],
        'password' => $dataform['contrasena'],
        'name' => $dataform['nombres'],
        'last_name' => $dataform['apellidos'],
        'cell_phone' => $dataform['celular'],
        'gender' => $dataform['genero'],
        'date_birth' => $dateformat,
        'description' => $dataform['descripcion'],
        'removed' => 'Activo'
    );
    $this->db->insert('users', $data);
  }

  public function check_user_login($u,$p){

    $this->db->select('id,name,last_name,role');
    $this->db->from('users');
    $this->db->where('removed','Activo');
    $this->db->where('email',$u);
    $this->db->where('password',$p);

    $query = $this->db->get();
    if ($query->num_rows() == 1) {
        $q = $query->row();
        return array(
            's_iduser' => $q->id,
            's_username' => $q->name.", ".$q->last_name,
            's_urole' => $q->role
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
                DATE_FORMAT(u.date_birth,'%d-%m-%Y') AS date_birth,
                u.description,
                u.gender,
                u.student_rating,
                u.tutor_rating
              FROM
                users AS u
                    WHERE u.`id` = ?
                    LIMIT 1";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->row_array();
  }

  public function update_user_profile($dataform){
    $date = new DateTime($dataform['fecha_nacimiento']);
    $dateformat = $date->format('Y-m-d');

        $data = array(
            //'password' => $dataform['contrasena'],
            'name' => $dataform['nombres'],
            'last_name' => $dataform['apellidos'],
            'cell_phone' => $dataform['celular'],
            'date_birth' => $dateformat,
            'description' => $dataform['descripcion']
        );
        $this->db->update('users', $data, array('id' => $this->session->userdata('s_iduser')));
  }

  public function change_user_password($dataform){
        $data = array(
            'password' => $dataform['contrasena']
        );
        $this->db->update('users', $data, array('id' => $this->session->userdata('s_iduser')));
  }

    public function find_user_by_email($email){
        $sql = "SELECT
                id,
                name,
                last_name,
                email
              FROM
                users
                    WHERE email = ?
                    LIMIT 1";

      $query = $this->db->query($sql,array($email));
      
      return $query->row_array();
    }


    public function insert_to_token($email,$token){
        $userdata = $this->user_model->find_user_by_email($email);
        $data = array(
            'user_id' => $userdata['id'],
            'token' => $token
    );
        $this->db->insert('token', $data);
    }


    public function find_user_by_token($token){
        $sql = "SELECT
                id,
                token,
                user_id
              FROM
                token
                    WHERE token = ?
                    LIMIT 1";

        $query = $this->db->query($sql,array($token));

        return $query->row_array();
    }

    public function update_user_password($dataform){
        //var_dump($dataform);exit();
        $data = array(
            'password' => $dataform['contrasena']
        );
        $this->db->update('users', $data, array('id' => $dataform['idusuario']));
    }

    public function delete_token($id){
        $this->db->delete('token', array('id' => $id));
    }


    public function get_total_workshops_by_user($user_id){
        $sql = "SELECT
                id,
                title,
                user_id
              FROM
                workshops
                WHERE user_id = ?
                AND removed = 'Activo'
                    ";

        $query = $this->db->query($sql,array($user_id));

        return $query->num_rows();
    }

    public function get_total_proposed_workshops_by_user($user_id){
        $sql = "SELECT
                id,
                title,
                user_id
              FROM
                proposed_workshops
                WHERE user_id = ?
                AND removed = 'Activo'
                    ";

        $query = $this->db->query($sql,array($user_id));

        return $query->num_rows();
    }

    public function get_total_inscriptions_by_user($user_id){
        $sql = "SELECT
                id
              FROM
                inscribed_users
                WHERE user_id = ?
                AND iu_status = 'Confirmado'
                    ";

        $query = $this->db->query($sql,array($user_id));

        return $query->num_rows();
    }

    public function get_profile_photo_name($user_id){
        $sql = "SELECT
                name
              FROM
                profile_photo
                WHERE user_id = ?
                ORDER BY id DESC
                    ";

        $query = $this->db->query($sql,array($user_id));

        return $query->row_array();
    }


    public function insert_to_profile_photo($user_id, $name){
        $data = array(
            'user_id' => $user_id,
            'name' => $name
    );
        $this->db->insert('profile_photo', $data);
    }
}
