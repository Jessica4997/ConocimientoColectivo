<?php
class Created_Workshops_model extends CI_Model {

	    public function get_workshops_by_user($user_id){
 
        $sql = "SELECT 
			  w.id,
			  w.title,
			  DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
        	  DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
			  w.start_date,
			  w.final_date,
			  w.level,
			  w.amount,
			  w.vacancy,
			  w.description,
			  c.name AS category_name,
			  u.name AS user_name,
			  u.last_name AS user_last_name 
			FROM
			  workshops AS w 
			  INNER JOIN categories AS c 
			    ON w.category_id = c.id 
			  INNER JOIN users AS u 
			    ON u.id = w.user_id 
			WHERE u.id = ? ";

      $query = $this->db->query($sql,array($user_id));
      
      return $query->result_array();
  }

 }