<?php
class Created_Workshops_model extends CI_Model {

  	public function get_sql_my_created_w_list($user_id,$q){
          $sql = "SELECT 
              w.id AS w_id,
              w.title,
              w.description,
              DATE_FORMAT(w.start_date,'%d-%m-%Y') AS start_date,
              w.amount,
			        w.vacancy,
              w.start_time,
              w.end_time,
              c.name AS category_name,
              sc.sub_name AS subcategory_name,
              u.name AS user_name,
			        u.last_name AS user_last_name,
              l.id,
              l.level AS level_name
            FROM
              workshops AS w 
              INNER JOIN categories AS c 
                ON w.category_id = c.id
                INNER JOIN subcategories AS sc
                ON w.subcategory_id = sc.id
                 INNER JOIN users AS u
                 ON w.user_id = u.id
                  INNER JOIN level AS l
                  ON w.level_id = l.id
                WHERE w.user_id = $user_id
                 ";

      if(trim($q)!=''){
        //$q_clean = preg_replace('([^A-Za-z])', '', $q);
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }

    public function search_created_w_list_by_title($user_id,$page,$q,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_my_created_w_list($user_id,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql,array($user_id));
      return $query->result_array();
    }
  
    public function get_created_w_list_total_search($user_id,$q,$rp){
      $sql = $this->get_sql_my_created_w_list($user_id,$q);
      $query = $this->db->query($sql);
      $total = $query->num_rows();
      return ceil($total/$rp);
    }


    public function get_postulants_list($id){
      $sql = "SELECT 
        /*iu.id,*/
        iu.iu_status,
        u.id AS user_id,
        u.name AS user_name,
        u.last_name AS user_last_name,
        u.description AS user_description,
        u.email AS user_email,
        u.cell_phone AS user_cell_phone,
        u.student_rating,
        w.id AS w_id
      FROM
        inscribed_users AS iu 
        INNER JOIN users AS u 
          ON iu.user_id = u.id 
        INNER JOIN workshops AS w 
          ON iu.wrks_id = w.id
          WHERE w.id = ? ";

      $query = $this->db->query($sql,array($id));

      return $query->result_array();
  }

  public function validate_student($iu_id){
    $data=array(
      'iu_status'=> 'Confirmado'
    );
    return $this->db->update('inscribed_users', $data, array('id' => $iu_id));
  }

  public function cancel_student($iu_id){
    $data=array(
      'iu_status'=> 'No confirmado'
    );
    return $this->db->update('inscribed_users', $data, array('id' => $iu_id));
  }

  	public function get_students_list($id){
      $sql = "SELECT 
			  /*iu.id,*/
			  iu.iu_status,
        u.id AS user_id,
			  u.name AS user_name,
			  u.last_name AS user_last_name,
			  u.description AS user_description,
			  u.email AS user_email,
			  u.cell_phone AS user_cell_phone,
        u.student_rating,
			  w.id AS w_id
			FROM
			  inscribed_users AS iu 
			  INNER JOIN users AS u 
			    ON iu.user_id = u.id 
			  INNER JOIN workshops AS w 
			    ON iu.wrks_id = w.id
			    WHERE iu.iu_status = 'Confirmado'
          AND w.id = ? ";

      $query = $this->db->query($sql,array($id));

      return $query->result_array();
  }

//PARA OBETENER EL ID DE INSCRIBED USERS CON EL ID DEL USUARIO Y DEL TALLER
    public function get_student_info($user_id, $w_id){
      $sql = "SELECT
        iu.id AS iu_id,
        iu.iu_status,
        iu.student_rating AS iu_student_rating,
        iu.wrks_id,
        u.id,
        u.name,
        u.last_name,
        u.email,
        u.cell_phone,
        u.description,
        u.student_rating AS u_student_rating
      FROM
        inscribed_users AS iu
        INNER JOIN users AS u
         ON iu.user_id = u.id 
          WHERE iu.user_id = ?
          AND iu.wrks_id = ? ";

      $query = $this->db->query($sql,array($user_id, $w_id));

      return $query->row_array();
    }


    public function rate_student($dataform, $iu_id){
      $data=array(
        'student_rating'=> $dataform['puntaje']
      );
      return $this->db->update('inscribed_users', $data, array('id' => $iu_id));
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


    public function find_user_by_iu_id($iu_id){
      $sql = "SELECT
        iu.id AS iu_id,
        iu.user_id AS iu_user_id,
        iu.wrks_id AS iu_w_id
      FROM
        inscribed_users AS iu
          WHERE iu.id = ? ";

      $query = $this->db->query($sql,array($iu_id));

      return $query->row_array();
    }

    public function get_workshop_info($w_id){
      $sql = "SELECT
        w.id,
        w.title,
        w.vacancy,
        w.start_date
      FROM
        workshops AS w
      WHERE w.id = ? ";

      $query = $this->db->query($sql,array($w_id));

      return $query->row_array();
    }

    public function update_vacancy_number($id, $vacancy){
      $data=array(
        'vacancy'=>$vacancy
      );
      return $this->db->update('workshops', $data, array('id' => $id));
    }

}