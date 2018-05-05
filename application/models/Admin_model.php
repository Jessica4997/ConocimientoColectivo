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
                gender
              FROM
                users";

        $query = $this->db->query($sql);
        
        return $query->result_array();
  }

}
