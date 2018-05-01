<?php
class Workshop_model extends CI_Model {

    public function get_list(){
        $sql = "SELECT 
        w.id,
        w.title,
        DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
        DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,        
        w.level,
        w.amount,
        w.description,
        c.name
      FROM
        workshops AS w
        INNER JOIN categories AS c
          ON w.`category_id` = c.`id` ;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }

    public function show_by_id($id){
 
        $sql = "SELECT
        w.id,
        w.title,
        DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
        DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
        w.level,
        w.amount,
        w.vacancy,
        w.description,
        /*w.wrks_status,*/
        c.name AS category_name,
        u.name AS user_name,
        u.last_name AS user_last_name
      FROM
        workshops AS w
        INNER JOIN categories AS c
          ON w.category_id = c.id
          INNER JOIN users AS u
            ON u.id = w.user_id
            WHERE w.`id` = ?
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
        'amount' => $dataform['monto'],
        'description' => $dataform['descripcion'],
        'vacancy' => $dataform['vacantes'],
        'wrks_status' => 'En Curso',
        'user_id'=> $dataform['s_iduser']

    );

    $this->db->insert('workshops', $data);

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
        workshops;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }





}
