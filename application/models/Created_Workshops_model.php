<?php
class Created_Workshops_model extends CI_Model {

	/*public function get_workshops_by_user($user_id){
 
        $sql = "SELECT 
			  w.id,
			  w.title,
			  DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
        	  DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
			  w.start_date,
			  w.final_date,
			  w.amount,
			  w.vacancy,
			  w.description,
			  c.name AS category_name,
			  u.name AS user_name,
			  u.last_name AS user_last_name ,
			  sc.sub_name AS subcategory_name,
			  l.level AS level_name
			FROM
			  workshops AS w 
			  INNER JOIN categories AS c 
			    ON w.category_id = c.id 
			  INNER JOIN users AS u 
			    ON u.id = w.user_id
			    INNER JOIN subcategories AS sc
			    ON w.subcategory_id = sc.id
			      INNER JOIN level AS l
			      ON w.level_id = l.id
			WHERE u.id = ? ";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->result_array();
  	}*/


  	public function get_sql_my_created_w_list($user_id,$q){
          $sql = "SELECT 
              w.id AS w_id,
              w.title,
              w.description,
              DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
              DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
              w.amount,
			  w.vacancy,
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


  	public function get_students_list($id){

  	$sql = "SELECT 
			  iu.id,
			  iu.iu_status,
			  u.`name` AS user_name,
			  u.`last_name` AS user_last_name,
			  u.`description` AS user_description,
			  u.`email` AS user_email,
			  u.`cell_phone` AS user_cell_phone,
			  w.id
			FROM
			  inscribed_users AS iu 
			  INNER JOIN users AS u 
			    ON iu.`user_id` = u.`id` 
			  INNER JOIN workshops AS w 
			    ON iu.`wrks_id` = w.`id`
			    WHERE w.`id`= ? ";

      $query = $this->db->query($sql,array($id));

      return $query->result_array();
      


  	
  }

 }