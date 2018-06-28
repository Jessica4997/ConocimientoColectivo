<?php
class Admin_model extends CI_Model {

//USERS

  public function check_admin($user_id){
          $sql = "SELECT
              id,
              name,
              last_name,
              email,
              removed,
              role
            FROM
              users
              WHERE id = ?
              LIMIT 1";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->row_array();
  }

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
      $date = new DateTime($dataform['fecha_nacimiento']);
      $dateformat = $date->format('Y-m-d');

        $data = array(
            'name' => $dataform['nombres'],
            'last_name' => $dataform['apellidos'],
            'cell_phone' => $dataform['celular'],
            'date_birth' => $dateformat,
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
          'removed' => 'Activo',
          'role'=>$dataform['rol']
      );
      $this->db->insert('users', $data);
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
//CATEGORIES

    public function get_categories_list(){
        $sql = "SELECT 
                   id,
                   name
              FROM
                categories
                WHERE removed ='Activo'; 
                ";

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
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }

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
        'name' => $dataform['category_name'],
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
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }

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
        $list_cat=array();
        foreach ($category as $row){
          if(is_numeric($row)){
            $list_cat[]=$row;
          }
        }
        if(count($list_cat)>0){
          $cat_id = implode(",",$category);
          $sql.="AND c.id IN ({$cat_id}) ";
        }
      }
      

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND pw.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY pw.id ";

      return $sql;
    }

    public function search_pw_by_category_title($page,$category,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }

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
      $date = new DateTime($dataform['fecha_inicio']);
      $dateformat = $date->format('Y-m-d');

      $data = array(
          'title' => $dataform['titulo'],
          'category_id' => $dataform['categoria'],
          'subcategory_id' => $dataform['sub_categoria'],
          'level_id' => $dataform['nivel'],
          'start_date' => $dateformat,
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
        $list_cat=array();
        foreach ($category as $row){
          if(is_numeric($row)){
            $list_cat[]=$row;
          }
        }
        if(count($list_cat)>0){
          $cat_id = implode(",",$category);
          $sql.="AND c.id IN ({$cat_id}) ";
        }
      }

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }

  public function search_w_by_category_title($page,$category,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }


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
      $date = new DateTime($dataform['fecha_inicio']);
      $dateformat = $date->format('Y-m-d');

      $data = array(
          'title' => $dataform['titulo'],
          'category_id' => $dataform['categoria'],
          'subcategory_id' => $dataform['subcategoria'],
          'level_id' => $dataform['nivel'],
          'start_date' => $dateformat,
          'start_time' => $dataform['hora_inicio'],
          'end_time' => $dataform['hora_fin'],
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


//RATINGS

  public function get_student_list($iu_w_id){
    $sql = "SELECT
              iu.id AS iu_id,
              iu.iu_status,
              iu.student_rating AS iu_student_rating,
              iu.tutor_rating AS iu_tutor_rating,
              iu.user_id AS iu_user_id,
              iu.wrks_id AS iu_w_id,
              u.name,
              u.last_name,
              u.student_rating
            FROM
                inscribed_users AS iu
                INNER JOIN users AS u
                ON iu.user_id = u.id
                  WHERE iu.wrks_id = ? ";

        $query = $this->db->query($sql,array($iu_w_id));
        
        return $query->result_array();
  }


  public function get_teacher($w_id){
    $sql = "SELECT
              w.user_id,
              u.name,
              u.last_name,
              u.tutor_rating
            FROM
                workshops AS w
                INNER JOIN users AS u
                ON w.user_id = u.id
                  WHERE w.id = ? ";

        $query = $this->db->query($sql,array($w_id));
        
        return $query->row_array();
  }


  public function get_iu_id($iu_w_id,$user_id){
    $sql = "SELECT
              iu.id AS iu_id,
              iu.iu_status,
              iu.user_id AS iu_user_id,
              iu.wrks_id AS iu_w_id,
              iu.student_rating AS iu_student_rating,
              iu.tutor_rating AS iu_tutor_rating
            FROM
                inscribed_users AS iu
                INNER JOIN users AS u
                ON iu.user_id = u.id
                  WHERE iu.wrks_id = ?
                  AND iu.user_id = ? ";

        $query = $this->db->query($sql,array($iu_w_id,$user_id));
        
        return $query->row_array();
  }

  public function update_student_rating($dataform,$iu_id){
    $data = array(
      'student_rating' => $dataform['puntaje_alumno']
        );
        $this->db->update('inscribed_users', $data, array('id' => $iu_id));
    }

  public function delete_student_rating($iu_id){
    $data = array(
      'student_rating' => NULL
        );
        $this->db->update('inscribed_users', $data, array('id' => $iu_id));
    }


    public function get_student_final_rating($user_id){
      $sql = "SELECT
        ROUND(SUM(student_rating) / COUNT(*),1) AS student_final_note 
        FROM inscribed_users
          WHERE user_id = ?
          AND student_rating is not null 
          GROUP BY user_id
          HAVING COUNT(*) >= 2
          ";

      $query = $this->db->query($sql,array($user_id));

      $rs = $query->row_array();

      if(is_null($rs)){
        $num =0;
      }else{
        $num = $rs['student_final_note'];
      }
      return $num;
    }

    public function insert_final_rating_to_users($user_id){
      $final_rating = $this->get_student_final_rating($user_id);
      $data=array(
        'student_rating'=> $final_rating
      );
      return $this->db->update('users', $data, array('id' => $user_id));

    }

  public function get_user_by_iu_id($iu_id){
    $sql = "SELECT
              iu.id AS iu_id,
              iu.iu_status,
              iu.user_id AS iu_user_id,
              iu.wrks_id AS iu_w_id,
              iu.student_rating AS iu_student_rating
            FROM
                inscribed_users AS iu
                INNER JOIN users AS u
                ON iu.user_id = u.id
                  WHERE iu.id = ? ";

        $query = $this->db->query($sql,array($iu_id));
        
        return $query->row_array();
  }





  public function update_teacher_rating($dataform,$iu_id){
    $data = array(
      'tutor_rating' => $dataform['puntaje_docente']
        );
        $this->db->update('inscribed_users', $data, array('id' => $iu_id));
    }

  public function delete_teacher_rating($iu_id){
    $data = array(
      'student_rating' => NULL
        );
        $this->db->update('inscribed_users', $data, array('id' => $iu_id));
    }


    public function get_teacher_final_rating($w_user_id){
      $sql = "SELECT
        ROUND(SUM(iu.tutor_rating) / COUNT(*),1) AS teacher_final_note 
        FROM inscribed_users AS iu
        INNER JOIN workshops AS w
        ON iu.wrks_id = w.id
          WHERE w.user_id = ?
          AND iu.tutor_rating is not null 
          GROUP BY w.user_id
          HAVING COUNT(*) >= 2
          ";

      $query = $this->db->query($sql,array($w_user_id));

      $rs = $query->row_array();

      if(is_null($rs)){
        $num =0;
      }else{
        $num = $rs['teacher_final_note'];
      }
      return $num;
    }

    public function insert_final_teacher_rating_to_users($user_id){
      $final_teacher_rating = $this->get_teacher_final_rating($user_id);
      $data=array(
        'tutor_rating'=> $final_teacher_rating
      );
      return $this->db->update('users', $data, array('id' => $user_id));
    }


    public function get_user_id_by_iu_w_id($w_id){
      $sql = "SELECT
                w.id,
                w.user_id AS w_user_id
              FROM
                  workshops AS w
                  INNER JOIN users AS u
                  ON w.user_id = u.id
                    WHERE w.id = ? ";

          $query = $this->db->query($sql,array($w_id));
          
          return $query->row_array();
    }

//PROPOSED_SUBCATEGORIES

    public function get_psc_sql_search($category,$q){
          $sql = "SELECT 
              psc.id AS psc_id,
              psc.name AS psc_name,
              psc.description,
              psc.votes_quantity,
              c.id,
              c.name AS c_name,
              u.id,
              u.name AS u_name,
              u.last_name AS u_last_name
            FROM
              proposed_subcategories AS psc 
              INNER JOIN categories AS c 
              ON psc.category_id = c.id
                INNER JOIN users AS u
                ON psc.user_id = u.id
                   ";

      if(is_numeric($category)){
        if(is_array($category) && count($category)>0){
          $cat_id = implode(",",$category);
          $sql.="AND c.id IN ({$cat_id}) ";
        }
      }else{
        unset($category);
      }


      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND psc.name LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY psc.id ";

      return $sql;
    }

    public function search_psc_by_category_title($page,$category,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }

      $sql = $this->get_psc_sql_search($category,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
  
    public function get_psc_total_search($category,$q,$rp){
      $sql = $this->get_psc_sql_search($category,$q);
      $query = $this->db->query($sql);
      $total = $query->num_rows();
      return ceil($total/$rp);
    }

    public function proposed_subcategories_show_by_id($id){
        $sql = "SELECT
                  psc.id AS psc_id,
                  psc.name AS psc_name,
                  psc.description AS psc_description,
                  psc.votes_quantity,
                  psc.removed AS psc_removed,
                  psc.psc_status AS psc_status,
                  c.id AS c_id,
                  c.name AS category_name,
                  u.name AS user_name,
                  u.last_name AS user_last_name
                FROM
                  proposed_subcategories AS psc
                  INNER JOIN categories AS c
                  ON psc.category_id = c.id
                    INNER JOIN users AS u
                    ON psc.user_id = u.id
                WHERE psc.id = ?
                LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

    public function update_proposed_subcategories($dataform, $id){
      $data = array(
          'name' => $dataform['nombre_subcategoria'],
          'category_id' => $dataform['categoria'],
          'description' => $dataform['descripcion']
      );

      $this->db->update('proposed_subcategories', $data, array('id' => $id));
    }

    public function delete_proposed_subcategories($id){
      $data = array(
        'removed' => 'Eliminado'
      );
      $this->db->update('proposed_subcategories', $data, array('id' => $id));
    }


    public function cancel_delete_proposed_subcategories($id){
      $data = array(
        'removed' => 'Activo'
      );
      $this->db->update('proposed_subcategories', $data, array('id' => $id));
    }

    public function open_subcategory_request($id){
      $psc_data = $this->proposed_subcategories_show_by_id($id);
      $data = array(
        'sub_name' => $psc_data['psc_name'],
        'categories_id' => $psc_data['c_id'],
        'removed' => 'Activo',
        'psc_status'=> 'Aperturado'
      );
      $this->db->insert('subcategories', $data);
    }

    public function change_proposed_subcategory_status($id){
      $data = array(
        'status' => 'En Curso'
      );
      $this->db->update('proposed_subcategories', $data, array('id' => $id));
    }

//REPORTS

    public function sql_inscriptions_per_month($month){
      $sql = "SELECT
              iu.id AS iu_id,
              iu.iu_status,
              iu.user_id AS iu_user_id,
              iu.wrks_id AS iu_w_id,
              iu.created_date AS iu_created_date,
              u.name AS u_name,
              u.last_name AS u_last_name,
              w.title AS w_title,
              w.category_id,
              c.name AS c_name,
              sc.sub_name AS sc_name
            FROM
                inscribed_users AS iu
                INNER JOIN users AS u
                ON iu.user_id = u.id
                  INNER JOIN workshops AS w
                  ON iu.wrks_id = w.id
                    INNER JOIN categories AS c
                    ON w.category_id = c.id
                      INNER JOIN subcategories AS sc
                      ON w.subcategory_id = sc.id
            WHERE MONTH(iu.created_date) = $month ";
        
        return $sql;
      }

    public function inscriptions_per_month($month){
      $sql = $this->sql_inscriptions_per_month($month);
      $query = $this->db->query($sql);
      return $query->result_array();
      }

    public function number_inscriptions_per_month($month){
      $sql = $this->sql_inscriptions_per_month($month);
      $query = $this->db->query($sql);
      return $query->num_rows();
    }



    public function sql_workshops_request_per_month($month){
      $sql = "SELECT
              pw.id AS pw_id,
              pw.title,
              pw.user_id AS pw_user_id,
              pw.votes_quantity,
              pw.removed,
              pw.pw_status,
              u.name AS u_name,
              u.last_name AS u_last_name,
              c.name AS c_name,
              sc.sub_name AS sc_name
            FROM
                proposed_workshops AS pw
                INNER JOIN users AS u
                ON pw.user_id = u.id
                  INNER JOIN categories AS c
                  ON pw.category_id = c.id
                    INNER JOIN subcategories AS sc
                    ON pw.subcategory_id = sc.id
            WHERE MONTH(pw.created_date) = $month ";
        
        return $sql;
      }

    public function workshops_request_per_month($month){
      $sql = $this->sql_workshops_request_per_month($month);
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function number_workshops_request_per_month($month){
      $sql = $this->sql_workshops_request_per_month($month);
      $query = $this->db->query($sql);
      return $query->num_rows();
    }



   public function sql_subcategories_request_per_month($month){
      $sql = "SELECT
              psc.id AS psc_id,
              psc.name,
              psc.user_id AS psc_user_id,
              psc.votes_quantity,
              psc.category_id,
              psc.psc_status,
              u.name AS u_name,
              u.last_name AS u_last_name,
              c.name AS c_name
            FROM
                proposed_subcategories AS psc
                INNER JOIN users AS u
                ON psc.user_id = u.id
                  INNER JOIN categories AS c
                  ON psc.category_id = c.id
            WHERE MONTH(psc.created_date) = $month ";
        
        return $sql;
      }

    public function subcategories_request_per_month($month){
      $sql = $this->sql_subcategories_request_per_month($month);
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function number_subcategories_request_per_month($month){
      $sql = $this->sql_subcategories_request_per_month($month);
      $query = $this->db->query($sql);
      return $query->num_rows();
    }


   public function sql_user_registration_per_month($month){
      $sql = "SELECT
              u.id AS u_id,
              u.name,
              u.last_name,
              u.email,
              u.date_birth,
              u.gender,
              u.student_rating
            FROM
                users AS u
            WHERE MONTH(u.created_date) = $month ";
        
        return $sql;
      }

    public function user_registration_per_month($month){
      $sql = $this->sql_user_registration_per_month($month);
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function number_user_registration_per_month($month){
      $sql = $this->sql_user_registration_per_month($month);
      $query = $this->db->query($sql);
      return $query->num_rows();
    }

    public function most_popular_category(){
        $sql = "SELECT 
                  c.name AS c_name,
                  COUNT(iu.id) AS iu_quantity
                FROM
                  inscribed_users AS iu 
                  INNER JOIN workshops AS w 
                    ON iu.wrks_id = w.id
                    INNER JOIN categories AS c
                    ON w.category_id = c.id
                    GROUP BY w.category_id
                    ORDER BY iu_quantity DESC
                    LIMIT 3";

      $query = $this->db->query($sql,array());
      
      return $query->result_array();
  }

    public function category_draw(){
        $category_name = $this->most_popular_category();
        $name = array();
        $quantity = array();
        foreach ($category_name as $key => $value) {
          $name[] = '"'.$value['c_name'].'"';
          $quantity[] = $value['iu_quantity'];
        }

        return array(
          'name' => implode(",", $name),
          'quantity' => implode(",", $quantity),
        );

  }

    public function quantity_inscriptions_per_month(){
        $sql = "SELECT
              MONTHNAME(iu.created_date) AS month_name,
              COUNT(iu.id) AS iu_quantity
              FROM
                inscribed_users AS iu
                  GROUP BY MONTH(iu.created_date)
                  ORDER BY MONTH(iu.created_date)";

        $query = $this->db->query($sql,array());
      
        return $query->result_array();
  }

    public function incriptions_draw(){
        $category_name = $this->quantity_inscriptions_per_month();
        $quantity = array();
        foreach ($category_name as $key => $value) {
          $quantity[] = $value['iu_quantity'];
        }
        return array(
          'quantity' => implode(",", $quantity),
        );

  }


}
