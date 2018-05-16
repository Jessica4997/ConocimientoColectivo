<?php
class Admin_model extends CI_Model {

  public function show_all_users(){
 
        $sql = "SELECT
                id,
                name,
                last_name,
                email,
                cell_phone,
                phone,
                DATE_FORMAT(date_birth,'%d-%m-%Y') AS date_birth,
                description,
                gender,
                removed
              FROM
                users";

        $query = $this->db->query($sql);
        
        return $query->result_array();
  }

    public function show_specific_user($user_id){
 
        $sql = "SELECT
                id,
                name,
                last_name,
                email,
                cell_phone,
                phone,
                DATE_FORMAT(date_birth,'%d-%m-%Y') AS date_birth,
                description,
                gender,
                status,
                removed
              FROM
                users
                WHERE id = ?
                LIMIT 1";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->row_array();
  }

    public function update_users_profiles($dataform, $user_id){
        $data = array(
            'name' => $dataform['nombres'],
            'last_name' => $dataform['apellidos'],
            'password' => $dataform['contrasena'],
            'cell_phone' => $dataform['celular'],
            'phone' => $dataform['telefono'],
            'date_birth' => $dataform['fecha_nacimiento'],
            'description' => $dataform['descripcion'],
            'status' => $dataform['estado'],
            'gender' => $dataform['genero'],
            'removed' => 'Activo'
        );

        $this->db->update('users', $data, array('id' => $user_id));
    }

    public function delete_users($user_id){
        $data = array(
            'removed' => 'Eliminado'
        );

        return $this->db->update('users', $data, array('id' => $user_id));
    }


    public function get_categories_list(){
        $sql = "SELECT 
                   id,
                   name

              FROM
                categories;";

                $query = $this->db->query($sql);
                
                return $query->result_array();
    }

    public function get_subcategories_list($category_id){
        $sql = "SELECT 
                  id,
                  sub_name,
                  categories_id,
                  removed
                FROM
                  subcategories 
                WHERE categories_id = ? ;";

          $query = $this->db->query($sql,array($category_id));
          
          return $query->result_array();
    }


  public function create_subcategory($dataform, $category_id){
    $data = array(
        'sub_name' => $dataform['subcategory_name'],
        'categories_id' => $category_id,
        'removed' => 'Activo'
    );

    $this->db->insert('subcategories', $data);

  }


  public function get_specific_subcategory($subcategory_id){

            $sql = "SELECT
                id,
                sub_name,
                removed
              FROM
                subcategories
                WHERE id = ?
                LIMIT 1";

      $query = $this->db->query($sql,array($subcategory_id));
      
      return $query->row_array();
  }

  public function update_subcategory($dataform, $subcategory_id){
    $data = array(
      'sub_name' => $dataform['subcategory_name']
        );

        $this->db->update('subcategories', $data, array('id' => $subcategory_id));
    }

  public function delete_subcategory($subcategory_id){
    $data = array(
      'removed' => 'Eliminado'
        );

        $this->db->update('subcategories', $data, array('id' => $subcategory_id));
    }

  public function cancel_delete_subcategory($subcategory_id){
    $data = array(
      'removed' => 'Activo'
        );

        $this->db->update('subcategories', $data, array('id' => $subcategory_id));
    }


}
