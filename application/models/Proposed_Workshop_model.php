<?php
class Proposed_Workshop_model extends CI_Model {

    public function get_sql_search($category,$q){
          $sql = "SELECT 
              pw.id AS pw_id,
              pw.title,
              pw.description,
              DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
              pw.removed,
              pw.start_time,
              pw.end_time,
              c.id,
              c.name,
              sc.sub_name,
              l.id,
              l.level AS level_name
            FROM
              proposed_workshops AS pw 
              INNER JOIN categories AS c 
                ON pw.`category_id` = c.`id`
                INNER JOIN subcategories AS sc
                ON pw.`subcategory_id` = sc.`id`
                  INNER JOIN level AS l
                  ON pw.level_id = l.id
                WHERE pw.removed = 'Activo'
                AND DATE_SUB(start_date, INTERVAL 7 DAY) > NOW()
                 ";

        if(is_array($category) && count($category)>0){
          $list_cat=array();
          foreach ($category as $row){
            if(is_numeric($row) && !is_null($row)){
              $list_cat[]=$row;
            }
          }
          if(count($list_cat)>0){
            //var_dump($list_cat);exit();
            $cat_id = implode(",",$list_cat);
            //var_dump($cat_id);exit();

            $cat_id = (isset($cat_id))? preg_replace('([^1-9,])', '', $cat_id):'';
            $sql.="AND c.id IN ({$cat_id}) ";
          }
        }


      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND pw.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY pw.id ";

      return $sql;
    }

    public function search_by_category_title($page,$category,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);

      if (is_int($offset)){
        if ($offset <= 0) {
          $offset = 0;
        }
      }else{
        $offset = 0;
      }
      

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
                  pw.id,
                  pw.title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
                  pw.start_time,
                  pw.end_time,
                  pw.votes_quantity,
                  pw.removed,
                  pw.user_id AS pw_user_id,
                  pw.votes_quantity,
                  c.name AS category_name,
                  sc.sub_name AS subcategory_name,
                  u.name AS user_name,
                  u.last_name AS user_last_name,
                  l.level AS level_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                            INNER JOIN users AS u
                              ON u.id = pw.user_id
                                INNER JOIN level AS l
                                ON pw.level_id = l.id
                        WHERE pw.`id` = ?
                        LIMIT 1";

      $query = $this->db->query($sql,array($id));
      
      return $query->row_array();
  }

  public function create($dataform, $category_id, $user_id){
    $date = new DateTime($dataform['fecha_inicio']);
    $dateformat = $date->format('Y-m-d');

    $data = array(
        'title' => $dataform['titulo'],
        'category_id' => $category_id,
        'subcategory_id' => $dataform['sub_categoria'],
        'level_id' => $dataform['nivel'],
        'start_date' => $dateformat,
        'start_time' => $dataform['hora_inicio'],
        'end_time' => $dataform['hora_fin'],
        'description' => $dataform['descripcion'],
        'pw_status' => 'Inactivo',
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
        categories
        WHERE removed = 'Activo';
        ";

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

    public function get_filter_subcategories_list($category_id){
        $sql = "SELECT 
            id,
            sub_name,
            categories_id
      FROM
        subcategories
        WHERE categories_id = ?
        AND removed = 'Activo';";

        $query = $this->db->query($sql,array($category_id));
        
        return $query->result_array();
    }

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


    public function get_sql_my_request_list($user_id,$q){
          $sql = "SELECT 
              pw.id AS pw_id,
              pw.title,
              pw.description,
              DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
              pw.start_time,
              pw.end_time,
              pw.votes_quantity,
              pw.pw_status,
              c.name AS category_name,
              sc.sub_name AS subcategory_name,
              l.id,
              l.level AS level_name
            FROM
              proposed_workshops AS pw 
              INNER JOIN categories AS c 
                ON pw.category_id = c.id
                INNER JOIN subcategories AS sc
                ON pw.subcategory_id = sc.id
                  INNER JOIN level AS l
                  ON pw.level_id = l.id
                WHERE pw.user_id = $user_id
                 ";

      if(trim($q)!=''){
        $q = trim($q);
        $sql.="AND pw.title LIKE '%{$q}%' ";
      }

      $sql.=" ORDER BY pw.id ";

      return $sql;
    }

    public function search_request_list_by_title($user_id,$page,$q,$rp){
      $page = preg_replace('([^1-9])', '', $page);
      if ($page === '') {
        $page = 1;
      }

      $offset = (($page-1)*$rp);
      if ($offset <= 0) {
        $offset = 0;
      }

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

    public function get_proposed_workshop_data($pw_id){

              $sql = "SELECT
                  pw.id AS pw_id,
                  pw.title AS pw_title,
                  pw.description,
                  DATE_FORMAT(pw.start_date,'%d-%m-%Y') AS start_date,
                  pw.start_time,
                  pw.end_time,
                  pw.removed AS removed,
                  pw.user_id AS pw_user_id,
                  pw.pw_status,
                  c.id AS category_id,
                  c.name AS category_name,
                  sc.id AS subcategory_id,
                  sc.sub_name AS subcategory_name,
                  l.id AS level_id,
                  l.level AS level_name
                FROM
                    proposed_workshops AS pw
                    INNER JOIN categories AS c
                      ON pw.category_id = c.id
                        INNER JOIN subcategories AS sc
                          ON pw.subcategory_id = sc.id
                            INNER JOIN level AS l
                            ON pw.level_id = l.id
                        WHERE pw.`id`= ? ";

        $query = $this->db->query($sql,array($pw_id));

        return $query->row_array();
    }


    public function open_workshop_request($dataform, $user_id){
      $id_data = $dataform['pw_id'];
      $data2 = $this->proposed_workshop_model->get_proposed_workshop_data($id_data);

      $date = new DateTime($data2['start_date']);
      $dateformat = $date->format('Y-m-d');

        $data = array(
        'title' => $data2['pw_title'],
        'category_id' => $data2['category_id'],
        'subcategory_id' => $data2['subcategory_id'],
        'level_id' => $data2['level_id'],
        'start_date' => $dateformat,
        'start_time' => $data2['start_time'],
        'end_time' => $data2['end_time'],
        'amount' => $dataform['monto'],
        'description' => $dataform['descripcion'],
        'vacancy' => $dataform['vacantes'],
        'removed' => 'Activo',
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

    public function change_status($pw_id){
      $data = array(
        'pw_status' => 'Aperturado'
      );
      $this->db->update('proposed_workshops', $data, array('id' => $pw_id));
    }

    public function get_pw_creator_email($id){
              $sql = "SELECT
                  id,
                  email
                FROM
                users
                WHERE id = ? ";

        $query = $this->db->query($sql,array($id));

        return $query->row_array();
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

    public function get_category_id_by_subcategory_id($subcategory_id){
      $sql = "SELECT 
        sc.id,
        sc.sub_name,
        sc.categories_id
      FROM
        subcategories AS sc 
          WHERE sc.id = ? ";

      $query = $this->db->query($sql,array($subcategory_id));

      return $query->row_array(); 
  }
}
