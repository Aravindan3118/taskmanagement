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
  public function fetch_edit_data($taskid)
  {
    $this->db->select("*, DATE_FORMAT(start_date, '%m/%d/%Y') as 'dfstart', DATE_FORMAT(end_date, '%m/%d/%Y') as 'dfend'");
    $this->db->from("task_main");
    $this->db->where("task_id",$taskid);
    $query = $this->db->get();
    // echo $this->db->last_query();
    return $query;
  }
  public function delete_task($taskid)
  {
    $this->db->where('task_id', $taskid);
    $this->db->delete('task_main');
  }
}



 ?>
