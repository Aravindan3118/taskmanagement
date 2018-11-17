<?php
/**
 *
 */
class task_model extends CI_Model
{
  function fetch_type_data()
  {
    $this->db->select("*");
    $this->db->from("tast_type");
    $query = $this->db->get();
    return $query;
  }
  function fetch_task()
  {
    $this->db->select("*");
    $this->db->from("task_main");
    $query = $this->db->get();
    return $query;
  }
  function insert_task_data($data)
  {

       $this->db->insert("task_main", $data);
       //echo $this->db->last_query();
       //exit;
  }
}



 ?>
