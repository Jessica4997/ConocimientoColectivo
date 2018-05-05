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

    /*
 idl1  namel1          idl2  namel2   
------  ------------  ------  ---------
     1  Bailes             7  Bachata  
     1  Bailes             8  Salsa    
     2  Deportes           9  Fútbol  
     2  Deportes          10  Voley    
     3  Música        (NULL)  (NULL)   
     4  Teatro        (NULL)  (NULL)   
     5  Arte          (NULL)  (NULL)   
     6  Gastronomía   (NULL)  (NULL)   
     7  Bachata       (NULL)  (NULL)   
     8  Salsa         (NULL)  (NULL)   
     9  Fútbol        (NULL)  (NULL)   
    10  Voley         (NULL)  (NULL)   
                                       
    */
        $sql = "SELECT 
                  level1.`id` AS idl1,
                  level1.`name` AS namel1,
                  level2.`id` AS idl2,
                  level2.`name` AS namel2 
                FROM
                  categories AS level1 
                  LEFT JOIN categories AS level2 
                    ON level1.`id` = level2.`parent_id`";

        $query = $this->db->query($sql);
        
        $data = $query->result_array();

        $list = [];

        foreach ($data as $row) {
          if(!isset($list[$row['idl1']])){
            $list[$row['idl1']]=['id'=>$row['idl1'],'name'=>$row['namel1']];
          }
          if(!is_null($row['idl2'])){
            $list[$row['idl2']]=['id'=>$row['idl2'],'name'=>$row['namel1'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['namel2']];
          } 
        }

        return $list;
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

    $this->db->select('wrks_id,user_id');
    $this->db->from('inscribed_users');
    $this->db->where('wrks_id',$id);
    $this->db->where('user_id',$user_id);

    $query = $this->db->get();
        
    return $query->row_array(); 
  }


  public function check_user_creator($id){
    $sql = "SELECT 
              user_id 
            FROM
              workshops
              WHERE id = ?
              LIMIT 1";

        $query = $this->db->query($sql,array($id));
        
        return $query->row_array(); 
  }


  public function get_vacancy_number($id){
        $sql = "SELECT 
                  id,
                  vacancy 
            FROM
              workshops
              WHERE id = ?
              LIMIT 1";

        $query = $this->db->query($sql,array($id));
        
        return $query->row_array(); 
  }


  public function update_vacany_number($id, $vacancy){
    $data=array(
      'vacancy'=>$vacancy
    );

    return $this->db->update('workshops', $data, array('id' => $id));
  }


}
