<?php
class Workshop_model extends CI_Model {

    public function get_list(){
        $sql = "SELECT 
        w.id,
        w.title,
        w.start_date,
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
                w.description,
                c.name AS category_name
              FROM
                workshops AS w 
                INNER JOIN categories AS c 
                  ON w.`category_id` = c.`id` 
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
        'vacancy' => $dataform['vacantes'],
        'amount' => $dataform['monto'],
        'description' => $dataform['descripcion'],
    );

    $this->db->insert('Workshops', $data);

  }
}
