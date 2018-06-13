<?php
class Proposed_subcategories_model extends CI_Model {

    public function get_sql_search($category,$q){
          $sql = "SELECT 
              psc.id AS psc_id,
              psc.name AS psc_name,
              psc.description,
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
           	WHERE psc.removed = 'Activo' AND
            psc.status = 'Pendiente'
                 ";

      if(is_array($category) && count($category)>0){
        $cat_id = implode(",",$category);
        $sql.="AND c.id IN ({$cat_id}) ";
      }

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND psc.name LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY psc.id ";

      return $sql;
    }

    public function search_by_category_title($page,$category,$q,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_search($category,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql);
      return $query->result_array();
    }
  
    public function get_total_search($category,$q,$rp){
      $sql = $this->get_sql_search($category,$q);
      $query = $this->db->query($sql);
      $total = $query->num_rows();
      return ceil($total/$rp);
    }

    public function show_by_id($id){
 
        $sql = "SELECT
                  psc.id AS psc_id,
              	  psc.name AS psc_name,
              	  psc.description,
              	  psc.votes_quantity,
              	  psc.removed,
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
                WHERE psc.removed = 'Activo'
                AND psc.id = ?
                LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

  public function create($dataform, $user_id){
    $date = new DateTime($dataform['fecha_inicio']);
    $dateformat = $date->format('Y-m-d');

    $data = array(
        'name' => $dataform['nombre_subcategoria'],
        'category_id' => $dataform['categoria'],
        'description' => $dataform['descripcion'],
        'removed' => 'Activo',
        'status' => 'Pendiente',
        'user_id'=> $user_id
    );
    $this->db->insert('proposed_subcategories', $data);
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


    public function get_sql_my_request_list($user_id,$q){
          $sql = "SELECT 
              psc.id AS psc_id,
              psc.name AS psc_name,
              psc.description,
              psc.votes_quantity,
              c.id,
              c.name AS c_name,
              u.id AS u_id,
              u.name AS u_name
            FROM
              proposed_subcategories AS psc 
              INNER JOIN categories AS c 
              ON psc.category_id = c.id
                INNER JOIN users AS u
                ON psc.user_id = u.id
            WHERE psc.user_id = $user_id
                 ";

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND psc.name LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY psc.id ";

      return $sql;
    }

    public function search_request_list_by_title($user_id,$page,$q,$rp){
      $offset = (($page-1)*$rp);
      $sql = $this->get_sql_my_request_list($user_id,$q);
      $sql.=  " LIMIT {$rp} OFFSET {$offset}";
      $query = $this->db->query($sql,array($user_id));
      return $query->result_array();
    }
  
    public function get_request_list_total_search($user_id,$q,$rp){
      $sql = $this->get_sql_my_request_list($user_id,$q);
      $query = $this->db->query($sql);
      $total = $query->num_rows();
      return ceil($total/$rp);
    }


    public function insert_into_votes($psc_id, $user_id){
        $data = array(
        'proposed_subcategory_id' => $psc_id,
        'user_id' => $user_id
    );
    $this->db->insert('proposed_subcategories_votes', $data); 
    }


    public function verify_user_vote($psc_id, $user_id){
      $this->db->select('proposed_subcategory_id,user_id');
      $this->db->from('proposed_subcategories_votes');
      $this->db->where('proposed_subcategory_id',$psc_id);
      $this->db->where('user_id',$user_id);

      $query = $this->db->get();

      return $query->row_array(); 
  }


    public function get_votes_quantity($psc_id){
        $sql = "SELECT 
                  id,
                  votes_quantity 
            FROM
              proposed_subcategories
              WHERE id = ?
              LIMIT 1";

        $query = $this->db->query($sql,array($psc_id));
        
        return $query->row_array();
    }


    public function update_votes_quantity($psc_id, $votes_q){
      $data=array(
        'votes_quantity'=>$votes_q
      );
    return $this->db->update('proposed_subcategories', $data, array('id' => $psc_id));
    }
}