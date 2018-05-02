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

  public function create($dataform, $user_id){
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
        'user_id'=> $user_id

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


    public function enroll_workshop($user_id, $id){
    $data = array(
        'user_id'=> $user_id,
        'iu_status'=> 'Confirmado',
        'wrks_id'=> $id

    );

    $this->db->insert('inscribed_users', $data);

  }

  public function verify_enroll_user($id, $user_id){

                $sql = "SELECT 
                      w.id AS workshop_id,
                      u.id AS user_id
                    FROM
                      inscribed_users AS iu 
                      INNER JOIN users AS u 
                        ON iu.user_id = u.id
                      INNER JOIN workshops AS w 
                        ON iu.wrks_id = w.id 
                        WHERE w.id = ?";

        $query = $this->db->query($sql,array($id));
        
        return $query->row_array();


    

  }





}
