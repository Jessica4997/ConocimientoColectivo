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
        c.name
      FROM
        proposed_workshops AS pw
        INNER JOIN categories AS c
          ON pw.`category_id` = c.`id`";

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
        /*pw.pw_status,*/
        c.name AS category_name,
        u.name AS user_name,
        u.last_name AS user_last_name
      FROM
        proposed_workshops AS pw
        INNER JOIN categories AS c
          ON pw.category_id = c.id
          INNER JOIN users AS u
            ON u.id = pw.user_id
            WHERE pw.`id` = 1
            LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

  public function create($dataform){
    $data = array(
        'title' => $dataform['titulo'],
        'category_id' => $dataform['categoria'],
        //'category_id' => $dataform['sub_categoria'],
        'level' => $dataform['nivel'],
        'start_date' => $dataform['fecha_inicio'],
        'final_date' => $dataform['fecha_fin'],
        'description' => $dataform['descripcion'],
        'pw_status' => 'Activo',
        'user_id'=>2

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

    public function get_level_list(){
        $sql = "SELECT 
           DISTINCT
            level

      FROM
        proposed_workshops;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }


}
