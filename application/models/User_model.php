<?php
class User_model extends CI_Model {


  public function create($dataform){
    $data = array(
        'email' => $dataform['correo'],
        'password' => $dataform['contraseña'],
        //'category_id' => $dataform['sub_categoria'],
        'name' => $dataform['nombres'],
        'last_name' => $dataform['apellidos'],
        'cell_phone' => $dataform['celular'],
        'phone' => $dataform['telefono'],
        'gender' => $dataform['genero'],
        'date_birth' => $dataform['fecha_nacimiento'],
        'description' => $dataform['descripcion'],
        'user_id'=>2
    );

    $this->db->insert('users', $data);

  }
}