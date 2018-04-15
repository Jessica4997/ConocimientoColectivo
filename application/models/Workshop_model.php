<?php
class Workshop_model extends CI_Model {
    public function get_list(){
        $sql = "SELECT id,title, amount FROM workshops AS ws;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
}
