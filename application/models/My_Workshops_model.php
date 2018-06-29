<?php
class My_Workshops_model extends CI_Model {

  	public function get_sql_my_works_list($user_id,$q){
      $sql = "SELECT
			  iu.iu_status,
			  iu.user_id AS inscribed_user,
			  iu.wrks_id,
        iu.student_rating,
			  w.id,
			  w.title,
			  w.start_date,
        w.start_time,
        w.end_time,
			  w.amount,
			  w.description,
			  c.name AS category_name,
			  sc.sub_name AS subcategory_name,
			  l.level AS level_name
          FROM
          inscribed_users AS iu
            INNER JOIN workshops AS w
            ON iu.wrks_id = w.id 
              INNER JOIN categories AS c 
              ON w.category_id = c.id
                INNER JOIN subcategories AS sc
                ON w.subcategory_id = sc.id
                  INNER JOIN level AS l
                  ON w.level_id = l.id
          WHERE iu.user_id = $user_id
                 ";

      if(trim($q)!=''){
        //$q_clean = preg_replace('([^A-Za-z])', '', $q);
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }

    public function search_my_works_by_title($user_id,$page,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }
      
      $sql = $this->get_sql_my_works_list($user_id,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql,array($user_id));
      return $query->result_array();
    }
  
    public function get_my_works_total_search($user_id,$q,$rp){
      $sql = $this->get_sql_my_works_list($user_id,$q);
      $query = $this->db->query($sql,array($user_id));
      $total = $query->num_rows();
      return ceil($total/$rp);
    }


  	public function get_teacher_list($id){
      $sql = "SELECT 
			  w.id AS w_id,
			  w.user_id AS w_user_id,
			  u.name AS name,
			  u.last_name AS last_name,
			  u.email,
			  u.cell_phone,
			  u.description,
        u.tutor_rating AS u_tutor_rating
			FROM
			  workshops AS w
			  INNER JOIN users AS u
			  ON w.`user_id`=u.`id`
			  WHERE w.id= ?";

      $query = $this->db->query($sql,array($id));

      return $query->row_array();
  }

    public function get_teacher_info($w_id,$iu_user_id){
      $sql = "SELECT
        iu.id iu_id,
        iu.tutor_rating,
        /*iu.user_id,*/
        w.id AS w_id,
        w.user_id AS w_user_id,
        u.name AS name,
        u.last_name AS last_name,
        u.email,
        u.cell_phone,
        u.description
      FROM
        inscribed_users AS iu
        INNER JOIN workshops AS w
        ON iu.wrks_id = w.id
         INNER JOIN users AS u
         ON w.user_id = u.id
      WHERE iu.wrks_id = ?
      AND iu.user_id = ?";

      $query = $this->db->query($sql,array($w_id, $iu_user_id));

      return $query->row_array();
    }


    public function rate_teacher($dataform, $iu_id){
      $data=array(
        'tutor_rating'=> $dataform['puntaje']
      );
      return $this->db->update('inscribed_users', $data, array('id' => $iu_id));
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

    public function insert_final_tutor_rating_to_users($user_id){
      $final_rating = $this->get_teacher_final_rating($user_id);
      $data=array(
        'tutor_rating'=> $final_rating
      );
      return $this->db->update('users', $data, array('id' => $user_id));
    }

    public function find_w_id_by_iu_id($iu_id){
      $sql = "SELECT
        iu.id AS iu_id,
        iu.user_id AS iu_user_id,
        iu.wrks_id AS iu_w_id,
        iu.tutor_rating AS iu_tutor_rating
      FROM
        inscribed_users AS iu
          WHERE iu.id = ? ";

      $query = $this->db->query($sql,array($iu_id));

      return $query->row_array();
    }


    public function find_user_by_w_id($w_id){
      $sql = "SELECT
        w.id AS w_id,
        w.user_id AS w_user_id
      FROM
        workshops AS w
          WHERE w.id = ? ";

      $query = $this->db->query($sql,array($w_id));

      return $query->row_array();
    }

    public function get_workshop_info($w_id){
      $sql = "SELECT
        w.id,
        w.title,
        w.user_id,
        w.vacancy,
        w.start_date
      FROM
        workshops AS w
      WHERE w.id = ? ";

      $query = $this->db->query($sql,array($w_id));

      return $query->row_array();
    }

    public function check_if_user_is_confirm_validation($w_id,$user_id){
      $sql = "SELECT
        iu.id,
        iu.iu_status,
        iu.wrks_id,
        iu.user_id
      FROM
        inscribed_users AS iu
      WHERE iu.wrks_id = ?
      AND iu.user_id = ?
      ";

      $query = $this->db->query($sql,array($w_id,$user_id));

      return $query->row_array();
    }

    public function check_if_workshop_id_exist($w_id){
      $sql = "SELECT
        w.id,
        w.title
      FROM
        workshops AS w
      WHERE w.id = ?
      ";

      $query = $this->db->query($sql,array($w_id));

      return $query->row_array();
    }

    public function get_info_by_iu($iu_id){
      $sql = "SELECT
        iu.id,
        iu.user_id AS iu_user_id,
        iu.wrks_id,
        iu.iu_status,
        w.id,
        w.user_id AS w_user_id
      FROM
        inscribed_users AS iu
        INNER JOIN workshops AS w
        ON iu.wrks_id = w.id
      WHERE iu.id = ?
      ";

      $query = $this->db->query($sql,array($iu_id));

      return $query->row_array();
    }

 }