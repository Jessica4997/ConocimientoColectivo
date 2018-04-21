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
}