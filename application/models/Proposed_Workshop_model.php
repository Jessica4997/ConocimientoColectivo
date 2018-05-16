<?php
class Proposed_Workshop_model extends CI_Model {

    public function get_list(){
        $sql = "SELECT 
                  pw.id,
                  pw.title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
                  DATE_FORMAT(pw.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
                  pw.level,
                  pw.removed,
                  c.name,
                  sc.sub_name
                FROM
                  proposed_workshops AS pw 
                  INNER JOIN categories AS c 
                    ON pw.`category_id` = c.`id`
                    INNER JOIN subcategories AS sc
                    ON pw.`subcategory_id` = sc.`id`
                    WHERE pw.removed = 'Activo' ";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }


    public function show_by_id($id){
 
        $sql = "SELECT
                  pw.id,
                  pw.title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
                  DATE_FORMAT(pw.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
                  pw.level,
                  pw.votes_quantity,
                  pw.removed,
                  pw.user_id AS pw_user_id,
                  /*pw.pw_status,*/
                  c.name AS category_name,
                  sc.sub_name AS subcategory_name,
                  u.name AS user_name,
                  u.last_name AS user_last_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                            INNER JOIN users AS u
                              ON u.id = pw.user_id
                        WHERE pw.`id` = ?
                        LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

  public function create($dataform, $user_id){
    $data = array(
        'title' => $dataform['titulo'],
        'category_id' => $dataform['categoria'],
        'subcategory_id' => $dataform['sub_categoria'],
        'level' => $dataform['nivel'],
        'start_date' => $dataform['fecha_inicio'],
        'final_date' => $dataform['fecha_fin'],
        'description' => $dataform['descripcion'],
        'pw_status' => 'Activo',
        'removed' => 'Activo',
        'user_id'=> $user_id

    );

    $this->db->insert('proposed_workshops', $data);
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


    public function get_subcategories_list(){
        $sql = "SELECT 
            id,
            sub_name

      FROM
        subcategories
        WHERE removed = 'Activo';";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }


    public function get_level_list(){
        $sql = "SELECT 
           DISTINCT
            level

      FROM
        proposed_workshops;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }


    public function get_my_request_list($user_id){

        $sql = "SELECT 
                  pw.id,
                  pw.title AS title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
                  DATE_FORMAT(pw.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
                  pw.level,
                  
                  c.name AS category_name,
                  sc.sub_name AS subcategory_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                        WHERE pw.`user_id` = ? ";

        $query = $this->db->query($sql,array($user_id));

        return $query->result_array();
    }

    public function get_proposed_workshop_data($pw_id){

              $sql = "SELECT
                  pw.id AS pw_id,
                  pw.title AS pw_title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
                  DATE_FORMAT(pw.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
                  pw.level AS pw_level,
                  pw.removed AS removed,
                  pw.user_id AS pw_user_id,
                  /*pw.pw_status,*/
                  c.id AS category_id,
                  c.name AS category_name,
                  sc.id AS subcategory_id,
                  sc.sub_name AS subcategory_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                        WHERE pw.`id`= ? ";

        $query = $this->db->query($sql,array($pw_id));

        return $query->row_array();
    }


    public function open_workshop_request($dataform, $user_id){
      $id_data = $dataform['pw_id'];
        $data2 = $this->proposed_workshop_model->get_proposed_workshop_data($id_data);

        $data = array(
        'title' => $data2['pw_title'],
        'category_id' => $data2['category_id'],
        'subcategory_id' => $data2['subcategory_id'],
        'level' => $data2['pw_level'],
        'start_date' => $data2['start_date'],
        'final_date' => $data2['final_date'],
        'amount' => $dataform['monto'],
        'description' => $dataform['descripcion'],
        'vacancy' => $dataform['vacantes'],
        'wrks_status' => 'En Curso',
        'user_id'=> $user_id
    );
    $this->db->insert('workshops', $data);
    }


    public function remove_from_list($pw_id){
      $data = array(
        'removed' => 'Eliminado'
      );
      $this->db->update('proposed_workshops', $data, array('id' => $pw_id));
    }


    public function insert_into_votes($pw_id, $user_id){
        $data = array(
        'proposed_workshops_id' => $pw_id,
        'user_id' => $user_id
        
    );

    $this->db->insert('proposed_workshops_votes', $data); 
    }


    public function verify_user_vote($pw_id, $user_id){
      $this->db->select('proposed_workshops_id,user_id');
      $this->db->from('proposed_workshops_votes');
      $this->db->where('proposed_workshops_id',$pw_id);
      $this->db->where('user_id',$user_id);

      $query = $this->db->get();

      return $query->row_array(); 
  }


    public function get_votes_quantity($pw_id){
        $sql = "SELECT 
                  id,
                  votes_quantity 
            FROM
              proposed_workshops
              WHERE id = ?
              LIMIT 1";

        $query = $this->db->query($sql,array($pw_id));
        
        return $query->row_array();
    }


    public function update_votes_quantity($pw_id, $votes_q){
      $data=array(
        'votes_quantity'=>$votes_q
      );

    return $this->db->update('proposed_workshops', $data, array('id' => $pw_id));
    }
}
