<?php
class Workshop_model extends CI_Model {

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
        w.user_id AS workshop_creator,
        /*w.wrks_status,*/
        c.name AS category_name,
        sc.id AS sc_id,
        sc.sub_name,
        u.name AS user_name,
        u.last_name AS user_last_name,
        l.level AS level_name,
        l.dificult AS dificult 
      FROM
        workshops AS w
        INNER JOIN categories AS c
          ON w.category_id = c.id
          INNER JOIN subcategories AS sc
            ON w.subcategory_id = sc.id
          INNER JOIN users AS u
            ON u.id = w.user_id
              INNER JOIN level AS l
              ON w.level_id = l.id
            WHERE w.`id` = ?
            LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
    }


  public function create($dataform, $user_id){
    $data = array(
        'title' => $dataform['titulo'],
        'category_id' => $dataform['categoria'],
        'subcategory_id' => $dataform['subcategoria'],
        'level_id' => $dataform['nivel'],
        'start_date' => $dataform['fecha_inicio'],
        'final_date' => $dataform['fecha_fin'],
        'amount' => $dataform['monto'],
        'description' => $dataform['descripcion'],
        'vacancy' => $dataform['vacantes'],
        'wrks_status' => 'En Curso',
        'removed' => 'Activo',
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

    public function get_subcategories_list(){
      $sql = "SELECT 
                id,
                sub_name,
                categories_id 
              FROM
                subcategories
                WHERE removed = 'Activo';";
              
      $query = $this->db->query($sql);
          
      return $query->result_array();
    }


    /*public function get_level_list(){
        $sql = "SELECT 
           DISTINCT
            level
      FROM
        workshops;";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }*/

    public function level_list(){
        $sql = "SELECT 
           id,
           level,
           dificult
      FROM
        level;";

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


    public function get_inscribed_workshops_by_user($user_id,$subcategory_id){
        $sql = "  SELECT 
                  iu.id,
                  iu.user_id,
                  iu.wrks_id,
                  l.dificult AS dificult
                FROM
                  inscribed_users AS iu 
                  INNER JOIN workshops AS w 
                    ON iu.wrks_id = w.id 
                  INNER JOIN LEVEL AS l 
                    ON w.level_id = l.id 
                WHERE iu.user_id = ? AND w.subcategory_id = ?
                ORDER BY l.dificult DESC";

        $query = $this->db->query($sql,array($user_id,$subcategory_id));
        
        return $query->row_array(); 
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

    public function get_sql_search($category,$q){
          $sql = "SELECT 
              w.id AS w_id,
              w.title,
              w.description,
              DATE_FORMAT(w.start_date,'%d-%m-%Y %l:%i %p') AS start_date,
              DATE_FORMAT(w.final_date,'%d-%m-%Y %l:%i %p') AS final_date,
              w.level,
              w.amount,
              w.removed,
              c.id,
              c.name,
              sc.sub_name,
              l.id AS level_id,
              l.level AS level_name

            FROM
              workshops AS w 
              INNER JOIN categories AS c 
                ON w.`category_id` = c.`id`
                INNER JOIN subcategories AS sc
                ON w.`subcategory_id` = sc.`id`
                  INNER JOIN level AS l
                  ON w.level_id = l.id
                WHERE w.removed = 'Activo'
                 ";

      if(is_array($category) && count($category)>0){
        $cat_id = implode(",",$category);
        $sql.="AND c.id IN ({$cat_id}) ";
      }

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND w.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY w.id ";

      return $sql;
    }
}
