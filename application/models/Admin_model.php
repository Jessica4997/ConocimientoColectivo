<?php
class Admin_model extends CI_Model {

//USERS

  public function get_sql_users($q){
        $sql = "SELECT
                id,
                name,
                last_name,
                email,
                cell_phone,
                DATE_FORMAT(date_birth,'%d-%m-%Y') AS date_birth,
                description,
                gender,
                removed
              FROM
                users";

        if(trim($q)!=''){
          $q = trim($q);
          $sql.=" WHERE name LIKE '%{$q}%' ";
        }
        return $sql;
  }

  public function search_users_by_name($q,$page,$rp){
    $offset = (($page-1)*$rp);
    $sql = $this->get_sql_users($q);
    $sql.= " LIMIT {$rp} OFFSET {$offset}";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function get_rows_number($q,$page,$rp){
    $sql = $this->get_sql_users($q);
    $query = $this->db->query($sql);
    $row_number = $query->num_rows();
    return ceil($row_number/$rp);
    //var_dump($sql);exit();
  }

    public function show_specific_user($user_id){
        $sql = "SELECT
                id,
                name,
                last_name,
                email,
                password,
                cell_phone,
                DATE_FORMAT(date_birth,'%d-%m-%Y') AS date_birth,
                description,
                gender,
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
            'cell_phone' => $dataform['celular'],
            'date_birth' => $dataform['fecha_nacimiento'],
            'description' => $dataform['descripcion'],
            'gender' => $dataform['genero'],
            'removed' => 'Activo'
        );

        $this->db->update('users', $data, array('id' => $user_id));
    }

    public function update_users_password($dataform, $user_id){
        $data = array(
            'password' => $dataform['contrasena']
        );

        $this->db->update('users', $data, array('id' => $user_id));
    }

    public function delete_users($user_id){
        $data = array(
            'removed' => 'Eliminado'
        );

        return $this->db->update('users', $data, array('id' => $user_id));
    }

//CATEGORIES

    public function get_categories_list(){
        $sql = "SELECT 
                   id,
                   name
              FROM
                categories;";

                $query = $this->db->query($sql);
                
                return $query->result_array();
    }

    public function get_sql_categories($q){
      $sql = "SELECT
                id,
                name,
                removed
              FROM
                categories";

        if(trim($q)!=''){
          $q = trim($q);
          $sql.=" WHERE name LIKE '%{$q}%' ";
        }
        return $sql;
    }

    public function search_categories_by_name($q,$page,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_categories($q);
      $sql.= " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql);

      return $query->result_array();
    }

    public function get_rows_number_categories($q,$page,$rp){
      $sql = $this->get_sql_categories($q);
      $query = $this->db->query($sql);
      $row_number = $query->num_rows();
      return ceil($row_number/$rp);
      //var_dump($sql);exit();
    }

    public function get_specific_category($category_id){
        $sql = "SELECT 
                   id,
                   name,
                   removed
              FROM
                categories
                WHERE id = ? ;";

        $query = $this->db->query($sql,array($category_id));

        return $query->row_array();
    }

    public function update_category($dataform, $category_id){
      $data = array(
      'name' => $dataform['category_name']
        );

        $this->db->update('categories', $data, array('id' => $category_id));
    }

    public function create_category($dataform){
      $data = array(
        'name' => $dataform['subcategory_name'],
        'removed' => 'Activo'
    );
      $this->db->insert('categories', $data);
    }

    public function delete_category($category_id){
      $data = array(
        'removed' => 'Eliminado'
      );
      $this->db->update('categories', $data, array('id' => $category_id));
    }

    public function cancel_delete_category($category_id){
      $data = array(
        'removed' => 'Activo'
      );
      $this->db->update('categories', $data, array('id' => $category_id));
    }

    public function check_subcategory_exist($category_id){
            $sql = "SELECT
            sc.id AS sc_id,
            sc.sub_name AS sc_name,
            c.id AS c_id,
            c.name AS c_name
              FROM
                subcategories AS sc 
                INNER JOIN categories AS c 
                  ON sc.categories_id = c.id
                  WHERE c.id = ?";

      $query = $this->db->query($sql,array($category_id));
      
      return $query->result_array();
    }


//SUBCATEGORIES

    public function get_subcategories_list_no_filter(){
        $sql = "SELECT 
                  id,
                  sub_name,
                  categories_id,
                  removed
                FROM
                  subcategories ;";

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

    public function get_sql_subcategories($category_id,$q){
      $sql = "SELECT
                id,
                sub_name,
                categories_id,
                removed
              FROM
                subcategories
                WHERE categories_id = $category_id
                ";
                //var_dump($category_id);exit();

        if(trim($q)!=''){
          $q = trim($q);
          $sql.=" AND sub_name LIKE '%{$q}%' ";
        }
        return $sql;
    }

    public function search_subcategories_by_name($category_id,$q,$page,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_subcategories($category_id,$q);
      $sql.= " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql,array($category_id));

      return $query->result_array();
    }

    public function get_rows_number_subcategories($category_id,$q,$page,$rp){
      $sql = $this->get_sql_subcategories($category_id,$q);
      $query = $this->db->query($sql);
      $row_number = $query->num_rows();
      return ceil($row_number/$rp);
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
                removed,
                categories_id
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

    public function search_subcategory_by_name($category_id, $q){
      $this->db->select('id,sub_name,categories_id,removed');
      $this->db->from('subcategories');
      $this->db->where('categories_id',$category_id);

      if(is_string($q) && trim($q)!=''){
        $q = trim($q);
        //$this->db->where("sub_name LIKE '%{$q}%' ",$q);
        $this->db->where('sub_name LIKE ', "%{$q}%");
      }

    $query = $this->db->get();
        
    return $query->result_array(); 
  }

//PROPOSED_WORKSHOPS

    public function get_sql_pw_list($category,$q){
          $sql = "SELECT 
              pw.id AS pw_id,
              pw.title,
              pw.description,
              DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
              pw.removed,
              pw.start_time,
              pw.end_time,
              c.id,
              c.name,
              sc.sub_name,
              pw.user_id AS u_id,
              u.name AS u_name,
              u.last_name AS u_last_name,
              l.id AS level_id,
              l.level AS level_name
            FROM
              proposed_workshops AS pw 
              INNER JOIN categories AS c 
                ON pw.`category_id` = c.`id`
                INNER JOIN subcategories AS sc
                ON pw.`subcategory_id` = sc.`id`
                    INNER JOIN users AS u
                    ON pw.user_id = u.id
                      INNER JOIN level AS l
                      ON pw.level_id = l.id ";

      if(is_array($category) && count($category)>0){
        $cat_id = implode(",",$category);
        $sql.="AND c.id IN ({$cat_id}) ";
      }

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND pw.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY pw.id ";

      return $sql;
    }

    public function search_pw_by_category_title($page,$category,$q,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_pw_list($category,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
  
    public function get_pw_total_search($category,$q,$rp){
      $sql = $this->get_sql_pw_list($category,$q);
      $query = $this->db->query($sql);
      $total = $query->num_rows();
      return ceil($total/$rp);
    }


    public function show_by_id($id){
 
        $sql = "SELECT
                  pw.id,
                  pw.title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
                  pw.start_time,
                  pw.end_time,
                  pw.votes_quantity,
                  pw.removed AS pw_removed,
                  pw.user_id AS pw_user_id,
                  pw.pw_status,
                  c.id AS category_id,
                  c.name AS category_name,
                  sc.sub_name AS subcategory_name,
                  u.name AS user_name,
                  u.last_name AS user_last_name,
                  l.id AS level_id,
                  l.level AS level_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                            INNER JOIN users AS u
                              ON u.id = pw.user_id
                                INNER JOIN level AS l
                                ON pw.level_id = l.id
                        WHERE pw.`id` = ?
                        LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

    public function update_pw_description($dataform, $id){
      $data = array(
          'title' => $dataform['titulo'],
          'category_id' => $dataform['categoria'],
          'subcategory_id' => $dataform['sub_categoria'],
          'level_id' => $dataform['nivel'],
          'start_date' => $dataform['fecha_inicio'],
          'start_time' => $dataform['hora_inicio'],
          'end_time' => $dataform['hora_fin'],
          'description' => $dataform['descripcion']
      );

      $this->db->update('proposed_workshops', $data, array('id' => $id));
  }

    public function delete_pw($id){
    $data = array(
      'removed' => 'Eliminado'
        );

        $this->db->update('proposed_workshops', $data, array('id' => $id));
    }


  public function cancel_delete_pw($id){
    $data = array(
      'removed' => 'Activo'
        );

        $this->db->update('proposed_workshops', $data, array('id' => $id));
    }

//WORKSHOPS

    public function get_sql_w_list($category,$q){
          $sql = "SELECT 
              w.id AS w_id,
              w.title,
              w.description,
              DATE_FORMAT(w.start_date,'%d-%m-%Y') AS start_date,
              w.start_time,
              w.end_time,
              w.amount,
              w.removed,
              w.user_id as w_user_id,
              c.id,
              c.name,
              sc.sub_name,
              u.name AS w_user_name,
              u.last_name AS w_user_lastname,
              l.id AS level_id,
              l.level AS level_name
            FROM
              workshops AS w 
              INNER JOIN categories AS c 
                ON w.`category_id` = c.`id`
                INNER JOIN subcategories AS sc
                ON w.`subcategory_id` = sc.`id`
                  INNER JOIN users AS u
                  ON w.user_id = u.id
                    INNER JOIN level AS l
                    ON w.level_id = l.id
                 ";

      if(is_array($category) && count($category)>0){
        $cat_id = implode(",",$category);
        $sql.="AND c.id IN ({$cat_id}) ";
      }

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }

  public function search_w_by_category_title($page,$category,$q,$rp){
    $offset = (($page-1)*$rp);
    $sql = $this->get_sql_w_list($category,$q);
    $sql.=  " LIMIT {$rp} OFFSET {$offset}";
    $query = $this->db->query($sql);
    return $query->result_array();
  }
  
  public function get_w_total_search($category,$q,$rp){
    $sql = $this->get_sql_w_list($category,$q);
    $query = $this->db->query($sql);
    $total = $query->num_rows();
    return ceil($total/$rp);
  }



    public function show_w_by_id($id){
 
        $sql = "SELECT
                  w.id,
                  w.title,
                  w.description,
                  DATE_FORMAT(w.start_date,'%d-%m-%Y') AS start_date,
                  w.start_time,
                  w.end_time,
                  w.vacancy,
                  w.amount,
                  w.removed AS w_removed,
                  w.user_id AS w_user_id,
                  c.id AS category_id,
                  c.name AS category_name,
                  sc.sub_name AS subcategory_name,
                  u.name AS user_name,
                  u.last_name AS user_last_name,
                  l.id AS level_id,
                  l.level AS level_name
                FROM
                    workshops AS w
                    INNER JOIN categories AS c
                      ON w.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON w.subcategory_id = sc.id
                            INNER JOIN users AS u
                              ON u.id = w.user_id
                                INNER JOIN level AS l
                                ON w.level_id = l.id
                        WHERE w.`id` = ?
                        LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }


    public function update_w_description($dataform, $id){
      $data = array(
          'title' => $dataform['titulo'],
          'category_id' => $dataform['categoria'],
          'subcategory_id' => $dataform['subcategoria'],
          'level_id' => $dataform['nivel'],
          'start_date' => $dataform['fecha_inicio'],
          'start_time' => $dataform['hora_inicio'],
          'start_time' => $dataform['hora_fin'],
          'description' => $dataform['descripcion']
      );

      $this->db->update('workshops', $data, array('id' => $id));
  }

  public function delete_w($id){
    $data = array(
      'removed' => 'Eliminado'
        );

        $this->db->update('workshops', $data, array('id' => $id));
    }


  public function cancel_delete_w($id){
    $data = array(
      'removed' => 'Activo'
        );

        $this->db->update('workshops', $data, array('id' => $id));
    }


//LEVEL

  public function level_list(){
    $sql = "SELECT 
           id,
           level,
           dificult

          FROM
          level;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

}
