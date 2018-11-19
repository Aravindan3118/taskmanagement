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
    $this->db->select("*,tast_type.task_type_name as 'tpn'");
    $this->db->from("task_main");
    $this->db->join('tast_type', 'task_main.task_type = tast_type.task_type_id');

    $query = $this->db->get();
    // echo $this->db->last_query();
    return $query;
  }
  function insert_task_data($data)
  {

       $this->db->insert("task_main", $data);
       $insert_id = $this->db->insert_id();
       return $insert_id;
       //echo $this->db->last_query();
       //exit;
  }
  function insert_file($data)
  {

       $this->db->insert("task_files", $data);



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
  public function update_task_data($data , $task_id){
    $this->db->where("task_id", $task_id);
    $this->db->update("task_main", $data);
  }
  public function fetch_task_name($taskname){
    $this->db->select("*");
    $this->db->from("task_main");
    $this->db->where('task_name',$taskname);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return true;
    }
    else{
      return false;
    }
  }

}



 ?>
