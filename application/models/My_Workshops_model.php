<?php
class My_Workshops_model extends CI_Model {

	/*public function get_workshops_by_inscribed_user($user_id){
 
        $sql = "SELECT 
			  iu.iu_status,
			  iu.user_id AS inscribed_user,
			  iu.wrks_id,
			  w.id,
			  w.title,
			  w.start_date,
			  w.final_date,
			  w.amount,
			  w.description,
			  c.name AS category_name,
			  sc.sub_name AS subcategory_name,
			  l.level AS level_name
			FROM
			  inscribed_users AS iu 
			  INNER JOIN workshops AS w 
			    ON iu.`wrks_id` = w.`id`
			    INNER JOIN categories AS c
			    ON w.`category_id`=c.`id`
			     INNER JOIN subcategories AS sc
			     ON w.subcategory_id =sc.id
			       INNER JOIN level AS l
			       ON w.level_id = l.id
			WHERE iu.user_id = ? ";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->result_array();
  	}*/


  	public function get_sql_my_works_list($user_id,$q){
          $sql = "SELECT
			  iu.iu_status,
			  iu.user_id AS inscribed_user,
			  iu.wrks_id,
			  w.id,
			  w.title,
			  w.start_date,
			  w.final_date,
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
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }

    public function search_my_works_by_title($user_id,$page,$q,$rp){
      $offset = (($page-1)*$rp);
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
			  w.id,
			  w.user_id,
			  u.name AS name,
			  u.last_name AS last_name,
			  u.email,
			  u.cell_phone,
			  u.description
			FROM
			  workshops AS w
			  INNER JOIN users AS u
			  ON w.`user_id`=u.`id`
			  WHERE w.id= ?";

      $query = $this->db->query($sql,array($id));

      return $query->row_array();
      


  	
  }

 }